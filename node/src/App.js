import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Login from './Components/Account/Login'
import Dashboard from './Components/Dashboard'

function App() {
  return (
    <>
      <BrowserRouter>
        <Switch>
          <Route path="/account/login">
            <Login />
          </Route>
          <Route path="/">
            <Dashboard />
          </Route>
        </Switch>
      </BrowserRouter>
    </>
  );
}

export default App;
