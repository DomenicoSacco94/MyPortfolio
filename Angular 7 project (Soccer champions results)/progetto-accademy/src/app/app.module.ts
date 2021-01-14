import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule }    from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavComponent } from './nav/nav.component';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { DaystableComponent } from './daystable/daystable.component';
import { DaysComponent } from './days/days.component';
import { ChampionshipComponent } from './championship/championship.component';
import { MatchComponent } from './match/match.component';
import { DaydetailComponent } from './daydetail/daydetail.component';
import { MatchtableComponent } from './matchtable/matchtable.component';
import { TeamtableComponent } from './teamtable/teamtable.component';
import { PlayerdetailsComponent } from './playerdetails/playerdetails.component';
import { TeamdetailsComponent } from './teamdetails/teamdetails.component';
import { SeasoninfoComponent } from './seasoninfo/seasoninfo.component';

@NgModule({
  declarations: [
    AppComponent,
    NavComponent,
    HeaderComponent,
    FooterComponent,
    DaystableComponent,
    DaysComponent,
    ChampionshipComponent,
    MatchComponent,
    DaydetailComponent,
    MatchtableComponent,
    TeamtableComponent,
    PlayerdetailsComponent,
    TeamdetailsComponent,
    SeasoninfoComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
