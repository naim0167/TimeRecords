<?php


use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TimeRecordController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/time_records', [TimeRecordController::class, 'index'])->name('time_records');
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
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('/projects/create', [ProjectController::class, 'create']);
    Route::post('/projects/store', [ProjectController::class, 'store']);

    /**
     * Reports Routes
     */
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/person', [ReportController::class, 'person']);
    Route::get('/reports/person/{id}/show', [ReportController::class, 'personReport']);
    Route::get('/reports/daily', [ReportController::class, 'daily']);
    Route::get('/reports/monthly', [ReportController::class, 'monthly']);
    Route::get('/reports/download', [ReportController::class, 'download']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
