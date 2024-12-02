<?php

namespace App\Services;
use Illuminate\Http\JsonResponse;

use App\Repositories\MyWordsRepositoryInterface;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MyWordsService
{
    protected $MyWordsRepositoryInterface;

    public function __construct(MyWordsRepositoryInterface $MyWordsRepositoryInterface)
    {
        $this->MyWordsRepositoryInterface = $MyWordsRepositoryInterface;
    }

    public function get()
    {
        return $this->MyWordsRepositoryInterface->get();
    }

    public function delete(int $id) :JsonResponse
    {
        try {
            $this->MyWordsRepositoryInterface->delete($id);
            return new JsonResponse(['message' => 'Word deleted.' . $id ], 200);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Failed to delete word.' . $id], 500);
        }
    }

    /**
     * CSVをダウンロードするメソッド
     * @return StreamedResponse
     */
    public function download_csv()
    {
        $head = $this->_make_header(); // ヘッダを取得
        $data = $this->_make_csv_data(); // データを取得
        $response = $this->_get_stream($data, $head);
        return new StreamedResponse($response, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="my_words.csv"',
        ]);
    }

    /**
     * CSVデータを作成するメソッド
     */
    public function _make_csv_data() : array
    {
        $data = $this->MyWordsRepositoryInterface->get();
        $csv_data = [];
        foreach ($data as $d) {
            $csv_data[] = [
                'word' => $d->word,
                'definition' => $d->definition,
                'part_of_speech' => $d->mPartOfSpeech ? $d->mPartOfSpeech->name : 'N/A',
            ];
        }
        return $csv_data;
    }


    /**
     * CSVのヘッダを作成するメソッド
     * @return array
     */
    public function _make_header() : array
    {
        return ['出力日', '単語', '説明', '品詞'];
    }

    /**
     * CSVデータを実際のファイルに書き込むストリームを返すメソッド
     * @param array $data
     * @param array $head
     * @param string $currentDate
     * @return \Closure
     */
    public function _get_stream($data, $head) 
    {
         return function() use ($data, $head) {
            $output = fopen('php://output', 'w');
            if ($output) {
                fputcsv($output, $head);
                foreach ($data as $item) {
                    // 出力日を先頭に追加
                    fputcsv($output, [
                        date('Y-m-d'),  // 出力日
                        $item['word'],  // 単語
                        $item['definition'],  // 説明
                        $item['part_of_speech']  // 品詞
                    ]);
                }
                fclose($output);
            }
        };
    }
}