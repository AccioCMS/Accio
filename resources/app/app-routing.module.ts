import { NgModule } from '@angular/core';
import {RouterModule, Routes} from "@angular/router";
import {MyCustomComponentComponent} from "./my-custom-component/my-custom-component.component";

const appRoutes: Routes = [
  { path: 'admin', component: MyCustomComponentComponent },
];
@NgModule({
  imports: [
    RouterModule.forRoot(appRoutes)
  ],
  declarations: [
    MyCustomComponentComponent,
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
