<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_part_of_speech', function (Blueprint $table) {
            $table->id(); // IDカラム (自動増分の主キー)
            $table->string('name'); // 品詞の名前
            $table->timestamps(); // created_at, updated_at カラム
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_part_of_speech');
    }
};
