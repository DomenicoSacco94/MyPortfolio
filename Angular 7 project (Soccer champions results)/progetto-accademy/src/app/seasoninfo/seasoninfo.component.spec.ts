import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SeasoninfoComponent } from './seasoninfo.component';

describe('SeasoninfoComponent', () => {
  let component: SeasoninfoComponent;
  let fixture: ComponentFixture<SeasoninfoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SeasoninfoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SeasoninfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
