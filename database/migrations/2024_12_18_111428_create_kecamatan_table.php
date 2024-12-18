<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->uuid('uuid')->unique();
            $table->string('code')->nullable();
            $table->bigInteger('kabupaten_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('kabupaten_id')->on('kabupaten')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kecamatan');
    }
};
