import { useState } from "react";
import { Helmet } from "react-helmet-async";
import { FiStar, FiCheckCircle, FiThumbsUp, FiMessageSquare } from "react-icons/fi";
import { mockCustomers } from "@/constants/mockData";

function Reviews() {
    const [filterCategory, setFilterCategory] = useState("all");

    const reviewsData = [
        {
            id: 1,
            name: "Sarah Jenkins",
            avatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330",
            location: "San Francisco, USA",
            tour: "Bali Getaway Special",
            rating: 5,
            date: "2 weeks ago",
            category: "couples",
            title: "Unforgettable Honeymoon in Bali! 🌺",
            review: "Travel ERP organized our honeymoon seamlessly. From our private pool villa to the guided temple tours and airport transfers, everything was executed flawlessly. Will definitely book again!",
            verified: true,
            likes: 24
        },
        {
            id: 2,
            name: "Marcus Aurelius",
            avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d",
            location: "London, UK",
            tour: "Swiss Alps Mountain Retreat",
            rating: 5,
            date: "1 month ago",
            category: "adventure",
            title: "Breathtaking Alps Ski Experience! 🎿",
            review: "The ski resort recommendations and mountain train passes arranged through the portal saved us hours of queueing. The views in Interlaken were out of this world.",
            verified: true,
            likes: 19
        },
        {
            id: 3,
            name: "Aiko Tanaka",
            avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb",
            location: "Sydney, Australia",
            tour: "Maldives Luxury Overwater Villa",
            rating: 5,
            date: "3 weeks ago",
            category: "luxury",
            title: "Pure Paradise & World Class Service 🌊",
            review: "Watching marine life right from the glass floor of our overwater bungalow was magical. Customer support was available 24/7 on WhatsApp for all our dining reservations.",
            verified: true,
            likes: 38
        },
        {
            id: 4,
            name: "Vikram Mehta",
            avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e",
            location: "Mumbai, India",
            tour: "Royal Rajasthan Heritage Tour",
            rating: 5,
            date: "Last month",
            category: "family",
            title: "Royal Treatment in Jaipur and Udaipur 🏰",
            review: "Our family loved every single fort and palace visit. Our private chauffeur and local historian guide were polite and highly knowledgeable.",
            verified: true,
            likes: 15
        }
    ];

    const filteredReviews = filterCategory === "all"
        ? reviewsData
        : reviewsData.filter(r => r.category === filterCategory);

    return (
        <>
            <Helmet>
                <title>Verified Traveler Reviews & Stories | Travel ERP</title>
                <meta name="description" content="Read real reviews, ratings and travel stories from verified guests across the world." />
            </Helmet>

            {/* Header */}
            <div style={{
                background: "linear-gradient(135deg, #0f172a, #1e293b)",
                padding: "60px 0",
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
                        marginBottom: "12px"
                    }}>
                        ⭐ 4.9/5 Overall Guest Satisfaction
                    </span>
                    <h1 style={{ fontSize: "36px", fontWeight: "800", marginBottom: "12px" }}>
                        Traveler Stories & Reviews
                    </h1>
                    <p style={{ color: "rgba(255,255,255,0.8)", fontSize: "16px", maxWidth: "600px", margin: "0 auto" }}>
                        See what over 10,000 happy travelers have to say about their vacations and ERP services.
                    </p>
                </div>
            </div>

            {/* Scorecard Overview */}
            <div style={{ background: "#ffffff", padding: "30px 0", borderBottom: "1px solid #e2e8f0" }}>
                <div className="container">
                    <div style={{
                        display: "flex",
                        justifyContent: "space-around",
                        alignItems: "center",
                        flexWrap: "wrap",
                        gap: "20px",
                        textAlign: "center"
                    }}>
                        <div>
                            <div style={{ fontSize: "38px", fontWeight: "900", color: "#2563eb" }}>4.92</div>
                            <div style={{ display: "flex", justifyContent: "center", gap: "2px", color: "#eab308", margin: "4px 0" }}>
                                {[1,2,3,4,5].map(i => <FiStar key={i} fill="#eab308" />)}
                            </div>
                            <span style={{ fontSize: "13px", color: "#64748b" }}>Based on 1,420+ Verified Reviews</span>
                        </div>

                        <div style={{ minWidth: "220px", textAlign: "left" }}>
                            <div style={{ display: "flex", alignItems: "center", gap: "10px", marginBottom: "6px" }}>
                                <span style={{ fontSize: "12px", width: "70px", color: "#64748b" }}>5 Stars</span>
                                <div style={{ flex: "1", height: "8px", background: "#e2e8f0", borderRadius: "4px", overflow: "hidden" }}>
                                    <div style={{ width: "92%", height: "100%", background: "#eab308" }} />
                                </div>
                                <span style={{ fontSize: "12px", fontWeight: "700", width: "30px" }}>92%</span>
                            </div>
                            <div style={{ display: "flex", alignItems: "center", gap: "10px" }}>
                                <span style={{ fontSize: "12px", width: "70px", color: "#64748b" }}>4 Stars</span>
                                <div style={{ flex: "1", height: "8px", background: "#e2e8f0", borderRadius: "4px", overflow: "hidden" }}>
                                    <div style={{ width: "7%", height: "100%", background: "#eab308" }} />
                                </div>
                                <span style={{ fontSize: "12px", fontWeight: "700", width: "30px" }}>7%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Filter Pills & Review Cards */}
            <div style={{ padding: "50px 0", background: "#f8fafc" }}>
                <div className="container">
                    <div style={{ display: "flex", gap: "10px", justifyContent: "center", marginBottom: "35px", flexWrap: "wrap" }}>
                        {["all", "couples", "adventure", "luxury", "family"].map((cat) => (
                            <button
                                key={cat}
                                onClick={() => setFilterCategory(cat)}
                                style={{
                                    padding: "8px 18px",
                                    borderRadius: "20px",
                                    border: filterCategory === cat ? "1px solid #2563eb" : "1px solid #cbd5e1",
                                    background: filterCategory === cat ? "#2563eb" : "#ffffff",
                                    color: filterCategory === cat ? "#ffffff" : "#475569",
                                    fontSize: "13px",
                                    fontWeight: "600",
                                    cursor: "pointer",
                                    textTransform: "capitalize"
                                }}
                            >
                                {cat === "all" ? "All Reviews" : cat}
                            </button>
                        ))}
                    </div>

                    <div className="row">
                        {filteredReviews.map((rev) => (
                            <div className="col-12 col-6 mb-4" key={rev.id}>
                                <div style={{
                                    background: "#ffffff",
                                    borderRadius: "16px",
                                    padding: "24px",
                                    border: "1px solid #e2e8f0",
                                    boxShadow: "0 4px 15px rgba(0,0,0,0.03)",
                                    height: "100%",
                                    display: "flex",
                                    flexDirection: "column"
                                }}>
                                    <div style={{ display: "flex", justifyContent: "space-between", alignItems: "flex-start", marginBottom: "16px" }}>
                                        <div style={{ display: "flex", alignItems: "center", gap: "12px" }}>
                                            <img
                                                src={rev.avatar}
                                                alt={rev.name}
                                                style={{ width: "48px", height: "48px", borderRadius: "50%", objectFit: "cover" }}
                                            />
                                            <div>
                                                <h4 style={{ fontSize: "16px", fontWeight: "700", color: "#0f172a", margin: "0", display: "flex", alignItems: "center", gap: "6px" }}>
                                                    {rev.name}
                                                    {rev.verified && <FiCheckCircle color="#16a34a" size={14} title="Verified Traveler" />}
                                                </h4>
                                                <span style={{ fontSize: "12px", color: "#64748b" }}>{rev.location} • {rev.date}</span>
                                            </div>
                                        </div>

                                        <div style={{ display: "flex", color: "#eab308" }}>
                                            {[...Array(rev.rating)].map((_, i) => (
                                                <FiStar key={i} fill="#eab308" size={14} />
                                            ))}
                                        </div>
                                    </div>

                                    <span style={{
                                        display: "inline-block",
                                        padding: "3px 10px",
                                        background: "#eff6ff",
                                        color: "#2563eb",
                                        borderRadius: "6px",
                                        fontSize: "12px",
                                        fontWeight: "600",
                                        marginBottom: "12px",
                                        alignSelf: "flex-start"
                                    }}>
                                        Tour: {rev.tour}
                                    </span>

                                    <h5 style={{ fontSize: "16px", fontWeight: "700", color: "#1e293b", marginBottom: "8px" }}>
                                        {rev.title}
                                    </h5>

                                    <p style={{ fontSize: "14px", color: "#475569", lineHeight: "1.6", marginBottom: "16px", flex: "1" }}>
                                        "{rev.review}"
                                    </p>

                                    <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", borderTop: "1px solid #f1f5f9", paddingTop: "12px" }}>
                                        <span style={{ fontSize: "12px", color: "#94a3b8" }}>Was this helpful?</span>
                                        <button style={{
                                            background: "none",
                                            border: "1px solid #e2e8f0",
                                            borderRadius: "6px",
                                            padding: "4px 10px",
                                            fontSize: "12px",
                                            color: "#475569",
                                            cursor: "pointer",
                                            display: "flex",
                                            alignItems: "center",
                                            gap: "4px"
                                        }}>
                                            <FiThumbsUp size={12} /> {rev.likes}
                                        </button>
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

export default Reviews;
