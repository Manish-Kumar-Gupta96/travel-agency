import { useState } from "react";
import { Helmet } from "react-helmet-async";
import { FiSearch, FiPlus, FiEdit, FiTrash, FiCheckCircle, FiXCircle } from "react-icons/fi";
import { mockCustomers } from "@/constants/mockData";

function CustomerList() {
    const [searchTerm, setSearchTerm] = useState("");
    const [customers, setCustomers] = useState(mockCustomers);

    const handleSearch = (e) => {
        const value = e.target.value;
        setSearchTerm(value);
        if (value.trim() === "") {
            setCustomers(mockCustomers);
        } else {
            const filtered = mockCustomers.filter(
                (c) =>
                    `${c.first_name} ${c.last_name}`.toLowerCase().includes(value.toLowerCase()) ||
                    c.email.toLowerCase().includes(value.toLowerCase()) ||
                    c.passport.toLowerCase().includes(value.toLowerCase())
            );
            setCustomers(filtered);
        }
    };

    const getStatusBadge = (status) => {
        return status === "active" ? (
            <span className="badge badge-success"><FiCheckCircle className="mr-1" /> Active</span>
        ) : (
            <span className="badge badge-danger"><FiXCircle className="mr-1" /> Inactive</span>
        );
    };

    return (
        <>
            <Helmet>
                <title>Travel ERP | Customers CRM</title>
            </Helmet>

            <div className="fade-in">
                {/* Header */}
                <div className="d-flex justify-between align-center mb-4">
                    <div>
                        <h2 className="text-2xl font-bold" style={{ color: "var(--gray-900)" }}>Customer Management</h2>
                        <p style={{ color: "var(--gray-500)", fontSize: "14px", marginTop: "4px" }}>
                            View and manage registered clients and passport details.
                        </p>
                    </div>
                    <button className="btn btn-primary">
                        <FiPlus size={16} />
                        <span>Add Customer</span>
                    </button>
                </div>

                {/* Filters and Search */}
                <div className="card mb-4" style={{ padding: "15px" }}>
                    <div className="d-flex align-center justify-between gap-3">
                        <div className="input-wrapper search-input w-100">
                            <FiSearch className="input-icon" />
                            <input
                                type="text"
                                className="form-control"
                                placeholder="Search by name, email, or passport..."
                                value={searchTerm}
                                onChange={handleSearch}
                            />
                        </div>
                    </div>
                </div>

                {/* Table Card */}
                <div className="card">
                    <div className="table-wrapper">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Nationality</th>
                                    <th>Passport</th>
                                    <th>Verification</th>
                                    <th>Status</th>
                                    <th style={{ textAlign: "center" }}>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {customers.length > 0 ? (
                                    customers.map((c) => (
                                        <tr key={c.id}>
                                            <td className="font-semibold" style={{ color: "var(--gray-900)" }}>
                                                {c.first_name} {c.last_name}
                                            </td>
                                            <td>{c.email}</td>
                                            <td>{c.phone}</td>
                                            <td>{c.nationality}</td>
                                            <td><code style={{ background: "var(--gray-100)", padding: "2px 6px", borderRadius: "4px" }}>{c.passport}</code></td>
                                            <td>
                                                {c.passport_verified === 1 ? (
                                                    <span style={{ color: "var(--success-500)", fontSize: "13px", fontWeight: "600" }}>✓ Verified</span>
                                                ) : (
                                                    <span style={{ color: "var(--gray-400)", fontSize: "13px" }}>Unverified</span>
                                                )}
                                            </td>
                                            <td>{getStatusBadge(c.status)}</td>
                                            <td style={{ textAlign: "center" }}>
                                                <div className="d-flex justify-center gap-2">
                                                    <button className="btn btn-outline btn-sm" style={{ padding: "6px" }} title="Edit">
                                                        <FiEdit size={14} />
                                                    </button>
                                                    <button className="btn btn-outline btn-sm" style={{ padding: "6px", color: "var(--danger-500)" }} title="Delete">
                                                        <FiTrash size={14} />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="8" className="text-center" style={{ padding: "30px", color: "var(--gray-400)" }}>
                                            No customers found matching search criteria.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </>
    );
}

export default CustomerList;
