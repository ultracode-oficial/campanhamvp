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
        Schema::create('local_eleitoral', function (Blueprint $table) {
            $table->id();
            $table->decimal('lat',10,8);
            $table->decimal('lng',10,8);
            $table->string('nome_local');
            $table->string('cep');
            $table->string('logradouro');
            $table->string('numero_logradouro');
            $table->string('bairro');
            $table->string('municipio');
            $table->string('uf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_eleitoral');
    }
};
