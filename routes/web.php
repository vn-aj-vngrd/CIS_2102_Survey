<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('app');
// });

Route::post('create', [SurveyController::class, 'create']);
Route::get('index', [SurveyController::class, 'index']);
Route::get('getQuestions/{id}', [SurveyController::class, 'getQuestions']);
Route::get('getSurveyInfo/{id}', [SurveyController::class, 'getSurveyInfo']);
Route::get('getData/{id}', [SurveyController::class, 'getData']);
Route::post('delete/{id}', [SurveyController::class, 'delete']);
Route::post('update', [SurveyController::class, 'update']);

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
