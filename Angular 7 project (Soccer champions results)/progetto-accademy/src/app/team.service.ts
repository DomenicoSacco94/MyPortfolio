import { Injectable } from '@angular/core';
import {Match} from './models/match';
import {Player} from './models/player';
import {Team} from './models/team';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { ActivatedRoute } from '@angular/router';
import { catchError, map, tap } from 'rxjs/operators';
import { SafeDelay } from './models/SafeDelay';

@Injectable({
  providedIn: 'root'
})

export class TeamService {

  tm: Team;

  BASE_URL= "http://api.football-data.org/v2/teams/";
  header = new HttpHeaders({'X-Auth-Token':'551c8548b0fe456784ba41fe2ba552e3'});
  
  constructor(private route: ActivatedRoute,private http: HttpClient) { }

  getTeamDetails(idTeam: string) : Observable<Team> { 

    const url = this.BASE_URL + idTeam;

    return this.http.get(url, {headers : this.header}).pipe(map((response: any) => {
      console.log(response);
      return response;
    }));
  }

  getTeamMatches(idTeam: string) : Observable<Match[]> { 

    const url = this.BASE_URL + idTeam + "/matches";

    return this.http.get(url, {headers : this.header}).pipe(map((response: any[]) => {
      console.log(response);
      return response;
    }));
  }

  }

