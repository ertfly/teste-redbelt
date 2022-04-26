import HeaderIn from "./HeaderIn";
import './BaseIn.css'

export default function Dashboard() {
    if (!sessionStorage.getItem('logged')) {
        document.location.href = '/account/login'
    }
    return (
        <div>
            <HeaderIn />
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