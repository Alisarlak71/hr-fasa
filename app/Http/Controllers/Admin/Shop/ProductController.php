<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Enums\ProductType;
use App\Enums\PublishStatuses;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\File\FileManager;
use App\Services\FilterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    protected FilterService $filterService;

    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $filters = $request->input('filters', []);
        $sorts = $request->input('sorts', []);

        $products = $this->filterService->apply(Product::query()->with(['image', 'category']), $filters, $sorts)->paginate(10);

        return view('dashboard.admin.products.index')->with(['title' => 'لیست محصولات', 'products' => $products]);
    }

    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('dashboard.admin.products.create')->with(['title' => 'افزودن محصول', 'categories' => Category::all()]);
    }

    public function edit(Product $product): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('dashboard.admin.products.edit')->with(['title' => 'ویرایش محصول', 'product' => $product->load('image'),'categories' => Category::all()]);
    }

    /**
     * @param Request $request
     * @param FileManager $fm
     * @return JsonResponse
     */
    public function store(Request $request, FileManager $fm): JsonResponse
    {
        $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'type' => ['required', ProductType::validation()],
            'status' => ['required', PublishStatuses::validation()],
            'image_id' => 'required|exists:files,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        $image_id = $request->input('image_id');

        $product = new Product();
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->short_description = $request->input('description');
        $product->type = $request->input('type');
        $product->status = $request->input('status');
        $product->image_id = $image_id;
        $product->category_id = $request->input('category_id');
        $product->save();

        $fm->attachFile('products', $product->id, [0 => ['id' => (int)$image_id]]);

        return new JsonResponse(['message' => 'باموفقیت ایجاد شد!', 'product' => $product]);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param FileManager $fm
     * @return JsonResponse
     */
    public function update(Request $request, Product $product, FileManager $fm): JsonResponse
    {
        $request->validate([
            'title' => 'nullable|string',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'type' => ['nullable', ProductType::validation()],
            'status' => ['nullable', PublishStatuses::validation()],
            'image_id' => 'nullable|exists:files,id',
            'category_id' => 'nullable|exists:categories,id',]);

        $image_id = $request->input('image_id');

        $product->title = $request->input('title')??$product->title ;
        $product->price = $request->input('price')??$product->title ;
        $product->short_description = $request->input('description')??$product->title ;
        $product->type = $request->input('type')??$product->title ;
        $product->status = $request->input('status')??$product->title ;
        $product->image_id = $image_id ?? $product->image_id;
        $product->category_id = $request->input('category_id');
        $product->save();

        if(!empty($request->input('image_id'))){
            $fm->attachFile('products', $product->id, [0 => ['id' => (int)$image_id]]);
        }

        return new JsonResponse(['message'=>'محصول با موفقیت ']);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return new JsonResponse(['message' => 'محصول با موفقیت حذف شد']);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function publish(Product $product): JsonResponse
    {
        $product->status = PublishStatuses::PUBLISHED;
        $product->save();

        return new JsonResponse(['message' => 'محصول با موفقیت منتشر شد']);
    }
}
