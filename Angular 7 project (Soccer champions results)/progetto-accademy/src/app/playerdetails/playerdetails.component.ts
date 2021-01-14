import { Component, OnInit, Input } from '@angular/core';
import { Player } from '../models/player';
import { PlayerService } from '../player.service';
import { ActivatedRoute } from '@angular/router';
import { Match } from '../models/match';
import { SafeDelay } from '../models/SafeDelay';

@Component({
  selector: 'app-playerdetails',
  templateUrl: './playerdetails.component.html',
  styleUrls: ['./playerdetails.component.css']
})
export class PlayerdetailsComponent implements OnInit {

  @Input()
  player: Player;

  constructor(private route: ActivatedRoute,private playerService: PlayerService) { }

  ngOnInit() {
    SafeDelay.delay();
    this.getPlayerDetails();
  }

  getPlayerDetails() : void {
    const id = this.route.snapshot.paramMap.get('id');
    
    this.playerService.getPlayerDetails(id).subscribe(
      data => {

        this.player=new Player();
        this.player.id=data['id'];
        this.player.countryOfBirth=data['countryOfBirth'];
        this.player.name=data['name'];
        this.player.position=data['position'];
        data['shirtNumber'] == null? this.player.shirtNumber="N/A" : this.player.shirtNumber=data['shirtNumber'];
        this.player.dateOfBirth=data['dateOfBirth'];
        this.playerService.getPlayerPicture(this.player.name.replace(" ","%20")).subscribe( data => {
          let firstProp;
          for(var key in data['query']['pages']) {
          if(data['query']['pages'].hasOwnProperty(key)) {
            firstProp = data['query']['pages'][key];
            break;
          }
          }
          this.player.playerUrl=firstProp['thumbnail']['source'];
          this.player.playerDetails=firstProp['extract'];
        });

        this.playerService.getPlayerDescription(this.player.name.replace(" ","%20")).subscribe( data => {
          let firstProp;
          for(var key in data['query']['pages']) {
          if(data['query']['pages'].hasOwnProperty(key)) {
            firstProp = data['query']['pages'][key];
            break;
          }
          }

        this.player.playerDetails=firstProp['extract'];
        });  

  },
  error=> console.log(error)
    )} 


  }

