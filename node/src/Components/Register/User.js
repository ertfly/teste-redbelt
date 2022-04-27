import HeaderIn from "../HeaderIn"

function UserList() {
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

    return (
        <>
            <HeaderIn breadcrumb={breadcrumb} />
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
                                            <th className="text-left">Nome</th>
                                            <th className="text-left">Usuário</th>
                                            <th className="text-center">Perfis</th>
                                            <th className="text-right">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>asdasd</td>
                                            <td>asdasd</td>
                                            <td className="text-center">
                                                asdasd
                                            </td>
                                            <td className="text-right">
                                                <a href="/" className="btn btn-primary btn-sm" title="Editar registro"><i className="fa fa-pencil fa-white"></i></a>
                                                <button type="button" className="btn btn-danger btn-sm" title="Excluir registro"><i className="fa fa-trash fa-white"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td className="text-center" colspan="20">Nenhum registro encontrado!</td>
                                        </tr>
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