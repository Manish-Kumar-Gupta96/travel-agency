import React, { useState } from "react";
import { Link } from "react-router-dom";

function Footer() {
  const [email, setEmail] = useState("");

  const handleSubscribe = (e) => {
    e.preventDefault();
    if (!email) return;
    alert("Thank you for subscribing to our luxury newsletter!");
    setEmail("");
  };

  return (
    <footer className="footer-site">
      <div className="footer-top">
        <div className="container-custom">
          <div className="footer-grid">
            
            {/* Column 1: Brand Info */}
            <div className="footer-col">
              <Link to="/" className="footer-logo">
                <i className="fa-solid fa-paper-plane"></i>
                Travel<span>Nest</span>
              </Link>
              <p className="footer-desc">
                TravelNest is a global luxury travel and tour brand. We design personalized travel itineraries, private transfers, and luxury accommodation packages for travelers seeking high-end trips.
              </p>
              <div className="footer-socials">
                <a href="#" onClick={(e) => e.preventDefault()}><i className="fa-brands fa-facebook-f"></i></a>
                <a href="#" onClick={(e) => e.preventDefault()}><i className="fa-brands fa-instagram"></i></a>
                <a href="#" onClick={(e) => e.preventDefault()}><i className="fa-brands fa-x-twitter"></i></a>
                <a href="#" onClick={(e) => e.preventDefault()}><i className="fa-brands fa-linkedin-in"></i></a>
              </div>
            </div>

            {/* Column 2: Quick Links */}
            <div className="footer-col">
              <h4 className="footer-title">Quick Links</h4>
              <ul className="footer-links">
                <li><Link to="/"><i className="fa-solid fa-chevron-right"></i> Home</Link></li>
                <li><Link to="/about"><i className="fa-solid fa-chevron-right"></i> About Us</Link></li>
                <li><Link to="/destinations"><i className="fa-solid fa-chevron-right"></i> Destinations</Link></li>
                <li><Link to="/packages"><i className="fa-solid fa-chevron-right"></i> Tour Packages</Link></li>
                <li><Link to="/services"><i className="fa-solid fa-chevron-right"></i> Travel Services</Link></li>
                <li><Link to="/gallery"><i className="fa-solid fa-chevron-right"></i> Visual Gallery</Link></li>
              </ul>
            </div>

            {/* Column 3: Company Links */}
            <div className="footer-col">
              <h4 className="footer-title">Company</h4>
              <ul className="footer-links">
                <li><Link to="/careers"><i className="fa-solid fa-chevron-right"></i> Careers</Link></li>
                <li><Link to="/press-media"><i className="fa-solid fa-chevron-right"></i> Press & Media</Link></li>
                <li><Link to="/partners"><i className="fa-solid fa-chevron-right"></i> Travel Partners</Link></li>
                <li><Link to="/sustainability"><i className="fa-solid fa-chevron-right"></i> Sustainability</Link></li>
                <li><Link to="/customer-account"><i className="fa-solid fa-chevron-right"></i> Membership Plans</Link></li>
                <li><Link to="/travel-rewards"><i className="fa-solid fa-chevron-right"></i> Travel Rewards</Link></li>
                <li><Link to="/emergency-assistance"><i className="fa-solid fa-chevron-right"></i> Emergency Info</Link></li>
                <li><Link to="/travel-agent-portal"><i className="fa-solid fa-chevron-right"></i> Agent Portal</Link></li>
                <li><Link to="/developers"><i className="fa-solid fa-chevron-right"></i> Developer API</Link></li>
              </ul>
            </div>

            {/* Column 4: Contact Info */}
            <div className="footer-col">
              <h4 className="footer-title">Office Contact</h4>
              <ul className="footer-contact-list">
                <li>
                  <i className="fa-solid fa-location-dot"></i>
                  <div>
                    <span>Head Office Address</span>
                    <p>12 Luxury Plaza, Suite 400, New York, NY 10001</p>
                  </div>
                </li>
                <li>
                  <i className="fa-solid fa-phone"></i>
                  <div>
                    <span>Phone Support</span>
                    <p><a href="tel:+12125550190">+1 (212) 555-0190</a></p>
                  </div>
                </li>
                <li>
                  <i className="fa-solid fa-envelope"></i>
                  <div>
                    <span>Email Address</span>
                    <p><a href="mailto:concierge@travelnest.com">concierge@travelnest.com</a></p>
                  </div>
                </li>
              </ul>
            </div>

            {/* Column 5: Newsletter */}
            <div className="footer-col">
              <h4 className="footer-title">Stay Updated</h4>
              <p className="footer-newsletter-text">
                Join our elite newsletter and receive updates on secret tour packages, discount codes and seasonal itineraries.
              </p>
              <form className="newsletter-form-group" onSubmit={handleSubscribe}>
                <div className="newsletter-input-wrapper">
                  <i className="fa-solid fa-envelope"></i>
                  <input 
                    type="email" 
                    placeholder="Your Email Address" 
                    className="newsletter-input" 
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                  />
                </div>
                <button type="submit" className="btn-newsletter">
                  Subscribe <i className="fa-solid fa-paper-plane"></i>
                </button>
              </form>
            </div>

          </div>
        </div>
      </div>

      {/* Footer Bottom Copyright Bar */}
      <div className="footer-bottom">
        <div className="container-custom">
          <p>&copy; {new Date().getFullYear()} TravelNest. All Rights Reserved. Designed by Antigravity IDE.</p>
          <div className="footer-bottom-links">
            <a href="#" onClick={(e) => e.preventDefault()}>Privacy Policy</a>
            <a href="#" onClick={(e) => e.preventDefault()}>Terms & Conditions</a>
            <Link to="/faq">FAQ Support</Link>
          </div>
          <div className="payment-gateways">
            <i className="fa-brands fa-cc-visa"></i>
            <i className="fa-brands fa-cc-mastercard"></i>
            <i className="fa-brands fa-cc-amex"></i>
            <i className="fa-brands fa-cc-paypal"></i>
          </div>
        </div>
      </div>
    </footer>
  );
}

export default Footer;
