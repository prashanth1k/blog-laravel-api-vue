<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/test", function () {
    return response()->json(["message" => "Hello World!"]);
});

Route::apiResource("posts", PostController::class);



// Route::post("/register", [AuthController::class, "register"]);
// Route::post("/login", [AuthController::class, "login"]);
// Route::post("/logout", [AuthController::class, "logout"]);
