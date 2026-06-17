import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ActivatedRoute, RouterLink } from '@angular/router';
import { noticias } from './dados-noticias';

@Component({
  selector: 'app-noticia',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './noticia.html',
  styleUrl: './noticia.scss'
})
export class NoticiaComponent {
  id = 0;
  noticia: any;

  constructor(private route: ActivatedRoute) {
    this.route.paramMap.subscribe(params => {
      this.id = Number(params.get('id'));
      this.noticia = noticias.find(n => n.id === this.id);

      if (typeof window !== 'undefined') {
        window.scrollTo(0, 0);
      }

      console.log('ID recebido:', this.id);
      console.log('Notícia encontrada:', this.noticia);
    });
}

  get noticiasRelacionadas() {
    if (!this.noticia) {
      return [];
    }

    return noticias
      .filter(n =>
        n.secao === this.noticia.secao &&
        n.id !== this.noticia.id
      )
      .slice(0, 3);
  }
}