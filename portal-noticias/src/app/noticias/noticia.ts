import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ActivatedRoute } from '@angular/router';
import { noticias } from './dados-noticias';

@Component({
  selector: 'app-noticia',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './noticia.html',
  styleUrl: './noticia.scss'
})
export class NoticiaComponent {
  id: number;
  noticia: any;

  constructor(private route: ActivatedRoute) {
    this.id = Number(this.route.snapshot.paramMap.get('id'));
    this.noticia = noticias.find(n => n.id === this.id);

    console.log('ID recebido:', this.id);
    console.log('Notícia encontrada:', this.noticia);
  }
}