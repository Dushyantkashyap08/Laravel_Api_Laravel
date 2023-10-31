<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/form-submit',[ApiController::class,'form_submit']);
Route::get('/display-form',[ApiController::class,'display_form']);
Route::delete('/delete-data/{id}',[ApiController::class,'delete_data']);
// Route::get('/fetch-data/{id}',[ApiController::class,'fetch_data']);//display the record you want to edit
// Route::put('/edit-data/{id}',[ApiController::class,'edit_data']);//edit the displayed record

//another method to update the record
Route::put('/update-record',[ApiController::class,'UpdateRecord']);

//search for records
Route::put('/search-record/{search}',[ApiController::class,'SearchRecord']);

//file upload
Route::post('/file-upload',[ApiController::class,'FileUpload']);

//carbon function
Route::get('/carbon',[ApiController::class,'Carbon_function']);