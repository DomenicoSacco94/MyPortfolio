import { TestBed } from '@angular/core/testing';

import { SeasoninfoService } from './seasoninfo.service';

describe('SeasoninfoService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: SeasoninfoService = TestBed.get(SeasoninfoService);
    expect(service).toBeTruthy();
  });
});
