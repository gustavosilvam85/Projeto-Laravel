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
        Schema::create('itens', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_explorador');
            $table->foreign('id_explorador')->references('id')->on('explorador');
            
            $table->string('NomeItem');
            $table->integer('Valor');
            $table->string('Latitude');
            $table->string('Longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
