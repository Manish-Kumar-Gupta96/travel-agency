import { FaMapMarkerAlt, FaStar } from "react-icons/fa";
import "./DestinationCard.css";

function DestinationCard({ destination }) {

    return (

        <article className="destination-card">

            <div className="destination-image">

                <img
                    src={destination.image}
                    alt={destination.name}
                />

            </div>

            <div className="destination-content">

                <div className="destination-rating">

                    <FaStar />

                    <span>

                        {destination.rating}

                    </span>

                    <small>

                        ({destination.reviews})

                    </small>

                </div>

                <h3>

                    {destination.name}

                </h3>

                <p>

                    <FaMapMarkerAlt />

                    {destination.country}

                </p>

                <div className="destination-footer">

                    <strong>

                        From ${destination.price}

                    </strong>

                    <button>

                        Explore

                    </button>

                </div>

            </div>

        </article>

    );

}

export default DestinationCard;
