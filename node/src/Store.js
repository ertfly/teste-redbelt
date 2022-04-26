import { createStore, combineReducers } from 'redux'

const reducers = combineReducers({
    prop: function(){
        return {
            exemplo: 'teste'
        }
    }
})


function Store() {
    return createStore(reducers)
}

export default Store