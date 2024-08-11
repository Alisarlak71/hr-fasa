<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CompanyStatuses;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{

    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('dashboard.admin.companies')->with(['title' => 'مدیریت کاربران', 'companies' => Company::orderByDesc('id')->paginate(10)]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'nullable|string|min:5'
        ]);
        $company = new Company();
        $company->name = $request->input('name');
        $company->save();

        return new JsonResponse(['message' => 'created successfully', 'company' => $company]);
    }

    /**
     * @param Request $request
     * @param Company $company
     * @return JsonResponse
     */
    public function update(Request $request, Company $company): JsonResponse
    {
        $request->validate([
                'name' => 'nullable|string|min:5'
            ]
        );

        $company->name = $request->input('name')??$company->name;
        $company->save();

        return new JsonResponse(['message' => 'updated successfully', 'company' => $company]);
    }

    /**
     * @param Company $company
     * @return JsonResponse
     */
    public function toggleStatus(Company $company): JsonResponse
    {
        $company->status = ($company->status==CompanyStatuses::ACTIVATED?CompanyStatuses::DEACTIVATED:CompanyStatuses::ACTIVATED);
        $company->save();

        return new JsonResponse(['message' => 'company status updated successfully', 'company' => $company]);
    }

    /**
     * @param Company $company
     * @return Response
     */
    public function destroy(Company $company): Response
    {
        $company->delete();

        return response()->noContent();
    }
}
