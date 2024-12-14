<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyActivityTable extends Migration
{
    /**
     * 実行するマイグレーションの内容。
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_activity', function (Blueprint $table) {
            $table->id(); // idカラム（自動連番）
            $table->unsignedBigInteger('user_id'); // user_idカラム（数字）
            $table->enum('activity', ['register', 'delete']); // activityカラム（registerまたはdelete）
            $table->timestamps(); // created_at, updated_at
            
            // user_idに外部キー制約を設定する場合（任意）
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * マイグレーションをロールバックする内容。
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_activity');
    }
}
