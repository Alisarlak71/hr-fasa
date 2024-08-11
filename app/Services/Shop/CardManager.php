<?php

namespace App\Services\Shop;


use App\Models\Card;
use App\Models\Product;
use App\Models\Subscription;
use Auth;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CardManager
{
    /**
     * @param $data
     * @return Card|null
     */
    public function add($data): Card|null
    {
        $type = ($data['type'] === 'product' ? Product::class : Subscription::class);

        $card = Card::whereUserId(Auth::id())->whereOrderableType($type)->whereOrderableId($data['id'])->first();
        if ($card) {
            $card->count += $data['count'];
        } else {
            $card = new Card();
            $card->orderable_id = $data['id'];
            $card->orderable_type = ($data['type'] == 'product' ? Product::class : Subscription::class);
            $card->user_id = Auth::id();
            $card->count = $data['count'];
        }

        $card->save();
        return $card;
    }

    /**
     * @throws HttpException
     */
    public function remove($data): void
    {
        $type = ($data['type'] === 'product' ? Product::class : Subscription::class);

        $card = Card::whereUserId(Auth::id())->whereOrderableType($type)->whereOrderableId($data['id'])->first();

        if ($card && $card->count > $data['count']) {
            $card->count -= $data['count'];
            $card->save();
        } else if ($card && $card->count == $data['count']) {
            $card->delete();
        } else {
            throw new HttpException(403,'تعداد وارد شده بیشتر از تعداد موجود در سبد است');
        }
    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        $cardItems = Card::whereUserId(Auth::id())->get();
        $total_price = 0;
        $total_count = 0;
        $collection = new Collection();
        $collection->put('items', $cardItems);

        foreach ($cardItems as $cardItem) {
            $total_price += $cardItem->orderable->price * $cardItem->count;
            $total_count += $cardItem->count;
        }

        $collection->put('total_price', $total_price);
        $collection->put('total_count', $total_count);

        return $collection;
    }
}
