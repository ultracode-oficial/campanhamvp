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
        Schema::create('sub_servicos', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->BigInteger('servico_id')->unsigned();


            $table->timestamps();
        });

        Schema::table('sub_servicos', function($table){
            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_servicos');
    }
};
