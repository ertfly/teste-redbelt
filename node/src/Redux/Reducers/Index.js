import { combineReducers } from 'redux';
import Session from './Session';
import User from './User';

const Reducers = combineReducers(Session, User)
export default Reducers