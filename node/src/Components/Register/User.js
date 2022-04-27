import HeaderIn from "../HeaderIn"
import { useState } from "react";
import Loader from "../Loader";
import axios from "axios";
import { BASE_URL } from './../../Config'

function UserList() {
    if (sessionStorage.getItem('logged') != 1) {
        document.location.href = '/account/login'
    }

    let [rows, setRows] = useState([])
    let [error, setError] = useState('')
    let [loader, setLoader] = useState(true)
    let [modalDelete, setModalDelete] = useState(false)
    let [id, setId] = useState(null)

    let list = () => {
        axios.get(BASE_URL + 'user', { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response
            let data = request.data.data

            if (response.action !== 0) {
                setLoader(false)
                setError(response.msg)
                return;
            }

            setLoader(false)
            setRows(data.rows)
        })
    }

    list()


    let breadcrumb = [];
    breadcrumb.push({
        text: 'Dashboard',
        url: '/',
        active: false,
    })
    breadcrumb.push({
        text: 'Cadastro - Usuários',
        url: null,
        active: true,
    })

    let del = (id) => {
        setLoader(true)
        axios.delete(BASE_URL + 'user/' + id, { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response
            let data = request.data.data

            if (response.action !== 0) {
                setLoader(false)
                setError(response.msg)
                return;
            }

            setModalDelete(false)
            list()
        })
    }

    return (
        <>
            <Loader show={loader} />
            <div className={'modal fade' + (modalDelete ? ' show' : '') + (modalDelete ? ' d-block' : '')} tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title">ATENÇÃO!</h4>
                            <button type="button" className="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div className="modal-body">
                            <p className="text-danger">Deseja realmente excluir este registro?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" onClick={() => { del(id) }}>Sim</button>
                            <button type="button" class="btn btn-danger" onClick={() => { setModalDelete(false) }}>Não</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class={'modal-backdrop fade show' + (modalDelete ? '' : ' d-none')} id="backdrop"></div>
            <HeaderIn breadcrumb={breadcrumb} />
            <div class={'alert alert-danger mt-3' + (error ? ' d-block' : ' d-none')}>{error}</div>
            <div className="container">
                <div className="card">
                    <div className="card-body">
                        <div className="d-flex justify-content-between">
                            <div>
                                <h2 className="card-title">Usuários</h2>
                                <p className="card-text">Gestão dos dados do usuário</p>
                            </div>
                            <div>
                                <a href="/register/user/add" className="btn btn-primary">
                                    <i className="fa fa-plus fa-white"></i> Adicionar
                                </a>
                            </div>
                        </div>
                        <ul className="nav nav-tabs mt-4" id="myTab" role="tablist">
                            <li className="nav-item">
                                <a className="nav-link active" href="/">Consulta</a>
                            </li>
                        </ul>
                        <div className="tabcontent-border">
                            <div className="table-responsive">
                                <table className="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th className="text-left">ID</th>
                                            <th className="text-left">Nome</th>
                                            <th className="text-left">Usuário</th>
                                            <th className="text-right">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {rows.length <= 0 ? (
                                            <>
                                                <tr>
                                                    <td className="text-center" colspan="20">Nenhum registro encontrado!</td>
                                                </tr>
                                            </>
                                        ) : (
                                            <>
                                                {rows.map((a) => (
                                                    <>
                                                        <tr>
                                                            <td>{a.id}</td>
                                                            <td>{a.name}</td>
                                                            <td>{a.username}</td>
                                                            <td className="text-right">
                                                                <a href="/" className="btn btn-primary btn-sm mr-1" title="Editar registro"><i className="fa fa-pencil fa-white"></i></a>
                                                                <button type="button" className="btn btn-danger btn-sm" title="Excluir registro" onClick={(e) => { setId(a.id); setModalDelete(true) }}><i className="fa fa-trash fa-white"></i></button>
                                                            </td>
                                                        </tr>
                                                    </>
                                                ))}
                                            </>
                                        )}

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

function UserAdd() {
    if (sessionStorage.getItem('logged') != 1) {
        document.location.href = '/account/login'
    }

    let [user, setUser] = useState({})
    let [loader, setLoader] = useState(false)
    let [error, setError] = useState('')

    let breadcrumb = [];
    breadcrumb.push({
        text: 'Dashboard',
        url: '/',
        active: false,
    })
    breadcrumb.push({
        text: 'Cadastro - Usuários',
        url: '/register/user',
        active: false,
    })
    breadcrumb.push({
        text: 'Novo',
        url: null,
        active: true,
    })

    let save = () => {
        setLoader(true)
        axios.post(BASE_URL + 'user', user, { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response
            let data = request.data.data

            if (response.action !== 0) {
                setError(response.msg)
                return;
            }

            window.setTimeout(function () { document.location.href = '/register/user' }, 400)
        })
    }

    return (
        <>
            <Loader show={loader} />
            <HeaderIn breadcrumb={breadcrumb} />
            <div class={'alert alert-danger' + (error ? ' d-block' : ' d-none')}>{error}</div>
            <div className="container">
                <div className="card">
                    <div className="card-body">

                        <div className="d-flex justify-content-between">
                            <div>
                                <h2 className="card-title">Usuário - Novo</h2>
                                <p className="card-text">Preencha os campos para inserir as informações</p>
                            </div>
                        </div>
                        <hr />
                        <ul className="nav nav-tabs mt-4">
                            <li className="nav-item">
                                <a className="nav-link active" href="/register/user/add">Informações</a>
                            </li>
                        </ul>
                        <div className="tabcontent-border">
                            <form method="post" onSubmit={(e) => { e.preventDefault(); save() }}>
                                <div className="form-row">
                                    <div className="col-md-4 form-group">
                                        <label className="required">Nome</label>
                                        <input type="text" className="form-control" onChange={e => setUser({ ...user, name: e.target.value })} />
                                    </div>
                                    <div className="col-md-4 form-group">
                                        <label className="required">Usuário</label>
                                        <input type="text" className="form-control" onChange={e => setUser({ ...user, username: e.target.value })} />
                                    </div>
                                    <div className="col-md-4 form-group">
                                        <label className="required">Senha</label>
                                        <input type="password" className="form-control" onChange={e => setUser({ ...user, pass: e.target.value })} />
                                    </div>
                                    <div className="col-md-4 form-group">
                                        <label className="required">Confirmar senha</label>
                                        <input type="password" className="form-control" onChange={e => setUser({ ...user, passConfirm: e.target.value })} />
                                    </div>
                                </div>
                                <div className="clearfix text-left">
                                    <button className="btn btn-primary" type="submit"><i className="mr-1 fas fa-plus fa-white"></i> Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

export { UserList, UserAdd }