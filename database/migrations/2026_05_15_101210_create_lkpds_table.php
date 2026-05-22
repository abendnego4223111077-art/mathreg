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
       
Schema::create('lkpds', function (Blueprint $table) {
        $table->id();

        $table->foreignId('student_id')
              ->constrained()
              ->onDelete('cascade');

        // Jawaban analisis scatter
        $table->text('scatter_pattern')->nullable();
        $table->text('scatter_relation')->nullable();

        // Garis manual dari slider
        $table->float('manual_intercept')->nullable();
        $table->float('manual_slope')->nullable();
        $table->text('manual_line_reason')->nullable();
        $table->text('outlier_reason')->nullable();

        // Input jumlah untuk OLS
        $table->float('sum_x')->nullable();
        $table->float('sum_y')->nullable();
        $table->float('sum_x2')->nullable();
        $table->float('sum_xy')->nullable();

        // Hasil OLS
        $table->float('ols_intercept')->nullable();
        $table->float('ols_slope')->nullable();

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lkpds');
    }
};
