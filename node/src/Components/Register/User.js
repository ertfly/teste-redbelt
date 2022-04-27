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
            Usuários lista
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