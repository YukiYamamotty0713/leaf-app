export interface MyWord {
    id:number;
    word:string;
    definition:string;
    part_of_speech:
      {
        id:number;
        name:string;
      };
}