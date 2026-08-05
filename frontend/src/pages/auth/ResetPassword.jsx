import { useState } from "react";
import { useForm } from "react-hook-form";
import { Link, useNavigate, useSearchParams } from "react-router-dom";
import { motion } from "framer-motion";
import { FiLock, FiEye, FiEyeOff, FiCompass, FiAlertCircle, FiCheckCircle } from "react-icons/fi";
import { Helmet } from "react-helmet-async";
import { toast } from "react-toastify";

function ResetPassword() {
    const [searchParams] = useSearchParams();
    const token = searchParams.get("token") || "";

    const {
        register,
        handleSubmit,
        watch,
        formState: { errors }
    } = useForm({
        defaultValues: {
            password: "",
            confirmPassword: ""
        }
    });

    const [showPassword, setShowPassword] = useState(false);
    const [isLoading, setIsLoading] = useState(false);
    const [isSuccess, setIsSuccess] = useState(false);
    const [serverError, setServerError] = useState("");
    const navigate = useNavigate();

    const password = watch("password");

    const onSubmit = async (data) => {
        if (!token) {
            setServerError("Invalid or expired password reset token.");
            toast.error("Invalid token.");
            return;
        }

        setIsLoading(true);
        setServerError("");
        try {
            // Simulated password reset API call
            await new Promise((resolve) => setTimeout(resolve, 1500));
            
            setIsSuccess(true);
            toast.success("Password reset successful! Redirecting to login.");
            setTimeout(() => {
                navigate("/login");
            }, 3000);
        } catch (error) {
            setServerError("Failed to reset password. Please request a new reset link.");
            toast.error("Password reset failed.");
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <>
            <Helmet>
                <title>Travel ERP | Reset Password</title>
                <meta name="description" content="Set a new password for your Travel ERP agency account." />
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
                                New Password
                            </h3>
                            <p style={{ color: "var(--gray-500)", fontSize: "14px" }}>
                                Enter a strong, secure password for your account
                            </p>
                        </div>

                        {!token && (
                            <div className="alert alert-danger d-flex align-center gap-2 mb-3">
                                <FiAlertCircle style={{ flexShrink: 0 }} />
                                <span className="text-sm">No reset token found. Please check your email link.</span>
                            </div>
                        )}

                        {serverError && (
                            <div className="alert alert-danger d-flex align-center gap-2 mb-3">
                                <FiAlertCircle style={{ flexShrink: 0 }} />
                                <span className="text-sm">{serverError}</span>
                            </div>
                        )}

                        {!isSuccess ? (
                            <form onSubmit={handleSubmit(onSubmit)}>
                                {/* New Password */}
                                <div className="form-group mb-3">
                                    <label className="form-label">New Password</label>
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
                                            disabled={isLoading || !token}
                                        />
                                    </div>
                                    {errors.password && (
                                        <span className="form-error">{errors.password.message}</span>
                                    )}
                                </div>

                                {/* Confirm Password */}
                                <div className="form-group mb-3">
                                    <label className="form-label">Confirm New Password</label>
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
                                            disabled={isLoading || !token}
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
                                    {errors.confirmPassword && (
                                        <span className="form-error">{errors.confirmPassword.message}</span>
                                    )}
                                </div>

                                {/* Submit Button */}
                                <button
                                    type="submit"
                                    className="btn btn-primary w-100 mt-2"
                                    style={{ height: "46px" }}
                                    disabled={isLoading || !token}
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
                                            <span>Resetting...</span>
                                        </div>
                                    ) : (
                                        "Update Password"
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
                                <h4 style={{ fontSize: "16px", color: "var(--gray-900)", marginBottom: "6px" }}>Success!</h4>
                                <p style={{ fontSize: "13px", color: "var(--gray-600)", lineHeight: "1.5" }}>
                                    Your password has been reset successfully. You will be redirected to the login page shortly, or you can click below.
                                </p>
                            </motion.div>
                        )}

                        <div className="text-center mt-4 pt-2" style={{ borderTop: "1px solid var(--gray-100)" }}>
                            <Link
                                to="/login"
                                style={{ color: "var(--primary-500)", fontSize: "14px", fontWeight: "600" }}
                            >
                                Go to Sign In
                            </Link>
                        </div>
                    </div>
                </motion.div>
            </div>
        </>
    );
}

export default ResetPassword;
