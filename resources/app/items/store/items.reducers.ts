import * as ItemActions from './items.actions';
import { Item } from '../item.model';

export interface State {
    items: Item[];
    editedItem: Item;
    editedItemIndex: number;
}

const initialState: State = {
    items: [
        new Item(0, 'Keyboard', 'https://ae01.alicdn.com/kf/HTB1kdw9HVXXXXb2XVXXq6xXFXXXF/Sangee-multimedia-led-keyboard-armor-k6-xt2-gaming-keyboard-cool-fashion.jpg_640x640.jpg', '2018-10-11'),
        new Item(1, 'Mousepad', 'https://rukminim1.flixcart.com/image/832/832/mousepad/h/a/x/logitech-premium-quality-original-imae3npw7v3cayyv.jpeg?q=70', '2018-10-13'),
        new Item(2, 'Screen Mirror', 'https://ae01.alicdn.com/kf/HTB1kdw9HVXXXXb2XVXXq6xXFXXXF/Sangee-multimedia-led-keyboard-armor-k6-xt2-gaming-keyboard-cool-fashion.jpg_640x640.jpg', '2018-10-14')
    ],
    editedItem: null,
    editedItemIndex: -1
}

export function itemsReducer(state = initialState, action: ItemActions.ItemActions){
    switch(action.type){
        case ItemActions.ADD_ITEM:
            return {
                ...state,
                items: [...state.items, action.payload]
            }
        case ItemActions.UPDATE_ITEM:
            const item = state.items[state.editedItemIndex];
            const updatedItem = {
                ...item,
                ...action.payload.item
            };
            const items = [...state.items];
            items[state.editedItemIndex] = updatedItem;
            return {
                ...state,
                items: items,
                editedItem: null,
                editedItemIndex: -1
            };
        case ItemActions.DELETE_ITEM:
            const oldItems = [...state.items];
            oldItems.splice(action.payload, 1);
            return{
                ...state,
                items: oldItems
            };
        case ItemActions.START_EDIT:
            const editedItem = {...state.items[action.payload]};
            return {
                ...state,
                editedItem: editedItem,
                editedItemIndex: action.payload
            };
        case ItemActions.STOP_EDIT:
            return {
                ...state,
                editedItem: null,
                editedItemIndex: -1
            };    
        default: 
            return state;    
    }
}