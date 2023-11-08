<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TimeRecordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Time Records Routes
 */

Route::get('/', [TimeRecordController::class, 'index']);
Route::get('time_records/create', [TimeRecordController::class, 'create']);
Route::post('time_records/store', [TimeRecordController::class, 'store']);
Route::get('time_records/{id}/edit', [TimeRecordController::class, 'edit']);
Route::put('time_records/{id}/update', [TimeRecordController::class, 'update']);
Route::get('time_records/{id}/show', [TimeRecordController::class, 'show']);
Route::delete('time_records/{id}/delete', [TimeRecordController::class, 'destroy']);

/**
 * Project Routes
 * 
 */
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/create', [ProjectController::class, 'create']);
Route::post('/projects/store', [ProjectController::class, 'store']);

/**
 * Reports Routes
 */
Route::get('/reports', [ReportController::class, 'index']);
Route::get('/reports/daily', [ReportController::class, 'daily']);
Route::get('/reports/monthly', [ReportController::class, 'monthly']);
Route::get('/reports/download', [ReportController::class, 'download']);
