import { useState } from "react";
import { Helmet } from "react-helmet-async";
import { FiSearch, FiMapPin, FiClock, FiUsers, FiStar, FiArrowRight, FiShield, FiCompass, FiAward, FiPhoneCall } from "react-icons/fi";
import { Link } from "react-router-dom";
import { mockDestinations, mockTourPackages } from "@/constants/mockData";

function Home() {
    const [searchTerm, setSearchTerm] = useState("");
    const [selectedCategory, setSelectedCategory] = useState("all");

    // Filter packages based on search & category
    const filteredPackages = mockTourPackages.filter((pkg) => {
        const matchesSearch = pkg.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
            pkg.category.toLowerCase().includes(searchTerm.toLowerCase());
        const matchesCategory = selectedCategory === "all" || pkg.category.toLowerCase().includes(selectedCategory.toLowerCase());
        return matchesSearch && matchesCategory;
    });

    const categories = ["all", "Beach", "Mountains", "Heritage", "Luxury"];

    return (
        <>
            <Helmet>
                <title>Travel ERP | Discover World-Class Tours & Destinations</title>
                <meta name="description" content="Discover unforgettable vacation destinations and tailor-made travel packages with Travel ERP." />
            </Helmet>

            {/* Hero Section */}
            <section style={{
                background: "linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(30, 58, 138, 0.85)), url('https://images.unsplash.com/photo-1506744038136-46273834b3fb') center/cover no-repeat",
                padding: "100px 0 80px",
                color: "#ffffff",
                position: "relative"
            }}>
                <div className="container text-center">
                    <span style={{
                        display: "inline-block",
                        padding: "6px 16px",
                        borderRadius: "20px",
                        background: "rgba(255, 255, 255, 0.15)",
                        backdropFilter: "blur(10px)",
                        fontSize: "14px",
                        fontWeight: "600",
                        marginBottom: "16px",
                        letterSpacing: "0.5px"
                    }}>
                        ✈️ Curated Travel Experiences & Enterprise ERP
                    </span>

                    <h1 style={{
                        fontSize: "clamp(32px, 5vw, 54px)",
                        fontWeight: "800",
                        lineHeight: "1.2",
                        maxWidth: "850px",
                        margin: "0 auto 20px"
                    }}>
                        Explore The World With Unmatched Comfort & Style
                    </h1>

                    <p style={{
                        fontSize: "clamp(16px, 2vw, 18px)",
                        color: "rgba(255, 255, 255, 0.85)",
                        maxWidth: "650px",
                        margin: "0 auto 40px",
                        lineHeight: "1.6"
                    }}>
                        Handcrafted holiday packages, verified hotels, and seamless booking operations powered by modern travel technology.
                    </p>

                    {/* Interactive Search Bar */}
                    <div style={{
                        background: "#ffffff",
                        padding: "12px 20px",
                        borderRadius: "16px",
                        boxShadow: "0 20px 40px rgba(0,0,0,0.25)",
                        maxWidth: "750px",
                        margin: "0 auto",
                        display: "flex",
                        flexWrap: "wrap",
                        alignItems: "center",
                        gap: "12px"
                    }}>
                        <div style={{ display: "flex", alignItems: "center", gap: "10px", flex: "1 1 240px" }}>
                            <FiSearch style={{ color: "#3b82f6", fontSize: "20px" }} />
                            <input
                                type="text"
                                placeholder="Search destinations, Bali, Alps, etc..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                                style={{
                                    border: "none",
                                    outline: "none",
                                    width: "100%",
                                    fontSize: "15px",
                                    color: "#1e293b"
                                }}
                            />
                        </div>

                        <Link to="/packages" className="btn btn-primary" style={{ padding: "12px 28px", borderRadius: "10px", fontWeight: "600" }}>
                            Explore Tours
                        </Link>
                    </div>

                    {/* Quick Stats Banner */}
                    <div style={{
                        display: "flex",
                        justifyContent: "center",
                        flexWrap: "wrap",
                        gap: "30px",
                        marginTop: "50px"
                    }}>
                        <div style={{ textAlign: "center" }}>
                            <div style={{ fontSize: "28px", fontWeight: "800", color: "#60a5fa" }}>10,000+</div>
                            <div style={{ fontSize: "13px", color: "rgba(255,255,255,0.8)" }}>Happy Travelers</div>
                        </div>
                        <div style={{ textAlign: "center" }}>
                            <div style={{ fontSize: "28px", fontWeight: "800", color: "#60a5fa" }}>50+</div>
                            <div style={{ fontSize: "13px", color: "rgba(255,255,255,0.8)" }}>Global Destinations</div>
                        </div>
                        <div style={{ textAlign: "center" }}>
                            <div style={{ fontSize: "28px", fontWeight: "800", color: "#60a5fa" }}>120+</div>
                            <div style={{ fontSize: "13px", color: "rgba(255,255,255,0.8)" }}>Tailored Itineraries</div>
                        </div>
                        <div style={{ textAlign: "center" }}>
                            <div style={{ fontSize: "28px", fontWeight: "800", color: "#60a5fa" }}>4.9★</div>
                            <div style={{ fontSize: "13px", color: "rgba(255,255,255,0.8)" }}>Customer Rating</div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Popular Tour Packages */}
            <section style={{ padding: "70px 0", background: "#f8fafc" }}>
                <div className="container">
                    <div style={{ display: "flex", justifyContent: "space-between", alignItems: "flex-end", flexWrap: "wrap", gap: "20px", marginBottom: "40px" }}>
                        <div>
                            <span style={{ color: "#3b82f6", fontWeight: "700", fontSize: "13px", textTransform: "uppercase", letterSpacing: "1px" }}>
                                Featured Itineraries
                            </span>
                            <h2 style={{ fontSize: "32px", fontWeight: "800", color: "#0f172a", marginTop: "6px" }}>
                                Top Tour Packages
                            </h2>
                        </div>

                        {/* Category Filter Pills */}
                        <div style={{ display: "flex", gap: "8px", flexWrap: "wrap" }}>
                            {categories.map((cat) => (
                                <button
                                    key={cat}
                                    onClick={() => setSelectedCategory(cat)}
                                    style={{
                                        padding: "8px 16px",
                                        borderRadius: "20px",
                                        border: selectedCategory === cat ? "1px solid #3b82f6" : "1px solid #e2e8f0",
                                        background: selectedCategory === cat ? "#3b82f6" : "#ffffff",
                                        color: selectedCategory === cat ? "#ffffff" : "#475569",
                                        fontSize: "13px",
                                        fontWeight: "600",
                                        cursor: "pointer",
                                        textTransform: "capitalize",
                                        transition: "all 0.2s ease"
                                    }}
                                >
                                    {cat}
                                </button>
                            ))}
                        </div>
                    </div>

                    {/* Packages Grid */}
                    <div className="row">
                        {filteredPackages.slice(0, 6).map((pkg) => (
                            <div className="col-12 col-6 col-4 mb-4" key={pkg.id}>
                                <div style={{
                                    background: "#ffffff",
                                    borderRadius: "16px",
                                    overflow: "hidden",
                                    border: "1px solid #e2e8f0",
                                    boxShadow: "0 4px 20px rgba(0,0,0,0.04)",
                                    transition: "transform 0.2s ease, box-shadow 0.2s ease",
                                    height: "100%",
                                    display: "flex",
                                    flexDirection: "column"
                                }}>
                                    <div style={{ position: "relative", height: "220px" }}>
                                        <img
                                            src={pkg.featured_image}
                                            alt={pkg.title}
                                            style={{ width: "100%", height: "100%", objectFit: "cover" }}
                                        />
                                        <span style={{
                                            position: "absolute",
                                            top: "12px",
                                            left: "12px",
                                            background: "rgba(15, 23, 42, 0.75)",
                                            backdropFilter: "blur(6px)",
                                            color: "#ffffff",
                                            padding: "4px 12px",
                                            borderRadius: "12px",
                                            fontSize: "12px",
                                            fontWeight: "600"
                                        }}>
                                            {pkg.category}
                                        </span>
                                        <span style={{
                                            position: "absolute",
                                            top: "12px",
                                            right: "12px",
                                            background: "#ffffff",
                                            color: "#eab308",
                                            padding: "4px 8px",
                                            borderRadius: "12px",
                                            fontSize: "12px",
                                            fontWeight: "700",
                                            display: "flex",
                                            alignItems: "center",
                                            gap: "3px"
                                        }}>
                                            <FiStar size={12} fill="#eab308" /> 4.9
                                        </span>
                                    </div>

                                    <div style={{ padding: "20px", flex: "1", display: "flex", flexDirection: "column" }}>
                                        <h3 style={{ fontSize: "18px", fontWeight: "700", color: "#0f172a", marginBottom: "8px" }}>
                                            {pkg.title}
                                        </h3>
                                        <p style={{ fontSize: "13px", color: "#64748b", lineHeight: "1.5", marginBottom: "16px", flex: "1" }}>
                                            {pkg.description?.slice(0, 95)}...
                                        </p>

                                        <div style={{
                                            display: "flex",
                                            justifyContent: "space-between",
                                            fontSize: "12px",
                                            color: "#64748b",
                                            marginBottom: "16px",
                                            paddingBottom: "16px",
                                            borderBottom: "1px solid #f1f5f9"
                                        }}>
                                            <span style={{ display: "flex", alignItems: "center", gap: "4px" }}>
                                                <FiClock style={{ color: "#3b82f6" }} /> {pkg.duration}
                                            </span>
                                            <span style={{ display: "flex", alignItems: "center", gap: "4px" }}>
                                                <FiUsers style={{ color: "#3b82f6" }} /> Max {pkg.max_people} Pax
                                            </span>
                                        </div>

                                        <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center" }}>
                                            <div>
                                                <span style={{ fontSize: "11px", color: "#94a3b8", display: "block" }}>Price per person</span>
                                                <div style={{ fontSize: "22px", fontWeight: "800", color: "#2563eb" }}>
                                                    ${pkg.discount_price > 0 ? pkg.discount_price : pkg.price}
                                                </div>
                                            </div>

                                            <Link to="/packages" className="btn btn-primary btn-sm" style={{ borderRadius: "8px", fontWeight: "600", display: "flex", alignItems: "center", gap: "6px" }}>
                                                <span>Book Now</span>
                                                <FiArrowRight />
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                    <div style={{ textAlign: "center", marginTop: "30px" }}>
                        <Link to="/packages" className="btn btn-primary" style={{ padding: "12px 32px", borderRadius: "10px", fontWeight: "600" }}>
                            View All Tour Packages ({mockTourPackages.length})
                        </Link>
                    </div>
                </div>
            </section>

            {/* Featured Destinations */}
            <section style={{ padding: "70px 0", background: "#ffffff" }}>
                <div className="container">
                    <div style={{ textAlign: "center", maxWidth: "600px", margin: "0 auto 40px" }}>
                        <span style={{ color: "#3b82f6", fontWeight: "700", fontSize: "13px", textTransform: "uppercase", letterSpacing: "1px" }}>
                            Wanderlust Bucket List
                        </span>
                        <h2 style={{ fontSize: "32px", fontWeight: "800", color: "#0f172a", marginTop: "6px" }}>
                            Top Trending Destinations
                        </h2>
                        <p style={{ color: "#64748b", fontSize: "14px", marginTop: "8px" }}>
                            Discover picturesque islands, alpine summits, historic monuments, and scenic retreats worldwide.
                        </p>
                    </div>

                    <div className="row">
                        {mockDestinations.map((dest) => (
                            <div className="col-12 col-6 col-4 mb-4" key={dest.id}>
                                <div style={{
                                    borderRadius: "16px",
                                    overflow: "hidden",
                                    position: "relative",
                                    height: "260px",
                                    boxShadow: "0 10px 25px rgba(0,0,0,0.1)",
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
                                        background: "linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.2) 60%, transparent 100%)",
                                        display: "flex",
                                        flexDirection: "column",
                                        justifyContent: "flex-end",
                                        padding: "20px",
                                        color: "#ffffff"
                                    }}>
                                        <div style={{ display: "flex", alignItems: "center", gap: "6px", fontSize: "13px", color: "#93c5fd" }}>
                                            <FiMapPin /> {dest.city}, {dest.country}
                                        </div>
                                        <h3 style={{ fontSize: "22px", fontWeight: "800", margin: "4px 0 6px" }}>
                                            {dest.name}
                                        </h3>
                                        <p style={{ fontSize: "12px", color: "rgba(255,255,255,0.8)", margin: "0", lineHeight: "1.4" }}>
                                            {dest.short_description}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Why Choose Us */}
            <section style={{ padding: "60px 0", background: "#0f172a", color: "#ffffff" }}>
                <div className="container">
                    <div style={{ textAlign: "center", maxWidth: "600px", margin: "0 auto 50px" }}>
                        <h2 style={{ fontSize: "30px", fontWeight: "800" }}>Why Travel With Travel ERP?</h2>
                        <p style={{ color: "#94a3b8", fontSize: "14px", marginTop: "8px" }}>
                            Experience end-to-end reliability with personalized itineraries, top-rated support, and transparent pricing.
                        </p>
                    </div>

                    <div className="row">
                        <div className="col-12 col-6 col-3 mb-4">
                            <div style={{ textAlign: "center", padding: "20px" }}>
                                <div style={{
                                    width: "60px",
                                    height: "60px",
                                    borderRadius: "16px",
                                    background: "rgba(59, 130, 246, 0.15)",
                                    color: "#60a5fa",
                                    display: "flex",
                                    alignItems: "center",
                                    justifyContent: "center",
                                    margin: "0 auto 16px",
                                    fontSize: "24px"
                                }}>
                                    <FiCompass />
                                </div>
                                <h4 style={{ fontSize: "17px", fontWeight: "700", marginBottom: "8px" }}>Handpicked Tours</h4>
                                <p style={{ fontSize: "13px", color: "#94a3b8", lineHeight: "1.6" }}>
                                    Every tour itinerary is curated by seasoned travel experts for maximum satisfaction.
                                </p>
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-4">
                            <div style={{ textAlign: "center", padding: "20px" }}>
                                <div style={{
                                    width: "60px",
                                    height: "60px",
                                    borderRadius: "16px",
                                    background: "rgba(59, 130, 246, 0.15)",
                                    color: "#60a5fa",
                                    display: "flex",
                                    alignItems: "center",
                                    justifyContent: "center",
                                    margin: "0 auto 16px",
                                    fontSize: "24px"
                                }}>
                                    <FiAward />
                                </div>
                                <h4 style={{ fontSize: "17px", fontWeight: "700", marginBottom: "8px" }}>Best Price Guarantee</h4>
                                <p style={{ fontSize: "13px", color: "#94a3b8", lineHeight: "1.6" }}>
                                    Direct partnerships with leading airlines and resorts to get you unbeatable rates.
                                </p>
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-4">
                            <div style={{ textAlign: "center", padding: "20px" }}>
                                <div style={{
                                    width: "60px",
                                    height: "60px",
                                    borderRadius: "16px",
                                    background: "rgba(59, 130, 246, 0.15)",
                                    color: "#60a5fa",
                                    display: "flex",
                                    alignItems: "center",
                                    justifyContent: "center",
                                    margin: "0 auto 16px",
                                    fontSize: "24px"
                                }}>
                                    <FiShield />
                                </div>
                                <h4 style={{ fontSize: "17px", fontWeight: "700", marginBottom: "8px" }}>Secure Bookings</h4>
                                <p style={{ fontSize: "13px", color: "#94a3b8", lineHeight: "1.6" }}>
                                    End-to-end encrypted bookings with instant confirmation and transparent cancellation policies.
                                </p>
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-4">
                            <div style={{ textAlign: "center", padding: "20px" }}>
                                <div style={{
                                    width: "60px",
                                    height: "60px",
                                    borderRadius: "16px",
                                    background: "rgba(59, 130, 246, 0.15)",
                                    color: "#60a5fa",
                                    display: "flex",
                                    alignItems: "center",
                                    justifyContent: "center",
                                    margin: "0 auto 16px",
                                    fontSize: "24px"
                                }}>
                                    <FiPhoneCall />
                                </div>
                                <h4 style={{ fontSize: "17px", fontWeight: "700", marginBottom: "8px" }}>24/7 Concierge Support</h4>
                                <p style={{ fontSize: "13px", color: "#94a3b8", lineHeight: "1.6" }}>
                                    Dedicated ground support and travel advisors available round the clock during your trip.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* CTA Section */}
            <section style={{ padding: "60px 0", background: "linear-gradient(135deg, #1e40af, #3b82f6)", color: "#ffffff", textAlign: "center" }}>
                <div className="container">
                    <h2 style={{ fontSize: "32px", fontWeight: "800", marginBottom: "12px" }}>
                        Ready to Start Your Next Adventure?
                    </h2>
                    <p style={{ fontSize: "16px", color: "rgba(255,255,255,0.9)", maxWidth: "550px", margin: "0 auto 30px" }}>
                        Explore all available packages or jump directly into the enterprise dashboard to manage tour bookings.
                    </p>
                    <div style={{ display: "flex", justifyContent: "center", gap: "16px", flexWrap: "wrap" }}>
                        <Link to="/packages" className="btn btn-primary" style={{ background: "#ffffff", color: "#1e40af", padding: "12px 28px", borderRadius: "8px", fontWeight: "700" }}>
                            Explore Tour Packages
                        </Link>
                        <Link to="/admin" className="btn btn-secondary" style={{ background: "rgba(255,255,255,0.2)", color: "#ffffff", border: "1px solid rgba(255,255,255,0.4)", padding: "12px 28px", borderRadius: "8px", fontWeight: "700" }}>
                            Explore Admin ERP Portal
                        </Link>
                    </div>
                </div>
            </section>
        </>
    );
}

export default Home;
