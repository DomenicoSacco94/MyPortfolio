import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TeamtableComponent } from './teamtable.component';

describe('TeamtableComponent', () => {
  let component: TeamtableComponent;
  let fixture: ComponentFixture<TeamtableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TeamtableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TeamtableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
