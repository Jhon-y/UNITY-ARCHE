<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id('idP');
            $table->string('ancestry', 45)->nullable(); // ascendência
            $table->string('type', 45)->nullable();     // tipoP
            $table->string('characterName', 45);
            $table->integer('life')->default(0);
            $table->string('imagem')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
