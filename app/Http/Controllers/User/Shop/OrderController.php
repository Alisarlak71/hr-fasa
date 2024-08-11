<?php

namespace App\Http\Controllers\User\Shop;

use App\Enums\OrderStatuses;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\FilterService;
use App\Services\Shop\OrderManager;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class OrderController extends Controller
{
    protected FilterService $filterService;

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $request->validate([
            'filters' => 'nullable|array',
            'filters.status' => ['nullable',OrderStatuses::validation()],
            'filters.created_at.operator' => ['nullable'],
        ]);

        $filters = $request->input('filters', []);
        $sorts = $request->input('sorts', []);

        $orders = $this->filterService->apply(Order::query(), $filters, $sorts)->whereUserId(Auth::id())->paginate(10);

        return view('dashboard.user.orders.index')->with(['title' => 'سفارش ها',
            'orders' => $orders]);
    }


    /**
     * @param OrderManager $om
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(OrderManager $om): JsonResponse
    {
        $order = $om->create();
        return new JsonResponse(['message' => 'سفارش با موفقیت ایجاد شد', 'order' => $order]);
    }

    public function show(Order $order): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('dashboard.user.orders.show')->with(['title' => 'سفارش شماره :' . $order->id,
            'order' => $order->load('items')]);
    }

    /**
     * @param Order $order
     * @return JsonResponse
     * @throws HttpException
     */
    public function cancel(Order $order): JsonResponse
    {
        if ($order->status != OrderStatuses::WAIT_FOR_PAYMENT) {
            throw new HttpException(403, 'امکان تغییر این سفارش وجود ندارد!');
        }

        $order->status = OrderStatuses::CANCELED;
        $order->save();

        return new JsonResponse(['message' => 'سفارش با موفقیت لغو شد!']);
    }
}
