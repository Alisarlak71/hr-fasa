<?php

namespace App\Http\Controllers\User\Shop;

use App\Enums\ProductType;
use App\Enums\PublishStatuses;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ShopController extends Controller
{

    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('dashboard.user.shop')->with([
            'title' => 'فروشگاه',
            'products' => Product::whereType(ProductType::COMMODITY)->whereStatus(PublishStatuses::PUBLISHED)
                ->orderByDesc('created_at')->get(),
            'services' => Product::whereType(ProductType::SERVICE)->whereStatus(PublishStatuses::PUBLISHED)
                ->orderByDesc('created_at')->get(),
            'subscriptions' => Subscription::whereStatus(PublishStatuses::PUBLISHED)
                ->orderByDesc('created_at')->get()]);
    }
}
