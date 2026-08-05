import {

    Routes,

    Route

} from "react-router-dom";



import WebsiteLayout from "@/layouts/WebsiteLayout";

import AdminLayout from "@/layouts/AdminLayout";

import AuthLayout from "@/layouts/AuthLayout";


import Home from "@/pages/website/Home";
import Login from "@/pages/auth/Login";
import Register from "@/pages/auth/Register";
import ForgotPassword from "@/pages/auth/ForgotPassword";
import ResetPassword from "@/pages/auth/ResetPassword";
import OtpVerification from "@/pages/auth/OtpVerification";
import Dashboard from "@/pages/dashboard/Dashboard";

function AppRouter(){


    return (

        <Routes>


            {/* Website Routes */}

            <Route element={<WebsiteLayout />}>



                <Route

                    path="/"

                    element={<Home />}

                />


            </Route>



            {/* Auth Routes */}


            <Route element={<AuthLayout />}>


                <Route

                    path="/login"

                    element={<Login />}

                />


                <Route

                    path="/register"

                    element={<Register />}

                />


                <Route

                    path="/forgot-password"

                    element={<ForgotPassword />}

                />


                <Route

                    path="/reset-password"

                    element={<ResetPassword />}

                />


                <Route

                    path="/otp-verification"

                    element={<OtpVerification />}

                />


            </Route>



            {/* Admin Routes */}


            <Route element={<AdminLayout />}>


                <Route

                    path="/admin"

                    element={<Dashboard />}

                />


            </Route>



        </Routes>

    );


}



export default AppRouter;
