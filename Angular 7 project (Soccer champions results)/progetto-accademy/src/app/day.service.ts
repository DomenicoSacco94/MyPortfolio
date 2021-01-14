import { Injectable } from '@angular/core';
import {DailyMatch} from './models/dailyMatch';
import { Match } from './models/match';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';
import { SafeDelay } from './models/SafeDelay';


@Injectable({
  providedIn: 'root'
})
export class DayService {

  daysChampionship : DailyMatch[];
  day: DailyMatch;
  BASE_URL : string = "http://api.football-data.org/v2/competitions/";
  header = new HttpHeaders({'X-Auth-Token':'551c8548b0fe456784ba41fe2ba552e3'});

  constructor(private http: HttpClient) { }


    getDaysofChampionships(seasonId="2019") : Observable<DailyMatch[]>{
      const url = this.BASE_URL + seasonId + '/matches';

      return this.http.get(url, {headers : this.header}).pipe(map((response: any[]) => {
        console.log("4444444" + response)
        return response;
      }));
  }

  getDayDetails(dayID: number,seasonId="2019") : Observable<DailyMatch> {
    console.log("called service getDayDetails");
    const url = this.BASE_URL + seasonId +'/matches?matchday=' + dayID;

    return this.http.get(url, {headers : this.header}).pipe(map((response: any) => {
      return response;
    }));
  }
}
