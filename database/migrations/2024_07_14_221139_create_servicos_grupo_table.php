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
        Schema::create('servicos_grupo', function (Blueprint $table) {
            $table->id();

            $table->string('servico');
            $table->string('sub_servico');
            $table->text('obs')->nullable();
            $table->date('data_solicitacao');
            $table->date('data_prazo')->nullable();
            $table->date('data_finalizado')->nullable();
            $table->enum('status',['ABERTO','FINALIZADO','NÃO REALIZADO']);
            $table->string('indicacao')->nullable();
            $table->BigInteger('grupo_id')->unsigned();


            $table->timestamps();
        });

        Schema::table('servicos_grupo', function($table){
            $table->foreign('grupo_id')->references('id')->on('grupo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicos_grupo');
    }
};
