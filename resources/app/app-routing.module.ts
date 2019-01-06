import { NgModule } from '@angular/core';
import {RouterModule, Routes} from "@angular/router";
import {NucleusComponent} from "../../vendor/acciocms/nucleus/src/Shared/App/nucleus.component";

const appRoutes: Routes = [
    { path: 'admin', component: NucleusComponent },
];
@NgModule({
  imports: [
    RouterModule.forRoot(appRoutes)
  ],
  declarations: [
      NucleusComponent,
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }