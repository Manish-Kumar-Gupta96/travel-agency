import { NavLink } from "react-router-dom";


function Header(){


    const links=[

        {
            name:"Home",
            path:"/"
        },

        {
            name:"Packages",
            path:"/packages"
        },

        {
            name:"Destinations",
            path:"/destinations"
        },

        {
            name:"About",
            path:"/about"
        },

        {
            name:"Contact",
            path:"/contact"
        }

    ];



    return (

        <header className="website-header">


            <div className="container header-inner">


                <div className="website-logo">

                    Travel ERP

                </div>



                <nav className="website-nav">


                    {
                        links.map((item)=>(

                            <NavLink

                                key={item.path}

                                to={item.path}

                            >

                                {item.name}

                            </NavLink>

                        ))
                    }


                </nav>


                <div className="header-action">


                    <NavLink

                        to="/login"

                        className="btn btn-primary"

                    >

                        Login

                    </NavLink>


                </div>


            </div>


        </header>

    );


}


export default Header;
