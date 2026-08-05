import { useState } from "react";
import { useForm } from "react-hook-form";
import { Link, useNavigate } from "react-router-dom";
import { motion } from "framer-motion";
import { FiMail, FiLock, FiEye, FiEyeOff, FiCompass, FiAlertCircle } from "react-icons/fi";
import { Helmet } from "react-helmet-async";
import { toast } from "react-toastify";

function Login() {
    const {
        register,
        handleSubmit,
        formState: { errors }
    } = useForm({
        defaultValues: {
            email: "",
            password: "",
            rememberMe: false
        }
    });

    const [showPassword, setShowPassword] = useState(false);
    const [isLoading, setIsLoading] = useState(false);
    const [serverError, setServerError] = useState("");
    const navigate = useNavigate();

    const onSubmit = async (data) => {
        setIsLoading(true);
        setServerError("");
        try {
            // Simulated login API request
            await new Promise((resolve, reject) => {
                setTimeout(() => {
                    if (data.email === "admin@travelerp.com" && (data.password === "admin123" || data.password === "password")) {
                        resolve();
                    } else {
                        reject(new Error("Invalid email or password. Please use admin@travelerp.com / password"));
                    }
                }, 1500);
            });

            // Store mock user info & token
            localStorage.setItem("authToken", "mock-jwt-token-12345");
            localStorage.setItem("user", JSON.stringify({ email: data.email, role: "admin" }));
            
            toast.success("Welcome back! Login successful.");
            navigate("/admin");
        } catch (error) {
            setServerError(error.message);
            toast.error(error.message);
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <>
            <Helmet>
                <title>Travel ERP | Login</title>
                <meta name="description" content="Sign in to your Travel ERP admin account to manage bookings, packages, operations and workflows." />
            </Helmet>

            <div className="auth-layout">
                {/* Decorative background shapes */}
                <div style={{
                    position: "absolute",
                    width: "300px",
                    height: "300px",
                    borderRadius: "50%",
                    background: "radial-gradient(circle, rgba(37,99,235,0.15) 0%, rgba(255,255,255,0) 70%)",
                    top: "10%",
                    left: "10%",
                    zIndex: 0
                }} />
                <div style={{
                    position: "absolute",
                    width: "400px",
                    height: "400px",
                    borderRadius: "50%",
                    background: "radial-gradient(circle, rgba(124,58,237,0.15) 0%, rgba(255,255,255,0) 70%)",
                    bottom: "10%",
                    right: "10%",
                    zIndex: 0
                }} />

                <motion.div
                    className="auth-container"
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.5 }}
                >
                    <div className="auth-card" style={{ position: "relative", zIndex: 1 }}>
                        <div className="text-center mb-4">
                            <div className="d-flex align-center justify-center mb-2" style={{
                                width: "60px",
                                height: "60px",
                                background: "rgba(37,99,235,0.1)",
                                borderRadius: "var(--radius-md)",
                                margin: "0 auto"
                            }}>
                                <FiCompass style={{ fontSize: "32px", color: "var(--primary-500)" }} />
                            </div>
                            <h3 style={{ fontSize: "24px", color: "var(--gray-900)", marginBottom: "8px" }}>
                                Welcome Back
                            </h3>
                            <p style={{ color: "var(--gray-500)", fontSize: "14px" }}>
                                Enter your credentials to access the ERP panel
                            </p>
                        </div>

                        {serverError && (
                            <div className="alert alert-danger d-flex align-center gap-2 mb-3">
                                <FiAlertCircle style={{ flexShrink: 0 }} />
                                <span className="text-sm">{serverError}</span>
                            </div>
                        )}

                        <form onSubmit={handleSubmit(onSubmit)}>
                            {/* Email Address */}
                            <div className="form-group">
                                <label className="form-label">Email Address</label>
                                <div className="input-wrapper">
                                    <FiMail className="input-icon" />
                                    <input
                                        type="text"
                                        placeholder="admin@travelerp.com"
                                        className={`form-control ${errors.email ? "error" : ""}`}
                                        {...register("email", {
                                            required: "Email is required",
                                            pattern: {
                                                value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
                                                message: "Invalid email address"
                                            }
                                        })}
                                        disabled={isLoading}
                                    />
                                </div>
                                {errors.email && (
                                    <span className="form-error">{errors.email.message}</span>
                                )}
                            </div>

                            {/* Password */}
                            <div className="form-group">
                                <div className="d-flex justify-between align-center mb-2">
                                    <label className="form-label" style={{ marginBottom: 0 }}>Password</label>
                                    <Link
                                        to="/forgot-password"
                                        style={{ fontSize: "13px", color: "var(--primary-500)", fontWeight: "500" }}
                                    >
                                        Forgot Password?
                                    </Link>
                                </div>
                                <div className="input-wrapper">
                                    <FiLock className="input-icon" />
                                    <input
                                        type={showPassword ? "text" : "password"}
                                        placeholder="admin123"
                                        className={`form-control ${errors.password ? "error" : ""}`}
                                        {...register("password", {
                                            required: "Password is required",
                                            minLength: {
                                                value: 6,
                                                message: "Password must be at least 6 characters"
                                            }
                                        })}
                                        disabled={isLoading}
                                    />
                                    <button
                                        type="button"
                                        style={{
                                            position: "absolute",
                                            right: "14px",
                                            top: "50%",
                                            transform: "translateY(-50%)",
                                            background: "none",
                                            border: "none",
                                            cursor: "pointer",
                                            color: "var(--gray-400)",
                                            padding: 0
                                        }}
                                        onClick={() => setShowPassword(!showPassword)}
                                        tabIndex={-1}
                                    >
                                        {showPassword ? <FiEyeOff size={18} /> : <FiEye size={18} />}
                                    </button>
                                </div>
                                {errors.password && (
                                    <span className="form-error">{errors.password.message}</span>
                                )}
                            </div>

                            {/* Remember Me */}
                            <div className="form-group d-flex align-center gap-2 mb-4">
                                <input
                                    type="checkbox"
                                    id="rememberMe"
                                    style={{
                                        width: "16px",
                                        height: "16px",
                                        cursor: "pointer",
                                        accentColor: "var(--primary-500)"
                                    }}
                                    {...register("rememberMe")}
                                    disabled={isLoading}
                                />
                                <label
                                    htmlFor="rememberMe"
                                    style={{
                                        fontSize: "14px",
                                        color: "var(--gray-600)",
                                        cursor: "pointer",
                                        userSelect: "none"
                                    }}
                                >
                                    Remember me on this device
                                </label>
                            </div>

                            {/* Submit Button */}
                            <button
                                type="submit"
                                className="btn btn-primary w-100"
                                style={{ height: "46px" }}
                                disabled={isLoading}
                            >
                                {isLoading ? (
                                    <div className="d-flex align-center justify-center gap-2">
                                        <div style={{
                                            width: "18px",
                                            height: "18px",
                                            border: "2px solid rgba(255,255,255,0.3)",
                                            borderTopColor: "#fff",
                                            borderRadius: "50%",
                                            animation: "spin 0.6s linear infinite"
                                        }} />
                                        <span>Signing in...</span>
                                    </div>
                                ) : (
                                    "Sign In"
                                )}
                            </button>
                        </form>

                        <div className="text-center mt-4 pt-2" style={{ borderTop: "1px solid var(--gray-100)" }}>
                            <p style={{ color: "var(--gray-500)", fontSize: "14px" }}>
                                Don't have an account?{" "}
                                <Link
                                    to="/register"
                                    style={{ color: "var(--primary-500)", fontWeight: "600" }}
                                >
                                    Register Agency
                                </Link>
                            </p>
                        </div>
                    </div>
                </motion.div>
            </div>
        </>
    );
}

export default Login;
