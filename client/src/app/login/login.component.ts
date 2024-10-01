import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule]
})
export class LoginComponent {
  loginForm: FormGroup;


  constructor(private formBuilder: FormBuilder, private http: HttpClient, private router: Router) {
    this.loginForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(8)]]
    });
  }

  onSubmit() {
    if (this.loginForm.valid) {
      const loginData = this.loginForm.value;
      const headers = new HttpHeaders().set('Content-Type', 'application/json');

      this.http.post('http://localhost:8080/login', JSON.stringify(loginData), { headers, responseType: 'text' }).subscribe({
        next: (response) => {
          // console.log('Login successful:', response);
          // alert('Login successful!');
          // this.loginForm.reset();
          this.router.navigate(['/dashboard']);
        },
        error: (error) => {
          console.error('Error during login:', error);
          alert('Login failed. Please try again.');
        },
        complete: () => {
          console.log('Login request completed.');
        }
      });
    }
  }
}