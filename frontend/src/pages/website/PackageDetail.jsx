import { useState } from "react";
import { useParams, Link } from "react-router-dom";
import { Helmet } from "react-helmet-async";
import { FiClock, FiUsers, FiMapPin, FiCheck, FiX, FiShield, FiStar, FiCalendar, FiArrowLeft, FiHeart } from "react-icons/fi";
import { mockTourPackages, getDestinationById } from "@/constants/mockData";
import { toast } from "react-toastify";

function PackageDetail() {
    const { id } = useParams();
    const pkgId = parseInt(id) || 1;
    const pkg = mockTourPackages.find(p => p.id === pkgId) || mockTourPackages[0];
    const destination = getDestinationById(pkg.destination_id);

    const [guests, setGuests] = useState(2);
    const [travelDate, setTravelDate] = useState("2026-10-20");
    const [isSaved, setIsSaved] = useState(false);
    const [bookedSuccess, setBookedSuccess] = useState(false);

    const basePrice = pkg.discount_price > 0 ? pkg.discount_price : pkg.price;
    const totalPrice = basePrice * guests;

    const itineraryDays = [
        {
            day: "Day 1",
            title: "Arrival & VIP Welcome Dinner",
            description: "Land at the international airport where your private chauffeur meets you. Check in to your 5-star ocean-view resort, refresh, and enjoy an authentic 5-course welcome dinner by the beach."
        },
        {
            day: "Day 2",
            title: "Guided Cultural Sightseeing & Heritage Temples",
            description: "Explore the most famous ancient landmarks, UNESCO heritage temples, and local artisan craft villages with your private certified historian guide."
        },
        {
            day: "Day 3",
            title: "Scenic Island Cruise & Watersports Adventure",
            description: "Board a private luxury catamaran for a full-day coastal excursion with snorkeling, coral reef exploration, and sunset champagne tasting."
        },
        {
            day: "Day 4",
            title: "Mountain Rainforest Trek & Ayurvedic Spa Therapy",
            description: "Morning guided trek through lush valleys and cascading waterfalls. Afternoon dedicated to a 90-minute traditional herbal spa and rejuvenation treatment."
        },
        {
            day: "Day 5",
            title: "Souvenir Shopping & VIP Airport Departure",
            description: "Enjoy a leisurely buffet breakfast, morning souvenir shopping at local boutique markets, followed by private airport transfer for your return flight."
        }
    ];

    const inclusions = [
        "4 Nights 5-Star Luxury Resort Stay",
        "Daily Buffet Breakfast & 2 Gourmet Dinners",
        "Private Air-Conditioned Vehicle & Airport Transfers",
        "All Monument Entrance Fees & Fast-Track Passes",
        "English-Speaking Certified Tour Guide",
        "Comprehensive Travel & Medical Insurance"
    ];

    const exclusions = [
        "International Airfare (Available as add-on)",
        "Personal Souvenir Expenses & Alcoholic Beverages",
        "Optional Helicopter Excursions"
    ];

    const handleConfirmBooking = (e) => {
        e.preventDefault();
        setBookedSuccess(true);
        toast.success(`Booking request for ${guests} guests on "${pkg.title}" confirmed!`);
    };

    return (
        <>
            <Helmet>
                <title>{pkg.title} | Travel ERP</title>
                <meta name="description" content={pkg.description} />
            </Helmet>

            {/* Breadcrumb / Back Link */}
            <div style={{ background: "#ffffff", borderBottom: "1px solid #e2e8f0", padding: "14px 0" }}>
                <div className="container" style={{ display: "flex", justifyContent: "space-between", alignItems: "center" }}>
                    <Link to="/packages" style={{ color: "#2563eb", textDecoration: "none", fontWeight: "600", fontSize: "14px", display: "flex", alignItems: "center", gap: "6px" }}>
                        <FiArrowLeft /> Back to Tour Packages
                    </Link>
                    <button
                        onClick={() => {
                            setIsSaved(!isSaved);
                            toast.info(isSaved ? "Removed from Wishlist" : "Added to Wishlist! ❤️");
                        }}
                        style={{ background: "none", border: "1px solid #cbd5e1", borderRadius: "8px", padding: "6px 14px", fontSize: "13px", cursor: "pointer", display: "flex", alignItems: "center", gap: "6px", color: isSaved ? "#ef4444" : "#475569" }}
                    >
                        <FiHeart fill={isSaved ? "#ef4444" : "none"} /> {isSaved ? "Saved" : "Save to Wishlist"}
                    </button>
                </div>
            </div>

            {/* Hero Banner with Title & Badges */}
            <div style={{
                background: "linear-gradient(135deg, rgba(15, 23, 42, 0.85), rgba(30, 58, 138, 0.85)), url('" + pkg.featured_image + "') center/cover no-repeat",
                padding: "60px 0",
                color: "#ffffff"
            }}>
                <div className="container">
                    <div style={{ display: "flex", gap: "10px", marginBottom: "14px", flexWrap: "wrap" }}>
                        <span style={{ background: "#3b82f6", padding: "4px 12px", borderRadius: "12px", fontSize: "12px", fontWeight: "700" }}>
                            {pkg.category}
                        </span>
                        <span style={{ background: "rgba(255,255,255,0.2)", padding: "4px 12px", borderRadius: "12px", fontSize: "12px", fontWeight: "600", display: "flex", alignItems: "center", gap: "4px" }}>
                            <FiMapPin /> {destination ? `${destination.name}, ${destination.country}` : "Global"}
                        </span>
                        <span style={{ background: "#eab308", color: "#000000", padding: "4px 10px", borderRadius: "12px", fontSize: "12px", fontWeight: "700", display: "flex", alignItems: "center", gap: "4px" }}>
                            <FiStar fill="#000000" size={12} /> 4.9 (128 Reviews)
                        </span>
                    </div>

                    <h1 style={{ fontSize: "36px", fontWeight: "800", marginBottom: "12px" }}>
                        {pkg.title}
                    </h1>

                    <div style={{ display: "flex", gap: "24px", fontSize: "14px", color: "rgba(255,255,255,0.9)" }}>
                        <span style={{ display: "flex", alignItems: "center", gap: "6px" }}><FiClock /> {pkg.duration}</span>
                        <span style={{ display: "flex", alignItems: "center", gap: "6px" }}><FiUsers /> Max {pkg.max_people} Guests</span>
                        <span style={{ display: "flex", alignItems: "center", gap: "6px" }}><FiShield /> 100% Verified Safe</span>
                    </div>
                </div>
            </div>

            {/* Main Content Layout */}
            <div style={{ padding: "50px 0", background: "#f8fafc" }}>
                <div className="container">
                    <div className="row">
                        {/* Left Column: Details & Timeline */}
                        <div className="col-12 col-8 mb-4">
                            {/* Overview Card */}
                            <div style={{ background: "#ffffff", borderRadius: "16px", padding: "28px", border: "1px solid #e2e8f0", marginBottom: "28px", boxShadow: "0 4px 15px rgba(0,0,0,0.02)" }}>
                                <h2 style={{ fontSize: "22px", fontWeight: "800", color: "#0f172a", marginBottom: "14px" }}>Tour Overview</h2>
                                <p style={{ fontSize: "15px", lineHeight: "1.7", color: "#475569" }}>
                                    {pkg.description} Experience the beauty of pristine landscapes, handpicked accommodations, and curated local cuisines in a leisurely pace.
                                </p>
                            </div>

                            {/* Itinerary Timeline */}
                            <div style={{ background: "#ffffff", borderRadius: "16px", padding: "28px", border: "1px solid #e2e8f0", marginBottom: "28px", boxShadow: "0 4px 15px rgba(0,0,0,0.02)" }}>
                                <h2 style={{ fontSize: "22px", fontWeight: "800", color: "#0f172a", marginBottom: "20px" }}>Day-By-Day Itinerary</h2>

                                <div style={{ display: "flex", flexDirection: "column", gap: "20px" }}>
                                    {itineraryDays.map((item, index) => (
                                        <div key={index} style={{ display: "flex", gap: "16px" }}>
                                            <div style={{
                                                width: "44px",
                                                height: "44px",
                                                borderRadius: "12px",
                                                background: "#eff6ff",
                                                color: "#2563eb",
                                                display: "flex",
                                                alignItems: "center",
                                                justifyContent: "center",
                                                fontWeight: "800",
                                                fontSize: "13px",
                                                flexShrink: 0
                                            }}>
                                                {item.day}
                                            </div>
                                            <div>
                                                <h4 style={{ fontSize: "16px", fontWeight: "700", color: "#0f172a", marginBottom: "6px" }}>
                                                    {item.title}
                                                </h4>
                                                <p style={{ fontSize: "14px", color: "#64748b", lineHeight: "1.6", margin: "0" }}>
                                                    {item.description}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>

                            {/* Inclusions & Exclusions */}
                            <div style={{ background: "#ffffff", borderRadius: "16px", padding: "28px", border: "1px solid #e2e8f0", boxShadow: "0 4px 15px rgba(0,0,0,0.02)" }}>
                                <h2 style={{ fontSize: "22px", fontWeight: "800", color: "#0f172a", marginBottom: "20px" }}>What's Included & Excluded</h2>

                                <div className="row">
                                    <div className="col-12 col-6 mb-3">
                                        <h4 style={{ fontSize: "15px", fontWeight: "700", color: "#166534", marginBottom: "12px", display: "flex", alignItems: "center", gap: "6px" }}>
                                            <FiCheck color="#16a34a" /> Included in Package
                                        </h4>
                                        <ul style={{ listStyle: "none", padding: "0", display: "flex", flexDirection: "column", gap: "10px" }}>
                                            {inclusions.map((inc, i) => (
                                                <li key={i} style={{ fontSize: "13px", color: "#334155", display: "flex", alignItems: "flex-start", gap: "8px" }}>
                                                    <span style={{ color: "#16a34a", fontWeight: "bold" }}>✓</span> {inc}
                                                </li>
                                            ))}
                                        </ul>
                                    </div>

                                    <div className="col-12 col-6">
                                        <h4 style={{ fontSize: "15px", fontWeight: "700", color: "#991b1b", marginBottom: "12px", display: "flex", alignItems: "center", gap: "6px" }}>
                                            <FiX color="#dc2626" /> Not Included
                                        </h4>
                                        <ul style={{ listStyle: "none", padding: "0", display: "flex", flexDirection: "column", gap: "10px" }}>
                                            {exclusions.map((exc, i) => (
                                                <li key={i} style={{ fontSize: "13px", color: "#64748b", display: "flex", alignItems: "flex-start", gap: "8px" }}>
                                                    <span style={{ color: "#dc2626", fontWeight: "bold" }}>✗</span> {exc}
                                                </li>
                                            ))}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Right Column: Instant Booking Card */}
                        <div className="col-12 col-4">
                            <div style={{
                                background: "#ffffff",
                                borderRadius: "16px",
                                padding: "28px",
                                border: "1px solid #e2e8f0",
                                boxShadow: "0 10px 30px rgba(0,0,0,0.06)",
                                position: "sticky",
                                top: "90px"
                            }}>
                                <div style={{ borderBottom: "1px solid #f1f5f9", paddingBottom: "16px", marginBottom: "20px" }}>
                                    <span style={{ fontSize: "12px", color: "#64748b" }}>Starting from</span>
                                    <div style={{ display: "flex", alignItems: "baseline", gap: "8px" }}>
                                        <div style={{ fontSize: "32px", fontWeight: "900", color: "#2563eb" }}>
                                            ${basePrice}
                                        </div>
                                        <span style={{ fontSize: "13px", color: "#64748b" }}>/ person</span>
                                    </div>
                                </div>

                                {bookedSuccess ? (
                                    <div style={{ textAlign: "center", padding: "20px 0" }}>
                                        <div style={{ width: "50px", height: "50px", borderRadius: "50%", background: "#dcfce7", color: "#16a34a", display: "flex", alignItems: "center", justifyContent: "center", margin: "0 auto 12px", fontSize: "24px" }}>
                                            <FiCheck />
                                        </div>
                                        <h4 style={{ fontSize: "18px", fontWeight: "700", color: "#166534" }}>Tour Reserved!</h4>
                                        <p style={{ fontSize: "13px", color: "#64748b", margin: "8px 0" }}>
                                            Booking reference sent to your email. Total: <strong>${totalPrice}</strong>
                                        </p>
                                        <button onClick={() => setBookedSuccess(false)} className="btn btn-secondary btn-sm mt-2">
                                            Make Another Booking
                                        </button>
                                    </div>
                                ) : (
                                    <form onSubmit={handleConfirmBooking}>
                                        <div className="form-group mb-3">
                                            <label style={{ fontSize: "12px", fontWeight: "700", color: "#475569", display: "block", marginBottom: "6px" }}>Select Departure Date</label>
                                            <input
                                                type="date"
                                                required
                                                className="form-control"
                                                value={travelDate}
                                                onChange={(e) => setTravelDate(e.target.value)}
                                            />
                                        </div>

                                        <div className="form-group mb-3">
                                            <label style={{ fontSize: "12px", fontWeight: "700", color: "#475569", display: "block", marginBottom: "6px" }}>Number of Guests</label>
                                            <select
                                                className="form-control"
                                                value={guests}
                                                onChange={(e) => setGuests(parseInt(e.target.value))}
                                            >
                                                {[1, 2, 3, 4, 5, 6, 8, 10].map(n => (
                                                    <option key={n} value={n}>{n} {n === 1 ? "Traveler" : "Travelers"}</option>
                                                ))}
                                            </select>
                                        </div>

                                        <div style={{ background: "#f8fafc", borderRadius: "10px", padding: "14px", margin: "16px 0", fontSize: "13px" }}>
                                            <div style={{ display: "flex", justifyContent: "space-between", marginBottom: "6px" }}>
                                                <span style={{ color: "#64748b" }}>${basePrice} x {guests} Guests</span>
                                                <span style={{ fontWeight: "600" }}>${totalPrice}</span>
                                            </div>
                                            <div style={{ display: "flex", justifyContent: "space-between", marginBottom: "6px" }}>
                                                <span style={{ color: "#64748b" }}>Taxes & Booking Fees</span>
                                                <span style={{ color: "#16a34a", fontWeight: "600" }}>Free (Waived)</span>
                                            </div>
                                            <div style={{ display: "flex", justifyContent: "space-between", borderTop: "1px solid #e2e8f0", paddingTop: "8px", marginTop: "8px", fontWeight: "800", fontSize: "15px", color: "#0f172a" }}>
                                                <span>Total Amount</span>
                                                <span style={{ color: "#2563eb" }}>${totalPrice}</span>
                                            </div>
                                        </div>

                                        <button type="submit" className="btn btn-primary w-100" style={{ padding: "12px", fontWeight: "700", borderRadius: "10px" }}>
                                            Book This Package
                                        </button>
                                    </form>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

export default PackageDetail;
