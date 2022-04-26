function HeaderIn() {
    return (
        <header className="d-none d-sm-block">
            <div className="container">
                <div className="row">
                    <div className="col-md-12">
                        <div className="d-flex align-items-center">
                            <a href="/" className="logo"><img className="img-fluid" src="/assets/img/logo.png" alt="Esparta Core" /></a>
                            <div className="d-flex flex-fill justify-content-end">
                                <div className="warnings d-flex flex-column align-items-center">
                                    <a href="/" className="position-relative">
                                        <i className="far fa-bell fa-3x fa-white"></i>
                                    </a>
                                </div>
                                <div className="profile d-flex flex-row ml-4">
                                    <div className="photo">
                                        <img src="/assets/img/user.png" className="img-fluid rounded-circle" />
                                    </div>
                                    <div className="profile-info d-flex flex-column align-items-end ml-2">
                                        <a href="/" className="info1">Nome</a>
                                        <a href="javascript:void(0)" className="info2">Sair</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    )
}

export default HeaderIn