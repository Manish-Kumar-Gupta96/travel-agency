import { useState } from "react";
import { Helmet } from "react-helmet-async";
import { FiSearch, FiPlus, FiCheckCircle, FiClock, FiXCircle } from "react-icons/fi";
import { mockBookings, getBookingDetails } from "@/constants/mockData";

function BookingList() {
    const [searchTerm, setSearchTerm] = useState("");
    const [statusFilter, setStatusFilter] = useState("All");

    const resolvedBookings = mockBookings.map((b) => {
        const details = getBookingDetails(b.id);
        return {
            ...b,
            customerName: details ? `${details.customer.first_name} ${details.customer.last_name}` : "Unknown Customer",
            email: details ? details.customer.email : "",
            packageName: details ? details.package.title : "Custom Tour"
        };
    });

    const [bookings, setBookings] = useState(resolvedBookings);

    const handleSearchAndFilter = (search, status) => {
        let filtered = resolvedBookings;

        if (search.trim() !== "") {
            filtered = filtered.filter(
                (b) =>
                    b.booking_number.toLowerCase().includes(search.toLowerCase()) ||
                    b.customerName.toLowerCase().includes(search.toLowerCase()) ||
                    b.packageName.toLowerCase().includes(search.toLowerCase())
            );
        }

        if (status !== "All") {
            filtered = filtered.filter((b) => b.booking_status === status.toLowerCase());
        }

        setBookings(filtered);
    };

    const getBookingStatusBadge = (status) => {
        switch (status) {
            case "confirmed":
                return <span className="badge badge-success"><FiCheckCircle className="mr-1" /> Confirmed</span>;
            case "pending":
                return <span className="badge badge-warning"><FiClock className="mr-1" /> Pending</span>;
            case "cancelled":
                return <span className="badge badge-danger"><FiXCircle className="mr-1" /> Cancelled</span>;
            default:
                return <span className="badge badge-primary">{status}</span>;
        }
    };

    const getPaymentStatusBadge = (status) => {
        switch (status) {
            case "completed":
                return <span style={{ color: "var(--success-500)", fontWeight: "600", fontSize: "13px" }}>● Paid</span>;
            case "pending":
                return <span style={{ color: "var(--warning-500)", fontWeight: "600", fontSize: "13px" }}>● Pending</span>;
            case "failed":
                return <span style={{ color: "var(--danger-500)", fontWeight: "600", fontSize: "13px" }}>● Failed</span>;
            default:
                return <span style={{ color: "var(--gray-500)", fontSize: "13px" }}>● {status}</span>;
        }
    };

    return (
        <>
            <Helmet>
                <title>Travel ERP | Bookings Manager</title>
            </Helmet>

            <div className="fade-in">
                {/* Header */}
                <div className="d-flex justify-between align-center mb-4">
                    <div>
                        <h2 className="text-2xl font-bold" style={{ color: "var(--gray-900)" }}>Booking Management</h2>
                        <p style={{ color: "var(--gray-500)", fontSize: "14px", marginTop: "4px" }}>
                            Track customer tour reservations, payments, and schedules.
                        </p>
                    </div>
                    <button className="btn btn-primary">
                        <FiPlus size={16} />
                        <span>Create Booking</span>
                    </button>
                </div>

                {/* Search and Filters */}
                <div className="card mb-4" style={{ padding: "15px" }}>
                    <div className="row">
                        <div className="col-12 col-6">
                            <div className="input-wrapper search-input w-100">
                                <FiSearch className="input-icon" />
                                <input
                                    type="text"
                                    className="form-control"
                                    placeholder="Search by ID, customer, or package..."
                                    value={searchTerm}
                                    onChange={(e) => {
                                        setSearchTerm(e.target.value);
                                        handleSearchAndFilter(e.target.value, statusFilter);
                                    }}
                                />
                            </div>
                        </div>
                        <div className="col-12 col-6">
                            <div className="d-flex align-center gap-2">
                                <label className="form-label" style={{ marginBottom: 0, whiteSpace: "nowrap" }}>Status:</label>
                                <select
                                    className="form-select"
                                    value={statusFilter}
                                    onChange={(e) => {
                                        setStatusFilter(e.target.value);
                                        handleSearchAndFilter(searchTerm, e.target.value);
                                    }}
                                    style={{ maxWidth: "200px" }}
                                >
                                    <option value="All">All Statuses</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Table */}
                <div className="card">
                    <div className="table-wrapper">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Customer</th>
                                    <th>Package</th>
                                    <th>Travel Date</th>
                                    <th style={{ textAlign: "center" }}>Persons</th>
                                    <th>Final Amount</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                {bookings.length > 0 ? (
                                    bookings.map((b) => (
                                        <tr key={b.id}>
                                            <td className="font-semibold" style={{ color: "var(--gray-900)" }}>{b.booking_number}</td>
                                            <td>
                                                <div className="d-flex flex-column">
                                                    <span className="font-semibold text-sm">{b.customerName}</span>
                                                    <span className="text-xs" style={{ color: "var(--gray-400)" }}>{b.email}</span>
                                                </div>
                                            </td>
                                            <td className="text-sm">{b.packageName}</td>
                                            <td>{new Date(b.travel_date).toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" })}</td>
                                            <td style={{ textAlign: "center" }}>{b.persons}</td>
                                            <td className="font-bold text-sm" style={{ color: "var(--gray-900)" }}>${b.final_amount.toLocaleString()}</td>
                                            <td>{getPaymentStatusBadge(b.payment_status)}</td>
                                            <td>{getBookingStatusBadge(b.booking_status)}</td>
                                            <td className="text-xs" style={{ color: "var(--gray-500)", maxWidth: "200px", overflow: "hidden", textOverflow: "ellipsis", whiteSpace: "nowrap" }} title={b.notes}>
                                                {b.notes}
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="9" className="text-center" style={{ padding: "30px", color: "var(--gray-400)" }}>
                                            No bookings found matching filters.
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

export default BookingList;
