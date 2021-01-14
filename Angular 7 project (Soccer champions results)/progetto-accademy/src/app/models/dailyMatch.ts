import{Match} from './match'

export class DailyMatch {
  

    public dayOfMatch: number;
    public competitionName: string;
    public matches: Match[];
    
    constructor(){

    }

    public static parseJsonDays(data) {

        console.log(data);
         let days: DailyMatch[]=[];
         let sortedDays: DailyMatch[] =[];


          for(let match in data['matches']) {
          
          let day=new DailyMatch();
          day.matches=[];
          //console.log(data['matches'][match].matchday);

          let matchToPut = new Match();

          matchToPut.id = data['matches'][match].id,
          matchToPut.homeTeamName=data['matches'][match]['homeTeam']['name'],
          matchToPut.awayTeamName=data['matches'][match]['awayTeam']['name'],
          matchToPut.homeTeamID=data['matches'][match]['homeTeam']['id'],
          matchToPut.awayTeamID=data['matches'][match]['awayTeam']['id'],
          matchToPut.homeTeamScore=data['matches'][match]['score']['fullTime']['homeTeam'],
          matchToPut.awayTeamScore=data['matches'][match]['score']['fullTime']['awayTeam'],
          matchToPut.utcDate=data['matches'][match].utcDate,
          matchToPut.status=data['matches'][match].status,
          matchToPut.stage=data['matches'][match].stage,
          matchToPut.lastUpdated=data['matches'][match].lastUpdated,
          matchToPut.matchDay=data['matches'][match].matchday

          let date=matchToPut.utcDate.substring(0,matchToPut.utcDate.indexOf("T"));
          matchToPut.utcDate=date + " " + matchToPut.utcDate.substring(matchToPut.utcDate.indexOf("T")+1,matchToPut.utcDate.indexOf("Z")-3);
          
          day.matches.push(matchToPut);
          day.competitionName=data['competition'].name;
          day.dayOfMatch=data['matches'][match].matchday;

          //console.log(day.dayOfMatch);

          days.push(day);

        }
      
      let daysNumber=0;
      for(let i=0;i<days.length;i++) {
        let dayMatches=days[i].matches;
        for(let j=0;j<dayMatches.length;j++) {
          if(dayMatches[j].matchDay>daysNumber) {daysNumber=dayMatches[j].matchDay};
        }
      }

      for(let i=1;i<=daysNumber;i++) {
        let dayToPut=new DailyMatch();
        let matchesToAdd: Match[]=[];
         for(let day of days) {
           if (day.dayOfMatch==i) {dayToPut.competitionName=day.competitionName;
          dayToPut.dayOfMatch=day.dayOfMatch;
          for(let match of day.matches) {
            if(!matchesToAdd.includes(match)) {matchesToAdd.push(match);}
          }
          dayToPut.matches=matchesToAdd;
          }
         }
         sortedDays.push(dayToPut);
      }

      return sortedDays;
    }

    public static parseJsonDay(data) {
        let day=new DailyMatch();
        day.competitionName=data['competition'].name;
        day.matches=[];

          for(let match in data['matches']) {

          let matchToPut = new Match();

          matchToPut.id = data['matches'][match].id,
          matchToPut.homeTeamName=data['matches'][match]['homeTeam'].name,
          matchToPut.awayTeamName=data['matches'][match]['awayTeam'].name,
          matchToPut.homeTeamID=data['matches'][match]['homeTeam'].id,
          matchToPut.awayTeamID=data['matches'][match]['awayTeam'].id,
          matchToPut.homeTeamScore=data['matches'][match]['score']['fullTime']['homeTeam'],
          matchToPut.awayTeamScore=data['matches'][match]['score']['fullTime']['awayTeam'],
          matchToPut.utcDate=data['matches'][match].utcDate;
          let date=matchToPut.utcDate.substring(0,matchToPut.utcDate.indexOf("T"));
          matchToPut.utcDate=date + " " + matchToPut.utcDate.substring(matchToPut.utcDate.indexOf("T")+1,matchToPut.utcDate.indexOf("Z")-3);
          matchToPut.status=data['matches'][match].status,
          matchToPut.stage=data['matches'][match].stage,
          matchToPut.lastUpdated=data['matches'][match].lastUpdated,
          matchToPut.matchDay=data['matches'][match]['matchday'];

          day.matches.push(matchToPut);
          day.dayOfMatch=data['matches'][match]['matchday'];

          console.log(day.dayOfMatch);

        }

        return day;

    }
}