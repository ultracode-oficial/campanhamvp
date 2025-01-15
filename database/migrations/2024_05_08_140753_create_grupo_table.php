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
        Schema::create('grupo', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('zona')->nullable();
            $table->string('secao')->nullable();
            $table->string('apelido')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone');
            $table->string('cep')->nullable();
            $table->string('bairro')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('municipio')->nullable();
            $table->enum('tipo',['lideranca','colaborador','indeciso']);
            $table->integer('lider_id')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->decimal('lat',10,8)->nullable();
            $table->decimal('lng',10,8)->nullable();
            $table->mediumtext('foto')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo');
    }
};
