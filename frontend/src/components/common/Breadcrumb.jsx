import { Link, useLocation } from "react-router-dom";
import { FiChevronRight, FiHome } from "react-icons/fi";

const routeNameMap = {
    admin: "Dashboard",
    customers: "Customers",
    packages: "Packages",
    bookings: "Bookings",
    payments: "Payments",
    reports: "Reports",
    cms: "CMS Settings",
    settings: "System Settings",
    "forgot-password": "Forgot Password",
    "reset-password": "Reset Password",
    "otp-verification": "OTP Verification"
};

function Breadcrumb() {
    const location = useLocation();
    const pathnames = location.pathname.split("/").filter((x) => x);

    // Don't show breadcrumbs on auth pages or main homepage
    const isAuthPage = ["/login", "/register", "/forgot-password", "/reset-password", "/otp-verification"].includes(location.pathname);
    if (location.pathname === "/" || isAuthPage) {
        return null;
    }

    return (
        <nav className="breadcrumb" aria-label="breadcrumb">
            <Link to="/" className="d-flex align-center gap-1">
                <FiHome size={14} />
                <span>Home</span>
            </Link>

            {pathnames.map((value, index) => {
                const last = index === pathnames.length - 1;
                const to = `/${pathnames.slice(0, index + 1).join("/")}`;
                const displayName = routeNameMap[value.toLowerCase()] || decodeURIComponent(value);

                return (
                    <div key={to} className="d-flex align-center gap-1">
                        <FiChevronRight size={14} style={{ color: "var(--gray-400)" }} />
                        {last ? (
                            <span className="font-semibold" style={{ color: "var(--gray-800)" }}>
                                {displayName}
                            </span>
                        ) : (
                            <Link to={to}>{displayName}</Link>
                        )}
                    </div>
                );
            })}
        </nav>
    );
}

export default Breadcrumb;
