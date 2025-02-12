<?php

namespace App\Enums;

enum MPartOfSpeech: int
{
    case Noun = 1;           // 名詞
    case Verb = 2;           // 動詞
    case Adjective = 3;      // 形容詞
    case Adverb = 4;         // 副詞
    case Pronoun = 5;        // 代名詞
    case Preposition = 6;    // 前置詞
    case Conjunction = 7;    // 接続詞
    case Other = 8;          // その他
    case Idiom = 9;          // 英熟語
    case EnglishStructure = 10; // 英語構文
};