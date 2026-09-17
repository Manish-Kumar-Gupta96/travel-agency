import { useState } from "react";
import { Helmet } from "react-helmet-async";
import { FiStar, FiMapPin, FiWifi, FiCoffee, FiTv, FiShield, FiSearch, FiCheck, FiX } from "react-icons/fi";
import { FaSwimmingPool, FaSpa } from "react-icons/fa";
import { mockHotels, mockDestinations } from "@/constants/mockData";
import { toast } from "react-toastify";

function Hotels() {
    const [searchTerm, setSearchTerm] = useState("");
    const [selectedDestination, setSelectedDestination] = useState("all");
    const [minRating, setMinRating] = useState(0);
    const [bookingHotel, setBookingHotel] = useState(null);
    const [bookingSuccess, setBookingSuccess] = useState(false);

    // Filter hotels
    const filteredHotels = mockHotels.filter((hotel) => {
        const matchesSearch = hotel.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
            hotel.address.toLowerCase().includes(searchTerm.toLowerCase());
        const matchesDest = selectedDestination === "all" || hotel.destination_id === parseInt(selectedDestination);
        const matchesRating = hotel.rating >= minRating;
        return matchesSearch && matchesDest && matchesRating;
    });

    const handleBookNow = (hotel) => {
        setBookingHotel(hotel);
        setBookingSuccess(false);
    };

    const handleConfirmBooking = (e) => {
        e.preventDefault();
        setBookingSuccess(true);
        toast.success(`Booking request for ${bookingHotel.name} received!`);
        setTimeout(() => {
            setBookingHotel(null);
            setBookingSuccess(false);
        }, 2000);
    };

    const hotelImages = [
        "https://images.unsplash.com/photo-1566073771259-6a8506099945",
        "https://images.unsplash.com/photo-1582719478250-c89cae4dc85b",
        "https://images.unsplash.com/photo-1542314831-068cd1dbfeeb",
        "https://images.unsplash.com/photo-1520250497591-112f2f40a3f4",
        "https://images.unsplash.com/photo-1571896349842-33c89424de2d"
    ];

    return (
        <>
            <Helmet>
                <title>Luxury Hotels & Boutique Resorts | Travel ERP</title>
                <meta name="description" content="Discover handpicked luxury resorts, boutique villas, and 5-star hotels worldwide." />
            </Helmet>

            {/* Header Banner */}
            <div style={{
                background: "linear-gradient(135deg, #1e293b, #0f172a), url('https://images.unsplash.com/photo-1566073771259-6a8506099945') center/cover",
                padding: "60px 0 50px",
                color: "#ffffff",
                textAlign: "center"
            }}>
                <div className="container">
                    <span style={{
                        display: "inline-block",
                        padding: "5px 14px",
                        background: "rgba(59, 130, 246, 0.2)",
                        color: "#60a5fa",
                        borderRadius: "20px",
                        fontSize: "13px",
                        fontWeight: "700",
                        marginBottom: "12px",
                        border: "1px solid rgba(96, 165, 250, 0.3)"
                    }}>
                        🏨 Verified 5-Star & Boutique Accommodations
                    </span>
                    <h1 style={{ fontSize: "36px", fontWeight: "800", marginBottom: "12px" }}>
                        Find Your Perfect Stay
                    </h1>
                    <p style={{ color: "rgba(255,255,255,0.8)", fontSize: "16px", maxWidth: "600px", margin: "0 auto" }}>
                        From overwater villas in Maldives to alpine chalets in the Swiss Alps, experience world-class hospitality.
                    </p>
                </div>
            </div>

            {/* Filter Bar */}
            <div style={{ background: "#ffffff", borderBottom: "1px solid #e2e8f0", padding: "20px 0" }}>
                <div className="container">
                    <div style={{
                        display: "flex",
                        flexWrap: "wrap",
                        gap: "16px",
                        alignItems: "center",
                        justifyContent: "space-between"
                    }}>
                        {/* Search Input */}
                        <div style={{
                            display: "flex",
                            alignItems: "center",
                            gap: "10px",
                            background: "#f8fafc",
                            border: "1px solid #cbd5e1",
                            padding: "8px 16px",
                            borderRadius: "10px",
                            flex: "1 1 260px"
                        }}>
                            <FiSearch color="#64748b" />
                            <input
                                type="text"
                                placeholder="Search hotel by name or city..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                                style={{ border: "none", outline: "none", background: "transparent", width: "100%", fontSize: "14px" }}
                            />
                        </div>

                        {/* Destination Dropdown */}
                        <div style={{ flex: "1 1 200px" }}>
                            <select
                                className="form-control"
                                value={selectedDestination}
                                onChange={(e) => setSelectedDestination(e.target.value)}
                                style={{ borderRadius: "10px", fontSize: "14px", height: "42px" }}
                            >
                                <option value="all">All Destinations</option>
                                {mockDestinations.map(d => (
                                    <option key={d.id} value={d.id}>{d.name} ({d.country})</option>
                                ))}
                            </select>
                        </div>

                        {/* Rating Filter */}
                        <div style={{ display: "flex", alignItems: "center", gap: "8px" }}>
                            <span style={{ fontSize: "13px", color: "#64748b", fontWeight: "600" }}>Rating:</span>
                            {[0, 3, 4, 5].map((r) => (
                                <button
                                    key={r}
                                    onClick={() => setMinRating(r)}
                                    style={{
                                        padding: "6px 12px",
                                        borderRadius: "8px",
                                        border: minRating === r ? "1px solid #2563eb" : "1px solid #cbd5e1",
                                        background: minRating === r ? "#2563eb" : "#ffffff",
                                        color: minRating === r ? "#ffffff" : "#475569",
                                        fontSize: "13px",
                                        fontWeight: "600",
                                        cursor: "pointer"
                                    }}
                                >
                                    {r === 0 ? "All" : `${r}★+`}
                                </button>
                            ))}
                        </div>
                    </div>
                </div>
            </div>

            {/* Hotels List */}
            <div style={{ padding: "50px 0", background: "#f8fafc" }}>
                <div className="container">
                    <div style={{ marginBottom: "24px", display: "flex", justifyContent: "space-between", alignItems: "center" }}>
                        <h2 style={{ fontSize: "20px", fontWeight: "700", color: "#1e293b" }}>
                            Showing {filteredHotels.length} Luxury Stays
                        </h2>
                    </div>

                    <div className="row">
                        {filteredHotels.map((hotel, idx) => (
                            <div className="col-12 col-6 col-4 mb-4" key={hotel.id}>
                                <div style={{
                                    background: "#ffffff",
                                    borderRadius: "16px",
                                    border: "1px solid #e2e8f0",
                                    overflow: "hidden",
                                    boxShadow: "0 4px 15px rgba(0,0,0,0.03)",
                                    height: "100%",
                                    display: "flex",
                                    flexDirection: "column"
                                }}>
                                    <div style={{ position: "relative", height: "210px" }}>
                                        <img
                                            src={hotelImages[idx % hotelImages.length]}
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
                                        <h3 style={{ fontSize: "18px", fontWeight: "700", color: "#0f172a", marginBottom: "6px" }}>
                                            {hotel.name}
                                        </h3>

                                        <p style={{ fontSize: "13px", color: "#64748b", display: "flex", alignItems: "center", gap: "4px", marginBottom: "14px" }}>
                                            <FiMapPin color="#3b82f6" /> {hotel.address}
                                        </p>

                                        {/* Amenities Icons */}
                                        <div style={{
                                            display: "flex",
                                            gap: "12px",
                                            fontSize: "13px",
                                            color: "#475569",
                                            padding: "10px 0",
                                            borderTop: "1px solid #f1f5f9",
                                            borderBottom: "1px solid #f1f5f9",
                                            marginBottom: "16px"
                                        }}>
                                            <span title="Free High-Speed WiFi" style={{ display: "flex", alignItems: "center", gap: "4px" }}><FiWifi color="#2563eb" /> WiFi</span>
                                            <span title="Swimming Pool" style={{ display: "flex", alignItems: "center", gap: "4px" }}><FaSwimmingPool color="#2563eb" /> Pool</span>
                                            <span title="Spa & Wellness" style={{ display: "flex", alignItems: "center", gap: "4px" }}><FaSpa color="#2563eb" /> Spa</span>
                                            <span title="Complimentary Breakfast" style={{ display: "flex", alignItems: "center", gap: "4px" }}><FiCoffee color="#2563eb" /> Breakfast</span>
                                        </div>

                                        <div style={{ marginTop: "auto", display: "flex", justifyContent: "space-between", alignItems: "center" }}>
                                            <div>
                                                <span style={{ fontSize: "11px", color: "#94a3b8", display: "block" }}>Price per night</span>
                                                <div style={{ fontSize: "20px", fontWeight: "800", color: "#2563eb" }}>
                                                    ${hotel.price_per_night}
                                                </div>
                                            </div>

                                            <button
                                                onClick={() => handleBookNow(hotel)}
                                                className="btn btn-primary btn-sm"
                                                style={{ borderRadius: "8px", fontWeight: "600" }}
                                            >
                                                Book Room
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>

            {/* Booking Modal */}
            {bookingHotel && (
                <div style={{
                    position: "fixed",
                    inset: "0",
                    background: "rgba(15, 23, 42, 0.75)",
                    backdropFilter: "blur(4px)",
                    zIndex: 2000,
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "center",
                    padding: "20px"
                }}>
                    <div style={{
                        background: "#ffffff",
                        borderRadius: "16px",
                        maxWidth: "480px",
                        width: "100%",
                        padding: "24px",
                        position: "relative",
                        boxShadow: "0 25px 50px -12px rgba(0,0,0,0.25)"
                    }}>
                        <button
                            onClick={() => setBookingHotel(null)}
                            style={{ position: "absolute", top: "16px", right: "16px", background: "none", border: "none", fontSize: "20px", cursor: "pointer", color: "#64748b" }}
                        >
                            <FiX />
                        </button>

                        {bookingSuccess ? (
                            <div style={{ textAlign: "center", padding: "30px 0" }}>
                                <div style={{ width: "60px", height: "60px", borderRadius: "50%", background: "#dcfce7", color: "#16a34a", display: "flex", alignItems: "center", justifyContent: "center", margin: "0 auto 16px", fontSize: "28px" }}>
                                    <FiCheck />
                                </div>
                                <h3 style={{ fontSize: "20px", fontWeight: "700", color: "#166534" }}>Reservation Confirmed!</h3>
                                <p style={{ fontSize: "14px", color: "#64748b", marginTop: "8px" }}>
                                    Thank you! We've sent the confirmation details to your email.
                                </p>
                            </div>
                        ) : (
                            <>
                                <h3 style={{ fontSize: "20px", fontWeight: "800", color: "#0f172a", marginBottom: "4px" }}>
                                    Reserve {bookingHotel.name}
                                </h3>
                                <p style={{ fontSize: "13px", color: "#64748b", marginBottom: "16px" }}>
                                    {bookingHotel.address} • <strong>${bookingHotel.price_per_night}/night</strong>
                                </p>

                                <form onSubmit={handleConfirmBooking}>
                                    <div className="form-group mb-3">
                                        <label className="form-label" style={{ fontSize: "12px", fontWeight: "600" }}>Your Full Name</label>
                                        <input type="text" required className="form-control" placeholder="John Doe" />
                                    </div>

                                    <div className="form-group mb-3">
                                        <label className="form-label" style={{ fontSize: "12px", fontWeight: "600" }}>Email Address</label>
                                        <input type="email" required className="form-control" placeholder="john@example.com" />
                                    </div>

                                    <div style={{ display: "flex", gap: "10px" }} className="mb-3">
                                        <div style={{ flex: "1" }}>
                                            <label className="form-label" style={{ fontSize: "12px", fontWeight: "600" }}>Check-in</label>
                                            <input type="date" required className="form-control" />
                                        </div>
                                        <div style={{ flex: "1" }}>
                                            <label className="form-label" style={{ fontSize: "12px", fontWeight: "600" }}>Check-out</label>
                                            <input type="date" required className="form-control" />
                                        </div>
                                    </div>

                                    <button type="submit" className="btn btn-primary w-100" style={{ padding: "12px", fontWeight: "700", borderRadius: "10px" }}>
                                        Confirm Reservation
                                    </button>
                                </form>
                            </>
                        )}
                    </div>
                </div>
            )}
        </>
    );
}

export default Hotels;
