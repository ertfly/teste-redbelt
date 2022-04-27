import HeaderOut from './../HeaderOut'
import { useState } from 'react';
import './Login.css'
import { useDispatch } from 'react-redux';
import { createToken } from './../../Redux/Actions/Session';
import { BASE_URL } from '../../Config'
import axios from 'axios'

function Login() {
    let dispatch = useDispatch()
    if (sessionStorage.getItem('logged') == 1) {
        document.location.href = '/'
    }

    const [user, setUser] = useState({});
    const [error, setError] = useState('');

    let login = () => {
        axios.post(BASE_URL + 'account/login', user, { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response
            let data = request.data.data

            if (response.action !== 0) {
                setError(response.msg)
                return;
            }

            sessionStorage.setItem('logged', data.logged)
            dispatch(createToken({ name: data.name, isLogged: data.logged, token: data.token }))
            window.setTimeout(function () { document.location.href = '/' })
        })
    }

    return (
        <>
            <HeaderOut />
            <div className="h-100 d-flex align-items-center justify-content-center">
                <div className="login d-flex flex-column justify-content-center">
                    <div className="title d-flex flex-row align-items-center mt-3 mb-4">
                        <span className="traco"></span>
                        <h1>LOGIN</h1>
                        <span className="traco"></span>
                    </div>
                    {error && <div className="alert alert-danger mt-0 mb-1">{error}</div>}
                    <form onSubmit={e => { e.preventDefault(); login() }}>
                        <div className="login-form mt-1">
                            <div className="mt-2">
                                <input type="text" className="form-control bg-input" placeholder="Usuario" autoFocus="autofocus" onChange={e => setUser({ ...user, username: e.target.value })} />
                            </div>
                            <div className="mt-2">
                                <input type="password" className="form-control bg-input" placeholder="Senha" onChange={e => setUser({ ...user, pass: e.target.value })} />
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