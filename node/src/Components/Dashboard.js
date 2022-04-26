export default function Dashboard(){
    if(!sessionStorage.getItem('login')){
        document.location.href='/account/login'
    }
    return (
        <div>
            Dashboard
        </div>
    );
}