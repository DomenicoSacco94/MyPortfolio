import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TeamdetailsComponent } from './teamdetails.component';

describe('TeamdetailsComponent', () => {
  let component: TeamdetailsComponent;
  let fixture: ComponentFixture<TeamdetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TeamdetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TeamdetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
