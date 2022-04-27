function Loader(props) {
    
    if (typeof (props.image) == 'undefined' || !props.image) {
        props.image = '/assets/img/loader.gif'
    }
    if (typeof (props.show) == 'undefined' || !props.show) {
        props.show = false
    }

    return (
        <div className={'clearfix' + (props.show ? ' d-block' : ' d-none')}>
            <div className="custom-loader-bg"></div>
            <div className="custom-loader" >
                <img src={props.image} alt="Processando..." />
            </div >
        </div >
    )
}

export default Loader