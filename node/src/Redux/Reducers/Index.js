import { combineReducers } from 'redux';
import { SESSION_CREATE, SESSION_DATA, USER_LIST } from '../Types/Index';

const defaultSession = {
    name: '',
    isLogged: false,
    token: '',
}

const Session = (state = defaultSession, action) => {
    const { type, information = defaultSession } = action
    switch (type) {
        case SESSION_CREATE:
            return information;
        case SESSION_DATA:
            return information;
        default:
            return state;
    }
}

const defaultUser = {
    rows: [],
}

const User = (state = defaultUser, action) => {
    const { type, information = defaultUser } = action
    switch (type) {
        case USER_LIST:
            return information;
        default:
            return state;
    }
}

const Reducers = combineReducers({Session, User})
export default Reducers