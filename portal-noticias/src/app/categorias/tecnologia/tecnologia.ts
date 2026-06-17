import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-tecnologia',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './tecnologia.html',
  styleUrl: './tecnologia.scss'
})
export class TecnologiaComponent {}