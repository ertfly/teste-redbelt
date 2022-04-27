function Loader(props) {
    if (typeof (props.image) == 'undefined' || !props.image) {
        props.image = '/assets/img/loader.gif'
    }
    if (typeof (props.show) == '' || !props.show) {
        props.show = false
    }

    return (
        <div className="clearfix" style={props.show ? 'display:block;' : 'display:none;'}>
            <div style="position:fixed;width:100%;height:100%;opacity:0.70;filter:alpha(opacity=60);background-color:#000;top:0;left:0;right:0;bottom:0;z-index:8000;"></div>
            <div style="position:fixed;top:40%;left:50%;margin-left:-32px;margin-top:-32px;background-color:#fff;width:64px;height:64px;-webkit-border-radius:12px;-moz-border-radius: 12px;border-radius: 12px;z-index: 8001;overflow: auto;" >
                <img src={props.image} alt="Processando..." />
            </div >
        </div >
    )
}

export default Loader