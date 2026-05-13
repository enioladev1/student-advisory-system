<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('session'); // e.g. 2023/2024
            $table->enum('semester', ['First', 'Second'])->default('First');
            $table->decimal('score', 5, 2)->nullable();
            $table->string('grade')->nullable(); // A, B, C, D, E, F
            $table->integer('grade_points')->nullable(); // 5, 4, 3, 2, 1, 0
            $table->enum('status', ['registered', 'passed', 'failed', 'carry_over'])->default('registered');
            $table->timestamps();
            $table->unique(['student_id', 'course_id', 'session', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_courses');
    }
};
