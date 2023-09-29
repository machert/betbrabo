<?php

use App\Http\Controllers\Api;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Support\Facades\Route;
//use Tymon\JWTAuth\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact machert@github.com'], 404);
});

Route::prefix('groups')->group(function(){
    Route::get('/', [Api\GroupController::class, 'index'])->middleware('api')->name('groups.all');
    // Route::get('/', [Api\GroupController::class, 'index'])->name('groups.all');
    Route::get('/{id}', [Api\GroupController::class, 'show'])->name('groups.findById');
    Route::post('/', [Api\GroupController::class, "store"])->name('groups.post');
    Route::put('/{id}', [Api\GroupController::class, "update"])->name('groups.put');
    Route::delete('/{id}', [Api\GroupController::class, "destroy"])->name('groups.destroy');
});

Route::prefix('users')->group(function(){
    Route::get('/', [Api\UserController::class, 'index'])->name('users.all');
    Route::get('/{id}', [Api\UserController::class, 'show'])->name('users.findById');
    Route::post('/', [Api\UserController::class, "store"])->name('users.post');
    Route::put('/{id}', [Api\UserController::class, "update"])->name('users.put');
    Route::delete('/{id}', [Api\UserController::class, "destroy"])->name('users.destroy');
});

Route::prefix('users-groups')->group(function(){
    Route::get('/', [Api\UserGroupController::class, 'index'])->name('users-groups.all');
    Route::get('/{id}', [Api\UserGroupController::class, 'show'])->name('users-groups.findById');
    Route::post('/', [Api\UserGroupController::class, "store"])->name('users-groups.post');
    Route::put('/{id}', [Api\UserGroupController::class, "update"])->name('users-groups.put');
    Route::delete('/{id}', [Api\UserGroupController::class, "destroy"])->name('users-groups.destroy');

    
    Route::get('/findByUserId/{id}', [Api\UserGroupController::class, 'findByUserId'])->name('users-groups.findByUserId');
    Route::get('/findByGroupId/{id}', [Api\UserGroupController::class, 'findByGroupId'])->name('users-groups.findByGroupId');

});


Route::prefix('bets')->group(function(){
    Route::get('/', [Api\BetController::class, 'index'])->name('bets.all');
    Route::get('/{id}', [Api\BetController::class, 'show'])->name('bets.findById');
    Route::post('/', [Api\BetController::class, "store"])->name('bets.post');
    Route::put('/{id}', [Api\BetController::class, "update"])->name('bets.put');
    Route::delete('/{id}', [Api\BetController::class, "destroy"])->name('bets.destroy');

});

Route::prefix('bet-numbers')->group(function(){
    Route::get('/', [Api\BetNumberController::class, 'index'])->name('bet-numbers.all');
    Route::get('/{id}', [Api\BetNumberController::class, 'show'])->name('bet-numbers.findById');
    Route::post('/', [Api\BetNumberController::class, "store"])->name('bet-numbers.post');
    Route::put('/{id}', [Api\BetNumberController::class, "update"])->name('bet-numbers.put');
    Route::delete('/{id}', [Api\BetNumberController::class, "destroy"])->name('bet-numbers.destroy');

});


Route::prefix('bet-prizes')->group(function(){
    Route::get('/', [Api\BetPrizeController::class, 'index'])->name('bet-prizes.all');
    Route::get('/{id}', [Api\BetPrizeController::class, 'show'])->name('bet-prizes.findById');
    Route::post('/', [Api\BetPrizeController::class, "store"])->name('bet-prizes.post');
    Route::put('/{id}', [Api\BetPrizeController::class, "update"])->name('bet-prizes.put');
    Route::delete('/{id}', [Api\BetPrizeController::class, "destroy"])->name('bet-prizes.destroy');

});


Route::prefix('bettors')->group(function(){
    Route::get('/', [Api\BettorController::class, 'index'])->name('bettors.all');
    Route::get('/{id}', [Api\BettorController::class, 'show'])->name('bettors.findById');
    Route::post('/', [Api\BettorController::class, "store"])->name('bettors.post');
    Route::put('/{id}', [Api\BettorController::class, "update"])->name('bettors.put');
    Route::delete('/{id}', [Api\BettorController::class, "destroy"])->name('bettors.destroy');

});

Route::prefix('bettor-numbers')->group(function(){
    Route::get('/', [Api\BettorNumberController::class, 'index'])->name('bettor-numbers.all');
    Route::get('/{id}', [Api\BettorNumberController::class, 'show'])->name('bettor-numbers.findById');
    Route::post('/', [Api\BettorNumberController::class, "store"])->name('bettor-numbers.post');
    Route::put('/{id}', [Api\BettorNumberController::class, "update"])->name('bettor-numbers.put');
    Route::delete('/{id}', [Api\BettorNumberController::class, "destroy"])->name('bettor-numbers.destroy');

});

Route::controller(Api\AuthController::class)->group(function () {
    Route::get('login', 'sessionExpired')->name('sessionExpired');
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout');
    Route::post('me', 'me')->name('me');
    Route::post('refresh', 'refresh')->name('refresh');
});