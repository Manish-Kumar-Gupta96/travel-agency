import { Link } from "react-router-dom";
import { FaArrowRight, FaPlay } from "react-icons/fa";

import "./Hero.css";

function Hero() {
    return (
        <section className="hero">

            <div className="container">

                <div className="hero-wrapper">

                    <div className="hero-content">

                        <span className="hero-tag">

                            ✈ Explore The World

                        </span>

                        <h1>

                            Discover Amazing Places Around The World

                        </h1>

                        <p>

                            Book flights, hotels, tour packages and unforgettable
                            travel experiences with one trusted platform.

                        </p>

                        <div className="hero-buttons">

                            <Link
                                to="/packages"
                                className="hero-btn hero-btn-primary"
                            >

                                Explore Tours

                                <FaArrowRight />

                            </Link>

                            <button
                                className="hero-btn hero-btn-outline"
                            >

                                <FaPlay />

                                Watch Video

                            </button>

                        </div>

                        <div className="hero-stats">

                            <div>

                                <h3>25K+</h3>

                                <span>Happy Travelers</span>

                            </div>

                            <div>

                                <h3>450+</h3>

                                <span>Destinations</span>

                            </div>

                            <div>

                                <h3>12+</h3>

                                <span>Years Experience</span>

                            </div>

                        </div>

                    </div>

                    <div className="hero-image">

                        <img
                            src="/images/hero/hero.png"
                            alt="Travel Hero"
                        />

                    </div>

                </div>

            </div>

        </section>
    );
}

export default Hero;
