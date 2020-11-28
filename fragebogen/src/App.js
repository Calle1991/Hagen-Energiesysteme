import "./App.css";
import Header from "./pages/header/header.js";
import Fragebogen from "./pages/fragebogen/Fragebogen.js";
import Kontaktdaten from "./pages/kontaktdaten/Kontaktdaten.js";
import Fertig from "./pages/fertig/Fertig.js";
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

function App() {
  return (
    <div className="App">
      <Header />
      <Router>
        <Switch>
          <Route path="/kontaktdaten">
            <Kontaktdaten />
          </Route>
          <Route path="/fertig">
            <Fertig />
          </Route>
          <Route path="/">
            <Fragebogen />
          </Route>
        </Switch>
      </Router>



    </div>
  );
}

export default App;
