import { useState } from "react";
import { Link } from "react-router-dom";
import {
    FiMail,
    FiPhone,
    FiMapPin,
    FiSend,
    FiShield,
    FiHeart,
    FiCheckCircle,
    FiGlobe,
    FiAward,
    FiLock
} from "react-icons/fi";
import { FaFacebookF, FaTwitter, FaInstagram, FaLinkedinIn, FaYoutube, FaCcVisa, FaCcMastercard, FaCcAmex, FaCcPaypal, FaApplePay } from "react-icons/fa";
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
        <footer style={{
            background: "#0b1329",
            color: "#ffffff",
            paddingTop: "70px",
            paddingBottom: "35px",
            borderTop: "1px solid #1e293b",
            fontFamily: "'Inter', sans-serif"
        }}>
            <div className="container">
                {/* Top Features Ribbon */}
                <div style={{
                    background: "rgba(30, 41, 59, 0.6)",
                    backdropFilter: "blur(8px)",
                    border: "1px solid rgba(255, 255, 255, 0.08)",
                    borderRadius: "18px",
                    padding: "24px 30px",
                    marginBottom: "50px"
                }}>
                    <div className="row" style={{ alignItems: "center" }}>
                        <div className="col-12 col-6 col-3 mb-3 mb-md-0" style={{ display: "flex", alignItems: "center", gap: "14px" }}>
                            <div style={{ width: "42px", height: "42px", borderRadius: "10px", background: "rgba(37, 99, 235, 0.2)", color: "#60a5fa", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "20px" }}>
                                <FiAward />
                            </div>
                            <div>
                                <h5 style={{ fontSize: "14px", fontWeight: "800", color: "#ffffff", margin: 0 }}>Best Price Guarantee</h5>
                                <span style={{ fontSize: "12px", color: "#94a3b8" }}>No hidden booking fees</span>
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-3 mb-md-0" style={{ display: "flex", alignItems: "center", gap: "14px" }}>
                            <div style={{ width: "42px", height: "42px", borderRadius: "10px", background: "rgba(16, 185, 129, 0.2)", color: "#34d399", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "20px" }}>
                                <FiLock />
                            </div>
                            <div>
                                <h5 style={{ fontSize: "14px", fontWeight: "800", color: "#ffffff", margin: 0 }}>256-Bit SSL Secure</h5>
                                <span style={{ fontSize: "12px", color: "#94a3b8" }}>Encrypted transactions</span>
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-3 mb-md-0" style={{ display: "flex", alignItems: "center", gap: "14px" }}>
                            <div style={{ width: "42px", height: "42px", borderRadius: "10px", background: "rgba(245, 158, 11, 0.2)", color: "#fbbf24", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "20px" }}>
                                <FiPhone />
                            </div>
                            <div>
                                <h5 style={{ fontSize: "14px", fontWeight: "800", color: "#ffffff", margin: 0 }}>24/7 Expert Support</h5>
                                <span style={{ fontSize: "12px", color: "#94a3b8" }}>Dedicated ground team</span>
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3" style={{ display: "flex", alignItems: "center", gap: "14px" }}>
                            <div style={{ width: "42px", height: "42px", borderRadius: "10px", background: "rgba(168, 85, 247, 0.2)", color: "#c084fc", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "20px" }}>
                                <FiGlobe />
                            </div>
                            <div>
                                <h5 style={{ fontSize: "14px", fontWeight: "800", color: "#ffffff", margin: 0 }}>50+ Global Regions</h5>
                                <span style={{ fontSize: "12px", color: "#94a3b8" }}>Handpicked local partners</span>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Main 4-Column Footer */}
                <div className="row" style={{ borderBottom: "1px solid rgba(255,255,255,0.08)", paddingBottom: "50px", marginBottom: "35px" }}>
                    {/* Brand Column */}
                    <div className="col-12 col-4 mb-4">
                        <Link to="/" style={{ textDecoration: "none", display: "inline-flex", alignItems: "center", gap: "8px", marginBottom: "16px" }}>
                            <span style={{ fontSize: "24px", fontWeight: "900", color: "#60a5fa" }}>✈️ Travel ERP</span>
                        </Link>
                        <p style={{ fontSize: "14px", color: "#94a3b8", lineHeight: "1.7", marginBottom: "20px", maxWidth: "340px" }}>
                            Next-generation enterprise travel platform providing curated international itineraries, luxury hotel accommodations, flight reservations, and complete agency management.
                        </p>

                        {/* Social Links */}
                        <div style={{ display: "flex", gap: "10px" }}>
                            {[
                                { icon: <FaLinkedinIn />, href: "https://www.linkedin.com/in/manish-kumar-gupta-9690dev" },
                                { icon: <FaTwitter />, href: "#" },
                                { icon: <FaInstagram />, href: "#" },
                                { icon: <FaFacebookF />, href: "#" },
                                { icon: <FaYoutube />, href: "#" }
                            ].map((social, i) => (
                                <a
                                    key={i}
                                    href={social.href}
                                    target="_blank"
                                    rel="noreferrer"
                                    style={{
                                        width: "36px",
                                        height: "36px",
                                        borderRadius: "10px",
                                        background: "rgba(255,255,255,0.06)",
                                        color: "#cbd5e1",
                                        display: "flex",
                                        alignItems: "center",
                                        justifyContent: "center",
                                        fontSize: "14px",
                                        textDecoration: "none",
                                        transition: "all 0.2s ease"
                                    }}
                                >
                                    {social.icon}
                                </a>
                            ))}
                        </div>
                    </div>

                    {/* Quick Explore */}
                    <div className="col-12 col-2 mb-4">
                        <h4 style={{ fontSize: "16px", fontWeight: "800", color: "#ffffff", marginBottom: "18px" }}>Explore</h4>
                        <ul style={{ listStyle: "none", padding: "0", display: "flex", flexDirection: "column", gap: "12px", fontSize: "14px" }}>
                            <li><Link to="/packages" style={{ color: "#94a3b8", textDecoration: "none" }}>Tour Packages</Link></li>
                            <li><Link to="/destinations" style={{ color: "#94a3b8", textDecoration: "none" }}>Destinations</Link></li>
                            <li><Link to="/hotels" style={{ color: "#94a3b8", textDecoration: "none" }}>Luxury Hotels</Link></li>
                            <li><Link to="/flights" style={{ color: "#94a3b8", textDecoration: "none" }}>Flight Search</Link></li>
                            <li><Link to="/deals" style={{ color: "#38bdf8", textDecoration: "none", fontWeight: "700" }}>Special Deals 🔥</Link></li>
                        </ul>
                    </div>

                    {/* Company & Support */}
                    <div className="col-12 col-2 mb-4">
                        <h4 style={{ fontSize: "16px", fontWeight: "800", color: "#ffffff", marginBottom: "18px" }}>Support</h4>
                        <ul style={{ listStyle: "none", padding: "0", display: "flex", flexDirection: "column", gap: "12px", fontSize: "14px" }}>
                            <li><Link to="/about" style={{ color: "#94a3b8", textDecoration: "none" }}>About Us</Link></li>
                            <li><Link to="/reviews" style={{ color: "#94a3b8", textDecoration: "none" }}>Traveler Reviews</Link></li>
                            <li><Link to="/faq" style={{ color: "#94a3b8", textDecoration: "none" }}>FAQ & Help</Link></li>
                            <li><Link to="/contact" style={{ color: "#94a3b8", textDecoration: "none" }}>Contact Support</Link></li>
                            <li><Link to="/admin" style={{ color: "#60a5fa", textDecoration: "none", fontWeight: "700" }}>Admin ERP Portal</Link></li>
                        </ul>
                    </div>

                    {/* Newsletter & Contact */}
                    <div className="col-12 col-4 mb-4">
                        <h4 style={{ fontSize: "16px", fontWeight: "800", color: "#ffffff", marginBottom: "18px" }}>Stay In The Loop</h4>
                        <p style={{ fontSize: "13px", color: "#94a3b8", marginBottom: "16px", lineHeight: "1.6" }}>
                            Subscribe to get member-only discounts, secret flash sales, and comprehensive destination guides.
                        </p>

                        <form onSubmit={handleSubscribe} style={{ display: "flex", gap: "8px", marginBottom: "20px" }}>
                            <input
                                type="email"
                                required
                                placeholder="Enter your email"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                                style={{
                                    flex: "1",
                                    padding: "11px 16px",
                                    borderRadius: "10px",
                                    border: "1px solid rgba(255,255,255,0.15)",
                                    background: "rgba(255,255,255,0.05)",
                                    color: "#ffffff",
                                    fontSize: "14px",
                                    outline: "none"
                                }}
                            />
                            <button
                                type="submit"
                                className="btn btn-primary"
                                style={{ padding: "11px 20px", borderRadius: "10px", fontWeight: "700" }}
                            >
                                <FiSend />
                            </button>
                        </form>

                        <div style={{ fontSize: "13px", color: "#94a3b8", display: "flex", flexDirection: "column", gap: "6px" }}>
                            <div style={{ display: "flex", alignItems: "center", gap: "8px" }}>
                                <FiMail color="#60a5fa" />
                                <span>support@travelerp.com</span>
                            </div>
                            <div style={{ display: "flex", alignItems: "center", gap: "8px" }}>
                                <FiPhone color="#60a5fa" />
                                <span>+1 (800) 555-TRAVEL</span>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Bottom Bar: Copyright & Payment Icons */}
                <div style={{
                    display: "flex",
                    justifyContent: "space-between",
                    alignItems: "center",
                    flexWrap: "wrap",
                    gap: "16px",
                    fontSize: "13px",
                    color: "#64748b"
                }}>
                    <div>
                        © 2026 <strong>Travel ERP</strong>. Engineered by <strong>Manish Kumar Gupta</strong>. All Rights Reserved.
                    </div>

                    {/* Payment Gateways */}
                    <div style={{ display: "flex", alignItems: "center", gap: "12px", fontSize: "24px", color: "#94a3b8" }}>
                        <FaCcVisa title="Visa" />
                        <FaCcMastercard title="MasterCard" />
                        <FaCcAmex title="American Express" />
                        <FaCcPaypal title="PayPal" />
                        <FaApplePay title="Apple Pay" style={{ fontSize: "28px" }} />
                    </div>

                    {/* Legal Links */}
                    <div style={{ display: "flex", gap: "18px" }}>
                        <Link to="/faq" style={{ color: "#64748b", textDecoration: "none" }}>Privacy Policy</Link>
                        <Link to="/faq" style={{ color: "#64748b", textDecoration: "none" }}>Terms of Service</Link>
                        <Link to="/faq" style={{ color: "#64748b", textDecoration: "none" }}>Cookie Settings</Link>
                    </div>
                </div>
            </div>
        </footer>
    );
}

export default Footer;
