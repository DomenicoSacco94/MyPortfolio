import { Match } from './match';
import { Player } from './player';

export class Team{
    public area: string ;
    public address : string ; 
    public clubColor: string;
    public crustUrl : string; 
    public mail : string ; 
    public foundedYear : string ;
    public idTeam: string; 
    public name:string; 
    public phone : string ; 
    public shortName:string;
    public players: Player[] ; 
    public tla:string ; 
    public venue:string; 
    public webSite:string;
    public matches: Match[];

    constructor(){}

    public static parseJson(data) {
        let tm=new Team();

        
        tm.address=data['address'];
        tm.clubColor=data['clubColors'];
        tm.crustUrl=String(data['crestUrl']);
        console.log(String(data['crestUrl']));
        tm.area=data['area']['name'];
        tm.mail=data['email']
        tm.foundedYear=data['founded'];
        tm.idTeam=data['id'];
        tm.name=data['name'];
        tm.phone=data['phone'];
        tm.shortName=data['shortName'];
        tm.tla=data['tla'];
        tm.venue=data['venue'];
        tm.webSite=data['website'];
        tm.players=[];

        for(let player in data['squad']) {

          let playerToPut = new Player();
          playerToPut.id=data['squad'][player]['id'];
          playerToPut.name=data['squad'][player]['name'];
          playerToPut.position=data['squad'][player]['position'];
          playerToPut.shirtNumber=data['squad'][player]['shirtNumber'];
          playerToPut.countryOfBirth=data['squad'][player]['countryOfBirth'];
          console.log("putting player with id " + data['squad'][player]['id']);
          tm.players.push(playerToPut);
        }

        return tm;
    }
} 