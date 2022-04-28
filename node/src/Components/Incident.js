import HeaderIn from "./HeaderIn"
import { useEffect, useState } from "react";
import Loader from "./Loader";
import axios from "axios";
import { BASE_URL } from './../Config'
import { useParams } from "react-router";

function IncidentList() {
    let [rows, setRows] = useState([])
    let [error, setError] = useState('')
    let [loader, setLoader] = useState(true)
    let [modalDelete, setModalDelete] = useState(false)
    let [id, setId] = useState(null)

    let list = () => {
        axios.get(BASE_URL + 'incident', { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
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

    useEffect(() => {
        list()
    }, [])


    let breadcrumb = [];
    breadcrumb.push({
        text: 'Dashboard',
        url: '/',
        active: false,
    })
    breadcrumb.push({
        text: 'Incidentes',
        url: null,
        active: true,
    })

    let del = (id) => {
        setLoader(true)
        axios.delete(BASE_URL + 'incident/' + id, { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response

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
            <Loader show={loader} key="loader" />
            <div className={'modal fade' + (modalDelete ? ' show' : '') + (modalDelete ? ' d-block' : '')}>
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title">ATENÇÃO!</h4>
                            <button type="button" className="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div className="modal-body">
                            <p className="text-danger">Deseja realmente excluir este registro?</p>
                        </div>
                        <div className="modal-footer">
                            <button type="submit" className="btn btn-success" onClick={() => { del(id) }}>Sim</button>
                            <button type="button" className="btn btn-danger" onClick={() => { setModalDelete(false) }}>Não</button>
                        </div>
                    </div>
                </div>
            </div>
            <div className={'modal-backdrop fade show' + (modalDelete ? '' : ' d-none')} id="backdrop"></div>
            <HeaderIn breadcrumb={breadcrumb} key="headerIn" />
            <div className={'alert alert-danger mt-3' + (error ? ' d-block' : ' d-none')}>{error}</div>
            <div className="container">
                <div className="card">
                    <div className="card-body">
                        <div className="d-flex justify-content-between">
                            <div>
                                <h2 className="card-title">Incidentes</h2>
                                <p className="card-text">Gestão de incidentes</p>
                            </div>
                            <div>
                                <a href="/incident/add" className="btn btn-primary">
                                    <i className="fa fa-plus fa-white"></i> Adicionar
                                </a>
                            </div>
                        </div>
                        <ul className="nav nav-tabs mt-4" id="myTab" role="tablist">
                            <li className="nav-item">
                                <a className="nav-link active" href="/incident">Consulta</a>
                            </li>
                        </ul>
                        <div className="tabcontent-border">
                            <div className="table-responsive">
                                <table className="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th className="text-left">ID</th>
                                            <th className="text-left">Título</th>
                                            <th className="text-left">Criticidade</th>
                                            <th className="text-left">Tipo</th>
                                            <th className="text-left">Status</th>
                                            <th className="text-right">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {rows.length <= 0 ? (
                                            <>
                                                <tr>
                                                    <td className="text-center" colSpan="20">Nenhum registro encontrado!</td>
                                                </tr>
                                            </>
                                        ) : (
                                            <>
                                                {rows.map((a, i) => (
                                                    <tr key={i}>
                                                        <td>{a.id}</td>
                                                        <td>{a.title}</td>
                                                        <td>{a.critical}</td>
                                                        <td>{a.type}</td>
                                                        <td>{a.status}</td>
                                                        <td className="text-right">
                                                            <a href={'/incident/edit/' + a.id} className="btn btn-primary btn-sm mr-1" title="Editar registro"><i className="fa fa-pencil fa-white"></i></a>
                                                            <button type="button" className="btn btn-danger btn-sm" title="Excluir registro" onClick={(e) => { setId(a.id); setModalDelete(true) }}><i className="fa fa-trash fa-white"></i></button>
                                                        </td>
                                                    </tr>
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

function IncidentAdd() {
    let [incident, setIncident] = useState({})
    let [loader, setLoader] = useState(true)
    let [error, setError] = useState('')
    let [selects, setSelects] = useState({
        criticals: [],
        types: [],
        status: [],
    })

    let breadcrumb = [];
    breadcrumb.push({
        text: 'Dashboard',
        url: '/',
        active: false,
    })
    breadcrumb.push({
        text: 'Incidentes',
        url: '/incident',
        active: false,
    })
    breadcrumb.push({
        text: 'Novo',
        url: null,
        active: true,
    })

    let load = () => {
        axios.get(BASE_URL + 'incident/create', { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response
            let data = request.data.data

            if (response.action !== 0) {
                setLoader(false)
                setError(response.msg)
                return;
            }

            setLoader(false)
            setSelects(data)
        })
    }

    useEffect(() => {
        load()
    }, [])

    let save = () => {
        setLoader(true)
        axios.post(BASE_URL + 'incident', incident, { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response

            if (response.action !== 0) {
                setLoader(false)
                setError(response.msg)
                return;
            }

            window.setTimeout(function () { document.location.href = '/incident' }, 400)
        })
    }

    return (
        <>
            <Loader show={loader} />
            <HeaderIn breadcrumb={breadcrumb} key="headerIn" />
            <div className={'alert alert-danger' + (error ? ' d-block' : ' d-none')}>{error}</div>
            <div className="container">
                <div className="card">
                    <div className="card-body">

                        <div className="d-flex justify-content-between">
                            <div>
                                <h2 className="card-title">Incidente - Novo</h2>
                                <p className="card-text">Preencha os campos para inserir as informações</p>
                            </div>
                        </div>
                        <hr />
                        <ul className="nav nav-tabs mt-4">
                            <li className="nav-item">
                                <a className="nav-link active" href="/incident/add">Informações</a>
                            </li>
                        </ul>
                        <div className="tabcontent-border">
                            <form method="post" onSubmit={(e) => { e.preventDefault(); save() }}>
                                <div className="form-row">
                                    <div className="col-md-4 form-group">
                                        <label className="required">Criticidade</label>
                                        <select className="form-control" onChange={e => setIncident({ ...incident, criticalId: e.target.value })}>
                                            <option value="">Selecione</option>
                                            {selects.criticals.map((a,i) => {
                                                return (
                                                    <option key={i} value={a.id}>{a.description}</option>
                                                )
                                            })}
                                        </select>
                                    </div>
                                    <div className="col-md-4 form-group">
                                        <label className="required">Tipo</label>
                                        <select className="form-control" onChange={e => setIncident({ ...incident, typeId: e.target.value })}>
                                            <option value="">Selecione</option>
                                            {selects.types.map((a,i) => {
                                                return (
                                                    <option key={i} value={a.id}>{a.description}</option>
                                                )
                                            })}
                                        </select>
                                    </div>
                                    <div className="col-md-4 form-group">
                                        <label className="required">Status</label>
                                        <select className="form-control" onChange={e => setIncident({ ...incident, statusId: e.target.value })}>
                                            <option value="">Selecione</option>
                                            {selects.status.map((a,i) => {
                                                return (
                                                    <option key={i} value={a.id}>{a.description}</option>
                                                )
                                            })}
                                        </select>
                                    </div>
                                    <div className="col-md-12 form-group">
                                        <label className="required">Título</label>
                                        <input type="text" className="form-control" onChange={e => setIncident({ ...incident, title: e.target.value })} />
                                    </div>
                                    <div className="col-md-12 form-group">
                                        <label className="required">Descrição</label>
                                        <textarea className="form-control" onChange={e => setIncident({ ...incident, description: e.target.value })}></textarea>
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

function IncidentEdit() {
    let { id } = useParams();

    if (!id) {
        document.location.href = '/incident'
    }

    let [incident, setIncident] = useState({
        title: '',
        description: '',
        criticalId: null,
        typeId: null,
        statusId: null,
    })
    let [loader, setLoader] = useState(true)
    let [error, setError] = useState('')
    let [selects, setSelects] = useState({
        criticals: [],
        types: [],
        status: [],
    })

    let breadcrumb = [];
    breadcrumb.push({
        text: 'Dashboard',
        url: '/',
        active: false,
    })
    breadcrumb.push({
        text: 'Incidentes',
        url: '/incident',
        active: false,
    })
    breadcrumb.push({
        text: 'Editar',
        url: null,
        active: true,
    })

    useEffect(() => {
        axios.get(BASE_URL + 'incident/' + id, { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response
            let data = request.data.data

            if (response.action !== 0) {
                setLoader(false)
                setError(response.msg)
                return;
            }

            setLoader(false)
            setIncident({
                title: data.title,
                description: data.description,
                criticalId: data.criticalId,
                typeId: data.typeId,
                statusId: data.statusId,
            })
            setSelects({
                criticals: data.criticals,
                types: data.types,
                status: data.status,
            })
        })
    }, [id]);

    let save = () => {
        setLoader(true)
        axios.put(BASE_URL + 'incident/' + id, incident, { headers: { 'token': sessionStorage.getItem('token') } }).then((request) => {
            let response = request.data.response

            if (response.action !== 0) {
                setLoader(false)
                setError(response.msg)
                return;
            }

            window.setTimeout(function () { document.location.href = '/incident' }, 400)
        })
    }

    return (
        <>
            <Loader show={loader} />
            <HeaderIn breadcrumb={breadcrumb} key="headerIn" />
            <div className={'alert alert-danger' + (error ? ' d-block' : ' d-none')}>{error}</div>
            <div className="container">
                <div className="card">
                    <div className="card-body">
                        <div className="d-flex justify-content-between">
                            <div>
                                <h2 className="card-title">Incidente - #{id} - Editar</h2>
                                <p className="card-text">Preencha os campos para inserir as informações</p>
                            </div>
                        </div>
                        <hr />
                        <ul className="nav nav-tabs mt-4">
                            <li className="nav-item">
                                <a className="nav-link active" href="/incident/add">Informações</a>
                            </li>
                        </ul>
                        <div className="tabcontent-border">
                            <form method="post" onSubmit={(e) => { e.preventDefault(); save() }}>
                            <div className="form-row">
                                    <div className="col-md-4 form-group">
                                        <label className="required">Criticidade</label>
                                        <select className="form-control" onChange={e => setIncident({ ...incident, criticalId: e.target.value })} value={incident.criticalId}>
                                            <option value="">Selecione</option>
                                            {selects.criticals.map((a,i) => {
                                                return (
                                                    <option key={i} value={a.id}>{a.description}</option>
                                                )
                                            })}
                                        </select>
                                    </div>
                                    <div className="col-md-4 form-group">
                                        <label className="required">Tipo</label>
                                        <select className="form-control" onChange={e => setIncident({ ...incident, typeId: e.target.value })} value={incident.typeId}>
                                            <option value="">Selecione</option>
                                            {selects.types.map((a,i) => {
                                                return (
                                                    <option key={i} value={a.id}>{a.description}</option>
                                                )
                                            })}
                                        </select>
                                    </div>
                                    <div className="col-md-4 form-group">
                                        <label className="required">Status</label>
                                        <select className="form-control" onChange={e => setIncident({ ...incident, statusId: e.target.value })} value={incident.statusId}>
                                            <option value="">Selecione</option>
                                            {selects.status.map((a,i) => {
                                                return (
                                                    <option key={i} value={a.id}>{a.description}</option>
                                                )
                                            })}
                                        </select>
                                    </div>
                                    <div className="col-md-12 form-group">
                                        <label className="required">Título</label>
                                        <input type="text" className="form-control" onChange={e => setIncident({ ...incident, title: e.target.value })} defaultValue={incident.title} />
                                    </div>
                                    <div className="col-md-12 form-group">
                                        <label className="required">Descrição</label>
                                        <textarea className="form-control" onChange={e => setIncident({ ...incident, description: e.target.value })} defaultValue={incident.description}></textarea>
                                    </div>
                                </div>
                                <div className="clearfix text-left">
                                    <button className="btn btn-primary" type="submit"><i className="mr-1 fas fa-save fa-white"></i> Alterar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

export { IncidentList, IncidentAdd, IncidentEdit }