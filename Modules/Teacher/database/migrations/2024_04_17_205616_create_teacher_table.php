<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 50)->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->defualt('male');
            $table->string('phone', 12)->unique()->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('profile_image', 255)->nullable();
            $table->string('current_address', 255)->nullable();
            $table->string('permanent_address', 255)->nullable();
            $table->timestamp('created_at');
            $table->integer('created_by');
            $table->timestamp('updated_at');
            $table->integer('updated_by');
            $table->softDeletes();
            $table->integer('deleted_by');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('teacher', function($table)
    {
        $table->dropColumn(array('username', 'email'));
    });
}
};
