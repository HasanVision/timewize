// import { Component } from '@angular/core';
// import { HttpClient } from '@angular/common/http';

// @Component({
//   selector: 'app-register',
//   templateUrl: './register.component.html',
//   styleUrls: ['./register.component.css']
// })
// export class RegisterComponent {
//   registerData = {
//     username: '',
//     email: '',
//     password: ''
//   };

//   constructor(private http: HttpClient) {}

//   onSubmit() {
//     this.http.post('http://localhost:8080/register', this.registerData).subscribe(
//       response => {
//         console.log('Registration successful:', response);
//       },
//       error => {
//         console.error('Error registering:', error);
//       }
//     );
//   }
// }
import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RegisterComponent } from './register.component';

describe('RegisterComponent', () => {
  let component: RegisterComponent;
  let fixture: ComponentFixture<RegisterComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [RegisterComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(RegisterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
