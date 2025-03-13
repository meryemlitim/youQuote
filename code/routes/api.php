<?php

use App\Http\Controllers\QuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/',function(){
    return'hi';
});  

Route::apiResource('quote',QuoteController::class);
Route::get('random', [QuoteController::class, 'randomQuote']);
Route::get('search/{length}', [QuoteController::class, 'searchQuote']);
Route::get('popular', [QuoteController::class, 'popularQuote']);
