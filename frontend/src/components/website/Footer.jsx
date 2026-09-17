import { useState } from "react";
import { Link } from "react-router-dom";
import {
    FiMail,
    FiPhone,
    FiMapPin,
    FiSend,
    FiShield,
    FiHeart,
    FiAward,
    FiLock,
    FiGlobe,
    FiArrowRight
} from "react-icons/fi";
import {
    FaFacebookF,
    FaTwitter,
    FaInstagram,
    FaLinkedinIn,
    FaYoutube,
    FaCcVisa,
    FaCcMastercard,
    FaCcAmex,
    FaCcPaypal,
    FaApplePay
} from "react-icons/fa";
import { toast } from "react-toastify";

function Footer() {
    const [email, setEmail] = useState("");

    const handleSubscribe = (e) => {
        e.preventDefault();
        if (!email) return;
        toast.success("Thank you for subscribing! Check your email for an exclusive $100 travel voucher.");
        setEmail("");
    };

    return (
        <footer className="website-footer">
            <div className="container">
                {/* 1. Top Features Ribbon */}
                <div className="footer-ribbon">
                    <div className="ribbon-item">
                        <div className="ribbon-icon blue">
                            <FiAward />
                        </div>
                        <div className="ribbon-text">
                            <h5>Best Price Guarantee</h5>
                            <span>No hidden markups or fees</span>
                        </div>
                    </div>

                    <div className="ribbon-item">
                        <div className="ribbon-icon green">
                            <FiLock />
                        </div>
                        <div className="ribbon-text">
                            <h5>256-Bit SSL Secure</h5>
                            <span>Bank-grade encrypted checkout</span>
                        </div>
                    </div>

                    <div className="ribbon-item">
                        <div className="ribbon-icon amber">
                            <FiPhone />
                        </div>
                        <div className="ribbon-text">
                            <h5>24/7 Expert Support</h5>
                            <span>Dedicated ground concierges</span>
                        </div>
                    </div>

                    <div className="ribbon-item">
                        <div className="ribbon-icon purple">
                            <FiGlobe />
                        </div>
                        <div className="ribbon-text">
                            <h5>50+ Global Regions</h5>
                            <span>Handpicked certified partners</span>
                        </div>
                    </div>
                </div>

                {/* 2. Main 4-Column Footer Grid */}
                <div className="footer-grid">
                    {/* Brand Column */}
                    <div className="footer-brand">
                        <Link to="/" style={{ textDecoration: "none" }}>
                            <h3>✈️ Travel ERP</h3>
                        </Link>
                        <p>
                            Next-generation enterprise travel platform providing curated international itineraries, 5-star hotel accommodations, flight reservations, and complete agency operations.
                        </p>

                        {/* Social Links */}
                        <div className="footer-socials">
                            <a
                                href="https://www.linkedin.com/in/manish-kumar-gupta-9690dev"
                                target="_blank"
                                rel="noreferrer"
                                className="social-btn"
                                title="LinkedIn"
                            >
                                <FaLinkedinIn />
                            </a>
                            <a href="https://github.com/Manish-Kumar-Gupta96" target="_blank" rel="noreferrer" className="social-btn" title="GitHub">
                                <FaTwitter />
                            </a>
                            <a href="#" className="social-btn" title="Instagram">
                                <FaInstagram />
                            </a>
                            <a href="#" className="social-btn" title="Facebook">
                                <FaFacebookF />
                            </a>
                            <a href="#" className="social-btn" title="YouTube">
                                <FaYoutube />
                            </a>
                        </div>
                    </div>

                    {/* Explore Links */}
                    <div className="footer-col">
                        <h4>Explore Tours</h4>
                        <ul className="footer-links-list">
                            <li><Link to="/packages" className="footer-link"><FiArrowRight size={12} /> Tour Packages</Link></li>
                            <li><Link to="/destinations" className="footer-link"><FiArrowRight size={12} /> Top Destinations</Link></li>
                            <li><Link to="/hotels" className="footer-link"><FiArrowRight size={12} /> 5-Star Luxury Hotels</Link></li>
                            <li><Link to="/flights" className="footer-link"><FiArrowRight size={12} /> International Flights</Link></li>
                            <li><Link to="/deals" className="footer-link highlight"><FiArrowRight size={12} /> Flash Deals & Offers 🔥</Link></li>
                        </ul>
                    </div>

                    {/* Support & Company */}
                    <div className="footer-col">
                        <h4>Help & Agency</h4>
                        <ul className="footer-links-list">
                            <li><Link to="/about" className="footer-link"><FiArrowRight size={12} /> About Our Agency</Link></li>
                            <li><Link to="/reviews" className="footer-link"><FiArrowRight size={12} /> Verified Traveler Reviews</Link></li>
                            <li><Link to="/faq" className="footer-link"><FiArrowRight size={12} /> FAQs & Policies</Link></li>
                            <li><Link to="/contact" className="footer-link"><FiArrowRight size={12} /> 24/7 Concierge Contact</Link></li>
                            <li><Link to="/admin" className="footer-link highlight"><FiArrowRight size={12} /> Admin ERP Portal</Link></li>
                        </ul>
                    </div>

                    {/* Newsletter & Direct Contact */}
                    <div className="footer-newsletter">
                        <h4>Join 25,000+ Travelers</h4>
                        <p>
                            Subscribe to receive weekly secret flash sale alerts, free cancellation perks, and seasonal guides.
                        </p>

                        <form onSubmit={handleSubscribe} className="newsletter-form">
                            <input
                                type="email"
                                required
                                placeholder="Enter your email address"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                                className="newsletter-input"
                            />
                            <button type="submit" className="newsletter-btn">
                                <FiSend />
                            </button>
                        </form>

                        <div className="contact-info-list">
                            <div className="contact-info-item">
                                <FiMail />
                                <span>support@travelerp.com</span>
                            </div>
                            <div className="contact-info-item">
                                <FiPhone />
                                <span>+1 (800) 555-TRAVEL</span>
                            </div>
                            <div className="contact-info-item">
                                <FiMapPin />
                                <span>Global Operations Hub • New York & Mumbai</span>
                            </div>
                        </div>
                    </div>
                </div>

                {/* 3. Bottom Bar */}
                <div className="footer-bottom">
                    <div>
                        © 2026 <strong>Travel ERP</strong>. Engineered by <strong>Manish Kumar Gupta</strong>. All Rights Reserved.
                    </div>

                    {/* Payment Icons */}
                    <div className="payment-icons">
                        <FaCcVisa title="Visa" />
                        <FaCcMastercard title="MasterCard" />
                        <FaCcAmex title="American Express" />
                        <FaCcPaypal title="PayPal" />
                        <FaApplePay title="Apple Pay" style={{ fontSize: "30px" }} />
                    </div>

                    {/* Legal Links */}
                    <div className="footer-legal-links">
                        <Link to="/faq" className="legal-link">Privacy Policy</Link>
                        <Link to="/faq" className="legal-link">Terms of Service</Link>
                        <Link to="/faq" className="legal-link">Security</Link>
                    </div>
                </div>
            </div>
        </footer>
    );
}

export default Footer;
