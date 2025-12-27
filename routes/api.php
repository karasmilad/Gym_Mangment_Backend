<?php

use App\Http\Controllers\MembersController;
use App\Http\Controllers\TrainersController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working'
    ]);
});
Route::apiResource('member', MembersController::class);
Route::apiResource('trainer', TrainersController::class);
?>