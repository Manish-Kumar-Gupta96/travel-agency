import React from "react";
import { Routes, Route } from "react-router-dom";

import MainLayout from "@layouts/MainLayout";

// Page Imports
import Home from "@pages/Home/Home";
import About from "@pages/About/About";
import Destinations from "@pages/Destinations/Destinations";
import DestinationDetails from "@pages/DestinationDetails/DestinationDetails";
import Packages from "@pages/Packages/Packages";
import PackageDetails from "@pages/PackageDetails/PackageDetails";
import Services from "@pages/Services/Services";
import Booking from "@pages/Booking/Booking";
import Contact from "@pages/Contact/Contact";
import Gallery from "@pages/Gallery/Gallery";
import FAQ from "@pages/FAQ/FAQ";
import Testimonials from "@pages/Testimonials/Testimonials";
import Blog from "@pages/Blog/Blog";
import BlogDetails from "@pages/BlogDetails/BlogDetails";

import Careers from "@pages/Company/Careers";
import PressMedia from "@pages/Company/PressMedia";
import Partners from "@pages/Company/Partners";
import Sustainability from "@pages/Company/Sustainability";
import Franchise from "@pages/Company/Franchise";
import MobileApp from "@pages/Company/MobileApp";
import Developers from "@pages/Company/Developers";

import Login from "@pages/Auth/Login";
import Register from "@pages/Auth/Register";
import ForgotPassword from "@pages/Auth/ForgotPassword";

import Account from "@pages/Customer/Account";
import CustomerCRM from "@pages/Customer/CustomerCRM";
import TravelCRM from "@pages/Customer/TravelCRM";
import Referral from "@pages/Customer/Referral";
import Rewards from "@pages/Customer/Rewards";
import PhotoContest from "@pages/Customer/PhotoContest";

import Dashboard from "@pages/Admin/Dashboard";
import Analytics from "@pages/Admin/Analytics";
import BookingManagement from "@pages/Admin/BookingManagement";
import AgentPortal from "@pages/Admin/AgentPortal";

import Emergency from "@pages/Emergency/Emergency";
import Community from "@pages/Community/Community";
import NotFound from "@pages/NotFound/NotFound";

function AppRoutes() {
  return (
    <Routes>
      <Route element={<MainLayout />}>
        {/* Core Pages */}
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/destinations" element={<Destinations />} />
        <Route path="/destination-details" element={<DestinationDetails />} />
        <Route path="/packages" element={<Packages />} />
        <Route path="/package-details" element={<PackageDetails />} />
        <Route path="/services" element={<Services />} />
        <Route path="/booking" element={<Booking />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/gallery" element={<Gallery />} />
        <Route path="/faq" element={<FAQ />} />
        <Route path="/testimonials" element={<Testimonials />} />
        <Route path="/blog" element={<Blog />} />
        <Route path="/blog-details" element={<BlogDetails />} />

        {/* Company Pages */}
        <Route path="/careers" element={<Careers />} />
        <Route path="/press-media" element={<PressMedia />} />
        <Route path="/partners" element={<Partners />} />
        <Route path="/sustainability" element={<Sustainability />} />
        <Route path="/franchise" element={<Franchise />} />
        <Route path="/mobile-app" element={<MobileApp />} />
        <Route path="/developers" element={<Developers />} />

        {/* Auth Pages */}
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/forgot-password" element={<ForgotPassword />} />

        {/* Customer & Rewards Pages */}
        <Route path="/customer-account" element={<Account />} />
        <Route path="/customer-crm" element={<CustomerCRM />} />
        <Route path="/travel-crm" element={<TravelCRM />} />
        <Route path="/travel-referral" element={<Referral />} />
        <Route path="/travel-rewards" element={<Rewards />} />
        <Route path="/photo-contest" element={<PhotoContest />} />

        {/* Admin Dashboard Pages */}
        <Route path="/admin-dashboard" element={<Dashboard />} />
        <Route path="/analytics-dashboard" element={<Analytics />} />
        <Route path="/booking-management" element={<BookingManagement />} />
        <Route path="/travel-agent-portal" element={<AgentPortal />} />

        {/* Other Pages */}
        <Route path="/emergency-assistance" element={<Emergency />} />
        <Route path="/community-forum" element={<Community />} />
      </Route>

      {/* Fallback route */}
      <Route path="*" element={<NotFound />} />
    </Routes>
  );
}

export default AppRoutes;
