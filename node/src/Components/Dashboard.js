export default function Dashboard() {
    if (!sessionStorage.getItem('logged')) {
        document.location.href = '/account/login'
    }
    return (
        <div>
            Dashboard
        </div>
    );
}