import { LOGIN_POST } from "../Types/Login";

const defaultLogin = {
    name: '',
    isLogged: 0,
    token: '',
}

const Login = (state = defaultLogin, action) => {
    const { type, information = defaultLogin } = action
    switch (type) {
        case LOGIN_POST:
            return information;
        default:
            return state;
    }
}

export default Login