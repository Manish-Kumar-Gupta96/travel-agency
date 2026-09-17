import { useState } from "react";
import { Helmet } from "react-helmet-async";
import { FiChevronDown, FiChevronUp, FiSearch, FiHelpCircle, FiPhone, FiMail } from "react-icons/fi";
import { Link } from "react-router-dom";

function Faq() {
    const [searchTerm, setSearchTerm] = useState("");
    const [openIndex, setOpenIndex] = useState(0);
    const [activeTab, setActiveTab] = useState("all");

    const faqs = [
        {
            category: "booking",
            question: "How do I book a tour package through Travel ERP?",
            answer: "Booking a tour is fast and secure. Simply browse our 'Tour Packages' or 'Destinations' page, select your preferred itinerary, click 'Book Now', fill in your travel dates and passenger details, and confirm your reservation. You'll instantly receive an email voucher with your full itinerary."
        },
        {
            category: "payment",
            question: "What payment methods are supported?",
            answer: "We support major Credit/Debit Cards (Visa, MasterCard, American Express), PayPal, Apple Pay, Google Pay, and direct Bank Wire Transfers. All transactions are protected by 256-bit SSL encryption."
        },
        {
            category: "cancellation",
            question: "What is your cancellation and refund policy?",
            answer: "We offer 100% full refunds on cancellations made at least 14 days before your departure date. Cancellations made between 7 to 13 days prior are eligible for a 50% refund or full travel credit for future tours."
        },
        {
            category: "visa",
            question: "Do you provide visa assistance for international tours?",
            answer: "Yes! Our concierge visa team provides complete documentation guidance, official invitation letters, and appointment scheduling support for countries like Switzerland (Schengen), Japan, Indonesia, Maldives, and India."
        },
        {
            category: "customization",
            question: "Can I customize an existing package or add private excursions?",
            answer: "Absolutely! You can customize any itinerary—add extra nights, upgrade to 5-star ocean suites, or include private helicopter tours and private dining experiences. Just contact our 24/7 concierge team via our Contact page."
        },
        {
            category: "safety",
            question: "Is comprehensive travel insurance included in the package?",
            answer: "Basic emergency medical insurance is included in all our international luxury packages. You can also opt for our premium 'Comprehensive Protection Plan' during checkout for baggage loss, trip delays, and medical evacuation."
        }
    ];

    const filteredFaqs = faqs.filter(faq => {
        const matchesSearch = faq.question.toLowerCase().includes(searchTerm.toLowerCase()) ||
            faq.answer.toLowerCase().includes(searchTerm.toLowerCase());
        const matchesCategory = activeTab === "all" || faq.category === activeTab;
        return matchesSearch && matchesCategory;
    });

    return (
        <>
            <Helmet>
                <title>FAQ & Help Center | Travel ERP</title>
                <meta name="description" content="Find answers to common questions regarding bookings, payments, visas, refunds, and trip customization." />
            </Helmet>

            {/* Header */}
            <div style={{
                background: "linear-gradient(135deg, #1e3a8a, #0f172a)",
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
                        ❓ Help Center & Knowledge Base
                    </span>
                    <h1 style={{ fontSize: "36px", fontWeight: "800", marginBottom: "12px" }}>
                        Frequently Asked Questions
                    </h1>
                    <p style={{ color: "rgba(255,255,255,0.8)", fontSize: "16px", maxWidth: "600px", margin: "0 auto 30px" }}>
                        Have questions about your itinerary, visa, payments, or booking policies? We've got you covered.
                    </p>

                    {/* Search FAQ */}
                    <div style={{
                        maxWidth: "550px",
                        margin: "0 auto",
                        background: "#ffffff",
                        borderRadius: "12px",
                        padding: "8px 16px",
                        display: "flex",
                        alignItems: "center",
                        gap: "10px",
                        boxShadow: "0 10px 25px rgba(0,0,0,0.15)"
                    }}>
                        <FiSearch color="#3b82f6" size={18} />
                        <input
                            type="text"
                            placeholder="Type keywords like 'refund', 'visa', 'payment'..."
                            value={searchTerm}
                            onChange={(e) => setSearchTerm(e.target.value)}
                            style={{ border: "none", outline: "none", width: "100%", fontSize: "14px", color: "#1e293b" }}
                        />
                    </div>
                </div>
            </div>

            {/* Content Area */}
            <div style={{ padding: "60px 0", background: "#f8fafc" }}>
                <div className="container" style={{ maxWidth: "800px" }}>
                    {/* Category Filter */}
                    <div style={{ display: "flex", gap: "8px", justifyContent: "center", marginBottom: "35px", flexWrap: "wrap" }}>
                        {["all", "booking", "payment", "cancellation", "visa", "customization"].map((cat) => (
                            <button
                                key={cat}
                                onClick={() => setActiveTab(cat)}
                                style={{
                                    padding: "6px 14px",
                                    borderRadius: "16px",
                                    border: activeTab === cat ? "1px solid #2563eb" : "1px solid #cbd5e1",
                                    background: activeTab === cat ? "#2563eb" : "#ffffff",
                                    color: activeTab === cat ? "#ffffff" : "#475569",
                                    fontSize: "13px",
                                    fontWeight: "600",
                                    cursor: "pointer",
                                    textTransform: "capitalize"
                                }}
                            >
                                {cat}
                            </button>
                        ))}
                    </div>

                    {/* Accordion list */}
                    <div style={{ display: "flex", flexDirection: "column", gap: "12px" }}>
                        {filteredFaqs.map((faq, index) => {
                            const isOpen = openIndex === index;
                            return (
                                <div
                                    key={index}
                                    style={{
                                        background: "#ffffff",
                                        borderRadius: "12px",
                                        border: "1px solid #e2e8f0",
                                        overflow: "hidden",
                                        boxShadow: "0 2px 8px rgba(0,0,0,0.02)"
                                    }}
                                >
                                    <button
                                        onClick={() => setOpenIndex(isOpen ? -1 : index)}
                                        style={{
                                            width: "100%",
                                            textAlign: "left",
                                            padding: "18px 20px",
                                            background: "none",
                                            border: "none",
                                            display: "flex",
                                            justifyContent: "space-between",
                                            alignItems: "center",
                                            cursor: "pointer",
                                            fontSize: "16px",
                                            fontWeight: "700",
                                            color: isOpen ? "#2563eb" : "#0f172a"
                                        }}
                                    >
                                        <span>{faq.question}</span>
                                        {isOpen ? <FiChevronUp size={20} color="#2563eb" /> : <FiChevronDown size={20} color="#64748b" />}
                                    </button>

                                    {isOpen && (
                                        <div style={{
                                            padding: "0 20px 20px",
                                            fontSize: "14px",
                                            lineHeight: "1.7",
                                            color: "#475569",
                                            borderTop: "1px solid #f1f5f9",
                                            paddingTop: "14px"
                                        }}>
                                            {faq.answer}
                                        </div>
                                    )}
                                </div>
                            );
                        })}
                    </div>

                    {/* Support Box */}
                    <div style={{
                        marginTop: "50px",
                        background: "#eff6ff",
                        border: "1px solid #bfdbfe",
                        borderRadius: "16px",
                        padding: "30px",
                        textAlign: "center"
                    }}>
                        <h3 style={{ fontSize: "20px", fontWeight: "700", color: "#1e3a8a", marginBottom: "8px" }}>
                            Still have questions?
                        </h3>
                        <p style={{ fontSize: "14px", color: "#475569", marginBottom: "20px" }}>
                            Our expert travel concierge team is available 24/7 to assist you with custom quotes and bookings.
                        </p>
                        <div style={{ display: "flex", justifyContent: "center", gap: "12px", flexWrap: "wrap" }}>
                            <Link to="/contact" className="btn btn-primary" style={{ fontWeight: "600", padding: "10px 24px" }}>
                                Contact Support
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

export default Faq;
