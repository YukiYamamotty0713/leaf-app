<?php

namespace App\Utils;

class Prompt
{
    public static function suggestExamplePrompt(string $word = "test", string $description = "テスト", string $partOfSpeech = "名詞"): string
    {
        $prompt = <<<EOF
        ###課題
        次の英単語に対して、例文を提案してください。
        候補を3つ、提案してください。

        ###単語
        $word

        ###説明
        $description

        ###品詞
        $partOfSpeech

        ###データ形式
        JSON

        ### データ構造
        [
            {
                "example": "string"
            }
        ]
        EOF;

        return $prompt;
    }

    public static function extractDefinitionsPrompt(string $word, object $partOfSpeech): string
    {
        $prompt = <<<EOF
        ###課題
        次の英単語に対して、説明を日本語の単語で５つほど提案してください。
        品詞は、対応表を基に数字を入力してください。

        ###品詞対応表
        $partOfSpeech

        ###単語
        $word


        ###データ形式
        JSON

        ### データ構造
        [
            {
                "definition": "string",
                "partOfSpeech": {
                    "id": int
                    "name: "string"
                }   
            }
        ]
        EOF;

        return $prompt;
    }
}