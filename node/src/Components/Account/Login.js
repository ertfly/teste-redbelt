import HeaderOut from './../HeaderOut'
import './Login.css'

function Login() {
    return (
        <>
            <HeaderOut />
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="login d-flex flex-column justify-content-center">
                    <div class="title d-flex flex-row align-items-center mt-3">
                        <span class="traco"></span>
                        <h1>LOGIN</h1>
                        <span class="traco"></span>
                    </div>
                    <form>
                        <div class="login-form mt-3">
                            <div class="mt-2">
                                <input type="text" class="form-control bg-input" placeholder="Usuario" autofocus="autofocus" />
                            </div>
                            <div class="mt-2">
                                <input type="password" class="form-control bg-input" placeholder="Senha" />
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-primary btn-access">ACESSAR<i class="fa fa-arrow-right fa-white"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </>
    );
}

export default Login