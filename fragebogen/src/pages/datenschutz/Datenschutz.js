import React from "react";
import "./Fragebogen.css";
import Button from '@material-ui/core/Button';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import TextField from '@material-ui/core/TextField';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link,
  withRouter
} from "react-router-dom";

class Datenschutz extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      meter: '',
    }
  }

  render() {


    return (
      <h1>Datenschutz</h1>
    );
  }
}

export default withRouter (Datenschutz);
