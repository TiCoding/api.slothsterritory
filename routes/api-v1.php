<?php

use App\Http\Controllers\Api\AgencyController;
use App\Http\Controllers\Api\AgencyDataController;
use App\Http\Controllers\Api\AgencyTourController;
use App\Http\Controllers\Api\CommissionController;
use App\Http\Controllers\Api\CustomDateController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CustomPriceController;
use App\Http\Controllers\Api\CustomScheduleController;
use App\Http\Controllers\Api\FeeController;
use App\Http\Controllers\Api\GuideController;
use App\Http\Controllers\Api\GuideStatusController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\PaymentStatusController;
use App\Http\Controllers\Api\PaymentTypeController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ReservationStatusController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Api\TourGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [RegisterController::class, 'store'])->name('api.v1.register');

// Route::get('agencies', [AgencyController::class, 'index'])->name('api.v1.agencies.index');
// Route::post('agencies', [AgencyController::class, 'store'])->name('api.v1.agencies.store');
// Route::get('agencies/{agency}', [AgencyController::class, 'show'])->name('api.v1.agencies.show');
// Route::put('agencies/{agency}', [AgencyController::class, 'update'])->name('api.v1.agencies.update');
// Route::delete('agencies/{agency}', [AgencyController::class, 'destroy'])->name('api.v1.agencies.destroy');

Route::apiResource('agencies', AgencyController::class)->names('api.v1.agencies');
Route::apiResource('agency-data', AgencyDataController::class)->names('api.v1.agency-data');
Route::apiResource('agency-tours', AgencyTourController::class)->names('api.v1.agency-tours');
Route::apiResource('commissions', CommissionController::class)->names('api.v1.commissions');
Route::apiResource('custom-dates', CustomDateController::class)->names('api.v1.custom-dates');
Route::apiResource('customers', CustomerController::class)->names('api.v1.customers');
Route::apiResource('custom-prices', CustomPriceController::class)->names('api.v1.custom-prices');
Route::apiResource('custom-schedules', CustomScheduleController::class)->names('api.v1.custom-schedules');
Route::apiResource('fees', FeeController::class)->names('api.v1.fees');
Route::apiResource('guides', GuideController::class)->names('api.v1.guides');
Route::apiResource('guide-statuses', GuideStatusController::class)->names('api.v1.guide-statuses');
Route::apiResource('payments', PaymentController::class)->names('api.v1.payments');
Route::apiResource('payment-methods', PaymentMethodController::class)->names('api.v1.payment-methods');
Route::apiResource('payment-statuses', PaymentStatusController::class)->names('api.v1.payment-statuses');
Route::apiResource('payment-types', PaymentTypeController::class)->names('api.v1.payment-types');
Route::apiResource('reservations', ReservationController::class)->names('api.v1.reservations');
Route::apiResource('reservation-statuses', ReservationStatusController::class)->names('api.v1.reservation-statuses');
Route::apiResource('roles', RoleController::class)->names('api.v1.roles');
Route::apiResource('schedules', ScheduleController::class)->names('api.v1.schedules');
Route::apiResource('tours', TourController::class)->names('api.v1.tours');
Route::apiResource('tour-groups', TourGroupController::class)->names('api.v1.tour-groups');

