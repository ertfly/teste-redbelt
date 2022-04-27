function Loader(props) {
    let show, image
    if (typeof (props.image) == 'undefined' || !props.image) {
        image = '/assets/img/loader.gif'
    } else {
        image = props.image
    }
    if (typeof (props.show) == 'undefined' || !props.show) {
        show = false
    } else {
        show = props.show
    }

    return (
        <div className={'clearfix' + (show ? ' d-block' : ' d-none')}>
            <div className="custom-loader-bg"></div>
            <div className="custom-loader" >
                <img src={image} alt="Processando..." />
            </div >
        </div >
    )
}

export default Loader