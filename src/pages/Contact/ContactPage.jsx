import { Helmet } from "react-helmet-async";

function ContactPage() {
    return (
        <>
            <Helmet>
                <title>Contact | Travel Agency</title>
            </Helmet>

            <section className="page">

                <div className="container">

                    <h1>Contact Us</h1>

                    <p>
                        We'd love to hear from you.
                    </p>

                </div>

            </section>
        </>
    );
}

export default ContactPage;
