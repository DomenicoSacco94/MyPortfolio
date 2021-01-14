import { Component, OnInit, Input, ɵConsole } from '@angular/core';
import {DailyMatch} from '../models/dailyMatch';
import {DayService} from '../day.service';
import { ActivatedRoute } from '@angular/router';
import { Match } from '../models/match';

@Component({
  selector: 'app-daydetail',
  templateUrl: './daydetail.component.html',
  styleUrls: ['./daydetail.component.css']
})
export class DaydetailComponent implements OnInit {

  @Input() 
  day: DailyMatch;

  constructor(private route: ActivatedRoute,private dayService: DayService) { }

  ngOnInit() {
    this.getDayDetails();
  }

  getDayDetails(): void {
    const id = Number(this.route.snapshot.paramMap.get('id'));
    const champ = this.route.snapshot.paramMap.get('champ');

    this.dayService.getDayDetails(id,champ).subscribe(
      data => {

        this.day=DailyMatch.parseJsonDay(data);

  },
  error=> console.log(error)
    )}


  }
