import React from "react";
import "./Modal.css"


class Modal extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            show: "wrapperModal-hide",
        }

        
    }


    render() {
        return (
            <div className={this.props.show}>
                <div className="modalContent">
                    <p>{this.props.title}</p>
                    <p>{this.props.show}</p>
                    <p>{this.state.showCSS}</p>
                </div>
            </div>
        );
    }
}
export default Modal;
