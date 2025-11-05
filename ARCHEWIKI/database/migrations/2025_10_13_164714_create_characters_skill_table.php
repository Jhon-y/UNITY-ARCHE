<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('character_skill', function (Blueprint $table) {
            $table->unsignedBigInteger('idP');
            $table->unsignedBigInteger('idH');
            $table->string('imagem')->nullable();
            $table->primary(['idP', 'idH']);
            $table->foreign('idP')->references('idP')->on('characters')->onDelete('cascade');
            $table->foreign('idH')->references('idH')->on('skills')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('character_skill');
    }
};
