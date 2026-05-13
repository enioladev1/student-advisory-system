<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            $table->integer('credit_units');
            $table->enum('semester', ['First', 'Second'])->default('First');
            $table->enum('level', ['100', '200', '300', '400'])->default('100');
            $table->string('department');
            $table->boolean('is_compulsory')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
