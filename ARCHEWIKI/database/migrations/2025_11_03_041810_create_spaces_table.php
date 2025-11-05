<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id('idSpace');                     // ID principal
            $table->string('spaceName', 100);          // Nome do espaço
            $table->string('location', 255)->nullable(); // Localização
            $table->text('description')->nullable();   // Descrição do espaço
            $table->string('imagem')->nullable();      // Imagem do espaço
            $table->timestamps();                      // created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
