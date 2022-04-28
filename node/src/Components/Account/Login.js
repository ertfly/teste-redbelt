import HeaderOut from './../HeaderOut'
import Loader from '../Loader';
import { useState } from 'react';
import './Login.css'
import { BASE_URL } from '../../Config'
import axios from 'axios'

function Login() {
    if (sessionStorage.getItem('logged') == 1) {
        document.location.href = '/'
    }

    const [user, setUser] = useState({})
    const [error, setError] = useState('')

    const [loader, setLoader] = useState(false)

    let login = () => {
        setLoader(true)
        axios.post(BASE_URL + 'account/login', user, { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response
            let data = request.data.data

            if (response.action !== 0) {
                if (response.action == 4) {
                    sessionStorage.removeItem('token');
                    sessionStorage.removeItem('name');
                    sessionStorage.removeItem('logged');
                    document.location.href = '/account/login'
                }
                setLoader(false)
                setError(response.msg)
                return;
            }

            sessionStorage.setItem('logged', data.logged)
            sessionStorage.setItem('name', data.name)
            window.setTimeout(function () { document.location.href = '/' }, 400)
        })
    }

    return (
        <>
            <Loader show={loader} />
            <HeaderOut key="headerOut" />
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