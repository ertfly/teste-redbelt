function HeaderIn() {
    return (
        <header class="d-none d-sm-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center">
                            <a href="/" class="logo"><img class="img-fluid" src="/assets/img/logo.png" alt="Esparta Core" /></a>
                            <div class="d-flex flex-fill justify-content-end">
                                <div class="warnings d-flex flex-column align-items-center">
                                    <a href="/" class="position-relative">
                                        <i class="far fa-bell fa-3x fa-white"></i>
                                    </a>
                                </div>
                                <div class="profile d-flex flex-row ml-4">
                                    <div class="photo">
                                        <img src="/assets/img/user.png" class="img-fluid rounded-circle" />
                                    </div>
                                    <div class="profile-info d-flex flex-column align-items-end ml-2">
                                        <a href="/" class="info1">Nome</a>
                                        <a href="javascript:void(0)" class="info2">Sair</a>
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