import { ActionReducerMap } from '@ngrx/store';

import * as fromItems from '../items/store/items.reducers';

export interface AppState{
    items: fromItems.State,
}

export const reducers: ActionReducerMap<AppState> = {
    items: fromItems.itemsReducer,
}