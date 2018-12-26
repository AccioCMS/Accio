import { Component, OnInit, ViewChild, OnDestroy } from '@angular/core';
import { Store } from '@ngrx/store';
import { Item } from '../item.model';

import * as fromApp from '../../store/app.reducers';
import { ActivatedRoute, Router } from '@angular/router';
import * as ItemActions from '../store/items.actions';
import { Subscription } from 'rxjs';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-item-edit',
  templateUrl: './item-edit.component.html',
  styleUrls: ['./item-edit.component.css']
})
export class ItemEditComponent implements OnInit, OnDestroy {
  item: Item;
  editId: number;
  subscription: Subscription;
  @ViewChild('f') itemForm: NgForm;

  constructor(private store: Store<fromApp.AppState>,
            private route: ActivatedRoute,
            private router: Router) { }

  ngOnInit() {
    this.editId = this.route.snapshot.params['id'];
    this.store.dispatch(new ItemActions.StartEdit(this.editId));
    this.subscription = this.store.select('items')
      .subscribe(
        data => {
          if (data.editedItemIndex > -1) {
            this.item = data.editedItem;
          } 
        }
      );
  }

  onSubmit() {
    this.store.dispatch(new ItemActions.UpdateItem({item: this.item})); 
    this.router.navigate(['/items']);
  }


  ngOnDestroy() {
    this.store.dispatch(new ItemActions.StopEdit());
    this.subscription.unsubscribe();
  }

}
