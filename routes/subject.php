<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Subject\SubjectController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['custom_auth']], function(){
    Route::get('/{view_type?}',[SubjectController::class, 'index'])->name('subject');
    Route::match(['get', 'post'],'/subject/{action_type}', [SubjectController::class, 'handleSubjectRequest'])->name('handle_subject_request');
});
?>