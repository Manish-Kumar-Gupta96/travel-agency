import { useState } from "react";
import { useForm } from "react-hook-form";
import { Link, useNavigate } from "react-router-dom";
import { motion } from "framer-motion";
import { FiMail, FiLock, FiUser, FiPhone, FiBriefcase, FiEye, FiEyeOff, FiCompass, FiAlertCircle } from "react-icons/fi";
import { Helmet } from "react-helmet-async";
import { toast } from "react-toastify";

function Register() {
    const {
        register,
        handleSubmit,
        watch,
        formState: { errors }
    } = useForm({
        defaultValues: {
            agencyName: "",
            contactName: "",
            email: "",
            phone: "",
            password: "",
            confirmPassword: "",
            agreeTerms: false
        }
    });

    const [showPassword, setShowPassword] = useState(false);
    const [isLoading, setIsLoading] = useState(false);
    const [serverError, setServerError] = useState("");
    const navigate = useNavigate();

    const password = watch("password");

    const onSubmit = async (data) => {
        setIsLoading(true);
        setServerError("");
        try {
            // Simulated Register API request
            await new Promise((resolve) => setTimeout(resolve, 1500));
            
            toast.success("Agency registered successfully! Please login.");
            navigate("/login");
        } catch (error) {
            setServerError("Registration failed. Please try again.");
            toast.error("Registration failed.");
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <>
            <Helmet>
                <title>Travel ERP | Register Agency</title>
                <meta name="description" content="Register your travel agency on the Travel ERP platform to manage packages, bookings, customers and invoices." />
            </Helmet>

            <div className="auth-layout" style={{ padding: "40px 20px" }}>
                {/* Decorative background shapes */}
                <div style={{
                    position: "absolute",
                    width: "300px",
                    height: "300px",
                    borderRadius: "50%",
                    background: "radial-gradient(circle, rgba(37,99,235,0.12) 0%, rgba(255,255,255,0) 70%)",
                    top: "5%",
                    left: "5%",
                    zIndex: 0
                }} />
                <div style={{
                    position: "absolute",
                    width: "350px",
                    height: "350px",
                    borderRadius: "50%",
                    background: "radial-gradient(circle, rgba(124,58,237,0.12) 0%, rgba(255,255,255,0) 70%)",
                    bottom: "5%",
                    right: "5%",
                    zIndex: 0
                }} />

                <motion.div
                    className="auth-container"
                    style={{ maxWidth: "550px" }}
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.5 }}
                >
                    <div className="auth-card" style={{ position: "relative", zIndex: 1, padding: "35px" }}>
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
                                Register Your Agency
                            </h3>
                            <p style={{ color: "var(--gray-500)", fontSize: "14px" }}>
                                Get started with the most powerful Travel ERP solution
                            </p>
                        </div>

                        {serverError && (
                            <div className="alert alert-danger d-flex align-center gap-2 mb-3">
                                <FiAlertCircle style={{ flexShrink: 0 }} />
                                <span className="text-sm">{serverError}</span>
                            </div>
                        )}

                        <form onSubmit={handleSubmit(onSubmit)}>
                            <div className="row">
                                {/* Agency Name */}
                                <div className="col-12 col-6 mb-3">
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label className="form-label">Agency Name</label>
                                        <div className="input-wrapper">
                                            <FiBriefcase className="input-icon" />
                                            <input
                                                type="text"
                                                placeholder="Global Travels"
                                                className={`form-control ${errors.agencyName ? "error" : ""}`}
                                                {...register("agencyName", { required: "Agency Name is required" })}
                                                disabled={isLoading}
                                            />
                                        </div>
                                        {errors.agencyName && (
                                            <span className="form-error">{errors.agencyName.message}</span>
                                        )}
                                    </div>
                                </div>

                                {/* Contact Person */}
                                <div className="col-12 col-6 mb-3">
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label className="form-label">Contact Person Name</label>
                                        <div className="input-wrapper">
                                            <FiUser className="input-icon" />
                                            <input
                                                type="text"
                                                placeholder="John Doe"
                                                className={`form-control ${errors.contactName ? "error" : ""}`}
                                                {...register("contactName", { required: "Contact Name is required" })}
                                                disabled={isLoading}
                                            />
                                        </div>
                                        {errors.contactName && (
                                            <span className="form-error">{errors.contactName.message}</span>
                                        )}
                                    </div>
                                </div>
                            </div>

                            <div className="row">
                                {/* Email */}
                                <div className="col-12 col-6 mb-3">
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label className="form-label">Email Address</label>
                                        <div className="input-wrapper">
                                            <FiMail className="input-icon" />
                                            <input
                                                type="text"
                                                placeholder="info@globaltravels.com"
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
                                </div>

                                {/* Phone */}
                                <div className="col-12 col-6 mb-3">
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label className="form-label">Phone Number</label>
                                        <div className="input-wrapper">
                                            <FiPhone className="input-icon" />
                                            <input
                                                type="text"
                                                placeholder="+1 (555) 000-0000"
                                                className={`form-control ${errors.phone ? "error" : ""}`}
                                                {...register("phone", { required: "Phone number is required" })}
                                                disabled={isLoading}
                                            />
                                        </div>
                                        {errors.phone && (
                                            <span className="form-error">{errors.phone.message}</span>
                                        )}
                                    </div>
                                </div>
                            </div>

                            <div className="row">
                                {/* Password */}
                                <div className="col-12 col-6 mb-3">
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label className="form-label">Password</label>
                                        <div className="input-wrapper">
                                            <FiLock className="input-icon" />
                                            <input
                                                type={showPassword ? "text" : "password"}
                                                placeholder="Min 6 characters"
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
                                        </div>
                                        {errors.password && (
                                            <span className="form-error">{errors.password.message}</span>
                                        )}
                                    </div>
                                </div>

                                {/* Confirm Password */}
                                <div className="col-12 col-6 mb-3">
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label className="form-label">Confirm Password</label>
                                        <div className="input-wrapper">
                                            <FiLock className="input-icon" />
                                            <input
                                                type={showPassword ? "text" : "password"}
                                                placeholder="Repeat password"
                                                className={`form-control ${errors.confirmPassword ? "error" : ""}`}
                                                {...register("confirmPassword", {
                                                    required: "Confirm Password is required",
                                                    validate: (value) => value === password || "Passwords do not match"
                                                })}
                                                disabled={isLoading}
                                            />
                                        </div>
                                        {errors.confirmPassword && (
                                            <span className="form-error">{errors.confirmPassword.message}</span>
                                        )}
                                    </div>
                                </div>
                            </div>

                            {/* Show Password Toggle */}
                            <div className="form-group d-flex justify-end mb-3">
                                <button
                                    type="button"
                                    onClick={() => setShowPassword(!showPassword)}
                                    style={{
                                        background: "none",
                                        border: "none",
                                        color: "var(--primary-500)",
                                        cursor: "pointer",
                                        fontSize: "13px",
                                        fontWeight: "600",
                                        padding: 0,
                                        display: "flex",
                                        alignItems: "center",
                                        gap: "4px"
                                    }}
                                >
                                    {showPassword ? <FiEyeOff size={15} /> : <FiEye size={15} />}
                                    <span>{showPassword ? "Hide" : "Show"} Passwords</span>
                                </button>
                            </div>

                            {/* Terms and Conditions */}
                            <div className="form-group d-flex align-start gap-2 mb-4">
                                <input
                                    type="checkbox"
                                    id="agreeTerms"
                                    style={{
                                        width: "16px",
                                        height: "16px",
                                        marginTop: "3px",
                                        cursor: "pointer",
                                        accentColor: "var(--primary-500)"
                                    }}
                                    {...register("agreeTerms", { required: "You must accept the Terms and Conditions" })}
                                    disabled={isLoading}
                                />
                                <label
                                    htmlFor="agreeTerms"
                                    style={{
                                        fontSize: "13px",
                                        color: "var(--gray-600)",
                                        cursor: "pointer",
                                        userSelect: "none",
                                        lineHeight: "1.4"
                                    }}
                                >
                                    I agree to the{" "}
                                    <Link to="/terms" style={{ color: "var(--primary-500)", fontWeight: "500" }}>
                                        Terms of Service
                                    </Link>{" "}
                                    and{" "}
                                    <Link to="/privacy" style={{ color: "var(--primary-500)", fontWeight: "500" }}>
                                        Privacy Policy
                                    </Link>
                                </label>
                            </div>
                            {errors.agreeTerms && (
                                <span className="form-error d-block mb-3" style={{ marginTop: "-10px" }}>
                                    {errors.agreeTerms.message}
                                </span>
                            )}

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
                                        <span>Creating Account...</span>
                                    </div>
                                ) : (
                                    "Register Agency"
                                )}
                            </button>
                        </form>

                        <div className="text-center mt-4 pt-2" style={{ borderTop: "1px solid var(--gray-100)" }}>
                            <p style={{ color: "var(--gray-500)", fontSize: "14px" }}>
                                Already have an account?{" "}
                                <Link
                                    to="/login"
                                    style={{ color: "var(--primary-500)", fontWeight: "600" }}
                                >
                                    Sign In
                                </Link>
                            </p>
                        </div>
                    </div>
                </motion.div>
            </div>
        </>
    );
}

export default Register;
