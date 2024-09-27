<?php

use Illuminate\Support\Facades\Route;

// Example route
Route::get('/example', function () {
    return response()->json(['message' => 'API route is working!']);
});
