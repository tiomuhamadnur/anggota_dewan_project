<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->uuid('uuid')->unique();
            $table->string('code')->nullable();
            $table->bigInteger('kecamatan_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('kecamatan_id')->on('kecamatan')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('desa');
    }
};
