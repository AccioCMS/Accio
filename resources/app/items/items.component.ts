import { Component, OnInit } from '@angular/core';
import { Item } from './item.model';
import { Observable } from 'rxjs';
import { Store } from '@ngrx/store';

import * as fromApp from '../store/app.reducers';
import * as ItemActions from './store/items.actions';

@Component({
  selector: 'app-items',
  templateUrl: './items.component.html',
  styleUrls: ['./items.component.css']
})
export class ItemsComponent implements OnInit {
  itemsState: Observable<{items: Item[]}>;
  
  constructor(private store: Store<fromApp.AppState>) { }

  ngOnInit() {
    this.itemsState = this.store.select('items'); 
  }

  onDelete(index: number){
    this.store.dispatch(new ItemActions.DeleteItem(index));
  }

}
