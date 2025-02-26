<?php

namespace App\Adapters;

use Exception;

class Gemini
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env("GEMINI_API_KEY");
    }

    public function generateText(string $prompt): string
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$this->apiKey}";

        $data = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ];

        $options = [
            'http' => [
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            throw new Exception('Error processing request');
        }

        $response = json_decode($result, true);

        // エラーチェックを追加
        if (isset($response['error'])) {
            throw new Exception('Gemini API Error: ' . $response['error']['message']);
        }

        $generatedText = '';
        if (isset($response['candidates'][0]['content']['parts'])) {
            foreach ($response['candidates'][0]['content']['parts'] as $part) {
                if (isset($part['text'])) {
                    $generatedText .= $part['text'];
                }
            }
        }

        return $generatedText;
    }
}