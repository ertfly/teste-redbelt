import { useDispatch, useSelector } from 'react-redux';
import { createToken } from '../../Redux/Actions/Session';
import HeaderOut from './../HeaderOut'
import './Login.css'

function Login() {
    let dispatch = useDispatch();
    if (sessionStorage.getItem('login')) {
        document.location.href = '/'
    }
    return (
        <>
            <HeaderOut />
            <div className="h-100 d-flex align-items-center justify-content-center">
                <div className="login d-flex flex-column justify-content-center">
                    <div className="title d-flex flex-row align-items-center mt-3">
                        <span className="traco"></span>
                        <h1 onClick={() => { dispatch(createToken({ accessIp: '123', accessBrowser: 'teste' })) }}>LOGIN</h1>
                        <span className="traco"></span>
                    </div>
                    <form>
                        <div className="login-form mt-3">
                            <div className="mt-2">
                                <input type="text" className="form-control bg-input" placeholder="Usuario" autoFocus="autofocus" defaultValue={useSelector(state => state.accessIp)} />
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