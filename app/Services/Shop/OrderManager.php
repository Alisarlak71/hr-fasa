<?php

namespace App\Services\Shop;


use App\Enums\OrderStatuses;
use App\Models\Card;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class OrderManager
{
    /**
     * @throws Throwable
     */
    public function create(): Order
    {
        $cards = Card::whereUserId(Auth::id())->get();
        if ($cards->count() > 0) {
            $order = new Order();
            try {
                DB::beginTransaction();

                $order->user_id = Auth::id();
                $order->total_price = 0;
                $order->total_price_after_discount = 0;
                $order->status = OrderStatuses::WAIT_FOR_PAYMENT;
                $order->save();

                foreach ($cards as $card) {
                    $orderItem = new OrderItem();
                    $orderItem->orderable()->associate($card->orderable);
                    $orderItem->order_id = $order->id;
                    $orderItem->unit_price = $card->orderable->price;
                    $orderItem->total_price = $card->count * $card->orderable->price;
                    $orderItem->total_price_after_discount = $card->count * $card->orderable->price;
                    $orderItem->count = $card->count;
                    $orderItem->save();

                    $order->total_price += $orderItem->total_price;
                    $order->total_price_after_discount += $orderItem->total_price_after_discount;
                }

                $order->save();
                Card::whereUserId(Auth::id())->delete();

                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                throw new HttpException(500, $e->getMessage());
            }
            return $order;
        } else {
            throw new HttpException(403, 'سبد خرید خالی است!',);
        }

    }
}
