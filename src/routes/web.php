<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Jobs\FailedJobController;
use App\Http\Controllers\SelectDatabaseController;
use App\Http\Controllers\TableController;
use App\Http\Middleware\EnsureDatabaseSelected;
use App\Http\Middleware\SetDynamicDatabaseConnection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/health', function (Request $request){
    try {
        // Check database connection
        DB::connection()->getPdo();
        return response()->json(['status' => 'ok'], 200);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
});

Route::middleware('guest')->group(function (){
    Route::get('login',[LoginController::class,'login'])->name('login');
    Route::post('login',[LoginController::class,'store'])->name('loginStore');
});

Route::middleware(['auth',EnsureDatabaseSelected::class,SetDynamicDatabaseConnection::class])->group(function (){
    Route::get('home',[HomeController::class,'index'])->name('home');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/select-database', [SelectDatabaseController::class, 'show'])
        ->name('select-db')
        ->withoutMiddleware(EnsureDatabaseSelected::class);
    Route::post('/select-database', [SelectDatabaseController::class, 'store'])
        ->name('select-db.store')
        ->withoutMiddleware(EnsureDatabaseSelected::class);

    Route::get('/tables',[TableController::class,'index'])->name('tableIndex');
    Route::get('/tables/{table}/show',[TableController::class,'show'])->name('tableShow');

    Route::prefix('failed-jobs')->name('failed-jobs.')->group(function () {
        Route::get('/', [FailedJobController::class, 'index'])->name('index');
        Route::post('/retry/{id}', [FailedJobController::class, 'retry'])->name('retry');
        Route::get('/retry-all', [FailedJobController::class, 'retryAll'])->name('retry-all');
        Route::delete('/delete-all', [FailedJobController::class, 'destroyAll'])->name('destroy-all');
        Route::delete('/delete/{id}', [FailedJobController::class, 'destroy'])->name('destroy');
    });
});
