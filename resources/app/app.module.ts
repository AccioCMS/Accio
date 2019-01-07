import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { StoreModule } from '@ngrx/store';
import { StoreDevtoolsModule } from '@ngrx/store-devtools';

import { MainModule } from '../../vendor/acciocms/nucleus/src/Shared/main.module';
//import { AppComponent } from '../../vendor/acciocms/nucleus/src/Shared/app-fuse/app.component';
import { AppComponent } from './app.component';
import { AppRoutingModule } from "./app-routing.module";

//import { PluginsModule } from '../../plugins/plugins.module';
import { reducers } from './store/app.reducers';

@NgModule({
  declarations: [
      AppComponent,
  ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        //PluginsModule,
        FormsModule,
        StoreModule.forRoot(reducers),
        StoreDevtoolsModule.instrument(),
        MainModule,
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule{}
