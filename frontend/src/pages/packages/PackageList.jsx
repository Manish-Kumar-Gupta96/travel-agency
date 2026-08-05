import { useState } from "react";
import { Helmet } from "react-helmet-async";
import { FiSearch, FiPlus, FiEdit, FiTrash, FiTag, FiClock } from "react-icons/fi";
import { mockTourPackages } from "@/constants/mockData";

function PackageList() {
    const [searchTerm, setSearchTerm] = useState("");
    const [categoryFilter, setCategoryFilter] = useState("All");
    const [packages, setPackages] = useState(mockTourPackages);

    const handleSearchAndFilter = (search, category) => {
        let filtered = mockTourPackages;

        if (search.trim() !== "") {
            filtered = filtered.filter(
                (p) =>
                    p.title.toLowerCase().includes(search.toLowerCase()) ||
                    p.category.toLowerCase().includes(search.toLowerCase())
            );
        }

        if (category !== "All") {
            filtered = filtered.filter((p) => p.category === category);
        }

        setPackages(filtered);
    };

    const categories = ["All", ...new Set(mockTourPackages.map((p) => p.category))];

    return (
        <>
            <Helmet>
                <title>Travel ERP | Packages Management</title>
            </Helmet>

            <div className="fade-in">
                {/* Header */}
                <div className="d-flex justify-between align-center mb-4">
                    <div>
                        <h2 className="text-2xl font-bold" style={{ color: "var(--gray-900)" }}>Tour Package Management</h2>
                        <p style={{ color: "var(--gray-500)", fontSize: "14px", marginTop: "4px" }}>
                            Create, customize, and manage active tour packages.
                        </p>
                    </div>
                    <button className="btn btn-primary">
                        <FiPlus size={16} />
                        <span>Add Package</span>
                    </button>
                </div>

                {/* Filters card */}
                <div className="card mb-4" style={{ padding: "15px" }}>
                    <div className="row">
                        <div className="col-12 col-6">
                            <div className="input-wrapper search-input w-100">
                                <FiSearch className="input-icon" />
                                <input
                                    type="text"
                                    className="form-control"
                                    placeholder="Search by package name..."
                                    value={searchTerm}
                                    onChange={(e) => {
                                        setSearchTerm(e.target.value);
                                        handleSearchAndFilter(e.target.value, categoryFilter);
                                    }}
                                />
                            </div>
                        </div>
                        <div className="col-12 col-6">
                            <div className="d-flex align-center gap-2">
                                <label className="form-label" style={{ marginBottom: 0, whiteSpace: "nowrap" }}>Category:</label>
                                <select
                                    className="form-select"
                                    value={categoryFilter}
                                    onChange={(e) => {
                                        setCategoryFilter(e.target.value);
                                        handleSearchAndFilter(searchTerm, e.target.value);
                                    }}
                                    style={{ maxWidth: "200px" }}
                                >
                                    {categories.map((c) => (
                                        <option key={c} value={c}>{c}</option>
                                    ))}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Grid list or Table */}
                <div className="row">
                    {packages.length > 0 ? (
                        packages.map((p) => (
                            <div className="col-12 col-6 col-3 mb-4" key={p.id}>
                                <div className="card h-100 p-0 overflow-hidden" style={{ display: "flex", flexDirection: "column", border: "1px solid var(--gray-200)", boxShadow: "var(--shadow-sm)" }}>
                                    <div style={{ position: "relative", height: "180px" }}>
                                        <img
                                            src={p.featured_image}
                                            alt={p.title}
                                            style={{ width: "100%", height: "100%", objectFit: "cover" }}
                                        />
                                        <span
                                            className="badge badge-primary"
                                            style={{ position: "absolute", top: "12px", left: "12px", zIndex: 1 }}
                                        >
                                            <FiTag className="mr-1" /> {p.category}
                                        </span>
                                    </div>
                                    <div style={{ padding: "20px", display: "flex", flexDirection: "column", flexGrow: 1, justifyContent: "space-between" }}>
                                        <div>
                                            <h4 className="font-bold text-lg mb-2" style={{ color: "var(--gray-900)", lineHeight: "1.3" }}>{p.title}</h4>
                                            <div className="d-flex align-center gap-2 text-sm mb-3" style={{ color: "var(--gray-500)" }}>
                                                <FiClock />
                                                <span>{p.duration}</span>
                                            </div>
                                            <p className="text-sm line-clamp mb-4" style={{ color: "var(--gray-600)" }}>{p.description}</p>
                                        </div>

                                        <div style={{ borderTop: "1px solid var(--gray-100)", paddingTop: "15px" }}>
                                            <div className="d-flex justify-between align-center mb-3">
                                                <div>
                                                    {p.discount_price > 0 ? (
                                                        <div className="d-flex align-center gap-2">
                                                            <span className="font-bold text-xl" style={{ color: "var(--primary-500)" }}>${p.discount_price}</span>
                                                            <span className="text-sm" style={{ textDecoration: "line-through", color: "var(--gray-400)" }}>${p.price}</span>
                                                        </div>
                                                    ) : (
                                                        <span className="font-bold text-xl" style={{ color: "var(--gray-900)" }}>${p.price}</span>
                                                    )}
                                                </div>
                                                <span className="badge badge-success">Active</span>
                                            </div>

                                            <div className="d-flex gap-2">
                                                <button className="btn btn-outline w-100 btn-sm">
                                                    <FiEdit size={14} /> <span>Edit</span>
                                                </button>
                                                <button className="btn btn-outline btn-sm" style={{ color: "var(--danger-500)" }}>
                                                    <FiTrash size={14} />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))
                    ) : (
                        <div className="col-12">
                            <div className="card text-center" style={{ padding: "40px", color: "var(--gray-400)" }}>
                                No tour packages found matching filters.
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </>
    );
}

export default PackageList;
