import { MatchService } from '../match.service';

export class Match{

     public homeTeamName: string ; 
     public awayTeamName :string ; 
     public homeTeamID: string ; 
     public awayTeamID :string ; 
     public id : string ; 
    public lastUpdated : string;
    public matchDay:number; 
     public homeTeamScore : number; 
     public awayTeamScore : number ; 
     public homeTeamScoreHalfTime : number; 
     public awayTeamScoreHalfTime : number; 
     public homeTeamPenalties: string;
     public awayTeamPenalties: string;
     public stage : string;
     public status : string ; 
     public utcDate : string;
     public venue: string;
    constructor(){}

    public static parseJsonMatches(data) {

        let matches= [];
  
          console.log("----------------" + data['matches'].match);

          for(let match in data['matches']) {
            let mtch =new Match();
            mtch.id = data['matches'][match]['id'];
            console.log("----------------" + data['matches'][match]['id']);
            mtch.homeTeamName=data['matches'][match]['homeTeam']['name'];
            mtch.awayTeamName=data['matches'][match]['awayTeam']['name'];
            mtch.homeTeamID=data['matches'][match]['homeTeam']['id'];
            mtch.awayTeamID=data['matches'][match]['awayTeam']['id'];
            mtch.homeTeamScore=data['matches'][match]['score']['fullTime']['homeTeam'];
            mtch.awayTeamScore=data['matches'][match]['score']['fullTime']['awayTeam'];
            mtch.utcDate=data['matches'][match]['utcDate'];
            mtch.status=data['matches'][match]['status'];
            mtch.stage=data['matches'][match]['stage'];
            mtch.lastUpdated=data['matches'][match]['lastUpdated'];
            mtch.matchDay=data['matches'][match]['matchday'];
            matches.push(mtch);

          }

          return matches;

    }

    public static parseJsonMatch(data) {

      let match=new Match();
      //console.log(data['match']['homeTeam'].id);
      match.id = data['match'].id,
      match.homeTeamName=data['match']['homeTeam'].name,
      match.awayTeamName=data['match']['awayTeam'].name,
      match.homeTeamID=data['match']['homeTeam'].id,
      match.awayTeamID=data['match']['awayTeam'].id,
      match.homeTeamScore=data['match']['score']['fullTime']['homeTeam'],
      match.awayTeamScore=data['match']['score']['fullTime']['awayTeam'],
      match.utcDate=data['match'].utcDate,
      match.status=data['match'].status,
      match.stage=data['match'].stage,
      match.lastUpdated=data['match'].lastUpdated,
      match.matchDay=data['match']['matchday'];
      match.homeTeamScoreHalfTime=data['match']['score']['halfTime']['homeTeam'];
      match.awayTeamScoreHalfTime=data['match']['score']['halfTime']['homeTeam'];
      data['match']['score']['penalties']['homeTeam'] !=null ? match.homeTeamPenalties=data['match']['score']['penalties']['homeTeam'] : match.homeTeamPenalties = "NO";
      data['match']['score']['penalties']['awayTeam'] != null? match.awayTeamPenalties=data['match']['score']['penalties']['awayTeam'] : match.awayTeamPenalties = "NO";
      match.venue=data['match']['venue'];

      return match;
      
    }
}