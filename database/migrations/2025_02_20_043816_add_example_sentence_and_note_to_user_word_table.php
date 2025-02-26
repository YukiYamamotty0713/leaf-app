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
        Schema::table('user_word', function (Blueprint $table) {
            $table->text('example_sentence')->nullable()->after('definition');
            $table->text('note')->nullable()->after('example_sentence');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_word', function (Blueprint $table) {
            $table->dropColumn('example_sentence');
            $table->dropColumn('note');
        });
    }
};