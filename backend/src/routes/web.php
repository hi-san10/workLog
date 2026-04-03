<?php

use App\Http\Controllers\ContractorController;
use App\Http\Controllers\MakerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorkReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WorkReportController::class, 'index']);

Route::post('workReport', [WorkReportController::class, 'store']);

Route::get('registerTop', [ContractorController::class, 'index']);

Route::post('contractor', [ContractorController::class, 'store']);

Route::post('maker', [MakerController::class, 'store']);

Route::post('task', [TaskController::class, 'store']);

Route::get('paymentTop', [PaymentController::class, 'index']);

Route::post('payment/store', [PaymentController::class, 'store']);
