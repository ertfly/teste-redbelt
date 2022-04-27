import { useState } from "react";

function HeaderIn(props) {

    if (typeof (props.breadcrumb) == 'undefined' || !props.breadcrumb) {
        props.breadcrumb = [];
    }

    const [modalClose, setModalClose] = useState(false)

    return (
        <>
            <link href="/assets/css/base.in.css" rel="stylesheet" nonce="rAnd0m" />
            

            <header className="d-none d-sm-block">
                <div className="container">
                    <div className="row">
                        <div className="col-md-12">
                            <div className="d-flex align-items-center">
                                <a href="/" className="logo"><img className="img-fluid" src="/assets/img/logo.png" alt="Redbelt" /></a>
                                <div className="d-flex flex-fill justify-content-end">
                                    <div className="warnings d-flex flex-column align-items-center">
                                        <a href="/" className="position-relative">
                                            <i className="far fa-bell fa-3x fa-white"></i>
                                        </a>
                                    </div>
                                    <div className="profile d-flex flex-row ml-4">
                                        <div className="photo">
                                            <img src="/assets/img/user.png" className="img-fluid rounded-circle" alt="Redbelt" />
                                        </div>
                                        <div className="profile-info d-flex flex-column align-items-end ml-2">
                                            <a href="/" className="info1">{sessionStorage.getItem('name')}</a>
                                            <a href="#close" className="info2" onClick={setModalClose(true)}>Sair</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div className="menu-inferior clearfix d-none d-sm-block">
                <div className="container">
                    <ul>
                        <li className="sub">
                            <a href="/" target="_self">Cadastros</a>
                            <ul>
                                <li><a href="/register/user" target="_self"><i className="fa fa-cog"></i>Usuários</a></li>
                            </ul>
                        </li>
                        <li className="sub">
                            <a href="/" target="_self">Lançamento</a>
                            <ul>
                                <li><a href="/" target="_self"><i className="fa fa-cog"></i>Incidente</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div className="container d-none d-sm-block mt-3">
                <nav aria-label="breadcrumb">
                    <ol className="breadcrumb breadcrumb-bg">
                        {props.breadcrumb.map((item) => (
                            <>
                                {item.active ? (
                                    <>
                                        <li className="breadcrumb-item active">{item.text}</li>
                                    </>
                                ) : (
                                    <>
                                        <li className="breadcrumb-item"><a href={item.url}>{item.text}</a></li>
                                    </>
                                )}

                            </>
                        ))}
                    </ol>
                </nav>
            </div>

            <div className="pt-3 d-block d-sm-none"></div>
        </>
    )
}

export default HeaderIn