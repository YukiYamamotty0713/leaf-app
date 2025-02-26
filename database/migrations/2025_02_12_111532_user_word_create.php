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
        Schema::create('user_word', function (Blueprint $table) {
            $table->id(); // id カラム (bigIncrements)
            $table->string('word'); // 単語
            $table->foreignId('user_id')->constrained(); // ユーザーID (外部キー)
            $table->text('definition')->nullable(); // 定義
            $table->foreignId('part_of_speech_id')->nullable();
            $table->timestamps(); // created_at と updated_at カラム
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_word');
    }
};