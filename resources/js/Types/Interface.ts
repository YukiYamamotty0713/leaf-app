export interface PartOfSpeech  {
    id:number,
    name:string,
}

export interface WordData {
    id:number;
    word: string; // 英単語
    definition: string; // 説明
    PartOfSpeech: PartOfSpeech; // 品詞
    PartOfSpeechId?: number | null; // partOfSpeechId を追加 (オプショナル)
    exampleSentence: string | null; // 例文
    note: string | null; // 備考
  }
  
  export interface MyWord {
    id: number;
    word: string;
    definition: string;
    example_sentence: string | null;
    note: string | null;
    user_id: number;
    part_of_speech_id: number;
    m_part_of_speech: {
      id: number;
      name: string;
    };
  }