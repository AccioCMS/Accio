import { Component, OnInit, ViewChild } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Store } from '@ngrx/store';

import * as fromApp from '../../store/app.reducers';
import * as ItemActions from '../store/items.actions';
import { Router } from '@angular/router';

@Component({
  selector: 'app-item-new',
  templateUrl: './item-new.component.html',
  styleUrls: ['./item-new.component.css']
})
export class ItemNewComponent implements OnInit {
  @ViewChild('f') itemForm: NgForm;

  constructor(private store: Store<fromApp.AppState>, private router: Router) {}

  ngOnInit() {
  }

  onSubmit(){
    const newItem = this.itemForm.value;
    this.store.dispatch(new ItemActions.AddItem(newItem));

    this.router.navigate(['/items']);
  }

}
