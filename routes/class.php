<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Class\ClassController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['custom_auth']], function(){
    Route::get('/{view_type}',[ClassController::class, 'index'])->name('class');
    Route::match(['get', 'post'],'/class/{action_type}/{id?}', [ClassController::class, 'handleClassRequest'])->name('handle_class_request');
});
?>