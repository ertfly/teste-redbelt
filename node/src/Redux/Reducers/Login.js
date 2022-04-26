import { LOGIN_POST } from "../Types/Login";

const defaultLogin = {
    name: '',
    isLogged: false,
    token: '',
}

const Session = (state = defaultLogin, action) => {
    const { type, information = defaultLogin } = action
    switch (type) {
        case SESSION_CREATE:
            return information;
        default:
            return state;
    }
}

export default Session