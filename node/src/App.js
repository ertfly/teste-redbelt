import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Login from './Components/Account/Login'
import Dashboard from './Components/Dashboard'
import { UserList, UserAdd } from './Components/Register/User'
import axios from 'axios'
import { BASE_URL } from './Config';


let first = false

function App() {

  if (!first) {
    if (!sessionStorage.getItem('token')) {
      axios.post(BASE_URL + 'token').then((response) => {
        sessionStorage.setItem('name', response.data.data.name)
        sessionStorage.setItem('token', response.data.data.token)
        sessionStorage.setItem('logged', response.data.data.logged)
      })
    } else {
      axios.get(BASE_URL + 'token', { headers: { 'token': sessionStorage.getItem('token') } }).then((response) => {
        sessionStorage.setItem('name', response.data.data.name)
        sessionStorage.setItem('logged', response.data.data.logged)
      })
    }
    first = true
  }


  return (
    <>
      <BrowserRouter>
        <Switch>
          <Route path="/register/user/add">
            <UserAdd key="UserAdd" />
          </Route>
          <Route path="/register/user">
            <UserList key="UserList" />
          </Route>
          <Route path="/account/login">
            <Login key="Login" />
          </Route>
          <Route path="/">
            <Dashboard key="Dasboard" />
          </Route>
        </Switch>
      </BrowserRouter>
    </>
  );
}

export default App;
