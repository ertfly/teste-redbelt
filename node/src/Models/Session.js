import { combineReducers } from "redux";

const initialState = {
    allIds: [],
    byIds: {}
};

function Session(state = initialState, action) {
    switch (action.type) {
        case 'ADD':

            break;
        default:
            return state;
    }
}


export default combineReducers({ Session })