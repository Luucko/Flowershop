<?php

use App\Http\Controllers\BouquetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/bouquets", [BouquetController::class, "allBouquets"]);
Route::post("/purchases", [BouquetController::class, "addPurchase"]);
