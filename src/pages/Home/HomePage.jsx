import { Helmet } from "react-helmet-async";

import Hero from "@components/home/Hero/Hero";
import SearchBooking from "@components/home/SearchBooking/SearchBooking";
import BrandSection from "@components/home/BrandSection/BrandSection";

function HomePage(){

    return(

        <>

            <Helmet>

                <title>

                    Travel Agency

                </title>

            </Helmet>

            <Hero />

            <SearchBooking />

            <BrandSection />

        </>

    );

}

export default HomePage;
