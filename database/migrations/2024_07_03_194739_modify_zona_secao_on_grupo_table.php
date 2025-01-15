<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('grupo', function (Blueprint $table) {
            $table->string('zona', 4)->nullable()->change();
            $table->string('secao', 4)->nullable()->change();
            $table->foreign(["zona", "secao"])->references(["zona", "secao"])->on("secao_eleitoral");
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupo', function (Blueprint $table) {
            //
        });
    }
};
