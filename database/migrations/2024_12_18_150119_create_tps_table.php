<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tps', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->uuid('uuid')->unique();
            $table->string('code')->nullable();
            $table->text('location')->nullable();
            $table->bigInteger('desa_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('desa_id')->on('desa')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tps');
    }
};
