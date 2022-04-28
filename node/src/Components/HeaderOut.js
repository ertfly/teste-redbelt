import { Redirect } from "react-router-dom";

function HeaderOut() {

    if (sessionStorage.getItem('logged') == 1) {
        document.location.href = '/'
    }

    return (
        <>
            <link href="/assets/css/base.out.css" rel="stylesheet" nonce="rAnd0m" />
            <header>
                <div className="container">
                    <div className="row">
                        <div className="col-md-12 text-center">
                            <a href="/" className="logo"><img className="img-fluid" src="/assets/img/logo.png" alt="Redbelt Test" /></a>
                        </div>
                    </div>
                </div>
            </header>
        </>

    );
}

export default HeaderOut