import { Helmet } from "react-helmet-async";

function PublicAbout() {
    return (
        <>
            <Helmet>
                <title>About Us | Travel Agency</title>
            </Helmet>

            <div className="fade-in" style={{ padding: "60px 0" }}>
                <div className="container" style={{ maxWidth: "800px" }}>
                    <h2 className="text-3xl font-bold mb-4 text-center" style={{ color: "var(--gray-900)" }}>About Our Travel Agency</h2>
                    <div style={{ height: "4px", width: "60px", background: "var(--primary-500)", margin: "0 auto 30px" }} />
                    
                    <p style={{ color: "var(--gray-600)", lineHeight: "1.8", fontSize: "16px", marginBottom: "20px" }}>
                        Welcome to Travel ERP, your trusted travel management system designed to make tour package bookings, itineraries planning, and customer relationship management effortless.
                    </p>
                    <p style={{ color: "var(--gray-600)", lineHeight: "1.8", fontSize: "16px", marginBottom: "20px" }}>
                        Our mission is to bridge the gap between agencies and travelers by offering state of the art tools, customized packages, and reliable travel bookings. Whether you are traveling for leisure, adventure, or business, we provide unmatched services customized specifically to suit your requirements.
                    </p>

                    <h3 className="text-xl font-bold mt-5 mb-3" style={{ color: "var(--gray-800)" }}>Our Vision</h3>
                    <p style={{ color: "var(--gray-600)", lineHeight: "1.8", fontSize: "16px" }}>
                        To become a global leader in providing automated travel management solutions that delight tour operators and travelers alike. We leverage technology to create unforgettable, seamless journeys across the globe.
                    </p>
                </div>
            </div>
        </>
    );
}

export default PublicAbout;
