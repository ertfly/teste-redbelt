import HeaderIn from "./HeaderIn";

export default function Dashboard() {
    let breadcrumb = [];
    breadcrumb.push({
        text: 'Dashboard',
        url: null,
        active: true,
    })

    return (
        <div>
            <HeaderIn breadcrumb={breadcrumb} />
            <div className="container">
                <div className="card">
                    <div className="card-body">
                        <div className="d-flex justify-content-between">
                            <div>
                                <h2 className="card-title">Dashboard</h2>
                                <p className="card-text">Bem vindo ao teste do Redbelt.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}