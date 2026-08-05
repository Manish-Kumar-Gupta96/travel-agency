import { Helmet } from "react-helmet-async";
import { FiMapPin, FiCalendar, FiGlobe } from "react-icons/fi";
import { mockDestinations } from "@/constants/mockData";

function PublicDestinations() {
    return (
        <>
            <Helmet>
                <title>Top Destinations | Travel Agency</title>
            </Helmet>

            <div className="fade-in" style={{ padding: "40px 0" }}>
                <div className="container">
                    <div className="text-center mb-5">
                        <h2 className="text-3xl font-bold mb-3" style={{ color: "var(--gray-900)" }}>Top Travel Destinations</h2>
                        <p style={{ color: "var(--gray-500)", maxWidth: "600px", margin: "0 auto" }}>
                            Explore amazing cities and tropical lands around the world.
                        </p>
                    </div>

                    <div className="row">
                        {mockDestinations.map((d) => (
                            <div className="col-12 col-6 col-4 mb-4" key={d.id}>
                                <div className="card p-0 overflow-hidden" style={{ border: "1px solid var(--gray-200)", borderRadius: "8px" }}>
                                    <div style={{ height: "220px", position: "relative" }}>
                                        <img
                                            src={d.featured_image}
                                            alt={d.name}
                                            style={{ width: "100%", height: "100%", objectFit: "cover" }}
                                        />
                                        <div style={{ position: "absolute", bottom: "15px", left: "15px", zIndex: 1, color: "#fff", textShadow: "0 2px 4px rgba(0,0,0,0.6)" }}>
                                            <h3 className="font-bold text-2xl d-flex align-center gap-1">
                                                <FiMapPin size={18} />
                                                <span>{d.name}</span>
                                            </h3>
                                            <span className="text-sm font-semibold">{d.city}, {d.country}</span>
                                        </div>
                                    </div>
                                    <div style={{ padding: "20px" }}>
                                        <p className="text-sm mb-4" style={{ color: "var(--gray-600)" }}>{d.description}</p>
                                        
                                        <div style={{ borderTop: "1px solid var(--gray-100)", paddingTop: "15px" }} className="row">
                                            <div className="col-6 mb-2">
                                                <span className="text-xs" style={{ color: "var(--gray-400)" }}>Best Time:</span>
                                                <div className="text-xs font-semibold d-flex align-center gap-1 mt-1" style={{ color: "var(--gray-700)" }}>
                                                    <FiCalendar /> {d.best_time}
                                                </div>
                                            </div>
                                            <div className="col-6 mb-2">
                                                <span className="text-xs" style={{ color: "var(--gray-400)" }}>Languages:</span>
                                                <div className="text-xs font-semibold d-flex align-center gap-1 mt-1" style={{ color: "var(--gray-700)" }}>
                                                    <FiGlobe /> {d.language}
                                                </div>
                                            </div>
                                        </div>
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

export default PublicDestinations;
