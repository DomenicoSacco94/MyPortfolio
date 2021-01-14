import { Injectable } from '@angular/core';
import { catchError, map, tap } from 'rxjs/operators';
import { HttpHeaders, HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { SeasonInfo } from './models/seasoninfo';


@Injectable({
  providedIn: 'root'
})
export class SeasoninfoService {

  header = new HttpHeaders({'X-Auth-Token':'551c8548b0fe456784ba41fe2ba552e3'});

  constructor(private http: HttpClient) { }

  getSeason(seasonId="2019") : Observable<SeasonInfo> {
      let url = "http://api.football-data.org/v2/competitions/"+seasonId+"/standings";
      return this.http.get(url, {headers : this.header}).pipe(map((response: any) => {
        return response;
      }));
    }


}
