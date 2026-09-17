import { useState } from "react";
import { Link } from "react-router-dom";
import { FiMail, FiPhone, FiMapPin, FiSend, FiShield, FiHeart } from "react-icons/fi";
import { toast } from "react-toastify";

function Footer() {
    const [newsletterEmail, setNewsletterEmail] = useState("");

    const handleSubscribe = (e) => {
        e.preventDefault();
        if (!newsletterEmail) return;
        toast.success("Thank you for subscribing! Check your inbox for secret travel discount codes.");
        setNewsletterEmail("");
    };

    return (
        <footer style={{ background: "#0f172a", color: "#ffffff", paddingTop: "60px", paddingBottom: "30px" }}>
            <div className="container">
                <div className="row" style={{ borderBottom: "1px solid #1e293b", paddingBottom: "40px", marginBottom: "30px" }}>
                    {/* Brand Column */}
                    <div className="col-12 col-4 mb-4">
                        <h3 style={{ fontSize: "22px", fontWeight: "900", color: "#60a5fa", marginBottom: "14px" }}>
                            ✈️ Travel ERP
                        </h3>
                        <p style={{ fontSize: "14px", color: "#94a3b8", lineHeight: "1.7", marginBottom: "20px" }}>
                            Enterprise travel management platform offering bespoke tour packages, 5-star hotel bookings, international flights, and complete booking operations.
                        </p>
                        <div style={{ display: "flex", gap: "10px", fontSize: "13px", color: "#38bdf8" }}>
                            <span style={{ display: "flex", alignItems: "center", gap: "6px" }}><FiShield /> Verified & Protected</span>
                        </div>
                    </div>

                    {/* Navigation Links */}
                    <div className="col-12 col-2 mb-4">
                        <h4 style={{ fontSize: "15px", fontWeight: "700", color: "#ffffff", marginBottom: "16px" }}>Explore</h4>
                        <ul style={{ listStyle: "none", padding: "0", display: "flex", flexDirection: "column", gap: "10px", fontSize: "14px" }}>
                            <li><Link to="/packages" style={{ color: "#94a3b8", textDecoration: "none" }}>Tour Packages</Link></li>
                            <li><Link to="/destinations" style={{ color: "#94a3b8", textDecoration: "none" }}>Destinations</Link></li>
                            <li><Link to="/hotels" style={{ color: "#94a3b8", textDecoration: "none" }}>Luxury Hotels</Link></li>
                            <li><Link to="/flights" style={{ color: "#94a3b8", textDecoration: "none" }}>Flight Search</Link></li>
                            <li><Link to="/deals" style={{ color: "#38bdf8", textDecoration: "none", fontWeight: "700" }}>Special Deals 🔥</Link></li>
                        </ul>
                    </div>

                    {/* Company Links */}
                    <div className="col-12 col-2 mb-4">
                        <h4 style={{ fontSize: "15px", fontWeight: "700", color: "#ffffff", marginBottom: "16px" }}>Company</h4>
                        <ul style={{ listStyle: "none", padding: "0", display: "flex", flexDirection: "column", gap: "10px", fontSize: "14px" }}>
                            <li><Link to="/about" style={{ color: "#94a3b8", textDecoration: "none" }}>About Us</Link></li>
                            <li><Link to="/reviews" style={{ color: "#94a3b8", textDecoration: "none" }}>Traveler Reviews</Link></li>
                            <li><Link to="/faq" style={{ color: "#94a3b8", textDecoration: "none" }}>FAQ & Help</Link></li>
                            <li><Link to="/contact" style={{ color: "#94a3b8", textDecoration: "none" }}>Contact Support</Link></li>
                            <li><Link to="/admin" style={{ color: "#94a3b8", textDecoration: "none" }}>Admin Dashboard</Link></li>
                        </ul>
                    </div>

                    {/* Newsletter Subscription */}
                    <div className="col-12 col-4 mb-4">
                        <h4 style={{ fontSize: "15px", fontWeight: "700", color: "#ffffff", marginBottom: "16px" }}>Get Exclusive Travel Offers</h4>
                        <p style={{ fontSize: "13px", color: "#94a3b8", marginBottom: "14px" }}>
                            Join 25,000+ travelers and receive weekly flash sale alerts and travel guides directly in your inbox.
                        </p>
                        <form onSubmit={handleSubscribe} style={{ display: "flex", gap: "8px" }}>
                            <input
                                type="email"
                                required
                                placeholder="Your email address"
                                value={newsletterEmail}
                                onChange={(e) => setNewsletterEmail(e.target.value)}
                                style={{
                                    flex: "1",
                                    padding: "10px 14px",
                                    borderRadius: "8px",
                                    border: "1px solid #334155",
                                    background: "#1e293b",
                                    color: "#ffffff",
                                    fontSize: "13px",
                                    outline: "none"
                                }}
                            />
                            <button type="submit" className="btn btn-primary" style={{ padding: "10px 18px", borderRadius: "8px", fontWeight: "700" }}>
                                <FiSend />
                            </button>
                        </form>
                    </div>
                </div>

                {/* Footer Bottom */}
                <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", flexWrap: "wrap", gap: "12px", fontSize: "13px", color: "#64748b" }}>
                    <div>
                        © 2026 Travel ERP. Designed & Developed with <FiHeart color="#ef4444" size={12} /> for Modern Travel Enterprises.
                    </div>
                    <div style={{ display: "flex", gap: "20px" }}>
                        <Link to="/faq" style={{ color: "#64748b", textDecoration: "none" }}>Privacy Policy</Link>
                        <Link to="/faq" style={{ color: "#64748b", textDecoration: "none" }}>Terms of Service</Link>
                        <Link to="/admin" style={{ color: "#64748b", textDecoration: "none" }}>ERP Login</Link>
                    </div>
                </div>
            </div>
        </footer>
    );
}

export default Footer;
