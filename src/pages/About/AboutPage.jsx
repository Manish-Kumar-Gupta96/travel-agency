import { Helmet } from "react-helmet-async";

function AboutPage() {
    return (
        <>
            <Helmet>
                <title>About | Travel Agency</title>
            </Helmet>

            <section className="page">

                <div className="container">

                    <h1>About Us</h1>

                    <p>
                        We build unforgettable travel experiences around the world.
                    </p>

                </div>

            </section>
        </>
    );
}

export default AboutPage;
