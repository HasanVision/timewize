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
      this.http.post('http://localhost:8080/register', registerData, {
        headers: new HttpHeaders({ 'Content-Type': 'application/json' }), 
      }).subscribe({
        next: (response) => {
          console.log('Registration successful:', response);
          alert('Registration successful!');
          this.registerForm.reset();
        },
        error: (error) => {
          console.error('Error during registration:', error);
        }
      });
    }
  }
}