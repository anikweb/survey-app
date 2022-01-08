<?php

use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ResultSuggestionController;
use Illuminate\Support\Facades\Route;
use illuminate\Support\Facades\Auth;

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

Route::get('/',[FrontendController::class,'index'])->name('frontend');
Route::get('/social-test/{slug}',[FrontendController::class,'showQuestion'])->name('frontend.question.show');
Route::post('/survey/store',[FrontendController::class,'storeQuestion'])->name('frontend.question.store');
Route::get('/{slug}/results-suggestions',[FrontendController::class,'submitQuestion'])->name('frontend.question.submit');
Route::get('/{slug}/global-statistics',[FrontendController::class,'globalStatistics'])->name('frontend.global.statistics');
// Route::get('/survey/global/statistics/{id}',[FrontendController::class,'countryStatistics'])->name('frontend.country.statistics');
Route::post('/global/statistics/store',[FrontendController::class,'countryStatisticsStore'])->name('frontend.country.statistics.store');
// global-social-media-addiction-statistics
Route::get('/{slug}/global-and-country-statistics',[FrontendController::class,'countryStatisticsShow'])->name('frontend.country.statistics.show');

Route::get('/dashboard', function () {
    if(Auth::user()->role == 2){
        return redirect()->route('questionnaire.index');
    }else{
        return abort(404);
    }
})->middleware(['auth'])->name('dashboard');

Route::resource('dashboard/questionnaire', QuestionnaireController::class)->middleware('auth');
Route::resource('dashboard/result-and-suggestion',ResultSuggestionController::class)->middleware('auth');

require __DIR__.'/auth.php';
