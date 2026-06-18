import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { noticias as noticiasLocais } from '../noticias/dados-noticias';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [RouterLink, FormsModule, HttpClientModule],
  templateUrl: './home.html',
  styleUrl: './home.scss'
})
export class HomeComponent implements OnInit {
  noticias: any[] = noticiasLocais;
  
  resultadosApi: any[] = [];
  buscando = false;

  termoPesquisa = '';

  constructor(private http: HttpClient) {}

  ngOnInit() {
    this.http.get<any>('http://127.0.0.1:8000/api/public/notices')
      .subscribe({
        next: (res) => {
          const noticiasApi = res.data.map((item: any) => {
            const noticiaLocal = noticiasLocais.find(n => n.id === item.id);

            return {
              ...noticiaLocal,
              id: item.id,
              titulo: item.title,
              resumo: item.description,
              texto: item.notice,
              categoria: item.category?.name || noticiaLocal?.categoria || '',
              secao: noticiaLocal?.secao || item.category?.name || '',
              imagens: noticiaLocal?.imagens?.length
                ? noticiaLocal.imagens
                : [item.path_image],
            };
          });

          this.noticias = noticiasApi;

          console.log('Notícias misturadas API + local:', this.noticias);
        },
        error: (erro) => {
          console.error('Erro ao buscar notícias da API:', erro);

          // Se a API der erro, mantém os dados locais funcionando
          this.noticias = noticiasLocais;
        }
      });
  }

  get noticiasFiltradas() {
  if (this.termoPesquisa.trim() === '') {
    return [];
  }

  return this.resultadosApi;
  }

  get sugestoes() {
    if (this.termoPesquisa.trim().length < 2) {
      return [];
    }

    return this.resultadosApi.slice(0, 5);
  }

  selecionarSugestao(titulo: string) {
    this.termoPesquisa = titulo;
  }

  buscarNaApi() {
  const termo = this.termoPesquisa.trim();

  if (termo.length < 2) {
    this.resultadosApi = [];
    return;
  }

  this.buscando = true;

  this.http
    .get<any>(`http://127.0.0.1:8000/api/public/notices/search?term=${termo}`)
    .subscribe({
      next: (res) => {
        this.resultadosApi = res.data.map((item: any) => {
          const noticiaLocal = noticiasLocais.find(n => n.id === item.id);

          return {
            ...noticiaLocal,
            id: item.id,
            titulo: item.title,
            resumo: item.description,
            texto: item.notice,
            categoria: item.category?.name || noticiaLocal?.categoria || '',
            secao: noticiaLocal?.secao || item.category?.name || '',
            imagens: noticiaLocal?.imagens?.length
              ? noticiaLocal.imagens
              : [item.path_image],
          };
        });

        this.buscando = false;
      },
      error: (erro) => {
        console.error('Erro ao buscar notícias na API:', erro);
        this.resultadosApi = [];
        this.buscando = false;
      }
    });
  }
}