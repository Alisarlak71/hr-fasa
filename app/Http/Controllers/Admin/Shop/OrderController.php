<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Enums\OrderStatuses;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\FilterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected FilterService $filterService;

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    /**
     * @param Request $request
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $request->validate([
            'filters' => 'nullable|array',
            'filters.status' => ['nullable', OrderStatuses::validation()],
            'filters.created_at.operator' => ['nullable'],
        ]);

        $filters = $request->input('filters', []);
        $sorts = $request->input('sorts', []);

        $orders = $this->filterService->apply(Order::query(), $filters, $sorts)->paginate(10);

        return view('dashboard.admin.orders.index')->with(['title' => 'سفارش ها',
            'orders' => $orders]);
    }

    /**
     * @param Order $order
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function show(Order $order): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('dashboard.admin.orders.show')->with(['title' => 'سفارش شماره :' . $order->id,
            'order' => $order->load('items')]);
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return JsonResponse
     */
    public function update(Request $request, Order $order): JsonResponse
    {
        $request->validate([
                'status' => ['required', OrderStatuses::validation()]
            ]
        );

        $order->status = $request->input('status');
        $order->save();

        return new JsonResponse(['message' => 'سفارش با موفقیت تغییر کرد!']);
    }
}
