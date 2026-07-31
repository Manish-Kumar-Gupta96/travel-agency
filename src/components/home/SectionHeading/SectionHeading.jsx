import "./SectionHeading.css";

function SectionHeading({

    subtitle,

    title,

    description

}){

    return(

        <div className="section-heading">

            <span>

                {subtitle}

            </span>

            <h2>

                {title}

            </h2>

            {description && (

                <p>

                    {description}

                </p>

            )}

        </div>

    );

}

export default SectionHeading;
