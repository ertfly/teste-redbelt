import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Login from './Components/Account/Login'
import Dashboard from './Components/Dashboard'
import { useDispatch } from 'react-redux';
import axios from 'axios'
import { BASE_URL } from './Config';
import { createToken } from './Redux/Actions/Session';

if (!sessionStorage.getItem('token')) {
  axios.post(BASE_URL + 'token').then((response) => {
    sessionStorage.setItem('token', response.data.data.token)
    sessionStorage.setItem('logged', false)
    useDispatch(createToken({ name: '', isLogged: response.data.logged, token: response.data.token }))
  })
} else {
  axios.get(BASE_URL + 'token', { headers: {'Content-Type':'application:json', 'Accept': 'application/json', 'token': sessionStorage.getItem('token')} }).then((response) => {
    sessionStorage.setItem('logged', response.data.logged)
    useDispatch(createToken({ name: '', isLogged: response.data.logged, token: response.data.token }))
  })
}


function App() {

  return (
    <>
      <BrowserRouter>
        <Switch>
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
