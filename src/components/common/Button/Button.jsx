import "./Button.css";
import clsx from "clsx";

function Button({

    children,

    type = "button",

    variant = "primary",

    size = "md",

    fullWidth = false,

    disabled = false,

    onClick

}) {

    return (

        <button

            type={type}

            disabled={disabled}

            onClick={onClick}

            className={clsx(

                "btn",

                `btn-${variant}`,

                `btn-${size}`,

                fullWidth && "btn-block"

            )}

        >

            {children}

        </button>

    );

}

export default Button;
