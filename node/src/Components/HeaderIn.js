import { useState } from "react";
import Loader from './Loader'
import axios from 'axios'
import { BASE_URL } from './../Config';
import { Redirect } from "react-router-dom";

function HeaderIn(props) {

    let breadcrumb = props.breadcrumb
    if (!breadcrumb) {
        breadcrumb = []
    }

    const [modalClose, setModalClose] = useState(false)
    const [loader, setLoader] = useState(false)
    const [error, setError] = useState('')

    let logout = () => {
        setLoader(true)
        axios.delete(BASE_URL + 'account/login', { headers: { token: sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response

            if (response.action !== 0) {
                setLoader(false)
                setError(response.msg)
                return;
            }

            sessionStorage.setItem('name', '')
            sessionStorage.setItem('logged', 0)
            window.setTimeout(function () { document.location.href = '/account/login' }, 500)
        })
    }

    if (sessionStorage.getItem('logged') != 1) {
        return <Redirect to="/account/login" />
    }

    return (
        <>
            <Loader show={loader} key="loaderHeader" />
            <link href="/assets/css/base.in.css" rel="stylesheet" nonce="rAnd0m" />
            <div className={'modal fade' + (modalClose ? ' show' : '') + (modalClose ? ' d-block' : '')}>
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title">ATENÇÃO!</h4>
                            <button type="button" className="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div className="modal-body">
                            <p className="text-danger">Deseja realmente se desconectar?</p>
                        </div>
                        <div className="modal-footer">
                            <button type="submit" className="btn btn-success" onClick={() => { logout() }}>Sim</button>
                            <button type="button" className="btn btn-danger" onClick={() => { setModalClose(false) }}>Não</button>
                        </div>
                    </div>
                </div>
            </div>
            <div className={'modal-backdrop fade show' + (modalClose ? '' : ' d-none')} id="backdrop"></div>
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
                                            <a href="#a" className="info2" onClick={(e) => { e.preventDefault(); setModalClose(true) }}>Sair</a>
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
                            <a href="#a" target="_self">Cadastros</a>
                            <ul>
                                <li><a href="/register/user" target="_self"><i className="fa fa-cog"></i>Usuários</a></li>
                            </ul>
                        </li>
                        <li className="sub">
                            <a href="/incident" target="_self">Incidentes</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div className="container d-none d-sm-block mt-3">
                <nav aria-label="breadcrumb">
                    <ol className="breadcrumb breadcrumb-bg">
                        {breadcrumb.map((item, i) => {
                            if (item.active) {
                                return (
                                    <li key={i} className="breadcrumb-item active">{item.text}</li>
                                )
                            }

                            return (
                                <li key={i} className="breadcrumb-item"><a href={item.url}>{item.text}</a></li>
                            )
                        })}
                    </ol>
                </nav>
            </div>

            <div className="pt-3 d-block d-sm-none"></div>
            <div className={'alert alert-danger' + (error ? ' d-block' : ' d-none')}>{error}</div>
        </>
    )
}

export default HeaderIn