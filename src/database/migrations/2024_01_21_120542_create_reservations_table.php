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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('appartement_id');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->date('date_depuis')->nullable(false);
            $table->date('date_jusqua')->nullable(false);
            $table->decimal('prix', 8, 2)->nullable(false);
            $table->integer('total')->nullable(false);
            $table->integer('invite_n')->nullable(false);
            $table->enum('status', ['En attente', 'Valide', 'Annule'])->default('En attente');
            $table->boolean('expire')->default(false);
            $table->timestamps();
            
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('appartement_id')->references('id')->on('appartements')->onDelete('cascade');
            $table->foreign('agency_id')->references('id')->on('agency')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
