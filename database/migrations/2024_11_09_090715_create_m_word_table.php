<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_m_word_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMWordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_word', function (Blueprint $table) {
            $table->id()->comment('単語の一意識別子');
            $table->string('word')->comment('英単語');
            $table->string('part_of_speech')->comment('品詞（名詞、動詞、形容詞など）');
            $table->text('definition')->comment('単語の意味');
            $table->text('example_sentence')->nullable()->comment('単語を使った例文');
            $table->string('pronunciation')->nullable()->comment('発音の音声ファイルのパスやIPA表記');
            $table->text('synonyms')->nullable()->comment('同義語');
            $table->text('antonyms')->nullable()->comment('反義語');
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner')->comment('単語の難易度');
            $table->string('category')->nullable()->comment('単語が所属するカテゴリ（例: 食べ物、動物など）');
            $table->date('last_reviewed')->nullable()->comment('最後にレビューした日');
            $table->date('next_review_date')->nullable()->comment('次回学習予定日');
            $table->boolean('learned')->default(false)->comment('学習が完了したかどうか');
            $table->integer('streak')->default(0)->comment('連続学習日数');
            $table->integer('correct_answers')->default(0)->comment('正解した回数');
            $table->integer('incorrect_answers')->default(0)->comment('間違えた回数');
            $table->decimal('rating', 3, 2)->nullable()->comment('単語の習得度（SRSアルゴリズム等で使用）');
            $table->string('image')->nullable()->comment('単語に関連する画像');
            $table->string('audio_file')->nullable()->comment('発音音声ファイル');
            $table->timestamp('created_at')->nullable()->comment('作成日');
            $table->timestamp('updated_at')->nullable()->comment('更新日');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_word');
    }
}
