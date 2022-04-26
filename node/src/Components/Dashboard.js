import HeaderIn from "./HeaderIn";
import './BaseIn.css'

export default function Dashboard() {
    if (!sessionStorage.getItem('logged')) {
        document.location.href = '/account/login'
    }
    return (
        <div>
            <HeaderIn />
            Dashboard
        </div>
    );
}