<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_word', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id')->nullable(); // 最初はNULLを許容
        });
    
        // ここでデータを更新する処理を追加
        DB::table('user_word')->update(['user_id' => DB::table('users')->first()->id ?? null]);
    
        Schema::table('user_word', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_word', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['user_id']);
            
            // user_idカラムを削除
            $table->dropColumn('user_id');

            // part_of_speech_idを元に戻す
            $table->renameColumn('part_of_speech_id', 'part_of_speech');
        });

        // テーブル名を元に戻す
        Schema::rename('user_word', 'm_word');
    }
};
