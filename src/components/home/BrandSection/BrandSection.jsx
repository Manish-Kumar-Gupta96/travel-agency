import "./BrandSection.css";

const brands = [
    "Emirates",
    "Air India",
    "IndiGo",
    "Qatar",
    "Turkish",
    "Lufthansa"
];

function BrandSection() {

    return (

        <section className="brand-section">

            <div className="container">

                <p className="brand-title">

                    Trusted by World's Leading Travel Partners

                </p>

                <div className="brand-grid">

                    {brands.map(brand => (

                        <div
                            key={brand}
                            className="brand-card"
                        >

                            {brand}

                        </div>

                    ))}

                </div>

            </div>

        </section>

    );

}

export default BrandSection;
