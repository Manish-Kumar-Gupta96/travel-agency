import { Routes, Route } from "react-router-dom";

import WebsiteLayout from "@/layouts/WebsiteLayout";
import AdminLayout from "@/layouts/AdminLayout";
import AuthLayout from "@/layouts/AuthLayout";

// Website Pages
import Home from "@/pages/website/Home";
import PublicPackages from "@/pages/website/Packages";
import PackageDetail from "@/pages/website/PackageDetail";
import PublicDestinations from "@/pages/website/Destinations";
import Hotels from "@/pages/website/Hotels";
import Flights from "@/pages/website/Flights";
import Deals from "@/pages/website/Deals";
import Reviews from "@/pages/website/Reviews";
import Faq from "@/pages/website/Faq";
import PublicAbout from "@/pages/website/About";
import PublicContact from "@/pages/website/Contact";

// Auth Pages
import Login from "@/pages/auth/Login";
import Register from "@/pages/auth/Register";
import ForgotPassword from "@/pages/auth/ForgotPassword";
import ResetPassword from "@/pages/auth/ResetPassword";
import OtpVerification from "@/pages/auth/OtpVerification";

// Admin Pages
import Dashboard from "@/pages/dashboard/Dashboard";
import CustomerList from "@/pages/customers/CustomerList";
import PackageList from "@/pages/packages/PackageList";
import BookingList from "@/pages/bookings/BookingList";

function AppRouter() {
    return (
        <Routes>
            {/* Website Routes */}
            <Route element={<WebsiteLayout />}>
                <Route path="/" element={<Home />} />
                <Route path="/packages" element={<PublicPackages />} />
                <Route path="/packages/:id" element={<PackageDetail />} />
                <Route path="/destinations" element={<PublicDestinations />} />
                <Route path="/hotels" element={<Hotels />} />
                <Route path="/flights" element={<Flights />} />
                <Route path="/deals" element={<Deals />} />
                <Route path="/reviews" element={<Reviews />} />
                <Route path="/faq" element={<Faq />} />
                <Route path="/about" element={<PublicAbout />} />
                <Route path="/contact" element={<PublicContact />} />
            </Route>

            {/* Auth Routes */}
            <Route element={<AuthLayout />}>
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
                <Route path="/forgot-password" element={<ForgotPassword />} />
                <Route path="/reset-password" element={<ResetPassword />} />
                <Route path="/otp-verification" element={<OtpVerification />} />
            </Route>

            {/* Admin Routes */}
            <Route element={<AdminLayout />}>
                <Route path="/admin" element={<Dashboard />} />
                <Route path="/admin/customers" element={<CustomerList />} />
                <Route path="/admin/packages" element={<PackageList />} />
                <Route path="/admin/bookings" element={<BookingList />} />
            </Route>
        </Routes>
    );
}

export default AppRouter;
