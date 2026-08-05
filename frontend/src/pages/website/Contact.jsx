import { useState } from "react";
import { Helmet } from "react-helmet-async";
import { FiSend } from "react-icons/fi";
import { toast } from "react-toastify";

function PublicContact() {
    const [form, setForm] = useState({ name: "", email: "", message: "" });

    const handleSubmit = (e) => {
        e.preventDefault();
        if (!form.name || !form.email || !form.message) {
            toast.error("Please fill in all fields.");
            return;
        }
        toast.success("Thank you! Your message has been sent successfully.");
        setForm({ name: "", email: "", message: "" });
    };

    return (
        <>
            <Helmet>
                <title>Contact Us | Travel Agency</title>
            </Helmet>

            <div className="fade-in" style={{ padding: "60px 0" }}>
                <div className="container" style={{ maxWidth: "600px" }}>
                    <h2 className="text-3xl font-bold mb-4 text-center" style={{ color: "var(--gray-900)" }}>Contact Us</h2>
                    <p className="text-center mb-5" style={{ color: "var(--gray-500)" }}>
                        Have any questions or need custom packages? Shoot us a message!
                    </p>

                    <div className="card">
                        <form onSubmit={handleSubmit}>
                            <div className="form-group mb-3">
                                <label className="form-label">Full Name</label>
                                <input
                                    type="text"
                                    className="form-control"
                                    placeholder="Enter your name"
                                    value={form.name}
                                    onChange={(e) => setForm({ ...form, name: e.target.value })}
                                />
                            </div>
                            <div className="form-group mb-3">
                                <label className="form-label">Email Address</label>
                                <input
                                    type="email"
                                    className="form-control"
                                    placeholder="name@example.com"
                                    value={form.email}
                                    onChange={(e) => setForm({ ...form, email: e.target.value })}
                                />
                            </div>
                            <div className="form-group mb-4">
                                <label className="form-label">Message</label>
                                <textarea
                                    className="form-control"
                                    rows="5"
                                    placeholder="Tell us what you're planning..."
                                    value={form.message}
                                    onChange={(e) => setForm({ ...form, message: e.target.value })}
                                />
                            </div>
                            <button type="submit" className="btn btn-primary w-100">
                                <FiSend />
                                <span>Send Message</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}

export default PublicContact;
