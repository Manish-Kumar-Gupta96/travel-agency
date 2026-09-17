import { useState, useEffect } from "react";
import { Helmet } from "react-helmet-async";
import { FiTag, FiClock, FiCheck, FiArrowRight, FiPercent, FiGift } from "react-icons/fi";
import { Link } from "react-router-dom";
import { mockTourPackages } from "@/constants/mockData";
import { toast } from "react-toastify";

function Deals() {
    // Countdown timer calculation
    const [timeLeft, setTimeLeft] = useState({ hours: 48, minutes: 24, seconds: 15 });

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

    const copyPromoCode = (code) => {
        navigator.clipboard?.writeText(code);
        toast.success(`Promo code "${code}" copied to clipboard! Apply at checkout for 20% discount.`);
    };

    const dealsPackages = mockTourPackages.slice(0, 4);

    return (
        <>
            <Helmet>
                <title>Exclusive Travel Deals & Flash Discounts | Travel ERP</title>
                <meta name="description" content="Save up to 40% on luxury vacation packages and early-bird seasonal deals." />
            </Helmet>

            {/* Banner with Flash Sale Timer */}
            <div style={{
                background: "linear-gradient(135deg, #7c3aed, #2563eb)",
                padding: "60px 0",
                color: "#ffffff",
                textAlign: "center"
            }}>
                <div className="container">
                    <span style={{
                        display: "inline-flex",
                        alignItems: "center",
                        gap: "6px",
                        padding: "6px 16px",
                        background: "rgba(255, 255, 255, 0.2)",
                        borderRadius: "20px",
                        fontSize: "13px",
                        fontWeight: "700",
                        marginBottom: "16px"
                    }}>
                        <FiGift /> Limited-Time Flash Sale
                    </span>

                    <h1 style={{ fontSize: "38px", fontWeight: "800", marginBottom: "14px" }}>
                        Save Up To 40% On Top Travel Packages
                    </h1>

                    <p style={{ fontSize: "16px", color: "rgba(255,255,255,0.9)", maxWidth: "600px", margin: "0 auto 30px" }}>
                        Lock in your dream vacation with our lowest guaranteed fares and verified luxury resorts.
                    </p>

                    {/* Countdown Clock */}
                    <div style={{ display: "flex", justifyContent: "center", gap: "16px" }}>
                        <div style={{ background: "rgba(0,0,0,0.3)", padding: "12px 20px", borderRadius: "12px", minWidth: "80px" }}>
                            <div style={{ fontSize: "28px", fontWeight: "800" }}>{String(timeLeft.hours).padStart(2, '0')}</div>
                            <span style={{ fontSize: "11px", textTransform: "uppercase", letterSpacing: "1px", color: "rgba(255,255,255,0.7)" }}>Hours</span>
                        </div>
                        <div style={{ background: "rgba(0,0,0,0.3)", padding: "12px 20px", borderRadius: "12px", minWidth: "80px" }}>
                            <div style={{ fontSize: "28px", fontWeight: "800" }}>{String(timeLeft.minutes).padStart(2, '0')}</div>
                            <span style={{ fontSize: "11px", textTransform: "uppercase", letterSpacing: "1px", color: "rgba(255,255,255,0.7)" }}>Minutes</span>
                        </div>
                        <div style={{ background: "rgba(0,0,0,0.3)", padding: "12px 20px", borderRadius: "12px", minWidth: "80px" }}>
                            <div style={{ fontSize: "28px", fontWeight: "800" }}>{String(timeLeft.seconds).padStart(2, '0')}</div>
                            <span style={{ fontSize: "11px", textTransform: "uppercase", letterSpacing: "1px", color: "rgba(255,255,255,0.7)" }}>Seconds</span>
                        </div>
                    </div>
                </div>
            </div>

            {/* Promo Codes Bar */}
            <div style={{ background: "#ffffff", padding: "30px 0", borderBottom: "1px solid #e2e8f0" }}>
                <div className="container">
                    <div className="row">
                        <div className="col-12 col-6 mb-3">
                            <div style={{
                                border: "2px dashed #3b82f6",
                                borderRadius: "12px",
                                padding: "16px 20px",
                                display: "flex",
                                justifyContent: "space-between",
                                alignItems: "center",
                                background: "#eff6ff"
                            }}>
                                <div>
                                    <span style={{ fontSize: "11px", fontWeight: "700", color: "#2563eb", textTransform: "uppercase" }}>FLAT $150 OFF</span>
                                    <h4 style={{ fontSize: "18px", fontWeight: "800", color: "#1e3a8a", margin: "2px 0 0" }}>WANDER150</h4>
                                    <span style={{ fontSize: "12px", color: "#64748b" }}>On packages above $800</span>
                                </div>
                                <button onClick={() => copyPromoCode("WANDER150")} className="btn btn-primary btn-sm" style={{ fontWeight: "700" }}>
                                    Copy Code
                                </button>
                            </div>
                        </div>

                        <div className="col-12 col-6 mb-3">
                            <div style={{
                                border: "2px dashed #10b981",
                                borderRadius: "12px",
                                padding: "16px 20px",
                                display: "flex",
                                justifyContent: "space-between",
                                alignItems: "center",
                                background: "#ecfdf5"
                            }}>
                                <div>
                                    <span style={{ fontSize: "11px", fontWeight: "700", color: "#059669", textTransform: "uppercase" }}>EARLY BIRD 25% OFF</span>
                                    <h4 style={{ fontSize: "18px", fontWeight: "800", color: "#065f46", margin: "2px 0 0" }}>EARLYBIRD25</h4>
                                    <span style={{ fontSize: "12px", color: "#64748b" }}>On next season bookings</span>
                                </div>
                                <button onClick={() => copyPromoCode("EARLYBIRD25")} className="btn btn-primary btn-sm" style={{ background: "#059669", borderColor: "#059669", fontWeight: "700" }}>
                                    Copy Code
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Deals Grid */}
            <div style={{ padding: "60px 0", background: "#f8fafc" }}>
                <div className="container">
                    <h2 style={{ fontSize: "24px", fontWeight: "800", color: "#0f172a", marginBottom: "24px" }}>
                        Featured Discounted Packages
                    </h2>

                    <div className="row">
                        {dealsPackages.map((pkg) => (
                            <div className="col-12 col-6 col-3 mb-4" key={pkg.id}>
                                <div style={{
                                    background: "#ffffff",
                                    borderRadius: "16px",
                                    border: "1px solid #e2e8f0",
                                    overflow: "hidden",
                                    boxShadow: "0 4px 15px rgba(0,0,0,0.03)",
                                    position: "relative"
                                }}>
                                    <div style={{ height: "180px", position: "relative" }}>
                                        <img src={pkg.featured_image} alt={pkg.title} style={{ width: "100%", height: "100%", objectFit: "cover" }} />
                                        <span style={{
                                            position: "absolute",
                                            top: "10px",
                                            left: "10px",
                                            background: "#ef4444",
                                            color: "#ffffff",
                                            padding: "4px 10px",
                                            borderRadius: "8px",
                                            fontSize: "12px",
                                            fontWeight: "800"
                                        }}>
                                            SAVE 30%
                                        </span>
                                    </div>

                                    <div style={{ padding: "16px" }}>
                                        <h3 style={{ fontSize: "16px", fontWeight: "700", color: "#0f172a", marginBottom: "8px" }}>{pkg.title}</h3>
                                        
                                        <div style={{ display: "flex", alignItems: "baseline", gap: "8px", marginBottom: "14px" }}>
                                            <span style={{ fontSize: "20px", fontWeight: "800", color: "#ef4444" }}>
                                                ${Math.round(pkg.price * 0.7)}
                                            </span>
                                            <span style={{ fontSize: "14px", textDecoration: "line-through", color: "#94a3b8" }}>
                                                ${pkg.price}
                                            </span>
                                        </div>

                                        <Link to="/packages" className="btn btn-primary w-100" style={{ borderRadius: "8px", fontWeight: "600", padding: "10px" }}>
                                            Claim Discount
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </>
    );
}

export default Deals;
