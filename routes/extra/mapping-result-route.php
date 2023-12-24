<?php

use App\Http\Controllers\MappingResultController;
use Illuminate\Support\Facades\Route;

Route::controller(MappingResultController::class)->group(function(){
    Route::get('mapping-result', 'index');
    Route::get('mapping-result/district/{id}', 'district');
    Route::get('mapping-result/village/{id}', 'village');
});
