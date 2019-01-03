import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { StoreModule } from '@ngrx/store';
import { StoreDevtoolsModule } from '@ngrx/store-devtools';

import { AppComponent } from './app.component';
import { AppRoutingModule } from "./app-routing.module";

import { PluginsModule } from '../../plugins/plugins.module';

import { reducers } from './store/app.reducers';

import { HeaderComponent } from '../../vendor/acciocms/nucleus/src/Shared/header/header.component';
import { MainModule } from '../../vendor/acciocms/nucleus/src/Shared/main.module';
import { ItemsComponent } from './items/items.component';
import { ItemEditComponent } from './items/item-edit/item-edit.component';
import { ItemNewComponent } from './items/item-new/item-new.component';

import { ItemsRoutingModule } from './items/items-routing.module';

@NgModule({
  declarations: [
      AppComponent,
      ItemsComponent,
      ItemEditComponent,
      ItemNewComponent,
      HeaderComponent,
      MainModule
  ],
    imports: [
        BrowserModule,
        FormsModule,
        AppRoutingModule,
        PluginsModule,
        StoreModule.forRoot(reducers),
        StoreDevtoolsModule.instrument(),
        ItemsRoutingModule
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule{}
