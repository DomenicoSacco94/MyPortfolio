import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DaydetailComponent } from './daydetail.component';

describe('DaydetailComponent', () => {
  let component: DaydetailComponent;
  let fixture: ComponentFixture<DaydetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DaydetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DaydetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
