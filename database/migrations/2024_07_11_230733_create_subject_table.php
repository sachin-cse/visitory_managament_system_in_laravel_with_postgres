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
        Schema::create('subject', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id', 20);
            $table->string('subject_name', 255)->nullable();
            $table->string('subject_code', 12)->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->text('subject_description')->nullable();
            $table->foreign('teacher_id')->references('id')->on('teacher')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject');
    }
};
