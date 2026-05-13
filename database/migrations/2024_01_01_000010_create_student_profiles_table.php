<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('matric_number')->unique();
            $table->string('department');
            $table->string('faculty');
            $table->enum('program', ['ND', 'HND', 'BSc', 'BA', 'BEng', 'BTech'])->default('ND');
            $table->enum('level', ['100', '200', '300', '400'])->default('100');
            $table->string('phone')->nullable();
            $table->string('session')->nullable(); // e.g. 2023/2024
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
