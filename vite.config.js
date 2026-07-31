import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import path from "node:path";
import { fileURLToPath } from "node:url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default defineConfig(({ mode }) => ({
    plugins: [
        react()
    ],

    resolve: {
        alias: {
            "@": path.resolve(__dirname, "./src"),

            "@assets": path.resolve(__dirname, "./src/assets"),
            "@styles": path.resolve(__dirname, "./src/styles"),

            "@components": path.resolve(__dirname, "./src/components"),
            "@layouts": path.resolve(__dirname, "./src/layouts"),
            "@pages": path.resolve(__dirname, "./src/pages"),

            "@admin": path.resolve(__dirname, "./src/admin"),

            "@routes": path.resolve(__dirname, "./src/routes"),

            "@hooks": path.resolve(__dirname, "./src/hooks"),

            "@services": path.resolve(__dirname, "./src/services"),

            "@utils": path.resolve(__dirname, "./src/utils"),

            "@constants": path.resolve(__dirname, "./src/constants"),

            "@context": path.resolve(__dirname, "./src/context"),

            "@data": path.resolve(__dirname, "./src/data")
        }
    },

    server: {
        host: true,
        port: 5173,
        open: true,
        strictPort: false
    },

    preview: {
        host: true,
        port: 4173
    },

    build: {

        target: "esnext",

        outDir: "dist",

        assetsDir: "assets",

        emptyOutDir: true,

        sourcemap: mode === "development",

        cssCodeSplit: true,

        modulePreload: true,

        minify: "esbuild",

        chunkSizeWarningLimit: 1200,

        reportCompressedSize: true,

        rollupOptions: {

            output: {

                entryFileNames:
                    "assets/js/[name]-[hash].js",

                chunkFileNames:
                    "assets/js/[name]-[hash].js",

                assetFileNames: asset => {

                    if (asset.name.endsWith(".css")) {

                        return "assets/css/[name]-[hash][extname]";

                    }

                    if (
                        /\.(png|jpg|jpeg|gif|svg|webp)$/i.test(
                            asset.name
                        )
                    ) {

                        return "assets/images/[name]-[hash][extname]";

                    }

                    if (
                        /\.(woff|woff2|ttf|otf)$/i.test(
                            asset.name
                        )
                    ) {

                        return "assets/fonts/[name]-[hash][extname]";

                    }

                    return "assets/[name]-[hash][extname]";

                },

                manualChunks: {

                    react: [
                        "react",
                        "react-dom"
                    ],

                    router: [
                        "react-router-dom"
                    ],

                    axios: [
                        "axios"
                    ],

                    animation: [
                        "framer-motion"
                    ],

                    swiper: [
                        "swiper"
                    ],

                    forms: [
                        "react-hook-form",
                        "zod"
                    ],

                    charts: [
                        "chart.js",
                        "react-chartjs-2"
                    ],

                    table: [
                        "@tanstack/react-table"
                    ]
                }
            }
        }
    },

    css: {

        devSourcemap: true

    }

}));
