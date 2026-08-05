import { useState } from "react";
import { useForm } from "react-hook-form";
import { Link } from "react-router-dom";
import { motion } from "framer-motion";
import { FiMail, FiArrowLeft, FiCompass, FiAlertCircle, FiCheckCircle } from "react-icons/fi";
import { Helmet } from "react-helmet-async";
import { toast } from "react-toastify";

function ForgotPassword() {
    const {
        register,
        handleSubmit,
        formState: { errors }
    } = useForm({
        defaultValues: {
            email: ""
        }
    });

    const [isLoading, setIsLoading] = useState(false);
    const [isSubmitted, setIsSubmitted] = useState(false);
    const [serverError, setServerError] = useState("");

    const onSubmit = async (data) => {
        setIsLoading(true);
        setServerError("");
        try {
            // Simulated Forgot Password API request
            await new Promise((resolve) => setTimeout(resolve, 1500));
            
            setIsSubmitted(true);
            toast.success("Password reset instructions sent to your email.");
        } catch (error) {
            setServerError("An error occurred. Please try again.");
            toast.error("Failed to send reset link.");
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <>
            <Helmet>
                <title>Travel ERP | Forgot Password</title>
                <meta name="description" content="Recover your Travel ERP account password by entering your registered agency email address." />
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
                                Reset Password
                            </h3>
                            <p style={{ color: "var(--gray-500)", fontSize: "14px" }}>
                                We'll send you instructions to reset your password
                            </p>
                        </div>

                        {serverError && (
                            <div className="alert alert-danger d-flex align-center gap-2 mb-3">
                                <FiAlertCircle style={{ flexShrink: 0 }} />
                                <span className="text-sm">{serverError}</span>
                            </div>
                        )}

                        {!isSubmitted ? (
                            <form onSubmit={handleSubmit(onSubmit)}>
                                {/* Email Address */}
                                <div className="form-group mb-4">
                                    <label className="form-label">Registered Email</label>
                                    <div className="input-wrapper">
                                        <FiMail className="input-icon" />
                                        <input
                                            type="text"
                                            placeholder="enter your email"
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
                                            <span>Sending Link...</span>
                                        </div>
                                    ) : (
                                        "Send Reset Link"
                                    )}
                                </button>
                            </form>
                        ) : (
                            <motion.div 
                                className="text-center p-3 rounded mb-4" 
                                style={{ backgroundColor: "rgba(22, 163, 74, 0.05)", border: "1px solid rgba(22, 163, 74, 0.2)" }}
                                initial={{ scale: 0.95 }}
                                animate={{ scale: 1 }}
                            >
                                <FiCheckCircle size={40} style={{ color: "var(--success-500)", marginBottom: "12px" }} />
                                <h4 style={{ fontSize: "16px", color: "var(--gray-900)", marginBottom: "6px" }}>Check Your Email</h4>
                                <p style={{ fontSize: "13px", color: "var(--gray-600)", lineHeight: "1.5" }}>
                                    We have sent a password reset link to your email address. Please click the link to configure a new password.
                                </p>
                            </motion.div>
                        )}

                        <div className="text-center mt-4 pt-2" style={{ borderTop: "1px solid var(--gray-100)" }}>
                            <Link
                                to="/login"
                                className="d-flex align-center justify-center gap-2"
                                style={{ color: "var(--gray-600)", fontSize: "14px", fontWeight: "600" }}
                            >
                                <FiArrowLeft size={16} />
                                <span>Back to Login</span>
                            </Link>
                        </div>
                    </div>
                </motion.div>
            </div>
        </>
    );
}

export default ForgotPassword;
