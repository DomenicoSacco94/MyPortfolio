import { Component, OnInit } from '@angular/core';
import {Team} from '../models/team';
import {TeamService} from '../team.service';
import { Player } from '../models/player';
import { ActivatedRoute } from '@angular/router';
import { Match } from '../models/match';
import { SafeDelay } from '../models/SafeDelay';

@Component({
  selector: 'app-teamdetails',
  templateUrl: './teamdetails.component.html',
  styleUrls: ['./teamdetails.component.css']
})
export class TeamdetailsComponent implements OnInit {

  tm: Team;
  players: Player[];
  matches: Match[];
  mtch: Match;
  victoriesHome: number=0;
  defeatsHome: number=0;
  drawsHome: number=0;
  victoriesAway: number=0;
  defeatsAway: number=0;
  drawsAway: number=0;

  constructor(private route: ActivatedRoute,private teamService: TeamService) { }

  ngOnInit() {
    SafeDelay.delay();
    this.getTeamDetails();
    SafeDelay.delay();
    this.getTeamMatches();
  }

  getTeamDetails() : void {
    const id = this.route.snapshot.paramMap.get('id');
    
    this.teamService.getTeamDetails(id).subscribe(
      data => {
        this.tm=Team.parseJson(data);
  },
  error=> console.log(error)
    )}

    getTeamMatches() : void {
      const id = this.route.snapshot.paramMap.get('id');
      
      this.teamService.getTeamMatches(id).subscribe(
        data => {
  
          this.matches=Match.parseJsonMatches(data);

          this.mtch=new Match();

          for(let mtch of this.matches) {
            console.log(this.tm.name.toLowerCase().trim() + " " + mtch.homeTeamName.toLowerCase().trim());
            if(mtch.stage == "REGULAR_SEASON" && mtch.homeTeamScore!= null && mtch.awayTeamScore!= null) {

            if(this.tm.name.toLowerCase().trim() == mtch.homeTeamName.toLowerCase().trim()) {
                if(mtch.homeTeamScore>mtch.awayTeamScore) {this.victoriesHome++;}
                else if (mtch.homeTeamScore<mtch.awayTeamScore) {this.defeatsHome++;}
                else if (mtch.homeTeamScore==mtch.awayTeamScore) {this.drawsHome++;}
            }

            else {
              if(mtch.homeTeamScore<mtch.awayTeamScore) {this.victoriesAway++;}
              else if (mtch.homeTeamScore>mtch.awayTeamScore) {this.defeatsAway++;}
              else if (mtch.homeTeamScore==mtch.awayTeamScore) {this.drawsAway++;}
            }
          }
        }

          
  
    },
    error=> console.log(error)
      )}
    
  }

