import { useDispatch, useSelector } from 'react-redux';
import { createToken } from '../../Redux/Actions/Session';
import HeaderOut from './../HeaderOut'
import './Login.css'
import axios from 'axios'
import { BASE_URL } from '../../Config';

if (!sessionStorage.getItem('token')) {
    axios.post(BASE_URL + 'token').then((response) => {
        sessionStorage.setItem('token', response.data.data.token)
        useDispatch(createToken({ name: '', isLogged: response.data.logged, token: response.data.token }))
    })
}

function Login() {
    let isLogged = useSelector(state => state.isLogged)
    if (isLogged) {
        document.location.href = '/'
    }

    return (
        <>
            <HeaderOut />
            <div className="h-100 d-flex align-items-center justify-content-center">
                <div className="login d-flex flex-column justify-content-center">
                    <div className="title d-flex flex-row align-items-center mt-3">
                        <span className="traco"></span>
                        <h1>LOGIN</h1>
                        <span className="traco"></span>
                    </div>
                    <form>
                        <div className="login-form mt-3">
                            <div className="mt-2">
                                <input type="text" className="form-control bg-input" placeholder="Usuario" autoFocus="autofocus" defaultValue={useSelector(state => state.token)} />
                            </div>
                            <div className="mt-2">
                                <input type="password" className="form-control bg-input" placeholder="Senha" />
                            </div>
                            <div className="mt-2">
                                <button className="btn btn-primary btn-access">ACESSAR<i className="fa fa-arrow-right fa-white"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </>
    );
}

export default Login