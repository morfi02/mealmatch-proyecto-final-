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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('Cliente que califica');
            $table->foreignId('seller_id')->constrained('users')->comment('Chef calificado');
            $table->unsignedTinyInteger('rating')->comment('Valoración 1-5');
            $table->text('comment')->nullable()->comment('Comentario opcional');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
