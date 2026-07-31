import { Helmet } from "react-helmet-async";

import AppRoutes from "@routes/AppRoutes";

function App() {

    return (

        <>

            <Helmet>

                <title>

                    Travel Agency

                </title>

            </Helmet>

            <AppRoutes />

        </>

    );

}

export default App;
