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
        Schema::create('pagina', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('text');
            $table->Integer('numeracion');
            $table->unsignedBigInteger('cuento_id');
            $table->foreign('cuento_id')->references('id')->on('cuento')->onDelete('cascade');
            $table->primary(['id', 'cuento_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagina');
    }
};
