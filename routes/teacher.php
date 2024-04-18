<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\TeacherController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['custom_auth']], function(){
    Route::get('/teacher/{request_type}', [TeacherController::class, 'index'])->name('teacher.listing');
});
?>