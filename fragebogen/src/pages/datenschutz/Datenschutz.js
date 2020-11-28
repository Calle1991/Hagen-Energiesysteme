import React from "react";
import "./Datenschutz.css";
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
      <div className="wrapperDatenschutz">
        <div className="datenschutz">
          <h1>Datenschutz</h1>
          <p>Wir die Hagen Energiesysteme haben uns dem Datenschutz verpflichtet und möchten deshalb an dieser Stelle unserer Hinweispflicht aus Artikel 13 DSGVO nachkommen und Sie informieren, was mit Ihren Daten passiert und welche Rechte Sie haben.</p>
          <p><strong>Verantwortlich für die Verarbeitung</strong></p>
          <p>Hagen Energiesysteme</p>
          <p>Paul-Ehrlich-Weg 3</p>
          <p>31226 Peine</p>
          <br></br>
          <p>info@hagengmbh.de</p>
          <br></br>
          <h1>Kontaktdaten des Datenschutzbeauftragten</h1>
          <p>Herr Pascal Tobinski</p>
          <p>Paul-Ehrlich-Weg 3</p>
          <p>31226 Peine</p>
          <p>info@hagengmbh.de</p>
          <p>05171 / 5833966</p>
          <br></br>
          <h1>Zweck der Verarbeitung</h1>
          <p>Wir verarbeiten die hier angegebenen Daten ausschließlich zur Beantwortung Ihrer Anfrage. Wir beziehen uns dabei als Rechtsgrundlage der Verarbeitung auf den Artikel 6. Absatz 1 Buchstabe b DSGVO. Das bedeutet, wir gehen davon aus, dass Sie, wenn Sie dieses Kontaktformular nutzen unsere Leistungen anfragen oder bereits in einem Kundenverhältnis zu uns stehen.</p>
          <br></br>
          <h1>Weitergabe Ihrer Daten an Dritte</h1>
          <p>Die von Ihnen hier eingegebenen Daten werden uns automatisch per E-Mail geschickt und somit an unseren E-Mailprovider weiter gegeben, der unsere Postfächer hostet.
        Es handelt sich hierbei um die Firma:</p>
          <p>united-domains AG</p>
          <p>Gautinger Straße 10 </p>
          <p>82319 Starnberg </p>
          <p>Deutschland </p>
          <br></br>
          <p>Eine weitere Weitergabe Ihrer Daten erfolgt nicht. Weder an Dritte Parteien, noch an Drittländer oder internationale Organisationen.</p>
          <br></br>
          <h1>Dauer Ihrer Speicherung</h1>
          <p>Wir speichern Ihre Daten nur für den Zeitraum der Zweckerfüllung. Das heißt, dass wir Ihre Daten nach Erfüllung unverzüglich löschen. Sollte mit Ihrer Anfrage eine Angebots- oder Rechnungserstellung verbunden sein, speichern wir Ihre Daten gemäß den Regelungen der GoBD.</p>
          <br></br>
          <h1>Warum benötigen wir Ihre Daten?</h1>
          <p>Die Erhebung Ihrer Daten ist notwendig, um Ihre Anfrage bearbeiten zu können. Sie stellen uns diese freiwillig bereit. Eine Nichtbereitstellung hätte zur Folge, dass wir Ihre Anfrage nicht beantworten können.</p>
          <p>Sollten Sie weitere Fragen haben, zögern Sie bitte nicht Kontakt mit uns aufzunehmen.</p>
        </div>
      </div>
    );
  }
}

export default withRouter(Datenschutz);
