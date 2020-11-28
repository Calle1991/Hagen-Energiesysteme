import React from "react";
import "./Fertig.css";
import pic from "./img/done.png"
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link,
  withRouter
} from "react-router-dom";

class Fertig extends React.Component {
  constructor(props) {
    super(props);
    this.state = {


    }
  }

  componentDidMount() {
    this.sendDate();
  }

  sendDate() {
    fetch('https://hagen-energiesysteme.de/fragebogen/backend/sendMail.php', {
      method: 'POST',
      headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
      body: JSON.stringify(
        {
          sendmail: "sendmail",
          name: this.props.location.state.name,
          mail: this.props.location.state.email,
          tel: this.props.location.state.tel,
          meter: this.props.location.state.meter,
          stromverteilerChecked: this.props.location.state.stromverteilerChecked,
          tiefbauChecked: this.props.location.state.tiefbauChecked,
          wanddurchbruchChecked: this.props.location.state.wanddurchbruchChecked,
          installationChecked: this.props.location.state.installationChecked,
          ladesaeuleChecked: this.props.location.state.ladesaeuleChecked

        })
    }).then((response) => response.text())
      .then((responseData) => { console.log("response: " + responseData); })
      .catch((err) => { console.log(err); });
  }
  render() {
    return (
      <div className="wrapper">
        <div className="Container">
          <h1>Deine Angaben wurden übermittelt!</h1>
          <img src={pic}></img>
        </div>
      </div>
    );
  }
}

export default withRouter(Fertig);
