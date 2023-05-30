<?php

use App\Http\Controllers\BouquetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/flowers", [BouquetController::class, "allBouquets"]);
Route::post("/orders", [BouquetController::class, "addPurchase"]);
