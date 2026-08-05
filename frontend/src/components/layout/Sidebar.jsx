import {

    NavLink

} from "react-router-dom";



function Sidebar(){


    const menu=[


        {

            title:"Dashboard",

            path:"/admin"

        },


        {

            title:"Customers",

            path:"/admin/customers"

        },


        {

            title:"Packages",

            path:"/admin/packages"

        },


        {

            title:"Bookings",

            path:"/admin/bookings"

        }


    ];



    return (

        <aside className="sidebar">


            <div className="sidebar-logo">

                Travel ERP

            </div>



            <nav className="sidebar-menu">


                {

                    menu.map((item)=>(


                        <NavLink

                            key={item.path}

                            to={item.path}

                        >

                            {item.title}

                        </NavLink>


                    ))

                }


            </nav>


        </aside>

    );


}



export default Sidebar;
