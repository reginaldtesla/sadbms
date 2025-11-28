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
        Schema::create('personels', function (Blueprint $table) {
            $table->bigIncrements('id');
            // Basic personnel info
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('age');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            // Personnel type
            $table->string('personnel_type');
            // Department info
            $table->string('department');
            $table->string('supervision_name');
            // Role info
            $table->string('assigned_role')->nullable();
            // Service & attachment details
            $table->string('institution_name');
            $table->text('remarks')->nullable();
            $table->string('duration');
            // Other personnel info
            $table->date('start_date');
            $table->date('end_date');
            $table->text('address');
            $table->text('bio')->nullable();
            $table->string('program')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personels');
    }
};
