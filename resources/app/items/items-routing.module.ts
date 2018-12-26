import { NgModule } from "@angular/core";
import { Routes, RouterModule } from "@angular/router";

import { ItemsComponent } from "./items.component";
import { ItemNewComponent } from "./item-new/item-new.component";
import { ItemEditComponent } from "./item-edit/item-edit.component";

const itemsRoutes: Routes = [
    { path: 'items', component: ItemsComponent},
    { path: 'items/new', component: ItemNewComponent  },
    { path: 'items/:id/edit', component: ItemEditComponent}
];

@NgModule({
    imports: [RouterModule.forChild(itemsRoutes)],
    exports: [RouterModule]
})
export class ItemsRoutingModule{

}