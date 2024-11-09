<?php
// database/migrations/YYYY_MM_DD_HHMMSS_add_role_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToUsersTable extends Migration
{
    /**
     * マイグレーションを実行し、usersテーブルにroleカラムを追加します。
     * 'role'カラムは'user', 'admin', 'owner'の3つの選択肢からなるenum型で、デフォルトは'user'です。
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 'role'カラムをenum型で追加
            // 3つのロール: 'user', 'admin', 'owner'
            // デフォルト値は 'user'
            // MySQLのコメントを追加
            $table->enum('role', ['user', 'admin', 'owner'])->default('user')->after('name')
                ->comment('ユーザーの役割: user, admin, owner');
        });
    }

    /**
     * マイグレーションをロールバックし、usersテーブルからroleカラムを削除します。
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 'role'カラムを削除
            $table->dropColumn('role');
        });
    }
}
