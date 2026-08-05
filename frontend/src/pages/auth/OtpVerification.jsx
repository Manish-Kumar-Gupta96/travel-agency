import { useState, useRef, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { motion } from "framer-motion";
import { FiLock, FiArrowLeft, FiCompass, FiAlertCircle } from "react-icons/fi";
import { Helmet } from "react-helmet-async";
import { toast } from "react-toastify";

function OtpVerification() {
    const [otp, setOtp] = useState(["", "", "", "", "", ""]);
    const [isLoading, setIsLoading] = useState(false);
    const [serverError, setServerError] = useState("");
    const [timer, setTimer] = useState(59);
    const inputRefs = useRef([]);
    const navigate = useNavigate();

    // Resend Timer Countdown
    useEffect(() => {
        let interval = null;
        if (timer > 0) {
            interval = setInterval(() => {
                setTimer((prev) => prev - 1);
            }, 1000);
        } else {
            clearInterval(interval);
        }
        return () => clearInterval(interval);
    }, [timer]);

    // Handle Input Change
    const handleChange = (index, value) => {
        // Only allow numbers
        if (value && isNaN(value)) return;

        const newOtp = [...otp];
        newOtp[index] = value.substring(value.length - 1); // capture last char
        setOtp(newOtp);

        // Move to next input if filled
        if (value && index < 5) {
            inputRefs.current[index + 1].focus();
        }
    };

    // Handle Backspace Key
    const handleKeyDown = (index, e) => {
        if (e.key === "Backspace" && !otp[index] && index > 0) {
            inputRefs.current[index - 1].focus();
        }
    };

    // Handle Paste Event
    const handlePaste = (e) => {
        e.preventDefault();
        const pasteData = e.clipboardData.getData("text").trim();
        if (pasteData.length === 6 && !isNaN(pasteData)) {
            const newOtp = pasteData.split("");
            setOtp(newOtp);
            inputRefs.current[5].focus();
        }
    };

    const handleResend = () => {
        if (timer === 0) {
            setTimer(59);
            toast.success("Verification code resent to your device.");
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const code = otp.join("");
        if (code.length < 6) {
            setServerError("Please enter the complete 6-digit verification code.");
            return;
        }

        setIsLoading(true);
        setServerError("");
        try {
            // Simulated OTP verification API request
            await new Promise((resolve, reject) => {
                setTimeout(() => {
                    if (code === "123456") {
                        resolve();
                    } else {
                        reject(new Error("Invalid verification code. Please use 123456"));
                    }
                }, 1500);
            });

            toast.success("Identity verified successfully!");
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
                <title>Travel ERP | OTP Verification</title>
                <meta name="description" content="Verify your identity by entering the one-time passcode sent to your device." />
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
                                Verify Identity
                            </h3>
                            <p style={{ color: "var(--gray-500)", fontSize: "14px", lineHeight: "1.4" }}>
                                We have sent a 6-digit verification code to your device. Enter the code below to continue.
                            </p>
                        </div>

                        {serverError && (
                            <div className="alert alert-danger d-flex align-center gap-2 mb-3">
                                <FiAlertCircle style={{ flexShrink: 0 }} />
                                <span className="text-sm">{serverError}</span>
                            </div>
                        )}

                        <form onSubmit={handleSubmit}>
                            {/* OTP Fields Grid */}
                            <div className="d-flex justify-between gap-2 mb-4" onPaste={handlePaste}>
                                {otp.map((digit, idx) => (
                                    <input
                                        key={idx}
                                        type="text"
                                        maxLength="1"
                                        value={digit}
                                        ref={(el) => (inputRefs.current[idx] = el)}
                                        onChange={(e) => handleChange(idx, e.target.value)}
                                        onKeyDown={(e) => handleKeyDown(idx, e)}
                                        disabled={isLoading}
                                        style={{
                                            width: "48px",
                                            height: "54px",
                                            fontSize: "22px",
                                            fontWeight: "700",
                                            textAlign: "center",
                                            border: "1px solid var(--gray-300)",
                                            borderRadius: "var(--radius-md)",
                                            outline: "none",
                                            transition: "var(--transition-fast)",
                                            backgroundColor: "var(--white)",
                                            color: "var(--gray-900)"
                                        }}
                                        className="form-control"
                                    />
                                ))}
                            </div>

                            {/* Resend Action */}
                            <div className="text-center mb-4">
                                <span className="text-sm" style={{ color: "var(--gray-500)" }}>
                                    Didn't receive the code?{" "}
                                </span>
                                {timer > 0 ? (
                                    <span className="text-sm font-semibold" style={{ color: "var(--primary-500)" }}>
                                        Resend in {timer}s
                                    </span>
                                ) : (
                                    <button
                                        type="button"
                                        onClick={handleResend}
                                        style={{
                                            background: "none",
                                            border: "none",
                                            color: "var(--primary-500)",
                                            fontWeight: "600",
                                            cursor: "pointer",
                                            fontSize: "14px",
                                            padding: 0
                                        }}
                                    >
                                        Resend Code
                                    </button>
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
                                        <span>Verifying...</span>
                                    </div>
                                ) : (
                                    "Verify & Login"
                                )}
                            </button>
                        </form>

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

export default OtpVerification;
