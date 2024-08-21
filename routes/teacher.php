<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\TeacherController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['custom_auth']], function(){
    
    Route::get('/teacher/{action_type}/{id?}', [TeacherController::class, 'handleTeacherActionType'])
    ->where('action_type', '^(add|edit|delete|change-status)$')
    ->name('teacher.handle_teacher_action_type');

    Route::post('/teacher/{action_type}', [TeacherController::class, 'handleTeacherActionType'])
    ->where('action_type', '^(save|user-role)$')
    ->name('teacher.handle_teacher_action_type');

    Route::get('/teacher/{request_type}', [TeacherController::class, 'index'])
        ->where('request_type', '^(listing)$')
        ->name('teacher.listing');

    Route::post('/teacher-listing/reorder', [TeacherController::class, 'reorder'])->name('teacher-listing.reorder');
});
?>