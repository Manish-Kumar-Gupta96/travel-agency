import {

    Outlet

} from "react-router-dom";


import WebsiteHeader from "@/components/website/Header";

import WebsiteFooter from "@/components/website/Footer";



function WebsiteLayout(){


    return (

        <>


            <WebsiteHeader />


            <main>

                <Outlet />

            </main>


            <WebsiteFooter />


        </>

    );


}



export default WebsiteLayout;
