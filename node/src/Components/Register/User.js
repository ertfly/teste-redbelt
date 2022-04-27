import HeaderIn from "../HeaderIn"

function User() {
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
            Usuários
        </>
    )
}

export default User