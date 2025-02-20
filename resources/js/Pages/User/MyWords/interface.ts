export interface MyWord {
    id:number;
    word:string;
    definition:string;
    partOfSpeech:
      {
        id:number;
        name:string;
      };
}