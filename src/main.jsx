import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
import { HelmetProvider } from "react-helmet-async";
import { Toaster } from "react-hot-toast";

import App from "./App";

import "@styles/base/reset.css";
import "@styles/base/variables.css";
import "@styles/base/globals.css";
import "@styles/base/typography.css";
import "@styles/base/animations.css";

ReactDOM.createRoot(document.getElementById("root")).render(

    <React.StrictMode>

        <HelmetProvider>

            <BrowserRouter>

                <App />

                <Toaster
                    position="top-right"
                    reverseOrder={false}
                />

            </BrowserRouter>

        </HelmetProvider>

    </React.StrictMode>

);
