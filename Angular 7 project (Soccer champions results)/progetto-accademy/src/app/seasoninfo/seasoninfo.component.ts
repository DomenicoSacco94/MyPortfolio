import {Component, OnInit} from '@angular/core';
import {SeasoninfoService} from '../seasoninfo.service';
import {SafeDelay} from '../models/SafeDelay';
import {SeasonInfo} from '../models/seasoninfo';
import {seasonPosition} from '../models/seasonPosition';
import {ActivatedRoute} from '@angular/router';
import {HttpParams} from '@angular/common/http';

@Component({
  selector: 'app-seasoninfo',
  templateUrl: './seasoninfo.component.html',
  styleUrls: ['./seasoninfo.component.css']
})
export class SeasoninfoComponent implements OnInit {

  constructor(private route: ActivatedRoute, private seasonService: SeasoninfoService) {
  }

  champ: string;

  season: SeasonInfo;

  ngOnInit() {
    SafeDelay.delay().then(
      () => {
        this.route.paramMap.subscribe(queryParams => {
          this.champ = queryParams.get('champ');
          this.getSeasonDetails();
        });

      }
    );
  }


  getSeasonDetails(): void {

    console.log(this.champ);
    if (this.champ.includes('/')) {
      this.champ = '2019';
    }
    this.seasonService.getSeason(this.champ).subscribe(
      data => {

        this.season = SeasonInfo.parseJson(data);

      },
      error => console.log(error)
    );
  }

}
