<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartOfSpeechSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partsOfSpeech = [
            ['id' => 1, 'name' => '名詞'],
            ['id' => 2, 'name' => '動詞'],
            ['id' => 3, 'name' => '形容詞'],
            ['id' => 4, 'name' => '副詞'],
            ['id' => 5, 'name' => '代名詞'],
            ['id' => 6, 'name' => '前置詞'],
            ['id' => 7, 'name' => '接続詞'],
            ['id' => 8, 'name' => 'その他'],
        ];

        // データを挿入
        DB::table('m_part_of_speech')->insert($partsOfSpeech);
    }
}
