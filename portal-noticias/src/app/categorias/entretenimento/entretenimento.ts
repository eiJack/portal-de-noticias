import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-entretenimento',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './entretenimento.html',
  styleUrl: './entretenimento.scss'
})
export class EntretenimentoComponent {}