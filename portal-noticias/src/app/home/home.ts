import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { noticias } from '../noticias/dados-noticias';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [RouterLink, FormsModule],
  templateUrl: './home.html',
  styleUrl: './home.scss'
})
export class HomeComponent {
  noticias = noticias;

  termoPesquisa = '';

  get noticiasFiltradas() {
    const termo = this.termoPesquisa.toLowerCase().trim();

    if (termo === '') {
      return [];
    }

    return this.noticias.filter(noticia =>
      noticia.titulo.toLowerCase().includes(termo) ||
      noticia.secao.toLowerCase().includes(termo) ||
      noticia.categoria.toLowerCase().includes(termo) ||
      noticia.resumo.toLowerCase().includes(termo)
    );
  }

  get sugestoes() {
  const termo = this.termoPesquisa.toLowerCase().trim();

  if (termo.length < 2) {
    return [];
  }

  return this.noticias
    .filter(noticia =>
      noticia.titulo.toLowerCase().includes(termo)
    )
    .slice(0, 5); // máximo de 5 sugestões
}

selecionarSugestao(titulo: string) {
  this.termoPesquisa = titulo;
}
}