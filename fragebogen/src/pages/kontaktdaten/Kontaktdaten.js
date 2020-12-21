import React from "react";
import "./Kontaktdaten.css";
import Button from '@material-ui/core/Button';
import Radio from '@material-ui/core/Radio';
import RadioGroup from '@material-ui/core/RadioGroup';
import TextField from '@material-ui/core/TextField';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Checkbox from '@material-ui/core/Checkbox';
import Modal from "../../elemente/modal/Modal.js"
import Datenschutz from '../datenschutz/Datenschutz.js'
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link,
  withRouter
} from "react-router-dom";

class Kontaktdaten extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      email: '',
      tel: '',
      meter: this.props.location.state.meter,
      stromverteilerChecked: this.props.location.state.stromverteilerChecked,
      tiefbauChecked: this.props.location.state.tiefbauChecked,
      wanddurchbruchChecked: this.props.location.state.wanddurchbruchChecked,
      installationChecked: this.props.location.state.installationChecked,
      ladesaeuleChecked: this.props.location.state.ladesaeuleChecked,
      show: false
    }
    console.log(this.props.location.state)
    this.routeChange = this.routeChange.bind(this);
    this.handlevalidation = this.handlevalidation.bind(this);
    this.showModal = this.showModal.bind(this);
  }



  routeChange = () => {
    let path = '/fertig';
    this.props.history.push(path, {
      name: document.getElementById('inputName').value,
      email: document.getElementById('inputEmail').value,
      tel: document.getElementById('inputTel').value,
      meter: this.state.meter,
      stromverteilerChecked: this.state.stromverteilerChecked,
      tiefbauChecked: this.state.tiefbauChecked,
      wanddurchbruchChecked: this.state.wanddurchbruchChecked,
      installationChecked: this.state.installationChecked,
      ladesaeuleChecked: this.state.ladesaeuleChecked
    })
  }


  handlevalidation() {
    let formIsValid = true;
    let datenschutzChecked = document.querySelector('input[name="datenschutz"]:checked');

    if (document.getElementById('inputEmail').value === '') {
      document.getElementById('f__message').style.visibility = 'visible'
      formIsValid = false;
    }

    if (datenschutzChecked == null) {
      document.getElementById('f__message__datenschutz').style.visibility = 'visible'
      formIsValid = false;
    }

    if (formIsValid) {
      document.getElementById('f__message').style.visibility = 'hidden'
      this.sendData();
    }

  }

  sendData() {
    this.routeChange()
  }

  showModal = e => {
    this.setState({
      show: !this.state.show
    });
  };



  render() {
    return (
      <div className="wrapperKontaktdaten">
        <div className="Modal">
          <Modal onClose={this.showModal} show={this.state.show}>
            <Datenschutz/>
        </Modal>
        </div>
        <div className="container">
          <form>
            <div className="kontaktdaten">
              <div className="kheader">
                <h1>Kontaktdaten</h1>
                <p>Damit wir dich erreichen können benötigen wir deine Kontaktdaten</p>
              </div>
              <div className="auswahl">
                <TextField
                  id="inputName"
                  type="text"
                  label="Name"
                  name="name"
                />
              </div>
              <div className="auswahl">
                <TextField
                  id="inputEmail"
                  type="email"
                  label="E-Mail"
                  name="email"
                />
              </div>
              <div className="errorMessageEmail" id="f__message">
                <div>
                  <p>bitte eine E-Mail-Adresse angeben</p>
                </div>
              </div>
              <div className="auswahl">
                <TextField id="inputTel" type="tel" type="tel" label="Telefon" name="tel" />
              </div>
            </div>
          </form>
          <div className='buttonArea__datenschutz'>
            <FormControlLabel control={<Checkbox name="datenschutz" />} />
            <span id="datenschutztext">Ich habe die <span id="hyperlink" onClick={e => {this.showModal(e);}} >Datenschutzerklärung</span> zur Kenntnis genommen. Ich stimme zu, dass meine Angaben und Daten zur Beantwortung meiner Anfrage elektronisch erhoben und gespeichert werden.</span>
          </div>
          <div className="errorMessageEmail" id="f__message__datenschutz">
            <div>
              <p>Sie müssen der Datenschutzerklärung zustimmen</p>
            </div>
          </div>
          <div className='buttonArea'>
            <Button variant="contained" onClick={this.handlevalidation}>Absenden</Button>
          </div>



        </div>
      </div>
    );
  }
}

export default withRouter(Kontaktdaten);
