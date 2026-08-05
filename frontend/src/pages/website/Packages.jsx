import { Helmet } from "react-helmet-async";
import { FiClock, FiUsers, FiArrowRight } from "react-icons/fi";
import { Link } from "react-router-dom";
import { mockTourPackages } from "@/constants/mockData";

function PublicPackages() {
    return (
        <>
            <Helmet>
                <title>Explore Packages | Travel Agency</title>
            </Helmet>

            <div className="fade-in" style={{ padding: "40px 0" }}>
                <div className="container">
                    {/* Header */}
                    <div className="text-center mb-5">
                        <h2 className="text-3xl font-bold mb-3" style={{ color: "var(--gray-900)" }}>Our Popular Tour Packages</h2>
                        <p style={{ color: "var(--gray-500)", maxWidth: "600px", margin: "0 auto" }}>
                            Discover handpicked travel itineraries designed to give you an unforgettable experience.
                        </p>
                    </div>

                    {/* Grid */}
                    <div className="row">
                        {mockTourPackages.map((p) => (
                            <div className="col-12 col-6 col-4 mb-4" key={p.id}>
                                <div className="card p-0 overflow-hidden" style={{ border: "1px solid var(--gray-200)", borderRadius: "8px" }}>
                                    <div style={{ height: "240px", position: "relative" }}>
                                        <img
                                            src={p.featured_image}
                                            alt={p.title}
                                            style={{ width: "100%", height: "100%", objectFit: "cover" }}
                                        />
                                    </div>
                                    <div style={{ padding: "20px" }}>
                                        <span className="badge badge-primary mb-2">{p.category}</span>
                                        <h3 className="font-bold text-xl mb-2" style={{ color: "var(--gray-900)" }}>{p.title}</h3>
                                        <p className="text-sm mb-4" style={{ color: "var(--gray-500)", lineClamp: 2 }}>{p.description}</p>
                                        
                                        <div className="d-flex align-center justify-between mb-4 text-xs" style={{ color: "var(--gray-500)" }}>
                                            <span className="d-flex align-center gap-1"><FiClock /> {p.duration}</span>
                                            <span className="d-flex align-center gap-1"><FiUsers /> Max {p.max_people} Pax</span>
                                        </div>

                                        <div className="d-flex justify-between align-center" style={{ borderTop: "1px solid var(--gray-100)", paddingTop: "15px" }}>
                                            <div>
                                                <span className="text-xs" style={{ color: "var(--gray-400)" }}>Starting from</span>
                                                <div className="font-bold text-2xl" style={{ color: "var(--primary-500)" }}>
                                                    ${p.discount_price > 0 ? p.discount_price : p.price}
                                                </div>
                                            </div>
                                            <Link to={`/login`} className="btn btn-primary btn-sm">
                                                <span>Book Now</span>
                                                <FiArrowRight />
                                            </Link>
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

export default PublicPackages;
