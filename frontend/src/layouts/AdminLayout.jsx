import {

    Outlet

} from "react-router-dom";


import Sidebar from "@/components/layout/Sidebar";

import Header from "@/components/layout/Header";

import Breadcrumb from "@/components/common/Breadcrumb";



function AdminLayout(){


    return (

        <div className="admin-layout">


            <Sidebar />


            <Header />


            <main className="page-wrapper">


                <div className="page-content">

                    <Breadcrumb />


                    <Outlet />


                </div>


            </main>


        </div>

    );


}



export default AdminLayout;
