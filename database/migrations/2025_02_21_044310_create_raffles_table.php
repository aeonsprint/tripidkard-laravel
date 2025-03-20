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
        Schema::create('raffles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->unique();
            $table->string('title');
            $table->string('prize');
            $table->string('mechanics');
            $table->string('total_winner');
            $table->date('entries_deadline');
            $table->date('draw_date');
            $table->string('image')->nullable();
            $table->integer('status')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffles');
    }
};
