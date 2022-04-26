import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Login from './Components/Account/Login'
import Dashboard from './Components/Dashboard'
import { useDispatch } from 'react-redux';
import axios from 'axios'
import { BASE_URL } from './Config';
import { createToken } from './Redux/Actions/Session';


let first = false

function App() {

  let dispatch = useDispatch()
  if (!first) {
    if (!sessionStorage.getItem('token')) {
      axios.post(BASE_URL + 'token').then((response) => {
        sessionStorage.setItem('token', response.data.data.token)
        sessionStorage.setItem('logged', response.data.data.logged)
        dispatch(createToken({ name: response.data.data.name, isLogged: response.data.data.logged, token: response.data.data.token }))
      })
    } else {
      axios.get(BASE_URL + 'token', { headers: { 'token': sessionStorage.getItem('token') } }).then((response) => {
        sessionStorage.setItem('logged', response.data.data.logged)
        dispatch(createToken({ name: response.data.data.name, isLogged: response.data.data.logged, token: response.data.data.token }))
      })
    }
    first = true
  }


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
