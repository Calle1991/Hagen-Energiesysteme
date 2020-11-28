import headerlogo from "./img/logo_header.png";
import "./header.css";

function Header() {
  return  <div className="header">
    <img id="headerlogo" src={headerlogo}></img>
  </div>
  
}

export default Header;
