import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule]
})
export class RegisterComponent {
  registerForm: FormGroup;

  constructor(private formBuilder: FormBuilder, private http: HttpClient) {
    this.registerForm = this.formBuilder.group({
      username: ['', [Validators.required, Validators.minLength(3)]],
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(8)]]
    });
  }

  onSubmit() {
    if (this.registerForm.valid) {
      const registerData = this.registerForm.value;
      const headers = new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded');
  
      const body = new URLSearchParams();
      body.set('username', registerData.username);
      body.set('email', registerData.email);
      body.set('password', registerData.password);
  
      this.http.post('http://localhost:8080/register', body.toString(), { headers }).subscribe({
        next: (response) => {
          console.log('Registration successful:', response);
          alert('Registration successful!');
          this.registerForm.reset();
        },
        error: (error) => {
          console.error('Error during registration:', error);
          alert('Registration failed. Please try again.');
        },
        complete: () => {
          console.log('Registration request completed.');
        }
      });
    }
  }
}