import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {DaydetailComponent} from './daydetail/daydetail.component';
import {DaystableComponent} from './daystable/daystable.component';
import {MatchtableComponent} from './matchtable/matchtable.component';
import {TeamtableComponent} from './teamtable/teamtable.component';
import {TeamdetailsComponent} from './teamdetails/teamdetails.component';
import {PlayerdetailsComponent} from './playerdetails/playerdetails.component';
import {MatchComponent} from './match/match.component';
import {DaysComponent} from './days/days.component';

const routes: Routes = [
  {path: 'daystable/daydetail/:champ/:id', component: DaysComponent},
  {path: 'matchtable/matchdetail/:id', component: MatchComponent},
  {path: 'teamtable/teamdetail/:id', component: TeamdetailsComponent},
  {path: 'teamtable/playerdetail/:id', component: PlayerdetailsComponent},
  {path: 'daystable/:champ', component: DaysComponent},
  {path: 'matchtable', component: MatchtableComponent},
  {path: 'teamtable', component: TeamtableComponent},
  {path: '', redirectTo: '/daystable/2019', pathMatch: 'full'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {useHash: true})],
  exports: [RouterModule]
})

export class AppRoutingModule {
}
