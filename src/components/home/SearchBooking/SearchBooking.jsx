import "./SearchBooking.css";

function SearchBooking() {
    return (
        <section className="booking-search">

            <div className="container">

                <div className="booking-card">

                    <input
                        type="text"
                        placeholder="Destination"
                    />

                    <input
                        type="date"
                    />

                    <input
                        type="date"
                    />

                    <select>

                        <option>

                            Travelers

                        </option>

                        <option>1 Adult</option>

                        <option>2 Adults</option>

                        <option>Family</option>

                    </select>

                    <button>

                        Search

                    </button>

                </div>

            </div>

        </section>
    );
}

export default SearchBooking;
