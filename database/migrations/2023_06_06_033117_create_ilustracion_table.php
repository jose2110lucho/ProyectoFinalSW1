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
        Schema::create('ilustracion', function (Blueprint $table) {
            $table->id();
            $table->string('imagen');
            $table->string('descripcion');
            $table->unsignedBigInteger('elemento_id');
            $table->foreign('elemento_id')->references('id')->on('elemento');
            $table->unsignedBigInteger('pagina_id');
            $table->foreign('pagina_id')->references('id')->on('pagina');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ilustracion');
    }
};
