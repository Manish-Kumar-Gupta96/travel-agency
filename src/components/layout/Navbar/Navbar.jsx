import { Link, NavLink } from "react-router-dom";
import "./Navbar.css";

function Navbar() {

    return (

        <header className="navbar">

            <div className="container navbar-wrapper">

                <Link
                    to="/"
                    className="logo"
                >
                    Travel Agency
                </Link>

                <nav>

                    <ul className="nav-menu">

                        <li>
                            <NavLink to="/">
                                Home
                            </NavLink>
                        </li>

                        <li>
                            <NavLink to="/about">
                                About
                            </NavLink>
                        </li>

                        <li>
                            <NavLink to="/destinations">
                                Destinations
                            </NavLink>
                        </li>

                        <li>
                            <NavLink to="/packages">
                                Packages
                            </NavLink>
                        </li>

                        <li>
                            <NavLink to="/contact">
                                Contact
                            </NavLink>
                        </li>

                    </ul>

                </nav>

            </div>

        </header>

    );

}

export default Navbar;
