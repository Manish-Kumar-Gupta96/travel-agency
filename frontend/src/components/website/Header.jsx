import { useState } from "react";
import { NavLink, Link } from "react-router-dom";
import { FiCompass, FiMenu, FiX, FiGift, FiStar } from "react-icons/fi";
import TripCalculatorModal from "./TripCalculatorModal";

function Header() {
    const [isMenuOpen, setIsMenuOpen] = useState(false);
    const [isCalcOpen, setIsCalcOpen] = useState(false);

    const links = [
        { name: "Home", path: "/" },
        { name: "Packages", path: "/packages" },
        { name: "Destinations", path: "/destinations" },
        { name: "Hotels", path: "/hotels" },
        { name: "Flights", path: "/flights" },
        { name: "Deals 🔥", path: "/deals" },
        { name: "Reviews", path: "/reviews" },
        { name: "FAQ", path: "/faq" },
        { name: "Contact", path: "/contact" }
    ];

    return (
        <>
            <header className="website-header" style={{
                position: "sticky",
                top: 0,
                zIndex: 1000,
                background: "#ffffff",
                boxShadow: "0 2px 12px rgba(0,0,0,0.06)",
                padding: "14px 0"
            }}>
                <div className="container header-inner" style={{
                    display: "flex",
                    justifyContent: "space-between",
                    alignItems: "center"
                }}>
                    {/* Brand Logo */}
                    <Link to="/" style={{
                        fontSize: "22px",
                        fontWeight: "900",
                        color: "#1e3a8a",
                        textDecoration: "none",
                        display: "flex",
                        alignItems: "center",
                        gap: "8px"
                    }}>
                        <span>✈️ Travel ERP</span>
                    </Link>

                    {/* Navigation Links */}
                    <nav className="website-nav" style={{
                        display: "flex",
                        alignItems: "center",
                        gap: "18px"
                    }}>
                        {links.map((item) => (
                            <NavLink
                                key={item.path}
                                to={item.path}
                                style={({ isActive }) => ({
                                    color: isActive ? "#2563eb" : "#475569",
                                    fontWeight: isActive ? "800" : "600",
                                    textDecoration: "none",
                                    fontSize: "14px",
                                    transition: "color 0.2s ease"
                                })}
                            >
                                {item.name}
                            </NavLink>
                        ))}
                    </nav>

                    {/* Quick Action Buttons */}
                    <div className="header-action" style={{ display: "flex", alignItems: "center", gap: "10px" }}>
                        <button
                            onClick={() => setIsCalcOpen(true)}
                            className="btn btn-secondary"
                            style={{
                                padding: "8px 14px",
                                borderRadius: "8px",
                                fontSize: "13px",
                                fontWeight: "700",
                                background: "#eff6ff",
                                color: "#2563eb",
                                border: "1px solid #bfdbfe",
                                display: "flex",
                                alignItems: "center",
                                gap: "6px",
                                cursor: "pointer"
                            }}
                        >
                            <FiCompass />
                            <span>Trip Calculator</span>
                        </button>

                        <NavLink
                            to="/admin"
                            className="btn btn-secondary"
                            style={{
                                padding: "8px 14px",
                                borderRadius: "8px",
                                fontSize: "13px",
                                fontWeight: "700",
                                textDecoration: "none",
                                background: "#f8fafc",
                                color: "#334155",
                                border: "1px solid #cbd5e1"
                            }}
                        >
                            Admin ERP
                        </NavLink>

                        <NavLink
                            to="/login"
                            className="btn btn-primary"
                            style={{
                                padding: "8px 18px",
                                borderRadius: "8px",
                                fontSize: "13px",
                                fontWeight: "700",
                                textDecoration: "none"
                            }}
                        >
                            Sign In
                        </NavLink>
                    </div>
                </div>
            </header>

            {/* Trip Calculator Modal */}
            <TripCalculatorModal
                isOpen={isCalcOpen}
                onClose={() => setIsCalcOpen(false)}
            />
        </>
    );
}

export default Header;
