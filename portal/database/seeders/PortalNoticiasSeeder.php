<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortalNoticiasSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();

        $categorias = [
            'Esportes',
            'Ciência e Tecnologia',
            'Utilidade Pública',
            'Cultura e Entretenimento',
        ];

        foreach ($categorias as $nome) {
            Category::firstOrCreate(
                ['slug' => Str::slug($nome)],
                [
                    'user_id' => $user->id,
                    'name' => $nome,
                ]
            );
        }

        $noticias = [
            [
                'categoria' => 'Utilidade Pública',
                'title' => 'Oportunidades de emprego são atualizadas semanalmente',
                'description' => 'PAT São Roque divulga novas vagas de emprego para diferentes áreas.',
                'notice' => 'O Posto de Atendimento ao Trabalhador de São Roque atualiza semanalmente as oportunidades de emprego disponíveis para a população.',
                'path_image' => '/images/vagas.jpg',
            ],
            [
                'categoria' => 'Utilidade Pública',
                'title' => 'Alerta de frio intenso no Sul e Sudeste',
                'description' => 'O INMET mantém alerta para baixas temperaturas em estados do Sul e Sudeste.',
                'notice' => 'A Defesa Civil orienta a população a redobrar os cuidados durante o período de frio intenso, principalmente com crianças, idosos e pessoas em situação de vulnerabilidade.',
                'path_image' => '/images/frio.jpg',
            ],
            [
                'categoria' => 'Utilidade Pública',
                'title' => 'Vacinação contra Influenza ampliada para toda a população',
                'description' => 'Campanha de vacinação contra a Influenza é ampliada para toda a população.',
                'notice' => 'A vacinação contra a Influenza foi ampliada para todos os públicos, com o objetivo de aumentar a cobertura vacinal e reduzir complicações respiratórias.',
                'path_image' => '/images/vacinacao.jpg',
            ],

            [
                'categoria' => 'Cultura e Entretenimento',
                'title' => 'Festival de Inverno de São Roque 2026 reúne música, arte e lazer',
                'description' => 'Evento cultural reúne apresentações musicais, gastronomia e atividades de lazer.',
                'notice' => 'O Festival de Inverno de São Roque 2026 promete movimentar a cidade com apresentações musicais, atividades culturais, gastronomia e opções de lazer.',
                'path_image' => '/images/cultura-festival.jpg',
            ],
            [
                'categoria' => 'Cultura e Entretenimento',
                'title' => 'Bienal Internacional do Livro incentiva leitura e aproxima público da literatura',
                'description' => 'Evento literário reúne autores, editoras e leitores em uma grande programação cultural.',
                'notice' => 'A Bienal Internacional do Livro promove o encontro entre leitores, autores e editoras, fortalecendo o acesso à literatura e incentivando o hábito da leitura.',
                'path_image' => '/images/cultura-livro.png',
            ],
            [
                'categoria' => 'Cultura e Entretenimento',
                'title' => 'Festa da Luz 2026 transforma o centro de Belo Horizonte em galeria de arte a céu aberto',
                'description' => 'Evento utiliza projeções, instalações e intervenções urbanas para aproximar arte e cidade.',
                'notice' => 'A Festa da Luz transforma espaços urbanos em experiências artísticas, valorizando a cultura, a tecnologia e a participação do público.',
                'path_image' => '/images/cultura-arte.jpeg',
            ],

            [
                'categoria' => 'Esportes',
                'title' => 'Qual é o próximo jogo do Brasil na Copa? Veja data e horário',
                'description' => 'Seleção Brasileira se prepara para mais um confronto decisivo.',
                'notice' => 'A Seleção Brasileira segue sua preparação para os próximos jogos, com expectativa dos torcedores para a escalação e o desempenho da equipe.',
                'path_image' => '/images/brasil-copa.jpg',
            ],
            [
                'categoria' => 'Esportes',
                'title' => 'Brasil segura pressão e vence Estados Unidos em amistoso',
                'description' => 'Seleção Brasileira feminina vence partida amistosa contra os Estados Unidos.',
                'notice' => 'A equipe brasileira mostrou organização e resistência durante o amistoso, conquistando uma vitória importante contra as norte-americanas.',
                'path_image' => '/images/brasil-feminino.jpg',
            ],
            [
                'categoria' => 'Esportes',
                'title' => 'Pan-Americanos de Ginástica em 2026 serão realizados no Brasil',
                'description' => 'Competição reunirá atletas de vários países em solo brasileiro.',
                'notice' => 'O Brasil será sede dos Pan-Americanos de Ginástica em 2026, evento que deve fortalecer a modalidade e atrair atenção internacional.',
                'path_image' => '/images/ginastica-pan.jpg',
            ],

            [
                'categoria' => 'Ciência e Tecnologia',
                'title' => 'Nova infraestrutura computacional amplia acesso à ciência de ponta em Minas Gerais',
                'description' => 'Centro de computação fortalece pesquisas científicas e tecnológicas.',
                'notice' => 'A nova infraestrutura computacional amplia a capacidade de processamento para projetos de pesquisa, inovação e desenvolvimento científico.',
                'path_image' => '/images/ccad-cefet.jpg',
            ],
            [
                'categoria' => 'Ciência e Tecnologia',
                'title' => 'Ciência nuclear brasileira combate poluição por microplásticos',
                'description' => 'Pesquisadores usam tecnologia nuclear para estudar impactos dos microplásticos.',
                'notice' => 'A ciência nuclear brasileira tem contribuído para identificar e compreender os impactos dos microplásticos no meio ambiente e na saúde humana.',
                'path_image' => '/images/microplasticos.jpg',
            ],
            [
                'categoria' => 'Ciência e Tecnologia',
                'title' => 'Pesquisadores do Impa desenvolvem modelo de IA que prevê chuvas',
                'description' => 'Modelo de inteligência artificial auxilia na previsão de eventos climáticos.',
                'notice' => 'Pesquisadores desenvolveram um modelo de inteligência artificial capaz de auxiliar na previsão de chuvas e eventos climáticos extremos.',
                'path_image' => '/images/tupann-ia.jpg',
            ],
        ];

        foreach ($noticias as $item) {
            $categoria = Category::where('name', $item['categoria'])->first();

            Notice::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'category_id' => $categoria->id,
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'notice' => $item['notice'],
                    'path_image' => $item['path_image'],
                ]
            );
        }
    }
}