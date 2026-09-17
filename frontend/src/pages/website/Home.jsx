import { useState, useEffect } from "react";
import { Helmet } from "react-helmet-async";
import {
    FiSearch,
    FiMapPin,
    FiClock,
    FiUsers,
    FiStar,
    FiArrowRight,
    FiShield,
    FiCompass,
    FiAward,
    FiPhoneCall,
    FiHeart,
    FiCheck,
    FiGift,
    FiTag,
    FiCalendar,
    FiDollarSign,
    FiTrendingUp,
    FiGlobe,
    FiCoffee,
    FiWifi
} from "react-icons/fi";
import { FaPlaneDeparture, FaPlane, FaHotel, FaUmbrellaBeach, FaMountain, FaCrown, FaSwimmingPool } from "react-icons/fa";
import { Link } from "react-router-dom";
import { mockDestinations, mockTourPackages, mockHotels } from "@/constants/mockData";
import { toast } from "react-toastify";
import TripCalculatorModal from "@/components/website/TripCalculatorModal";

function Home() {
    const [searchTab, setSearchTab] = useState("tours"); // tours, hotels, flights
    const [searchTerm, setSearchTerm] = useState("");
    const [selectedCategory, setSelectedCategory] = useState("all");
    const [selectedDestination, setSelectedDestination] = useState("all");
    const [isCalcOpen, setIsCalcOpen] = useState(false);
    const [likedPackages, setLikedPackages] = useState({});

    // Flash sale countdown timer
    const [timeLeft, setTimeLeft] = useState({ hours: 36, minutes: 18, seconds: 45 });
    useEffect(() => {
        const timer = setInterval(() => {
            setTimeLeft(prev => {
                if (prev.seconds > 0) return { ...prev, seconds: prev.seconds - 1 };
                if (prev.minutes > 0) return { ...prev, minutes: 59, seconds: 59 };
                if (prev.hours > 0) return { hours: prev.hours - 1, minutes: 59, seconds: 59 };
                return prev;
            });
        }, 1000);
        return () => clearInterval(timer);
    }, []);

    const toggleLike = (id) => {
        setLikedPackages(prev => {
            const next = { ...prev, [id]: !prev[id] };
            toast.info(next[id] ? "Saved to your Travel Wishlist! ❤️" : "Removed from Wishlist");
            return next;
        });
    };

    const copyPromo = (code) => {
        navigator.clipboard?.writeText(code);
        toast.success(`Promo code "${code}" copied! Flat 25% discount applied.`);
    };

    // Filter packages
    const filteredPackages = mockTourPackages.filter((pkg) => {
        const matchesSearch = pkg.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
            pkg.category.toLowerCase().includes(searchTerm.toLowerCase()) ||
            pkg.description.toLowerCase().includes(searchTerm.toLowerCase());
        const matchesCategory = selectedCategory === "all" || pkg.category.toLowerCase().includes(selectedCategory.toLowerCase());
        const matchesDest = selectedDestination === "all" || pkg.destination_id === parseInt(selectedDestination);
        return matchesSearch && matchesCategory && matchesDest;
    });

    const categoryTabs = [
        { id: "all", label: "All Experiences", icon: "🌍" },
        { id: "Beach", label: "Tropical Beaches", icon: "🏖️" },
        { id: "Mountains", label: "Alpine Mountains", icon: "🏔️" },
        { id: "Heritage", label: "Historic Heritage", icon: "🏰" },
        { id: "Luxury", label: "Luxury Overwater", icon: "💎" }
    ];

    const flightDeals = [
        { from: "JFK (New York)", to: "DPS (Bali)", price: 680, airline: "Singapore Airlines", stops: "1 Stop" },
        { from: "LHR (London)", to: "ZRH (Zurich)", price: 210, airline: "Swiss International", stops: "Non-stop" },
        { from: "JFK (New York)", to: "HND (Tokyo)", price: 920, airline: "Japan Airlines", stops: "Non-stop" },
        { from: "DXB (Dubai)", to: "MLE (Maldives)", price: 450, airline: "Emirates", stops: "Non-stop" }
    ];

    return (
        <>
            <Helmet>
                <title>Travel ERP | Explore Luxury Tours, 5-Star Resorts & Flight Deals</title>
                <meta name="description" content="Discover handcrafted luxury vacation itineraries, international airline schedules, 5-star boutique hotels, and seamless travel management." />
            </Helmet>

            {/* 1. HERO SECTION WITH TABBED SEARCH ENGINE */}
            <section style={{
                background: "linear-gradient(180deg, rgba(15, 23, 42, 0.92) 0%, rgba(30, 58, 138, 0.88) 100%), url('https://images.unsplash.com/photo-1506744038136-46273834b3fb') center/cover no-repeat",
                padding: "90px 0 100px",
                color: "#ffffff",
                position: "relative"
            }}>
                <div className="container text-center">
                    {/* Top Pill Badge */}
                    <div style={{ display: "inline-flex", alignItems: "center", gap: "8px", background: "rgba(255, 255, 255, 0.15)", backdropFilter: "blur(10px)", border: "1px solid rgba(255,255,255,0.25)", padding: "6px 20px", borderRadius: "30px", fontSize: "14px", fontWeight: "700", marginBottom: "20px" }}>
                        <span style={{ color: "#60a5fa" }}>✦</span>
                        <span>Next-Gen Enterprise Travel & Luxury Holidays</span>
                        <span style={{ background: "#2563eb", color: "#ffffff", padding: "2px 8px", borderRadius: "10px", fontSize: "11px", fontWeight: "800" }}>2026 EDITION</span>
                    </div>

                    <h1 style={{
                        fontSize: "clamp(34px, 5.5vw, 58px)",
                        fontWeight: "900",
                        lineHeight: "1.15",
                        maxWidth: "920px",
                        margin: "0 auto 20px",
                        letterSpacing: "-0.5px"
                    }}>
                        Crafting Unforgettable Journeys Across The Globe
                    </h1>

                    <p style={{
                        fontSize: "clamp(16px, 2vw, 19px)",
                        color: "rgba(255, 255, 255, 0.88)",
                        maxWidth: "680px",
                        margin: "0 auto 40px",
                        lineHeight: "1.6"
                    }}>
                        Discover verified tour packages, 5-star boutique resorts, and instant flight bookings with 24/7 dedicated concierge assistance.
                    </p>

                    {/* Interactive Tabbed Search Engine Card */}
                    <div style={{
                        background: "#ffffff",
                        borderRadius: "24px",
                        padding: "24px",
                        boxShadow: "0 25px 50px -12px rgba(0,0,0,0.35)",
                        maxWidth: "950px",
                        margin: "0 auto",
                        textAlign: "left",
                        color: "#0f172a"
                    }}>
                        {/* Search Category Tabs */}
                        <div style={{ display: "flex", gap: "10px", borderBottom: "1px solid #f1f5f9", paddingBottom: "16px", marginBottom: "20px" }}>
                            {[
                                { id: "tours", label: "Tour Packages", icon: <FaUmbrellaBeach /> },
                                { id: "hotels", label: "Hotels & Stays", icon: <FaHotel /> },
                                { id: "flights", label: "Flight Search", icon: <FaPlane /> }
                            ].map((tab) => (
                                <button
                                    key={tab.id}
                                    onClick={() => setSearchTab(tab.id)}
                                    style={{
                                        display: "flex",
                                        alignItems: "center",
                                        gap: "8px",
                                        padding: "10px 20px",
                                        borderRadius: "12px",
                                        border: "none",
                                        background: searchTab === tab.id ? "#2563eb" : "#f1f5f9",
                                        color: searchTab === tab.id ? "#ffffff" : "#475569",
                                        fontSize: "14px",
                                        fontWeight: "700",
                                        cursor: "pointer",
                                        transition: "all 0.2s ease"
                                    }}
                                >
                                    {tab.icon}
                                    <span>{tab.label}</span>
                                </button>
                            ))}
                        </div>

                        {/* Search Input Controls */}
                        <div className="row" style={{ alignItems: "center" }}>
                            <div className="col-12 col-4 mb-3">
                                <label style={{ fontSize: "12px", fontWeight: "800", color: "#64748b", display: "block", marginBottom: "6px", textTransform: "uppercase" }}>
                                    Destination / Keyword
                                </label>
                                <div style={{ display: "flex", alignItems: "center", gap: "10px", background: "#f8fafc", border: "1px solid #cbd5e1", borderRadius: "12px", padding: "10px 14px" }}>
                                    <FiSearch color="#2563eb" size={18} />
                                    <input
                                        type="text"
                                        placeholder="Where do you want to go?"
                                        value={searchTerm}
                                        onChange={(e) => setSearchTerm(e.target.value)}
                                        style={{ border: "none", outline: "none", background: "transparent", width: "100%", fontSize: "14px", fontWeight: "600", color: "#0f172a" }}
                                    />
                                </div>
                            </div>

                            <div className="col-12 col-3 mb-3">
                                <label style={{ fontSize: "12px", fontWeight: "800", color: "#64748b", display: "block", marginBottom: "6px", textTransform: "uppercase" }}>
                                    Travel Region
                                </label>
                                <select
                                    className="form-control"
                                    value={selectedDestination}
                                    onChange={(e) => setSelectedDestination(e.target.value)}
                                    style={{ height: "46px", borderRadius: "12px", fontSize: "14px", fontWeight: "600" }}
                                >
                                    <option value="all">All Global Regions</option>
                                    {mockDestinations.map(d => (
                                        <option key={d.id} value={d.id}>{d.name} ({d.country})</option>
                                    ))}
                                </select>
                            </div>

                            <div className="col-12 col-2 mb-3">
                                <label style={{ fontSize: "12px", fontWeight: "800", color: "#64748b", display: "block", marginBottom: "6px", textTransform: "uppercase" }}>
                                    Category
                                </label>
                                <select
                                    className="form-control"
                                    value={selectedCategory}
                                    onChange={(e) => setSelectedCategory(e.target.value)}
                                    style={{ height: "46px", borderRadius: "12px", fontSize: "14px", fontWeight: "600" }}
                                >
                                    <option value="all">All Styles</option>
                                    <option value="Beach">Beach</option>
                                    <option value="Mountains">Mountains</option>
                                    <option value="Heritage">Heritage</option>
                                    <option value="Luxury">Luxury</option>
                                </select>
                            </div>

                            <div className="col-12 col-3 mb-3">
                                <label style={{ fontSize: "12px", fontWeight: "800", color: "#64748b", display: "block", marginBottom: "6px", visibility: "hidden" }}>
                                    Action
                                </label>
                                <Link
                                    to={searchTab === "hotels" ? "/hotels" : searchTab === "flights" ? "/flights" : "/packages"}
                                    className="btn btn-primary w-100"
                                    style={{ height: "46px", display: "flex", alignItems: "center", justifyContent: "center", gap: "8px", borderRadius: "12px", fontWeight: "700", fontSize: "15px" }}
                                >
                                    <span>Find Itineraries</span>
                                    <FiArrowRight />
                                </Link>
                            </div>
                        </div>

                        {/* Quick trending tags */}
                        <div style={{ display: "flex", alignItems: "center", gap: "10px", marginTop: "10px", flexWrap: "wrap", fontSize: "12px", color: "#64748b" }}>
                            <span style={{ fontWeight: "700" }}>🔥 Trending Searches:</span>
                            {["Bali Overwater Villas", "Swiss Alps Ski Passes", "Tokyo Cherry Blossom", "Maldives Resorts", "Jaipur Palaces"].map((tag, i) => (
                                <span
                                    key={i}
                                    onClick={() => setSearchTerm(tag.split(" ")[0])}
                                    style={{ background: "#f1f5f9", padding: "4px 10px", borderRadius: "8px", cursor: "pointer", color: "#2563eb", fontWeight: "600" }}
                                >
                                    #{tag}
                                </span>
                            ))}
                        </div>
                    </div>

                    {/* Live Stats Row */}
                    <div style={{
                        display: "flex",
                        justifyContent: "center",
                        flexWrap: "wrap",
                        gap: "35px",
                        marginTop: "50px"
                    }}>
                        <div style={{ textAlign: "center" }}>
                            <div style={{ fontSize: "32px", fontWeight: "900", color: "#60a5fa" }}>10,000+</div>
                            <div style={{ fontSize: "13px", color: "rgba(255,255,255,0.8)" }}>Happy Travelers</div>
                        </div>
                        <div style={{ textAlign: "center" }}>
                            <div style={{ fontSize: "32px", fontWeight: "900", color: "#60a5fa" }}>50+</div>
                            <div style={{ fontSize: "13px", color: "rgba(255,255,255,0.8)" }}>Global Destinations</div>
                        </div>
                        <div style={{ textAlign: "center" }}>
                            <div style={{ fontSize: "32px", fontWeight: "900", color: "#60a5fa" }}>120+</div>
                            <div style={{ fontSize: "13px", color: "rgba(255,255,255,0.8)" }}>Bespoke Packages</div>
                        </div>
                        <div style={{ textAlign: "center" }}>
                            <div style={{ fontSize: "32px", fontWeight: "900", color: "#60a5fa" }}>4.92 ★</div>
                            <div style={{ fontSize: "13px", color: "rgba(255,255,255,0.8)" }}>Customer Rating</div>
                        </div>
                    </div>
                </div>
            </section>

            {/* 2. FLASH SALE / PROMO BANNER */}
            <section style={{ background: "#ffffff", borderBottom: "1px solid #e2e8f0", padding: "24px 0" }}>
                <div className="container">
                    <div style={{
                        background: "linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)",
                        border: "1px solid #bfdbfe",
                        borderRadius: "18px",
                        padding: "20px 28px",
                        display: "flex",
                        justifyContent: "space-between",
                        alignItems: "center",
                        flexWrap: "wrap",
                        gap: "20px"
                    }}>
                        <div style={{ display: "flex", alignItems: "center", gap: "16px" }}>
                            <div style={{ width: "50px", height: "50px", borderRadius: "14px", background: "#2563eb", color: "#ffffff", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "24px" }}>
                                <FiGift />
                            </div>
                            <div>
                                <span style={{ fontSize: "12px", fontWeight: "800", color: "#2563eb", textTransform: "uppercase", letterSpacing: "0.5px" }}>
                                    Limited Time Deal
                                </span>
                                <h3 style={{ fontSize: "18px", fontWeight: "800", color: "#1e3a8a", margin: "2px 0 4px" }}>
                                    Get Flat 25% OFF On All European & Asian Itineraries!
                                </h3>
                                <span style={{ fontSize: "13px", color: "#475569" }}>
                                    Use promo code <strong>TRAVEL25</strong> at checkout.
                                </span>
                            </div>
                        </div>

                        <div style={{ display: "flex", alignItems: "center", gap: "14px" }}>
                            {/* Countdown badge */}
                            <div style={{ display: "flex", gap: "6px" }}>
                                <div style={{ background: "#1e3a8a", color: "#ffffff", padding: "6px 10px", borderRadius: "8px", fontWeight: "800", fontSize: "14px" }}>
                                    {String(timeLeft.hours).padStart(2, '0')}h
                                </div>
                                <div style={{ background: "#1e3a8a", color: "#ffffff", padding: "6px 10px", borderRadius: "8px", fontWeight: "800", fontSize: "14px" }}>
                                    {String(timeLeft.minutes).padStart(2, '0')}m
                                </div>
                                <div style={{ background: "#1e3a8a", color: "#ffffff", padding: "6px 10px", borderRadius: "8px", fontWeight: "800", fontSize: "14px" }}>
                                    {String(timeLeft.seconds).padStart(2, '0')}s
                                </div>
                            </div>

                            <button
                                onClick={() => copyPromo("TRAVEL25")}
                                className="btn btn-primary"
                                style={{ fontWeight: "700", padding: "10px 20px", borderRadius: "10px" }}
                            >
                                Copy Code
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            {/* 3. CATEGORY PILLS BAR */}
            <section style={{ padding: "40px 0 20px", background: "#f8fafc" }}>
                <div className="container">
                    <div style={{ display: "flex", justifyContent: "center", gap: "12px", flexWrap: "wrap" }}>
                        {categoryTabs.map((cat) => (
                            <button
                                key={cat.id}
                                onClick={() => setSelectedCategory(cat.id)}
                                style={{
                                    display: "flex",
                                    alignItems: "center",
                                    gap: "8px",
                                    padding: "10px 22px",
                                    borderRadius: "30px",
                                    border: selectedCategory === cat.id ? "2px solid #2563eb" : "1px solid #e2e8f0",
                                    background: selectedCategory === cat.id ? "#2563eb" : "#ffffff",
                                    color: selectedCategory === cat.id ? "#ffffff" : "#334155",
                                    fontSize: "14px",
                                    fontWeight: "700",
                                    cursor: "pointer",
                                    boxShadow: selectedCategory === cat.id ? "0 4px 14px rgba(37, 99, 235, 0.25)" : "0 2px 6px rgba(0,0,0,0.02)",
                                    transition: "all 0.2s ease"
                                }}
                            >
                                <span>{cat.icon}</span>
                                <span>{cat.label}</span>
                            </button>
                        ))}
                    </div>
                </div>
            </section>

            {/* 4. FEATURED TOUR PACKAGES (RICH DATA GRID) */}
            <section style={{ padding: "50px 0 80px", background: "#f8fafc" }}>
                <div className="container">
                    <div style={{ display: "flex", justifyContent: "space-between", alignItems: "flex-end", flexWrap: "wrap", gap: "16px", marginBottom: "36px" }}>
                        <div>
                            <span style={{ color: "#2563eb", fontWeight: "800", fontSize: "13px", textTransform: "uppercase", letterSpacing: "1px" }}>
                                Handcrafted Vacation Packages
                            </span>
                            <h2 style={{ fontSize: "32px", fontWeight: "900", color: "#0f172a", marginTop: "4px" }}>
                                Most Popular Tour Itineraries
                            </h2>
                        </div>
                        <Link to="/packages" style={{ color: "#2563eb", fontWeight: "700", fontSize: "14px", textDecoration: "none", display: "flex", alignItems: "center", gap: "6px" }}>
                            <span>Explore all {mockTourPackages.length} packages</span>
                            <FiArrowRight />
                        </Link>
                    </div>

                    <div className="row">
                        {filteredPackages.map((pkg) => (
                            <div className="col-12 col-6 col-4 mb-4" key={pkg.id}>
                                <div style={{
                                    background: "#ffffff",
                                    borderRadius: "20px",
                                    border: "1px solid #e2e8f0",
                                    overflow: "hidden",
                                    boxShadow: "0 8px 30px rgba(0,0,0,0.04)",
                                    height: "100%",
                                    display: "flex",
                                    flexDirection: "column",
                                    transition: "transform 0.2s ease, box-shadow 0.2s ease"
                                }}>
                                    <div style={{ position: "relative", height: "230px" }}>
                                        <img
                                            src={pkg.featured_image}
                                            alt={pkg.title}
                                            style={{ width: "100%", height: "100%", objectFit: "cover" }}
                                        />
                                        <span style={{
                                            position: "absolute",
                                            top: "14px",
                                            left: "14px",
                                            background: "rgba(15, 23, 42, 0.75)",
                                            backdropFilter: "blur(6px)",
                                            color: "#ffffff",
                                            padding: "5px 12px",
                                            borderRadius: "10px",
                                            fontSize: "12px",
                                            fontWeight: "700"
                                        }}>
                                            {pkg.category}
                                        </span>

                                        <button
                                            onClick={() => toggleLike(pkg.id)}
                                            style={{
                                                position: "absolute",
                                                top: "14px",
                                                right: "14px",
                                                background: "#ffffff",
                                                border: "none",
                                                borderRadius: "50%",
                                                width: "36px",
                                                height: "36px",
                                                display: "flex",
                                                alignItems: "center",
                                                justifyContent: "center",
                                                cursor: "pointer",
                                                boxShadow: "0 4px 10px rgba(0,0,0,0.15)",
                                                color: likedPackages[pkg.id] ? "#ef4444" : "#64748b"
                                            }}
                                        >
                                            <FiHeart fill={likedPackages[pkg.id] ? "#ef4444" : "none"} size={16} />
                                        </button>
                                    </div>

                                    <div style={{ padding: "22px", flex: "1", display: "flex", flexDirection: "column" }}>
                                        <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", marginBottom: "8px" }}>
                                            <span style={{ fontSize: "12px", color: "#eab308", fontWeight: "700", display: "flex", alignItems: "center", gap: "4px" }}>
                                                <FiStar fill="#eab308" size={13} /> 4.9 (84 reviews)
                                            </span>
                                            <span style={{ fontSize: "12px", color: "#64748b", fontWeight: "600", display: "flex", alignItems: "center", gap: "4px" }}>
                                                <FiClock /> {pkg.duration}
                                            </span>
                                        </div>

                                        <h3 style={{ fontSize: "19px", fontWeight: "800", color: "#0f172a", marginBottom: "8px", lineHeight: "1.3" }}>
                                            <Link to={`/packages/${pkg.id}`} style={{ color: "inherit", textDecoration: "none" }}>
                                                {pkg.title}
                                            </Link>
                                        </h3>

                                        <p style={{ fontSize: "13px", color: "#64748b", lineHeight: "1.6", marginBottom: "18px", flex: "1" }}>
                                            {pkg.description?.slice(0, 95)}...
                                        </p>

                                        <div style={{
                                            display: "flex",
                                            justifyContent: "space-between",
                                            alignItems: "center",
                                            borderTop: "1px solid #f1f5f9",
                                            paddingTop: "16px"
                                        }}>
                                            <div>
                                                <span style={{ fontSize: "11px", color: "#94a3b8", display: "block" }}>Price per traveler</span>
                                                <div style={{ fontSize: "24px", fontWeight: "900", color: "#2563eb" }}>
                                                    ${pkg.discount_price > 0 ? pkg.discount_price : pkg.price}
                                                </div>
                                            </div>

                                            <div style={{ display: "flex", gap: "8px" }}>
                                                <Link
                                                    to={`/packages/${pkg.id}`}
                                                    className="btn btn-secondary btn-sm"
                                                    style={{ borderRadius: "10px", fontWeight: "700", padding: "8px 14px", background: "#f8fafc", color: "#334155", border: "1px solid #cbd5e1" }}
                                                >
                                                    Details
                                                </Link>
                                                <Link
                                                    to={`/packages/${pkg.id}`}
                                                    className="btn btn-primary btn-sm"
                                                    style={{ borderRadius: "10px", fontWeight: "700", padding: "8px 16px" }}
                                                >
                                                    Book Now
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* 5. TOP DESTINATIONS SHOWCASE */}
            <section style={{ padding: "80px 0", background: "#ffffff" }}>
                <div className="container">
                    <div style={{ textAlign: "center", maxWidth: "650px", margin: "0 auto 45px" }}>
                        <span style={{ color: "#2563eb", fontWeight: "800", fontSize: "13px", textTransform: "uppercase", letterSpacing: "1px" }}>
                            Wanderlust Bucket List
                        </span>
                        <h2 style={{ fontSize: "34px", fontWeight: "900", color: "#0f172a", marginTop: "4px" }}>
                            Trending Global Destinations
                        </h2>
                        <p style={{ color: "#64748b", fontSize: "15px", marginTop: "8px" }}>
                            Explore ancient temples, snow-capped alpine peaks, modern skylines, and turquoise lagoons.
                        </p>
                    </div>

                    <div className="row">
                        {mockDestinations.map((dest) => (
                            <div className="col-12 col-6 col-4 mb-4" key={dest.id}>
                                <div style={{
                                    borderRadius: "20px",
                                    overflow: "hidden",
                                    position: "relative",
                                    height: "300px",
                                    boxShadow: "0 10px 30px rgba(0,0,0,0.08)",
                                    cursor: "pointer"
                                }}>
                                    <img
                                        src={dest.featured_image}
                                        alt={dest.name}
                                        style={{ width: "100%", height: "100%", objectFit: "cover" }}
                                    />
                                    <div style={{
                                        position: "absolute",
                                        inset: "0",
                                        background: "linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.3) 60%, transparent 100%)",
                                        display: "flex",
                                        flexDirection: "column",
                                        justifyContent: "flex-end",
                                        padding: "24px",
                                        color: "#ffffff"
                                    }}>
                                        <div style={{ display: "flex", alignItems: "center", gap: "6px", fontSize: "13px", color: "#93c5fd", fontWeight: "600" }}>
                                            <FiMapPin /> {dest.city}, {dest.country}
                                        </div>
                                        <h3 style={{ fontSize: "24px", fontWeight: "900", margin: "4px 0 8px" }}>
                                            {dest.name}
                                        </h3>
                                        <p style={{ fontSize: "13px", color: "rgba(255,255,255,0.85)", margin: "0 0 14px", lineHeight: "1.5" }}>
                                            {dest.short_description}
                                        </p>
                                        <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", borderTop: "1px solid rgba(255,255,255,0.2)", paddingTop: "12px", fontSize: "12px", color: "rgba(255,255,255,0.9)" }}>
                                            <span>Best Time: {dest.best_time}</span>
                                            <Link to="/packages" style={{ color: "#60a5fa", fontWeight: "700", textDecoration: "none" }}>
                                                Explore Tours →
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* 6. LUXURY HOTELS & RESORTS PREVIEW */}
            <section style={{ padding: "80px 0", background: "#f8fafc" }}>
                <div className="container">
                    <div style={{ display: "flex", justifyContent: "space-between", alignItems: "flex-end", flexWrap: "wrap", gap: "16px", marginBottom: "36px" }}>
                        <div>
                            <span style={{ color: "#2563eb", fontWeight: "800", fontSize: "13px", textTransform: "uppercase", letterSpacing: "1px" }}>
                                Handpicked Accommodations
                            </span>
                            <h2 style={{ fontSize: "32px", fontWeight: "900", color: "#0f172a", marginTop: "4px" }}>
                                5-Star Boutique Hotels & Villas
                            </h2>
                        </div>
                        <Link to="/hotels" style={{ color: "#2563eb", fontWeight: "700", fontSize: "14px", textDecoration: "none", display: "flex", alignItems: "center", gap: "6px" }}>
                            <span>View all luxury stays</span>
                            <FiArrowRight />
                        </Link>
                    </div>

                    <div className="row">
                        {mockHotels.map((hotel) => (
                            <div className="col-12 col-4 mb-4" key={hotel.id}>
                                <div style={{
                                    background: "#ffffff",
                                    borderRadius: "20px",
                                    border: "1px solid #e2e8f0",
                                    overflow: "hidden",
                                    boxShadow: "0 6px 20px rgba(0,0,0,0.03)",
                                    height: "100%",
                                    display: "flex",
                                    flexDirection: "column"
                                }}>
                                    <div style={{ height: "200px", position: "relative" }}>
                                        <img
                                            src="https://images.unsplash.com/photo-1566073771259-6a8506099945"
                                            alt={hotel.name}
                                            style={{ width: "100%", height: "100%", objectFit: "cover" }}
                                        />
                                        <span style={{
                                            position: "absolute",
                                            top: "12px",
                                            right: "12px",
                                            background: "#ffffff",
                                            color: "#eab308",
                                            padding: "4px 8px",
                                            borderRadius: "8px",
                                            fontSize: "12px",
                                            fontWeight: "700",
                                            display: "flex",
                                            alignItems: "center",
                                            gap: "3px"
                                        }}>
                                            <FiStar fill="#eab308" size={12} /> {hotel.rating}.0
                                        </span>
                                    </div>

                                    <div style={{ padding: "20px", flex: "1", display: "flex", flexDirection: "column" }}>
                                        <h4 style={{ fontSize: "18px", fontWeight: "800", color: "#0f172a", marginBottom: "6px" }}>
                                            {hotel.name}
                                        </h4>
                                        <p style={{ fontSize: "13px", color: "#64748b", marginBottom: "14px", display: "flex", alignItems: "center", gap: "4px" }}>
                                            <FiMapPin color="#3b82f6" /> {hotel.address}
                                        </p>

                                        <div style={{ marginTop: "auto", display: "flex", justifyContent: "space-between", alignItems: "center", borderTop: "1px solid #f1f5f9", paddingTop: "14px" }}>
                                            <div>
                                                <span style={{ fontSize: "11px", color: "#94a3b8" }}>From</span>
                                                <div style={{ fontSize: "20px", fontWeight: "900", color: "#2563eb" }}>
                                                    ${hotel.price_per_night} <span style={{ fontSize: "12px", color: "#64748b", fontWeight: "normal" }}>/night</span>
                                                </div>
                                            </div>
                                            <Link to="/hotels" className="btn btn-primary btn-sm" style={{ borderRadius: "8px", fontWeight: "700" }}>
                                                Reserve
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* 7. POPULAR FLIGHT ROUTES */}
            <section style={{ padding: "70px 0", background: "#ffffff" }}>
                <div className="container">
                    <div style={{ textAlign: "center", maxWidth: "600px", margin: "0 auto 40px" }}>
                        <span style={{ color: "#2563eb", fontWeight: "800", fontSize: "13px", textTransform: "uppercase", letterSpacing: "1px" }}>
                            Airline Partnerships
                        </span>
                        <h2 style={{ fontSize: "32px", fontWeight: "900", color: "#0f172a", marginTop: "4px" }}>
                            Special Flight Fares
                        </h2>
                    </div>

                    <div className="row">
                        {flightDeals.map((flight, idx) => (
                            <div className="col-12 col-6 mb-3" key={idx}>
                                <div style={{
                                    border: "1px solid #e2e8f0",
                                    borderRadius: "16px",
                                    padding: "20px",
                                    display: "flex",
                                    justifyContent: "space-between",
                                    alignItems: "center",
                                    background: "#f8fafc"
                                }}>
                                    <div style={{ display: "flex", alignItems: "center", gap: "14px" }}>
                                        <div style={{ width: "42px", height: "42px", borderRadius: "10px", background: "#eff6ff", color: "#2563eb", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "18px" }}>
                                            <FaPlaneDeparture />
                                        </div>
                                        <div>
                                            <h4 style={{ fontSize: "16px", fontWeight: "800", color: "#0f172a", margin: 0 }}>
                                                {flight.from} → {flight.to}
                                            </h4>
                                            <span style={{ fontSize: "12px", color: "#64748b" }}>
                                                {flight.airline} • {flight.stops}
                                            </span>
                                        </div>
                                    </div>

                                    <div style={{ display: "flex", alignItems: "center", gap: "14px" }}>
                                        <div style={{ textAlign: "right" }}>
                                            <div style={{ fontSize: "20px", fontWeight: "900", color: "#2563eb" }}>${flight.price}</div>
                                            <span style={{ fontSize: "11px", color: "#64748b" }}>one-way</span>
                                        </div>
                                        <Link to="/flights" className="btn btn-primary btn-sm" style={{ fontWeight: "700" }}>
                                            Book
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* 8. WHY CHOOSE US VALUE PROPOSITIONS */}
            <section style={{ padding: "80px 0", background: "#0f172a", color: "#ffffff" }}>
                <div className="container">
                    <div style={{ textAlign: "center", maxWidth: "600px", margin: "0 auto 50px" }}>
                        <span style={{ color: "#60a5fa", fontWeight: "800", fontSize: "13px", textTransform: "uppercase", letterSpacing: "1px" }}>
                            The Travel ERP Advantage
                        </span>
                        <h2 style={{ fontSize: "34px", fontWeight: "900", marginTop: "4px" }}>
                            Why 10,000+ Travelers Trust Us
                        </h2>
                    </div>

                    <div className="row">
                        <div className="col-12 col-6 col-3 mb-4">
                            <div style={{ background: "#1e293b", padding: "26px", borderRadius: "18px", border: "1px solid #334155", height: "100%" }}>
                                <div style={{ width: "50px", height: "50px", borderRadius: "12px", background: "rgba(59, 130, 246, 0.15)", color: "#60a5fa", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "22px", marginBottom: "16px" }}>
                                    <FiAward />
                                </div>
                                <h4 style={{ fontSize: "18px", fontWeight: "800", marginBottom: "8px" }}>Best Price Guarantee</h4>
                                <p style={{ fontSize: "13px", color: "#94a3b8", lineHeight: "1.6", margin: 0 }}>
                                    Direct contracts with airlines & resorts ensure you always get the lowest market rate without hidden markups.
                                </p>
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-4">
                            <div style={{ background: "#1e293b", padding: "26px", borderRadius: "18px", border: "1px solid #334155", height: "100%" }}>
                                <div style={{ width: "50px", height: "50px", borderRadius: "12px", background: "rgba(59, 130, 246, 0.15)", color: "#60a5fa", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "22px", marginBottom: "16px" }}>
                                    <FiShield />
                                </div>
                                <h4 style={{ fontSize: "18px", fontWeight: "800", marginBottom: "8px" }}>100% Verified Safety</h4>
                                <p style={{ fontSize: "13px", color: "#94a3b8", lineHeight: "1.6", margin: 0 }}>
                                    All tours include comprehensive medical coverage and background-checked private transport chauffeurs.
                                </p>
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-4">
                            <div style={{ background: "#1e293b", padding: "26px", borderRadius: "18px", border: "1px solid #334155", height: "100%" }}>
                                <div style={{ width: "50px", height: "50px", borderRadius: "12px", background: "rgba(59, 130, 246, 0.15)", color: "#60a5fa", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "22px", marginBottom: "16px" }}>
                                    <FiPhoneCall />
                                </div>
                                <h4 style={{ fontSize: "18px", fontWeight: "800", marginBottom: "8px" }}>24/7 Ground Concierge</h4>
                                <p style={{ fontSize: "13px", color: "#94a3b8", lineHeight: "1.6", margin: 0 }}>
                                    Dedicated local travel managers available round the clock on WhatsApp and phone for restaurant bookings and changes.
                                </p>
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-4">
                            <div style={{ background: "#1e293b", padding: "26px", borderRadius: "18px", border: "1px solid #334155", height: "100%" }}>
                                <div style={{ width: "50px", height: "50px", borderRadius: "12px", background: "rgba(59, 130, 246, 0.15)", color: "#60a5fa", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "22px", marginBottom: "16px" }}>
                                    <FiCompass />
                                </div>
                                <h4 style={{ fontSize: "18px", fontWeight: "800", marginBottom: "8px" }}>Customizable Plans</h4>
                                <p style={{ fontSize: "13px", color: "#94a3b8", lineHeight: "1.6", margin: 0 }}>
                                    Tailor your itinerary, add private helicopter rides, or upgrade to presidential suites seamlessly.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* 9. TRIP BUDGET CALCULATOR TRIGGER CTA */}
            <section style={{
                padding: "80px 0",
                background: "linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%)",
                color: "#ffffff",
                textAlign: "center"
            }}>
                <div className="container">
                    <h2 style={{ fontSize: "36px", fontWeight: "900", marginBottom: "14px" }}>
                        Need an Instant Estimate for Your Dream Vacation?
                    </h2>
                    <p style={{ fontSize: "17px", color: "rgba(255,255,255,0.9)", maxWidth: "600px", margin: "0 auto 30px" }}>
                        Use our real-time Trip Budget Calculator to simulate complete holiday costs including resorts, meals, and excursions.
                    </p>
                    <div style={{ display: "flex", justifyContent: "center", gap: "16px", flexWrap: "wrap" }}>
                        <button
                            onClick={() => setIsCalcOpen(true)}
                            className="btn btn-primary"
                            style={{ background: "#ffffff", color: "#1d4ed8", padding: "14px 32px", borderRadius: "12px", fontWeight: "800", fontSize: "16px", border: "none", boxShadow: "0 10px 25px rgba(0,0,0,0.15)", cursor: "pointer" }}
                        >
                            Open Trip Budget Calculator 🧮
                        </button>
                        <Link
                            to="/admin"
                            className="btn btn-secondary"
                            style={{ background: "rgba(255,255,255,0.2)", color: "#ffffff", padding: "14px 28px", borderRadius: "12px", fontWeight: "700", border: "1px solid rgba(255,255,255,0.4)" }}
                        >
                            Explore Admin ERP Portal
                        </Link>
                    </div>
                </div>
            </section>

            {/* Modal */}
            <TripCalculatorModal
                isOpen={isCalcOpen}
                onClose={() => setIsCalcOpen(false)}
            />
        </>
    );
}

export default Home;
