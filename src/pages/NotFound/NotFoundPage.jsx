import { Link } from "react-router-dom";

function NotFoundPage() {
    return (
        <section className="page">

            <div className="container">

                <h1>404</h1>

                <h2>Page Not Found</h2>

                <p>
                    The page you are looking for doesn't exist.
                </p>

                <Link to="/">
                    Back To Home
                </Link>

            </div>

        </section>
    );
}

export default NotFoundPage;
