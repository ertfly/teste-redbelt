import HeaderOut from './../HeaderOut'
import { useState } from 'react';
import './Login.css'
import { useDispatch, useSelector } from 'react-redux';
import postLogin from './../../Redux/Actions/Login'

function Login() {
    let isLogged = useSelector(state => state.isLogged)
    if (isLogged) {
        document.location.href = '/'
    }

    const [user, setUser] = useState({});

    let login = () => {
        
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
                                <input type="text" className="form-control bg-input" placeholder="Usuario" autoFocus="autofocus" onChange={e => setUser({ ...user, username: e.target.value })} />
                            </div>
                            <div className="mt-2">
                                <input type="password" className="form-control bg-input" placeholder="Senha" onChange={e => setUser({ ...user, pass: e.target.value })} />
                            </div>
                            <div className="mt-2">
                                <button className="btn btn-primary btn-access" onClick={() => { login() }}>ACESSAR<i className="fa fa-arrow-right fa-white"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </>
    );
}

export default Login