import { SESSION_CREATE, SESSION_DATA } from "../Types/Session";

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

export default Session