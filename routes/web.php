<?php

use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserInformationController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\UserVerifyMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
})->name('index');

Route::get('/login', function () {
    if (!Auth::check())
        return view('dashboard.auth');
    return redirect()->route('profile.index');
})->name('login');

Route::post('/auth/otp/request', [OtpController::class, 'request']);
Route::post('/auth/otp/submit', [OtpController::class, 'submit']);

Route::middleware(AuthMiddleware::class)->group(function () {

    Route::prefix('/informations')->group(function () {
        Route::get('/', [UserInformationController::class, 'index'])->name('informations.index');
        Route::post('/verify/request', [UserInformationController::class, 'requestVerify'])->name('informations.request.store');
        Route::put('/verify/request/{user_verification_request}',
            [UserInformationController::class, 'updateRequestVerify'])->name('informations.request.update')
            ->middleware('can:update,user_verification_request');
    });
    Route::get('/logout', [LogoutController::class, 'logout']);

    Route::get('user/documents', [UserInformationController::class, 'index'])->name('user.documents');
    Route::post('user/documents', [UserInformationController::class, 'upload']);
    Route::post('user/docs/del_doc_img/{id}', [UserInformationController::class, 'delImag']);
    Route::get('/sign_ins', [ProfileController::class, 'signIns']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/change_photo', [ProfileController::class, 'changePhoto']);
    Route::put('/profile/submit', [ProfileController::class, 'confirmUpdate']);

    Route::get('/account_number', [\App\Http\Controllers\User\accountNumber::class, 'index']);
    Route::post('/add_account', [\App\Http\Controllers\User\accountNumber::class, 'add_account']);

    Route::get('storage/{filename}', function ($filename) {
        $path = storage_path('uploads/docs/' . auth()->id() . '/' . $filename);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    });
});
//auth()->loginUsingId(57);
Route::prefix('/admin')->middleware(AdminAuthMiddleware::class)->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.transactions.index');
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::post('/', [AdminUserController::class, 'create']);
        Route::get('/account_number', [\App\Http\Controllers\User\accountNumber::class, 'accountNumber']);
        Route::post('/account_number/doEdit', [\App\Http\Controllers\User\accountNumber::class, 'changeDoEdit']);
        Route::get('/documents', [\App\Http\Controllers\User\UserInformationController::class, 'adShow']);
        Route::get('account_number/export', [\App\Http\Controllers\User\accountNumber::class, 'fileExport']);
        Route::put('/{user}', [AdminUserController::class, 'update']);
        Route::get('/{user}/toggle_status', [AdminUserController::class, 'toggleStatus']);
        Route::delete('/{user}', [AdminUserController::class, 'destroy']);
    });

    Route::prefix('/companies')->group(function () {
        Route::get('/', [AdminCompanyController::class, 'index']);
        Route::post('/', [AdminCompanyController::class, 'create']);
        Route::put('/{company}', [AdminCompanyController::class, 'update']);
        Route::get('/{company}/toggle_status', [AdminCompanyController::class, 'toggleStatus']);
        Route::delete('/{company}', [AdminCompanyController::class, 'destroy']);
    });

});
