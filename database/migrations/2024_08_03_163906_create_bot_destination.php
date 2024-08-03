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
        Schema::create('telegram_bot_destination', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('destination');
            $table->unsignedBigInteger('bot_id');
            $table->timestamps();

            $table->foreign('bot_id')->references('id')->on('telegram_bots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_destination');
    }
};
