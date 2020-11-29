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

class Fragebogen extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      meter: '',
      stromverteiler: '',
      tiefbau: '',
      wanddruchbruch: '',
      installation: '',
      ladesaeule: ''
    }
    this.sendData = this.sendData.bind(this);
    this.handlevalidation = this.handlevalidation.bind(this);
    this.routeChange = this.routeChange.bind(this);
    console.log(this.state)
  }

  routeChange = () => {
    let path = '/kontaktdaten';
    this.props.history.push(path, {
      name: 'TEST',
      meter: document.getElementById('inputMeter').value,
      stromverteilerChecked: document.querySelector('input[name="stromverteiler"]:checked').value,
      tiefbauChecked: document.querySelector('input[name="tiefbau"]:checked').value,
      wanddurchbruchChecked: document.querySelector('input[name="wanddurchbruch"]:checked').value,
      installationChecked: document.querySelector('input[name="installation"]:checked').value,
      ladesaeuleChecked: document.querySelector('input[name="ladesaeule"]:checked').value
    })
  }


  handlevalidation() {
    let formIsValid = true;
    let stromverteilerChecked = document.querySelector('input[name="stromverteiler"]:checked');
    let tiefbauChecked = document.querySelector('input[name="tiefbau"]:checked');
    let wanddurchbruchChecked = document.querySelector('input[name="wanddurchbruch"]:checked');
    let installationChecked = document.querySelector('input[name="installation"]:checked');
    let ladesaeuleChecked = document.querySelector('input[name="ladesaeule"]:checked');


    if (document.getElementById('inputMeter').value === '') {
      document.getElementById('f__message').style.visibility = 'visible'
      formIsValid = false;
    }

    if (stromverteilerChecked == null || tiefbauChecked == null || wanddurchbruchChecked == null || installationChecked == null || ladesaeuleChecked == null) {
      document.getElementById('f__message').style.visibility = 'visible'
      formIsValid = false;
    }

    if (formIsValid) {
      document.getElementById('f__message').style.visibility = 'hidden'
      this.sendData();
    } else {
      alert("Es müssen alle Felder ausgefüllt werden");
    }
  }

  sendData() {
    this.routeChange()
  }




  render() {


    return (
      <div className="wrapperFragebogen">
        <h1>{this.state.meter}</h1>
        <div className="container">
          <form>
            <div className="fheader">
              <h1>Fragebogen</h1>
              <p>Anhand Ihrer eingaben ein individuelle Angebot bekommen</p>
              <p>{this.state.meter}</p>
            </div>
            <div className="f1">
              <p>Wie groß ist die Entfernung zum Stromverteiler?</p>
              <div className="auswahl__input">
                <TextField variant="outlined" id="inputMeter" type="number" name="meter" label="Meter"/>
              </div>
            </div>
            <div className="f2">
              <p>Ist ausreichend Platz für einen Stromverteiler vorhanden?</p>
              <p id="f2__desc">14 cm werden benötigt)</p>

              <RadioGroup>
                <div className="auswahl">
                  <div>
                    <Radio type="radio" name="stromverteiler" value="Ja"></Radio> <span>Ja</span>
                  </div>
                  <div>
                    <Radio type="radio" name="stromverteiler" value="Nein"></Radio> <span>Nein</span>
                  </div>
                </div>
              </RadioGroup>

            </div>
            <div className="f3">
              <p>Sind Tiefbauarbeiten notwendig?</p>
              <RadioGroup>
                <div className="auswahl">
                  <div>
                    <Radio type="radio" name="tiefbau" value="Ja"></Radio> <span>Ja</span>
                  </div>
                  <div>
                    <Radio type="radio" name="tiefbau" value="Nein"></Radio> <span>Nein</span>
                  </div>
                </div>
              </RadioGroup>
            </div>
            <div className="f4">
              <p>Sind Wanddurchbrüche erforderlich?</p>
              <RadioGroup>
                <div className="auswahl">
                  <div>
                    <Radio type="radio" name="wanddurchbruch" value="Ja"></Radio> <span>Ja</span>
                  </div>
                  <div>
                    <Radio type="radio" name="wanddurchbruch" value="Nein"></Radio> <span>Nein</span>
                  </div>
                </div>
              </RadioGroup>
            </div>
            <div className="f5">
              <p>Soll die Installation Auf- oder Unterputz erfolgen?</p>
              <RadioGroup>
                <div className="auswahl">
                  <div>
                    <Radio type="radio" name="installation" value="Aufputz"></Radio> <span>Aufputz</span>
                  </div>
                  <div>
                    <Radio type="radio" name="installation" value="Unterputz"></Radio> <span>Unterputz</span>
                  </div>
                </div>
              </RadioGroup>
            </div>
            <div className="f6">
              <p>Wie soll die Ladesäule montiert werden?</p>
              <RadioGroup>
                <div className="auswahl">
                  <div>
                    <Radio type="radio" name="ladesaeule" value="Wandfuß"></Radio> <span>Wandmontage</span>
                  </div>
                  <div>
                    <Radio type="radio" name="ladesaeule" value="Standfuß"></Radio> <span>Standfuß</span>
                  </div>
                </div>
              </RadioGroup>
            </div>
            <div>
            </div>
            <div className="errorMessage" id="f__message">
              <div>
                <p>Es müssen alle Felder ausgefüllt sein!  </p>
              </div>
            </div>

            <div className='buttonArea'>
              <Button variant="contained" onClick={this.handlevalidation}>Weiter</Button>
            </div>
          </form>

        </div>
      </div>
    );
  }
}

export default withRouter(Fragebogen);
