<?php

namespace App\Http\Controllers\User\Shop;

use App\Enums\OrderableTypes;
use App\Http\Controllers\Controller;
use App\Services\Shop\CardManager;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CardController extends Controller
{
    /**
     * @param Request $request
     * @param CardManager $cm
     * @return JsonResponse
     */
    public function store(Request $request , CardManager $cm): JsonResponse
    {
        $type = $request->input('type');

        $request->validate([
            'type' => ['required' , OrderableTypes::validation()],
            'id' => ['required', ($type == 'product' ? 'exists:products,id' : 'exists:subscriptions,id')],
            'count' => 'required|numeric|max:1'
        ]);

        $card = $cm->add($request->all());

        return new JsonResponse(['message' => 'با موفقیت به سبد خرید اضافه شد!']);
    }

    /**
     * @param Request $request
     * @param CardManager $cm
     * @return JsonResponse
     * @throws HttpException
     */
    public function remove(Request $request, CardManager $cm): JsonResponse
    {
        $type = $request->input('type');

        $request->validate([
            'type' => ['required', OrderableTypes::validation()],
            'id' => ['required', ($type == 'product' ? 'exists:products,id' : 'exists:subscriptions,id')],
            'count' => 'required|numeric|max:1'
        ]);

        $cm->remove($request->all());

        return new JsonResponse(['message' => 'با موفقیت از سبد خرید حذف شد!']);
    }
}
