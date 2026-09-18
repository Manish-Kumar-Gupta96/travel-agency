import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";


export default defineConfig({
    base: './',
    plugins: [
        react()
    ],


    server: {

        port: 5173,

        host: true,

        open: true

    },


    build: {

        outDir: "dist",

        sourcemap: false,

        chunkSizeWarningLimit: 1000

    },


    resolve: {

        alias: {

            "@": "/src",

            "@assets": "/src/assets",

            "@components": "/src/components",

            "@layouts": "/src/layouts",

            "@pages": "/src/pages",

            "@services": "/src/services",

            "@hooks": "/src/hooks",

            "@utils": "/src/utils",

            "@store": "/src/store"

        }

    }

});
