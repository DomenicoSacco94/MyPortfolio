import { Injectable } from '@angular/core';
import { Team } from './models/team';
import { Player } from './models/player';
import { HttpHeaders, HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Match } from './models/match';
import { catchError, map, tap } from 'rxjs/operators';
import { ActivatedRoute } from '@angular/router';
import { SafeDelay } from './models/SafeDelay';

@Injectable({
  providedIn: 'root'
})
export class PlayerService {

  BASE_URL= "http://api.football-data.org/v2/players/";
  header = new HttpHeaders({'X-Auth-Token':'551c8548b0fe456784ba41fe2ba552e3'});
  wikiheader = new HttpHeaders({"Content-Type": "application/json; charset=UTF-8"});

  pl : Player;

  constructor(private route: ActivatedRoute,private http: HttpClient) { }

  getPlayerDetails(idMatch:string) : Observable<Player> {
    
    const id = this.route.snapshot.paramMap.get('id');

      const url = this.BASE_URL + idMatch;

      return this.http.get(url, {headers : this.header}).pipe(map((response: any) => {
        return response;
      }));
    }

  getPlayerPicture(name:string) : Observable<string> {

    const url = "https://en.wikipedia.org/w/api.php?action=query&titles="+ name + "&prop=pageimages&format=json&origin=*&pithumbsize=300";

      return this.http.get(url).pipe(map((response: any) => {
        return response;
      }));

  }

  getPlayerDescription(name:string) : Observable<string> {

    const url = "https://it.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&&exsectionformat=wiki&exintro&origin=*&redirects=1&titles="+name;

      return this.http.get(url, {headers : this.wikiheader}).pipe(map((response: any) => {
        return response;
      }));

  }
 

}
