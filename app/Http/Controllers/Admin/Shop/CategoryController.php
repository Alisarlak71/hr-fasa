<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Enums\OrderStatuses;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Services\FilterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected FilterService $filterService;

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|min:4'
        ]);

        $category = new Category();
        $category->title = $request->input('name');
        $category->save();

        return new JsonResponse(['message' => 'دسته بندی با موفقیت اضافه شد', 'category' => $category]);
    }
}
