import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-esportes',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './esportes.html',
  styleUrl: './esportes.scss'
})
export class EsportesComponent {}