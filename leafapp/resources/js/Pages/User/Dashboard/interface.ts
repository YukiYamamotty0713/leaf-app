export interface RegisterWordsCounts  {
    Noun: number;
    Verb: number;
    Adjective: number;
    Adverb: number;
    Pronoun: number;
    Preposition: number;
    Conjunction: number;
    Other: number;
    Idiom: number;
    EnglishStructure: number;
    Sum:number;
  }
export interface WeeklyActivities {
    days: string[];
    activities: DailyActivities[];
  }

  export interface DailyActivities {
    register:number;
    delete:number;
  }