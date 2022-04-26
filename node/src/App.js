import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Login from './Components/Account/Login'
import Dashboard from './Components/Dashboard'


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
