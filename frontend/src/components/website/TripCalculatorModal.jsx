import { useState } from "react";
import { FiX, FiDollarSign, FiUsers, FiCalendar, FiCompass, FiCheck } from "react-icons/fi";

function TripCalculatorModal({ isOpen, onClose }) {
    if (!isOpen) return null;

    const [destination, setDestination] = useState("bali");
    const [days, setDays] = useState(5);
    const [travelers, setTravelers] = useState(2);
    const [style, setStyle] = useState("standard"); // budget, standard, luxury

    const rates = {
        bali: { budget: 70, standard: 130, luxury: 260 },
        alps: { budget: 110, standard: 210, luxury: 420 },
        tokyo: { budget: 95, standard: 180, luxury: 350 },
        maldives: { budget: 150, standard: 300, luxury: 650 },
        rajasthan: { budget: 50, standard: 100, luxury: 220 }
    };

    const costPerDay = rates[destination][style];
    const totalEstimate = costPerDay * days * travelers;

    return (
        <div style={{
            position: "fixed",
            inset: 0,
            background: "rgba(15, 23, 42, 0.75)",
            backdropFilter: "blur(6px)",
            zIndex: 3000,
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
            padding: "20px"
        }}>
            <div style={{
                background: "#ffffff",
                borderRadius: "20px",
                maxWidth: "520px",
                width: "100%",
                padding: "28px",
                position: "relative",
                boxShadow: "0 25px 50px -12px rgba(0,0,0,0.25)"
            }}>
                <button
                    onClick={onClose}
                    style={{ position: "absolute", top: "18px", right: "18px", background: "none", border: "none", fontSize: "20px", cursor: "pointer", color: "#64748b" }}
                >
                    <FiX />
                </button>

                <div style={{ display: "flex", alignItems: "center", gap: "10px", marginBottom: "8px" }}>
                    <div style={{ width: "36px", height: "36px", borderRadius: "10px", background: "#eff6ff", color: "#2563eb", display: "flex", alignItems: "center", justifyContent: "center", fontSize: "18px" }}>
                        <FiCompass />
                    </div>
                    <h3 style={{ fontSize: "20px", fontWeight: "800", color: "#0f172a", margin: 0 }}>
                        Trip Budget Calculator
                    </h3>
                </div>

                <p style={{ fontSize: "13px", color: "#64748b", marginBottom: "20px" }}>
                    Estimate your complete holiday expenses including hotel stay, local tours, dining, and transfers.
                </p>

                {/* Destination selection */}
                <div className="mb-3">
                    <label style={{ fontSize: "12px", fontWeight: "700", color: "#475569", display: "block", marginBottom: "6px" }}>
                        Select Destination
                    </label>
                    <select
                        className="form-control"
                        value={destination}
                        onChange={(e) => setDestination(e.target.value)}
                        style={{ borderRadius: "10px", fontSize: "14px" }}
                    >
                        <option value="bali">Bali, Indonesia (Tropical Beaches & Temples)</option>
                        <option value="alps">Swiss Alps, Switzerland (Mountains & Skiing)</option>
                        <option value="tokyo">Tokyo, Japan (Ultra Modern & Cultural)</option>
                        <option value="maldives">Maldives (Luxury Overwater Bungalows)</option>
                        <option value="rajasthan">Rajasthan, India (Palaces & Forts)</option>
                    </select>
                </div>

                {/* Duration Slider */}
                <div className="mb-3">
                    <div style={{ display: "flex", justifyContent: "space-between", fontSize: "12px", fontWeight: "700", color: "#475569", marginBottom: "6px" }}>
                        <span>Trip Duration</span>
                        <span style={{ color: "#2563eb" }}>{days} Days</span>
                    </div>
                    <input
                        type="range"
                        min="3"
                        max="21"
                        value={days}
                        onChange={(e) => setDays(parseInt(e.target.value))}
                        style={{ width: "100%", accentColor: "#2563eb" }}
                    />
                </div>

                {/* Travelers Slider */}
                <div className="mb-3">
                    <div style={{ display: "flex", justifyContent: "space-between", fontSize: "12px", fontWeight: "700", color: "#475569", marginBottom: "6px" }}>
                        <span>Number of Travelers</span>
                        <span style={{ color: "#2563eb" }}>{travelers} {travelers === 1 ? "Person" : "People"}</span>
                    </div>
                    <input
                        type="range"
                        min="1"
                        max="12"
                        value={travelers}
                        onChange={(e) => setTravelers(parseInt(e.target.value))}
                        style={{ width: "100%", accentColor: "#2563eb" }}
                    />
                </div>

                {/* Travel Style Buttons */}
                <div className="mb-4">
                    <label style={{ fontSize: "12px", fontWeight: "700", color: "#475569", display: "block", marginBottom: "8px" }}>
                        Travel Style & Accommodation
                    </label>
                    <div style={{ display: "flex", gap: "8px" }}>
                        {[
                            { id: "budget", label: "Budget (3★)" },
                            { id: "standard", label: "Comfort (4★)" },
                            { id: "luxury", label: "Luxury (5★)" }
                        ].map((s) => (
                            <button
                                key={s.id}
                                onClick={() => setStyle(s.id)}
                                style={{
                                    flex: 1,
                                    padding: "8px",
                                    borderRadius: "10px",
                                    border: style === s.id ? "2px solid #2563eb" : "1px solid #cbd5e1",
                                    background: style === s.id ? "#eff6ff" : "#ffffff",
                                    color: style === s.id ? "#2563eb" : "#475569",
                                    fontSize: "12px",
                                    fontWeight: "700",
                                    cursor: "pointer"
                                }}
                            >
                                {s.label}
                            </button>
                        ))}
                    </div>
                </div>

                {/* Result Card */}
                <div style={{
                    background: "#0f172a",
                    color: "#ffffff",
                    borderRadius: "14px",
                    padding: "16px 20px",
                    display: "flex",
                    justifyContent: "space-between",
                    alignItems: "center",
                    marginBottom: "16px"
                }}>
                    <div>
                        <span style={{ fontSize: "12px", color: "rgba(255,255,255,0.7)" }}>Estimated Total Budget</span>
                        <div style={{ fontSize: "26px", fontWeight: "900", color: "#60a5fa" }}>
                            ${totalEstimate.toLocaleString()}
                        </div>
                    </div>
                    <div style={{ textAlign: "right", fontSize: "12px", color: "rgba(255,255,255,0.8)" }}>
                        <div>${costPerDay}/person/day</div>
                        <div style={{ color: "#4ade80" }}>✓ Inclusions Covered</div>
                    </div>
                </div>

                <button
                    onClick={onClose}
                    className="btn btn-primary w-100"
                    style={{ padding: "12px", borderRadius: "10px", fontWeight: "700" }}
                >
                    Apply Estimate to Itineraries
                </button>
            </div>
        </div>
    );
}

export default TripCalculatorModal;
