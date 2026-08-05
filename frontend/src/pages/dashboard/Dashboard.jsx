import { motion } from "framer-motion";
import Chart from "react-apexcharts";
import { Helmet } from "react-helmet-async";
import { Link } from "react-router-dom";
import { 
    FiTrendingUp, 
    FiCompass, 
    FiUsers, 
    FiDollarSign, 
    FiCalendar, 
    FiArrowRight, 
    FiPlus, 
    FiEye, 
    FiClock, 
    FiCheckCircle, 
    FiXCircle 
} from "react-icons/fi";
import { 
    mockBookings, 
    mockPayments, 
    mockTourPackages, 
    mockCustomers, 
    getBookingDetails 
} from "@/constants/mockData";

function Dashboard() {
    // 1. Calculate dynamic statistics from the mock database
    const totalBookings = mockBookings.length;
    
    // Revenue is calculated from completed payments
    const totalRevenue = mockPayments
        .filter(p => p.payment_status === "completed")
        .reduce((sum, p) => sum + p.amount, 0);

    const activePackagesCount = mockTourPackages.filter(p => p.status === "active").length;
    const activeCustomersCount = mockCustomers.filter(c => c.status === "active").length;

    // KPI Cards data
    const kpis = [
        {
            title: "Total Bookings",
            value: totalBookings.toLocaleString(),
            growth: "+12.5%",
            isPositive: true,
            icon: FiCalendar,
            color: "var(--primary-500)",
            bg: "rgba(37, 99, 235, 0.1)"
        },
        {
            title: "Revenue",
            value: `$${totalRevenue.toLocaleString()}`,
            growth: "+8.3%",
            isPositive: true,
            icon: FiDollarSign,
            color: "var(--success-500)",
            bg: "rgba(22, 163, 74, 0.1)"
        },
        {
            title: "Active Packages",
            value: activePackagesCount.toString(),
            growth: "+4.1%",
            isPositive: true,
            icon: FiCompass,
            color: "var(--secondary-500)",
            bg: "rgba(124, 58, 237, 0.1)"
        },
        {
            title: "Active Customers",
            value: activeCustomersCount.toString(),
            growth: "+6.8%",
            isPositive: true,
            icon: FiUsers,
            color: "var(--warning-500)",
            bg: "rgba(245, 158, 11, 0.1)"
        }
    ];

    // Chart 1: Revenue & Booking Trend (Line/Area) - Mocked based on payment records
    const trendChart = {
        series: [
            {
                name: "Revenue ($)",
                data: [15000, 22000, 18000, 31000, 29000, 42000, totalRevenue]
            },
            {
                name: "Bookings",
                data: [45, 60, 52, 90, 85, 110, totalBookings * 10] // scaled for visual trends
            }
        ],
        options: {
            chart: {
                height: 350,
                type: "area",
                toolbar: { show: false },
                fontFamily: "var(--font-primary)"
            },
            colors: ["#2563eb", "#7c3aed"],
            dataLabels: { enabled: false },
            stroke: { curve: "smooth", width: 2 },
            xaxis: {
                categories: ["Nov", "Dec", "Jan", "Feb", "Mar", "Apr", "May"],
                labels: { style: { colors: "var(--gray-500)" } }
            },
            yaxis: {
                labels: { style: { colors: "var(--gray-500)" } }
            },
            tooltip: { x: { format: "dd/MM/yy HH:mm" } },
            legend: {
                position: "top",
                horizontalAlign: "right",
                labels: { colors: "var(--gray-700)" }
            },
            grid: { borderColor: "var(--gray-200)" }
        }
    };

    // Chart 2: Package Category Bookings Share
    // Group count of packages by category dynamically
    const categoryCounts = mockTourPackages.reduce((acc, pkg) => {
        acc[pkg.category] = (acc[pkg.category] || 0) + 1;
        return acc;
    }, {});

    const categoryLabels = Object.keys(categoryCounts);
    const categorySeries = Object.values(categoryCounts);

    const categoryChart = {
        series: categorySeries,
        options: {
            chart: {
                type: "donut",
                fontFamily: "var(--font-primary)"
            },
            labels: categoryLabels,
            colors: ["#2563eb", "#10b981", "#f59e0b", "#ef4444"],
            legend: {
                position: "bottom",
                labels: { colors: "var(--gray-700)" }
            },
            dataLabels: { enabled: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: "70%",
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: "Categories",
                                formatter: () => categoryLabels.length
                            }
                        }
                    }
                }
            }
        }
    };

    // 2. Fetch recent bookings with resolved customer and package names (eager-loaded mock data)
    const recentBookings = mockBookings.slice(0, 4).map(b => {
        const details = getBookingDetails(b.id);
        return {
            id: b.booking_number,
            customer: details ? `${details.customer.first_name} ${details.customer.last_name}` : "Unknown",
            email: details ? details.customer.email : "",
            package: details ? details.package.title : "Custom Tour",
            amount: `$${b.final_amount.toLocaleString()}`,
            date: new Date(b.travel_date).toLocaleDateString("en-US", { month: "short", day: "numeric", year: "numeric" }),
            status: b.booking_status.charAt(0).toUpperCase() + b.booking_status.slice(1)
        };
    });

    const getStatusBadge = (status) => {
        switch (status) {
            case "Confirmed":
                return <span className="badge badge-success"><FiCheckCircle className="mr-1" /> Confirmed</span>;
            case "Pending":
                return <span className="badge badge-warning"><FiClock className="mr-1" /> Pending</span>;
            case "Cancelled":
                return <span className="badge badge-danger"><FiXCircle className="mr-1" /> Cancelled</span>;
            default:
                return <span className="badge badge-primary">{status}</span>;
        }
    };

    // 3. Dynamic Activity logs generated directly from recent actions in the mock database
    const liveActivities = mockBookings.slice(0, 4).map((b, idx) => {
        const details = getBookingDetails(b.id);
        const customerName = details ? `${details.customer.first_name} ${details.customer.last_name}` : "A customer";
        const packageName = details ? details.package.title : "Package";
        
        let activityText = "";
        let author = "";
        let time = "";

        if (b.booking_status === "confirmed") {
            activityText = `Booking ${b.booking_number} confirmed for ${customerName} to ${packageName}.`;
            author = "Operations";
            time = `${idx + 1} hr ago`;
        } else if (b.booking_status === "cancelled") {
            activityText = `Booking ${b.booking_number} for ${customerName} was cancelled.`;
            author = "CRM Service";
            time = `${idx * 2 + 3} hrs ago`;
        } else {
            activityText = `New booking request ${b.booking_number} received from ${customerName}.`;
            author = "Booking Engine";
            time = "Just now";
        }

        return {
            time,
            text: activityText,
            author
        };
    });

    return (
        <>
            <Helmet>
                <title>Travel ERP | Dashboard</title>
                <meta name="description" content="Manage and monitor bookings, package analytics, revenue streams, and customer metrics on the Travel ERP Admin Dashboard." />
            </Helmet>

            <div className="fade-in">
                {/* Header */}
                <div className="d-flex justify-between align-center mb-4">
                    <div>
                        <h2 className="text-2xl font-bold" style={{ color: "var(--gray-900)" }}>Dashboard Overview</h2>
                        <p style={{ color: "var(--gray-500)", fontSize: "14px", marginTop: "4px" }}>
                            Real-time statistics and updates of your travel agency.
                        </p>
                    </div>
                    <Link to="/admin/bookings" className="btn btn-primary">
                        <FiPlus size={16} />
                        <span>Create Booking</span>
                    </Link>
                </div>

                {/* KPI Cards Grid */}
                <div className="row mb-4">
                    {kpis.map((kpi, idx) => (
                        <div className="col-12 col-6 col-3 mb-3" key={idx}>
                            <motion.div
                                className="card"
                                initial={{ opacity: 0, y: 15 }}
                                animate={{ opacity: 1, y: 0 }}
                                transition={{ duration: 0.3, delay: idx * 0.1 }}
                                whileHover={{ y: -5, boxShadow: "var(--shadow-lg)" }}
                                style={{ height: "100%", display: "flex", flexDirection: "column", justifyContent: "space-between" }}
                            >
                                <div className="d-flex justify-between align-center mb-3">
                                    <span className="font-semibold text-sm" style={{ color: "var(--gray-500)" }}>
                                        {kpi.title}
                                    </span>
                                    <div className="d-flex align-center justify-center rounded" style={{
                                        width: "40px",
                                        height: "40px",
                                        backgroundColor: kpi.bg,
                                        color: kpi.color
                                    }}>
                                        <kpi.icon size={20} />
                                    </div>
                                </div>
                                <div>
                                    <h3 className="text-2xl font-bold mb-2" style={{ color: "var(--gray-900)" }}>
                                        {kpi.value}
                                    </h3>
                                    <div className="d-flex align-center gap-1">
                                        <FiTrendingUp style={{
                                            color: kpi.isPositive ? "var(--success-500)" : "var(--danger-500)",
                                            transform: kpi.isPositive ? "none" : "rotate(180deg)"
                                        }} />
                                        <span className="text-xs font-bold" style={{
                                            color: kpi.isPositive ? "var(--success-500)" : "var(--danger-500)"
                                        }}>
                                            {kpi.growth}
                                        </span>
                                        <span className="text-xs" style={{ color: "var(--gray-400)" }}>vs last month</span>
                                    </div>
                                </div>
                            </motion.div>
                        </div>
                    ))}
                </div>

                {/* Charts Section */}
                <div className="row mb-4">
                    <div className="col-12 col-6 mb-4">
                        <div className="card h-100">
                            <div className="card-header">
                                <h4 className="card-title">Booking & Revenue Trends</h4>
                                <span style={{ fontSize: "13px", color: "var(--gray-400)" }}>Year-to-date data</span>
                            </div>
                            <div className="card-body">
                                <Chart 
                                    options={trendChart.options} 
                                    series={trendChart.series} 
                                    type="area" 
                                    height={320} 
                                />
                            </div>
                        </div>
                    </div>
                    <div className="col-12 col-6 mb-4">
                        <div className="card h-100">
                            <div className="card-header">
                                <h4 className="card-title">Top Booking Categories</h4>
                                <span style={{ fontSize: "13px", color: "var(--gray-400)" }}>Category share</span>
                            </div>
                            <div className="card-body d-flex align-center justify-center">
                                <div style={{ width: "100%", maxWidth: "340px", padding: "10px" }}>
                                    <Chart 
                                        options={categoryChart.options} 
                                        series={categoryChart.series} 
                                        type="donut" 
                                        width="100%" 
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Bottom Row: Recent Bookings & Activity Feed */}
                <div className="row">
                    {/* Recent Bookings */}
                    <div className="col-12 col-6 mb-4">
                        <div className="card h-100">
                            <div className="card-header">
                                <h4 className="card-title">Recent Bookings</h4>
                                <Link to="/admin/bookings" className="d-flex align-center gap-1 text-sm font-semibold" style={{ color: "var(--primary-500)" }}>
                                    <span>View All</span>
                                    <FiArrowRight size={14} />
                                </Link>
                            </div>
                            <div className="card-body p-0">
                                <div className="table-wrapper">
                                    <table className="table">
                                        <thead>
                                            <tr>
                                                <th>Booking ID</th>
                                                <th>Customer</th>
                                                <th>Package</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th style={{ textAlign: "center" }}>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {recentBookings.map((b, idx) => (
                                                <tr key={idx}>
                                                    <td className="font-semibold" style={{ color: "var(--gray-900)" }}>{b.id}</td>
                                                    <td>
                                                        <div className="d-flex flex-column">
                                                            <span className="font-semibold text-sm">{b.customer}</span>
                                                            <span className="text-xs" style={{ color: "var(--gray-400)" }}>{b.email}</span>
                                                        </div>
                                                    </td>
                                                    <td className="text-sm">{b.package}</td>
                                                    <td className="font-bold text-sm" style={{ color: "var(--gray-900)" }}>{b.amount}</td>
                                                    <td>{getStatusBadge(b.status)}</td>
                                                    <td style={{ textAlign: "center" }}>
                                                        <Link 
                                                            to={`/admin/bookings/${b.id}`}
                                                            className="btn btn-outline btn-sm"
                                                            style={{ padding: "6px", display: "inline-flex" }}
                                                            title="View Details"
                                                        >
                                                            <FiEye size={14} />
                                                        </Link>
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Quick Timeline Activity */}
                    <div className="col-12 col-6 mb-4">
                        <div className="card h-100">
                            <div className="card-header">
                                <h4 className="card-title">Live Booking Activity</h4>
                                <span style={{ fontSize: "13px", color: "var(--gray-400)" }}>Real-time updates</span>
                            </div>
                            <div className="card-body">
                                <div style={{ display: "flex", flexDirection: "column", gap: "20px" }}>
                                    {liveActivities.map((act, idx) => (
                                        <div key={idx} style={{ display: "flex", gap: "15px" }}>
                                            <div style={{
                                                position: "relative",
                                                display: "flex",
                                                flexDirection: "column",
                                                alignItems: "center"
                                            }}>
                                                <div style={{
                                                    width: "12px",
                                                    height: "12px",
                                                    borderRadius: "50%",
                                                    backgroundColor: "var(--primary-500)",
                                                    border: "3px solid #fff",
                                                    boxShadow: "0 0 0 2px var(--primary-500)",
                                                    zIndex: 2
                                                }} />
                                                {idx !== liveActivities.length - 1 && (
                                                    <div style={{
                                                        width: "2px",
                                                        flexGrow: 1,
                                                        backgroundColor: "var(--gray-200)",
                                                        marginTop: "4px",
                                                        marginBottom: "-20px",
                                                        zIndex: 1
                                                    }} />
                                                )}
                                            </div>
                                            <div style={{ display: "flex", flexDirection: "column", gap: "2px" }}>
                                                <span className="text-sm font-semibold" style={{ color: "var(--gray-800)" }}>
                                                    {act.text}
                                                </span>
                                                <div className="d-flex align-center gap-2">
                                                    <span className="text-xs" style={{ color: "var(--gray-400)" }}>{act.time}</span>
                                                    <span style={{ fontSize: "4px", color: "var(--gray-400)" }}>●</span>
                                                    <span className="text-xs font-medium" style={{ color: "var(--primary-500)" }}>{act.author}</span>
                                                </div>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

export default Dashboard;
