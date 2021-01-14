import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DaystableComponent } from './daystable.component';

describe('DaystableComponent', () => {
  let component: DaystableComponent;
  let fixture: ComponentFixture<DaystableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DaystableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DaystableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
