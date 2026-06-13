import { Routes } from '@angular/router';

import { HomeComponent } from './home/home';
import { EsportesComponent } from './categorias/esportes/esportes';
import { TecnologiaComponent } from './categorias/tecnologia/tecnologia';
import { UtilidadePublicaComponent } from './categorias/utilidade-publica/utilidade-publica';
import { EntretenimentoComponent } from './categorias/entretenimento/entretenimento';

export const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'esportes', component: EsportesComponent },
  { path: 'tecnologia', component: TecnologiaComponent },
  { path: 'utilidade-publica', component: UtilidadePublicaComponent },
  { path: 'entretenimento', component: EntretenimentoComponent },
  { path: '**', redirectTo: '' }
];