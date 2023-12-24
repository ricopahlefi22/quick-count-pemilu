<?php

use App\Http\Controllers\MappingVoterController;
use Illuminate\Support\Facades\Route;

Route::controller(MappingVoterController::class)->group(function(){
    Route::get('mapping-voters', 'index');
    Route::get('mapping-voters/district/{id}', 'district');
    Route::get('mapping-voters/village/{id}', 'village');
});
