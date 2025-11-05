<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('saves', function (Blueprint $table) {
            $table->id('idS');
            $table->unsignedBigInteger('idU');
            $table->string('descS', 45)->nullable();
            $table->string('progress', 45)->nullable();

            $table->foreign('idU')->references('idU')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saves');
    }
};
