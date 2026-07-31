import React, { useState, useEffect } from "react";
import { Link, useLocation } from "react-router-dom";

function Navbar() {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  const [isScrolled, setIsScrolled] = useState(false);
  const location = useLocation();

  // Scroll Listener for Sticky Navbar
  useEffect(() => {
    const handleScroll = () => {
      if (window.scrollY > 50) {
        setIsScrolled(true);
      } else {
        setIsScrolled(false);
      }
    };
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  // Close mobile menu on route change
  useEffect(() => {
    setIsMobileMenuOpen(false);
  }, [location]);

  return (
    <header className={`header-site ${isScrolled ? "header-scrolled" : ""}`} id="header-site">
      <div className="container-custom">
        {/* Brand Logo */}
        <Link to="/" className="logo-brand">
          <i className="fa-solid fa-paper-plane"></i>
          Travel<span>Nest</span>
        </Link>
        
        {/* Desktop Navigation */}
        <nav className={`nav-menu-wrapper ${isMobileMenuOpen ? "active" : ""}`}>
          <ul className="nav-list">
            <li className="nav-item">
              <Link to="/" className="nav-link">Home</Link>
            </li>
            <li className="nav-item">
              <Link to="/about" className="nav-link">About Us</Link>
            </li>
            
            {/* Mega Menu - Destinations */}
            <li className="nav-item">
              <Link to="/destinations" className="nav-link">
                Destinations <i className="fa-solid fa-chevron-down"></i>
              </Link>
              <div className="mega-menu">
                <div className="mega-grid">
                  <div className="mega-column">
                    <h5 class="mega-column-title">Asia Pacific</h5>
                    <ul className="mega-links">
                      <li><Link to="/destination-details?dest=bali"><i className="fa-solid fa-circle"></i> Bali, Indonesia</Link></li>
                      <li><Link to="/destination-details?dest=maldives"><i className="fa-solid fa-circle"></i> Maldives Luxury</Link></li>
                      <li><Link to="/destination-details?dest=thailand"><i className="fa-solid fa-circle"></i> Tropical Thailand</Link></li>
                      <li><Link to="/destination-details?dest=singapore"><i className="fa-solid fa-circle"></i> Singapore City</Link></li>
                    </ul>
                  </div>
                  <div className="mega-column">
                    <h5 class="mega-column-title">Europe & Middle East</h5>
                    <ul className="mega-links">
                      <li><Link to="/destination-details?dest=switzerland"><i className="fa-solid fa-circle"></i> Swiss Alps, Switzerland</Link></li>
                      <li><Link to="/destination-details?dest=dubai"><i className="fa-solid fa-circle"></i> Dubai Sky-rise, UAE</Link></li>
                      <li><Link to="/destination-details?dest=europe"><i className="fa-solid fa-circle"></i> Grand Europe Tour</Link></li>
                      <li><Link to="/destination-details?dest=india"><i className="fa-solid fa-circle"></i> Heritage India</Link></li>
                    </ul>
                  </div>
                  <div className="mega-column">
                    <h5 class="mega-column-title">Special Packages</h5>
                    <ul className="mega-links">
                      <li><Link to="/packages?cat=honeymoon"><i className="fa-solid fa-circle"></i> Honeymoon Getaways</Link></li>
                      <li><Link to="/packages?cat=adventure"><i className="fa-solid fa-circle"></i> Alpine Adventures</Link></li>
                      <li><Link to="/packages?cat=luxury"><i className="fa-solid fa-circle"></i> Ultra Luxury Retreats</Link></li>
                      <li><Link to="/packages?cat=wildlife"><i className="fa-solid fa-circle"></i> Wilderness Safari</Link></li>
                    </ul>
                  </div>
                  {/* Mega Promotional Banner */}
                  <div className="mega-column">
                    <div className="mega-banner">
                      <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=300&q=80" alt="Special Offer" className="mega-banner-img img-cover" />
                      <div className="mega-banner-overlay"></div>
                      <div className="mega-banner-content">
                        <h5>Special Offer</h5>
                        <p>Save 20% on Bali resorts</p>
                        <Link to="/package-details?pkg=bali" className="mega-banner-btn">Book Now <i className="fa-solid fa-arrow-right"></i></Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            {/* Mega Menu - Tours */}
            <li className="nav-item">
              <Link to="/packages" className="nav-link">
                Tours <i className="fa-solid fa-chevron-down"></i>
              </Link>
              <div className="mega-menu" style={{ width: "600px" }}>
                <div className="mega-grid" style={{ gridTemplateColumns: "repeat(2, 1fr)" }}>
                  <div className="mega-column">
                    <h5 class="mega-column-title">Travel Services</h5>
                    <ul className="mega-links">
                      <li><Link to="/services"><i className="fa-solid fa-circle"></i> Custom Private Jets</Link></li>
                      <li><Link to="/services"><i className="fa-solid fa-circle"></i> Luxury Hotel Bookings</Link></li>
                      <li><Link to="/services"><i className="fa-solid fa-circle"></i> Chauffeur & Transfers</Link></li>
                      <li><Link to="/testimonials"><i className="fa-solid fa-circle"></i> Guest Reviews</Link></li>
                    </ul>
                  </div>
                  <div className="mega-column">
                    <h5 class="mega-column-title">Resources</h5>
                    <ul className="mega-links">
                      <li><Link to="/gallery"><i className="fa-solid fa-circle"></i> Photo Gallery</Link></li>
                      <li><Link to="/blog"><i className="fa-solid fa-circle"></i> Travel Blog</Link></li>
                      <li><Link to="/faq"><i className="fa-solid fa-circle"></i> FAQ Help Center</Link></li>
                      <li><Link to="/contact"><i className="fa-solid fa-circle"></i> Contact Agency</Link></li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>

            <li className="nav-item">
              <Link to="/services" className="nav-link">Services</Link>
            </li>
            <li className="nav-item">
              <Link to="/blog" className="nav-link">Blog</Link>
            </li>

            {/* Mega Menu - Company */}
            <li className="nav-item">
              <a href="#" onClick={(e) => e.preventDefault()} className="nav-link">Company <i className="fa-solid fa-chevron-down"></i></a>
              <div className="mega-menu" style={{ width: "800px", padding: "30px" }}>
                <div className="mega-grid" style={{ gridTemplateColumns: "repeat(3, 1fr)", gap: "30px" }}>
                  <div className="mega-column">
                    <h5 class="mega-column-title">Company Info</h5>
                    <ul className="mega-links">
                      <li><Link to="/careers"><i className="fa-solid fa-briefcase"></i> Careers Portal</Link></li>
                      <li><Link to="/press-media"><i className="fa-solid fa-newspaper"></i> Press & Media</Link></li>
                      <li><Link to="/partners"><i className="fa-solid fa-handshake"></i> Travel Partners</Link></li>
                      <li><Link to="/sustainability"><i className="fa-solid fa-leaf"></i> Sustainability</Link></li>
                      <li><Link to="/franchise"><i className="fa-solid fa-store"></i> Own Franchise</Link></li>
                      <li><Link to="/mobile-app"><i className="fa-solid fa-mobile-screen-button"></i> Mobile App</Link></li>
                      <li><Link to="/developers"><i className="fa-solid fa-code"></i> Developer API</Link></li>
                    </ul>
                  </div>
                  <div className="mega-column">
                    <h5 class="mega-column-title">Traveler Programs</h5>
                    <ul className="mega-links">
                      <li><Link to="/customer-account"><i className="fa-solid fa-crown"></i> Membership Plans</Link></li>
                      <li><Link to="/travel-rewards"><i className="fa-solid fa-star"></i> Travel Rewards</Link></li>
                      <li><Link to="/travel-referral"><i className="fa-solid fa-share-nodes"></i> Referral Program</Link></li>
                      <li><Link to="/gift-cards"><i className="fa-solid fa-gift"></i> Gift Cards</Link></li>
                      <li><Link to="/photo-contest"><i className="fa-solid fa-camera"></i> Photo Contest</Link></li>
                      <li><Link to="/community-forum"><i className="fa-solid fa-comments"></i> Travel Forum</Link></li>
                      <li><Link to="/customer-account"><i className="fa-solid fa-user-gear"></i> My Account</Link></li>
                    </ul>
                  </div>
                  <div className="mega-column">
                    <h5 class="mega-column-title">Portals & Safety</h5>
                    <ul className="mega-links">
                      <li><Link to="/travel-agent-portal"><i className="fa-solid fa-user-tie"></i> Agent Portal</Link></li>
                      <li><Link to="/travel-crm"><i className="fa-solid fa-chart-line"></i> Travel CRM</Link></li>
                      <li><Link to="/customer-crm"><i className="fa-solid fa-users-gear"></i> Customer CRM</Link></li>
                      <li><Link to="/booking-management"><i className="fa-solid fa-calendar-check"></i> Booking Manage</Link></li>
                      <li><Link to="/analytics-dashboard"><i className="fa-solid fa-chart-pie"></i> Analytics Panel</Link></li>
                      <li><Link to="/admin-dashboard"><i className="fa-solid fa-user-shield"></i> Admin Panel</Link></li>
                      <li><Link to="/emergency-assistance"><i className="fa-solid fa-circle-exclamation"></i> Emergency Info</Link></li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>

            <li className="nav-item">
              <Link to="/contact" className="nav-link">Contact</Link>
            </li>
          </ul>
        </nav>

        {/* Action Button */}
        <div className="header-actions">
          <Link to="/login" className="btn-header-login" style={{ marginRight: "15px", color: "var(--text-dark)", fontSize: "18px" }} title="My Account">
            <i className="fa-solid fa-user-circle"></i>
          </Link>
          <Link to="/booking" className="btn-header-book">Book Now</Link>
          
          {/* Hamburger Menu */}
          <div className={`hamburger-menu ${isMobileMenuOpen ? "active" : ""}`} onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}>
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div>
    </header>
  );
}

export default Navbar;
