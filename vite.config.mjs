// View your website at your own local server
// for example http://vite-php-setup.test

// http://localhost:3000 is serving Vite on development
// but accessing it directly will be empty

// IMPORTANT image urls in CSS works fine
// BUT you need to create a symlink on dev server to map this folder during dev:
// ln -s {path_to_vite}/src/assets {path_to_public_html}/assets
// on production everything will work just fine

//import vue from '@vitejs/plugin-vue'
import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";
import liveReload from "vite-plugin-live-reload";
import { resolve, basename } from "path";

export default defineConfig({
  plugins: [liveReload(__dirname + "/**/*.php"), tailwindcss()],
  root: "",
  base:
    process.env.NODE_ENV === "development"
      ? `/wp-content/themes/${basename(__dirname)}/`
      : `/wp-content/themes/${basename(__dirname)}/dist/`,
  build: {
    outDir: resolve(__dirname, "./dist"),
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        main: resolve(__dirname + "/main.js"),
      },
    },
    minify: true,
    write: true,
  },

  server: {
    cors: true,
    strictPort: true,
    port: 3000,
    https: false,
    hmr: {
      host: "localhost",
    },
  },
});
