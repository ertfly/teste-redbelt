import HeaderIn from "../HeaderIn"
import { useDispatch, useSelector } from 'react-redux';
import { listUser, setListUser } from "../../Redux/Actions/User";
import { useEffect, useState } from "react";
import Loader from "../Loader";
import axios from "axios";
import { BASE_URL } from './../../Config'

function UserList() {
    if (sessionStorage.getItem('logged') != 1) {
        document.location.href = '/account/login'
    }

    let [error, setError] = useState('')
    let [loader, setLoader] = useState(false)

    let dispatch = useDispatch()
    useEffect(() => {
        dispatch(setListUser({ rows: [] }))
    }, [])

    axios.get(BASE_URL + 'user', { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
        console.log(request)
        let response = request.data.response
        let data = request.data.data

        if (response.action !== 0) {
            setLoader(false)
            setError(response.msg)
            return;
        }

        dispatch(setListUser({ rows: data.rows }))
    })

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

    const rows = useSelector(state => state.rows)

    return (
        <>
            <Loader show={loader} />
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
                                <a href="/" className="btn btn-primary">
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
                                        {!rows || rows.length <= 0 ? (
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
                                                                <a href="/" className="btn btn-primary btn-sm" title="Editar registro"><i className="fa fa-pencil fa-white"></i></a>
                                                                <button type="button" className="btn btn-danger btn-sm" title="Excluir registro"><i className="fa fa-trash fa-white"></i></button>
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
    if (sessionStorage.getItem('logged') !== 1) {
        document.location.href = '/account/login'
    }

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

    return (
        <>
            <HeaderIn breadcrumb={breadcrumb} />
            Usuários add
        </>
    )
}

export { UserList, UserAdd }