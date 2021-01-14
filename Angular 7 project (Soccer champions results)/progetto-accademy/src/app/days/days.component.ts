import {Component, OnInit} from '@angular/core';
import {DailyMatch} from '../models/dailyMatch';
import {DayService} from '../day.service';
import {ActivatedRoute} from '@angular/router';
import {Match} from '../models/match';
import {max} from 'rxjs/operators';
import {SafeDelay} from '../models/SafeDelay';

@Component({
  selector: 'app-days',
  templateUrl: './days.component.html',
  styleUrls: ['./days.component.css']
})
export class DaysComponent implements OnInit {

  days: DailyMatch[] = [];
  sortedDays: DailyMatch[] = [];
  champ: string;
  matches = [];
  competitionName: string;

  constructor(private route: ActivatedRoute, private dayService: DayService) {
  }

  ngOnInit() {
    SafeDelay.delay().then(
      () => {
        this.route.paramMap.subscribe(queryParams => {
          this.champ = queryParams.get('champ');
          this.getdays();
        });

      }
    );
  }


  getdays(): void {

    // this.champ = this.getParamValueQueryString();
    this.dayService.getDaysofChampionships(this.champ).subscribe(
      data => {

        this.sortedDays = DailyMatch.parseJsonDays(data);
        this.competitionName = this.sortedDays[0].competitionName;

      },
      error => console.log(error)
    );
  }

}
