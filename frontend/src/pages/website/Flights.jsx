import { useState } from "react";
import { Helmet } from "react-helmet-async";
import { FiArrowRight, FiClock, FiCalendar, FiCheck, FiShield, FiBriefcase, FiFilter } from "react-icons/fi";
import { FaPlaneDeparture, FaPlaneArrival, FaPlane } from "react-icons/fa";
import { toast } from "react-toastify";

function Flights() {
    const [fromCity, setFromCity] = useState("New York (JFK)");
    const [toCity, setToCity] = useState("Bali (DPS)");
    const [flightClass, setFlightClass] = useState("economy");
    const [tripType, setTripType] = useState("roundtrip");
    const [bookedFlight, setBookedFlight] = useState(null);

    const availableFlights = [
        {
            id: "SQ-947",
            airline: "Singapore Airlines",
            logo: "✈️",
            departure_time: "10:30 AM",
            departure_code: "JFK",
            arrival_time: "08:15 PM (+1)",
            arrival_code: "DPS",
            duration: "19h 45m",
            stops: "1 Stop (SIN)",
            price: 680,
            seats_left: 4,
            aircraft: "Boeing 787-10 Dreamliner",
            baggage: "30 kg included"
        },
        {
            id: "EK-398",
            airline: "Emirates",
            logo: "✈️",
            departure_time: "02:15 PM",
            departure_code: "JFK",
            arrival_time: "11:40 PM (+1)",
            arrival_code: "DPS",
            duration: "21h 25m",
            stops: "1 Stop (DXB)",
            price: 740,
            seats_left: 7,
            aircraft: "Airbus A380-800",
            baggage: "35 kg included"
        },
        {
            id: "JL-006",
            airline: "Japan Airlines",
            logo: "✈️",
            departure_time: "11:45 AM",
            departure_code: "JFK",
            arrival_time: "09:30 PM (+1)",
            arrival_code: "HND",
            duration: "14h 45m",
            stops: "Non-stop",
            price: 920,
            seats_left: 2,
            aircraft: "Boeing 777-300ER",
            baggage: "2 x 23 kg included"
        },
        {
            id: "LX-019",
            airline: "Swiss International",
            logo: "✈️",
            departure_time: "06:10 PM",
            departure_code: "JFK",
            arrival_time: "07:55 AM (+1)",
            arrival_code: "ZRH",
            duration: "7h 45m",
            stops: "Non-stop",
            price: 610,
            seats_left: 9,
            aircraft: "Airbus A330-300",
            baggage: "23 kg included"
        },
        {
            id: "QR-702",
            airline: "Qatar Airways",
            logo: "✈️",
            departure_time: "09:00 PM",
            departure_code: "JFK",
            arrival_time: "05:45 PM (+1)",
            arrival_code: "MLE",
            duration: "16h 45m",
            stops: "1 Stop (DOH)",
            price: 850,
            seats_left: 5,
            aircraft: "Airbus A350-1000",
            baggage: "30 kg included"
        }
    ];

    const handleFlightBook = (flight) => {
        setBookedFlight(flight);
        toast.success(`Seat held on ${flight.airline} (${flight.id})!`);
    };

    return (
        <>
            <Helmet>
                <title>International Flight Search & Bookings | Travel ERP</title>
                <meta name="description" content="Compare international flights, flexible dates, and premium airline tickets worldwide." />
            </Helmet>

            {/* Header */}
            <div style={{
                background: "linear-gradient(135deg, #0284c7, #1e3a8a)",
                padding: "60px 0 80px",
                color: "#ffffff",
                textAlign: "center"
            }}>
                <div className="container">
                    <span style={{
                        display: "inline-block",
                        padding: "5px 14px",
                        background: "rgba(255,255,255,0.2)",
                        borderRadius: "20px",
                        fontSize: "13px",
                        fontWeight: "600",
                        marginBottom: "12px"
                    }}>
                        ✈️ Global Airline Partners & Real-time Schedules
                    </span>
                    <h1 style={{ fontSize: "36px", fontWeight: "800", marginBottom: "12px" }}>
                        Book Domestic & International Flights
                    </h1>
                    <p style={{ color: "rgba(255,255,255,0.85)", fontSize: "16px", maxWidth: "600px", margin: "0 auto" }}>
                        Exclusive deals on top airlines with flexible cancellation, transparent fares, and 24/7 flight support.
                    </p>
                </div>
            </div>

            {/* Search Box */}
            <div className="container" style={{ marginTop: "-40px", position: "relative", zIndex: 10 }}>
                <div style={{
                    background: "#ffffff",
                    borderRadius: "16px",
                    padding: "24px",
                    boxShadow: "0 15px 35px rgba(0,0,0,0.1)",
                    border: "1px solid #e2e8f0"
                }}>
                    {/* Trip Type Radios */}
                    <div style={{ display: "flex", gap: "20px", marginBottom: "20px" }}>
                        {["roundtrip", "oneway", "multicity"].map((type) => (
                            <label key={type} style={{ display: "flex", alignItems: "center", gap: "6px", cursor: "pointer", fontSize: "14px", fontWeight: "600", color: "#334155", textTransform: "capitalize" }}>
                                <input
                                    type="radio"
                                    name="tripType"
                                    checked={tripType === type}
                                    onChange={() => setTripType(type)}
                                />
                                {type === "roundtrip" ? "Round Trip" : type === "oneway" ? "One Way" : "Multi-City"}
                            </label>
                        ))}
                    </div>

                    <div className="row">
                        <div className="col-12 col-6 col-3 mb-3">
                            <label style={{ fontSize: "12px", fontWeight: "700", color: "#64748b", display: "block", marginBottom: "6px" }}>From</label>
                            <div style={{ display: "flex", alignItems: "center", gap: "8px", border: "1px solid #cbd5e1", borderRadius: "10px", padding: "8px 12px" }}>
                                <FaPlaneDeparture color="#3b82f6" />
                                <input
                                    type="text"
                                    value={fromCity}
                                    onChange={(e) => setFromCity(e.target.value)}
                                    style={{ border: "none", outline: "none", width: "100%", fontSize: "14px", fontWeight: "600" }}
                                />
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-3">
                            <label style={{ fontSize: "12px", fontWeight: "700", color: "#64748b", display: "block", marginBottom: "6px" }}>To</label>
                            <div style={{ display: "flex", alignItems: "center", gap: "8px", border: "1px solid #cbd5e1", borderRadius: "10px", padding: "8px 12px" }}>
                                <FaPlaneArrival color="#3b82f6" />
                                <input
                                    type="text"
                                    value={toCity}
                                    onChange={(e) => setToCity(e.target.value)}
                                    style={{ border: "none", outline: "none", width: "100%", fontSize: "14px", fontWeight: "600" }}
                                />
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-3">
                            <label style={{ fontSize: "12px", fontWeight: "700", color: "#64748b", display: "block", marginBottom: "6px" }}>Departure Date</label>
                            <div style={{ display: "flex", alignItems: "center", gap: "8px", border: "1px solid #cbd5e1", borderRadius: "10px", padding: "8px 12px" }}>
                                <FiCalendar color="#3b82f6" />
                                <input
                                    type="date"
                                    defaultValue="2026-10-15"
                                    style={{ border: "none", outline: "none", width: "100%", fontSize: "14px", fontWeight: "600" }}
                                />
                            </div>
                        </div>

                        <div className="col-12 col-6 col-3 mb-3">
                            <label style={{ fontSize: "12px", fontWeight: "700", color: "#64748b", display: "block", marginBottom: "6px" }}>Cabin Class</label>
                            <select
                                className="form-control"
                                value={flightClass}
                                onChange={(e) => setFlightClass(e.target.value)}
                                style={{ borderRadius: "10px", height: "42px", fontSize: "14px", fontWeight: "600" }}
                            >
                                <option value="economy">Economy Class</option>
                                <option value="premium">Premium Economy</option>
                                <option value="business">Business Class</option>
                                <option value="first">First Class</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {/* Flight Results */}
            <div style={{ padding: "60px 0", background: "#f8fafc" }}>
                <div className="container">
                    <div style={{ marginBottom: "20px", display: "flex", justifyContent: "space-between", alignItems: "center" }}>
                        <h2 style={{ fontSize: "20px", fontWeight: "700", color: "#1e293b" }}>
                            Available Flight Deals ({availableFlights.length})
                        </h2>
                    </div>

                    <div style={{ display: "flex", flexDirection: "column", gap: "16px" }}>
                        {availableFlights.map((flight) => (
                            <div key={flight.id} style={{
                                background: "#ffffff",
                                borderRadius: "16px",
                                border: "1px solid #e2e8f0",
                                padding: "24px",
                                boxShadow: "0 4px 15px rgba(0,0,0,0.02)",
                                display: "flex",
                                flexWrap: "wrap",
                                alignItems: "center",
                                justifyContent: "space-between",
                                gap: "20px"
                            }}>
                                {/* Airline info */}
                                <div style={{ minWidth: "180px" }}>
                                    <div style={{ display: "flex", alignItems: "center", gap: "10px" }}>
                                        <div style={{ width: "40px", height: "40px", borderRadius: "10px", background: "#eff6ff", color: "#2563eb", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "18px" }}>
                                            <FaPlane />
                                        </div>
                                        <div>
                                            <h4 style={{ fontSize: "16px", fontWeight: "700", color: "#0f172a", margin: "0" }}>{flight.airline}</h4>
                                            <span style={{ fontSize: "12px", color: "#64748b" }}>Flight {flight.id} • {flight.aircraft}</span>
                                        </div>
                                    </div>
                                </div>

                                {/* Schedule Timeline */}
                                <div style={{ display: "flex", alignItems: "center", gap: "24px", flex: "1 1 300px", justifyContent: "center" }}>
                                    <div style={{ textAlign: "center" }}>
                                        <div style={{ fontSize: "18px", fontWeight: "800", color: "#0f172a" }}>{flight.departure_time}</div>
                                        <span style={{ fontSize: "13px", fontWeight: "600", color: "#3b82f6" }}>{flight.departure_code}</span>
                                    </div>

                                    <div style={{ textAlign: "center", flex: "1", maxWidth: "160px" }}>
                                        <span style={{ fontSize: "11px", color: "#64748b", display: "block" }}>{flight.duration}</span>
                                        <div style={{ height: "2px", background: "#cbd5e1", margin: "6px 0", position: "relative" }}>
                                            <div style={{ position: "absolute", top: "-4px", left: "50%", transform: "translateX(-50%)", width: "10px", height: "10px", borderRadius: "50%", background: "#3b82f6" }} />
                                        </div>
                                        <span style={{ fontSize: "11px", color: flight.stops === "Non-stop" ? "#16a34a" : "#d97706", fontWeight: "600" }}>{flight.stops}</span>
                                    </div>

                                    <div style={{ textAlign: "center" }}>
                                        <div style={{ fontSize: "18px", fontWeight: "800", color: "#0f172a" }}>{flight.arrival_time}</div>
                                        <span style={{ fontSize: "13px", fontWeight: "600", color: "#3b82f6" }}>{flight.arrival_code}</span>
                                    </div>
                                </div>

                                {/* Price & Action */}
                                <div style={{ display: "flex", alignItems: "center", gap: "20px", minWidth: "160px", justifyContent: "flex-end" }}>
                                    <div style={{ textAlign: "right" }}>
                                        <div style={{ fontSize: "24px", fontWeight: "800", color: "#2563eb" }}>${flight.price}</div>
                                        <span style={{ fontSize: "11px", color: "#64748b" }}>{flight.baggage}</span>
                                    </div>

                                    <button
                                        onClick={() => handleFlightBook(flight)}
                                        className="btn btn-primary"
                                        style={{ padding: "10px 20px", borderRadius: "8px", fontWeight: "600" }}
                                    >
                                        Select Flight
                                    </button>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </>
    );
}

export default Flights;
