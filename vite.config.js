import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import path from "path";
import { fileURLToPath } from "url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default defineConfig({
  plugins: [react()],

  resolve: {
    alias: {
      "@": path.resolve(__dirname, "./src"),
      "@components": path.resolve(__dirname, "./src/components"),
      "@pages": path.resolve(__dirname, "./src/pages"),
      "@layouts": path.resolve(__dirname, "./src/layouts"),
      "@hooks": path.resolve(__dirname, "./src/hooks"),
      "@utils": path.resolve(__dirname, "./src/utils"),
      "@services": path.resolve(__dirname, "./src/services"),
      "@assets": path.resolve(__dirname, "./src/assets"),
      "@styles": path.resolve(__dirname, "./src/styles"),
      "@admin": path.resolve(__dirname, "./src/admin")
    }
  },

  server: {
    host: true,
    port: 5173,
    open: true
  },

  preview: {
    host: true,
    port: 4173
  },

  build: {
    outDir: "dist",
    assetsDir: "assets",
    sourcemap: false,
    minify: "esbuild",
    chunkSizeWarningLimit: 1200,
    cssCodeSplit: true,
    emptyOutDir: true,
    rollupOptions: {
      output: {
        manualChunks: {
          react: ["react", "react-dom"],
          router: ["react-router-dom"],
          animation: ["framer-motion"],
          swiper: ["swiper"],
          icons: ["react-icons"],
          axios: ["axios"],
          charts: ["chart.js", "react-chartjs-2"],
          tables: ["@tanstack/react-table"]
        }
      }
    }
  },

  css: {
    devSourcemap: true
  }
});
