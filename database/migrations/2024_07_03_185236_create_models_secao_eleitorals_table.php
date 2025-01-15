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
        Schema::create('secao_eleitoral', function (Blueprint $table) {
            $table->id();

            $table->string('zona', 4);
            $table->string('secao', 4);
            $table->unique(["zona", "secao"]);

            $table->timestamps();
            
            $table->unsignedbigInteger('local_eleitoral_id')->nullable();
            $table->foreign("local_eleitoral_id")->references("id")->on("local_eleitoral");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo');
        Schema::dropIfExists('secao_eleitoral');
    }
};
