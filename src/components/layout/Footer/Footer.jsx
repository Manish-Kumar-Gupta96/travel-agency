import { Link } from "react-router-dom";
import {
    FaFacebookF,
    FaInstagram,
    FaLinkedinIn,
    FaTwitter,
    FaYoutube
} from "react-icons/fa";

import "./Footer.css";

function Footer() {
    const year = new Date().getFullYear();

    return (
        <footer className="footer">

            <div className="container">

                <div className="footer-grid">

                    <div>

                        <h2 className="footer-logo">
                            Travel Agency
                        </h2>

                        <p className="footer-text">
                            Explore the world's most beautiful destinations
                            with premium travel experiences.
                        </p>

                    </div>

                    <div>

                        <h4>Company</h4>

                        <ul>

                            <li>
                                <Link to="/about">
                                    About Us
                                </Link>
                            </li>

                            <li>
                                <Link to="/packages">
                                    Tour Packages
                                </Link>
                            </li>

                            <li>
                                <Link to="/contact">
                                    Contact
                                </Link>
                            </li>

                        </ul>

                    </div>

                    <div>

                        <h4>Support</h4>

                        <ul>

                            <li>
                                <Link to="/">
                                    Help Center
                                </Link>
                            </li>

                            <li>
                                <Link to="/">
                                    Privacy Policy
                                </Link>
                            </li>

                            <li>
                                <Link to="/">
                                    Terms & Conditions
                                </Link>
                            </li>

                        </ul>

                    </div>

                    <div>

                        <h4>Follow Us</h4>

                        <div className="social-icons">

                            <a href="#">
                                <FaFacebookF />
                            </a>

                            <a href="#">
                                <FaInstagram />
                            </a>

                            <a href="#">
                                <FaTwitter />
                            </a>

                            <a href="#">
                                <FaLinkedinIn />
                            </a>

                            <a href="#">
                                <FaYoutube />
                            </a>

                        </div>

                    </div>

                </div>

                <div className="footer-bottom">

                    © {year} Travel Agency. All Rights Reserved.

                </div>

            </div>

        </footer>
    );
}

export default Footer;
