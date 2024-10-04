import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";
import { visualizer } from 'rollup-plugin-visualizer';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/app.jsx",
                "resources/css/app.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
        react(),
        visualizer({ open: false }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks(id) {
                    // Split node_modules into separate chunks
                    if (id.includes('node_modules')) {
                        return id
                            .toString()
                            .split('node_modules/')[1]
                            .split('/')[0]
                            .toString();
                    }
                }
            }
        }
    }
});
