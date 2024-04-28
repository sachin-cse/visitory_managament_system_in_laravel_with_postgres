<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\TeacherController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['custom_auth']], function(){
    Route::get('/teacher/{request_type}', [TeacherController::class, 'index'])->where('request_type', 'listing')->name('teacher.listing');
    Route::get('/teacher/{action_type}', [TeacherController::class, 'handleTeacherActionType'])->where('action_type', 'add|edit|delete')->name('teacher.handle_teacher_action_type');
});
?>