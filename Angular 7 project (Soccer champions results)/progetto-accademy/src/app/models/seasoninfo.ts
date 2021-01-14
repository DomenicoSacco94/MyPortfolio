import { seasonPosition } from './seasonPosition';

export class SeasonInfo {

    public classification: seasonPosition[];
    public currentMatchday: string;
    public endDate: string;
    public id: string;
    public startDate: string;
    public winner: string;
    public name: string;

    public static parseJson(data) {
        let season=new SeasonInfo();

        season=new SeasonInfo();
        console.log("----333333" + data['season']);

       
        season.startDate=data['season']['startDate'];
        season.endDate=data['season']['endDate'];
        season.id=data['season']['id'];
        season.winner=data['season']['winner'];
        season.currentMatchday=data['season']['currentMatchday'];
        season.name=data['competition']['name'];

        season.classification=[];

        console.log("----" + data['standings']['0']['table']);

        for (let seasonTeam of data['standings']['0']['table']) {
          let posInfo : seasonPosition=new seasonPosition();

          console.log("----" + seasonTeam['position']);
          posInfo.draw=seasonTeam['draw'];
          posInfo.goalDifference=seasonTeam['goalDifference'];
          posInfo.goalsAgainst=seasonTeam['goalsAgainst'];
          posInfo.goalsFor=seasonTeam['goalsFor'];
          posInfo.lost=seasonTeam['lost'];
          posInfo.playedGames=seasonTeam['playedGames'];
          posInfo.points=seasonTeam['points'];
          posInfo.position=seasonTeam['position'];
          posInfo.teamCrestUrl=seasonTeam['team']['crestUrl'];
          posInfo.teamName=seasonTeam['team']['name'];
          posInfo.won=seasonTeam['won'];
          posInfo.teamID=seasonTeam['team']['id'];



          season.classification.push(posInfo);
    }

    return season;

}
    
}