import { NavLink, Link } from "react-router-dom";

function Header() {
    const links = [
        { name: "Home", path: "/" },
        { name: "Tour Packages", path: "/packages" },
        { name: "Destinations", path: "/destinations" },
        { name: "About", path: "/about" },
        { name: "Contact", path: "/contact" }
    ];

    return (
        <header className="website-header" style={{
            position: "sticky",
            top: 0,
            zIndex: 1000,
            background: "#ffffff",
            boxShadow: "0 2px 10px rgba(0,0,0,0.06)",
            padding: "16px 0"
        }}>
            <div className="container header-inner" style={{
                display: "flex",
                justifyContent: "space-between",
                alignItems: "center"
            }}>
                <Link to="/" style={{
                    fontSize: "22px",
                    fontWeight: "800",
                    color: "#1e3a8a",
                    textDecoration: "none",
                    display: "flex",
                    alignItems: "center",
                    gap: "8px"
                }}>
                    <span>✈️ Travel ERP</span>
                </Link>

                <nav className="website-nav" style={{
                    display: "flex",
                    alignItems: "center",
                    gap: "24px"
                }}>
                    {links.map((item) => (
                        <NavLink
                            key={item.path}
                            to={item.path}
                            style={({ isActive }) => ({
                                color: isActive ? "#2563eb" : "#475569",
                                fontWeight: isActive ? "700" : "500",
                                textDecoration: "none",
                                fontSize: "15px",
                                transition: "color 0.2s"
                            })}
                        >
                            {item.name}
                        </NavLink>
                    ))}
                </nav>

                <div className="header-action" style={{ display: "flex", alignItems: "center", gap: "10px" }}>
                    <NavLink
                        to="/admin"
                        className="btn btn-secondary"
                        style={{
                            padding: "8px 16px",
                            borderRadius: "8px",
                            fontSize: "13px",
                            fontWeight: "600",
                            textDecoration: "none",
                            background: "#f1f5f9",
                            color: "#334155",
                            border: "1px solid #cbd5e1"
                        }}
                    >
                        Admin Portal
                    </NavLink>
                    <NavLink
                        to="/login"
                        className="btn btn-primary"
                        style={{
                            padding: "8px 18px",
                            borderRadius: "8px",
                            fontSize: "13px",
                            fontWeight: "600",
                            textDecoration: "none"
                        }}
                    >
                        Sign In
                    </NavLink>
                </div>
            </div>
        </header>
    );
}

export default Header;
