import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MatchtableComponent } from './matchtable.component';

describe('MatchtableComponent', () => {
  let component: MatchtableComponent;
  let fixture: ComponentFixture<MatchtableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MatchtableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MatchtableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
