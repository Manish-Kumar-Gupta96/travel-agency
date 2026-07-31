import { Routes, Route } from "react-router-dom";

import MainLayout from "@layouts/MainLayout";

import HomePage from "@pages/Home/HomePage";

import AboutPage from "@pages/About/AboutPage";

import ContactPage from "@pages/Contact/ContactPage";

import NotFoundPage from "@pages/NotFound/NotFoundPage";

function AppRoutes() {

    return (

        <Routes>

            <Route
                element={<MainLayout />}
            >

                <Route
                    path="/"
                    element={<HomePage />}
                />

                <Route
                    path="/about"
                    element={<AboutPage />}
                />

                <Route
                    path="/contact"
                    element={<ContactPage />}
                />

            </Route>

            <Route
                path="*"
                element={<NotFoundPage />}
            />

        </Routes>

    );

}

export default AppRoutes;
