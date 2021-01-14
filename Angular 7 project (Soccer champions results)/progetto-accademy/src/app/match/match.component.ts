import { Component, OnInit, Input } from '@angular/core';
import {Match} from '../models/match';
import {MatchService} from '../match.service';
import { ActivatedRoute } from '@angular/router';
import { SafeDelay } from '../models/SafeDelay';

@Component({
  selector: 'app-match',
  templateUrl: './match.component.html',
  styleUrls: ['./match.component.css']
})

export class MatchComponent implements OnInit {


  match: Match;

  constructor(private route: ActivatedRoute,private matchService: MatchService) { }

  ngOnInit() {
    SafeDelay.delay();
    this.getMatchDetails();
  }

  getMatchDetails(): void {
    const id = this.route.snapshot.paramMap.get('id');

    

    this.matchService.getMatchDetails(id).subscribe(
      data => {

         this.match=Match.parseJsonMatch(data);

        },
  error=> console.log(error)
    )}
  }

