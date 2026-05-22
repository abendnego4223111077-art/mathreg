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
       
 Schema::create('pemantik_answers', function (Blueprint $table) {
        $table->id();

        $table->foreignId('student_id')
              ->constrained()
              ->onDelete('cascade');

        $table->text('answer_1')->nullable();
        $table->text('answer_2')->nullable();
        $table->text('answer_3')->nullable();

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemantik_answers');
    }
};
