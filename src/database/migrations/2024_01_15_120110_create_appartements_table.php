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
        Schema::create('appartements', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->decimal('prix_haut', 8, 2)->required();
            $table->decimal('prix_bas', 8, 2)->required();
            $table->integer('numero_appartement')->required();
            $table->integer('etage')->required();
            $table->integer('nombre_chambre')->required();
            $table->integer('capacite_appartement')->required();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartements');
    }
};
