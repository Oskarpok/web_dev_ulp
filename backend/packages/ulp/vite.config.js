import { defineConfig } from 'vite';

import dotenv from 'dotenv';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

dotenv.config({ path: '/docker/.env' });

export default defineConfig({
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: true,
    origin: 'http://localhost:5173',
    cors: true,
  },
  build: {
    outDir: `../../html/${process.env.PROJECT}/public/build`,
    manifest: true,
    emptyOutDir: true,
  },
  plugins: [
    laravel({
      input: ['core/resources/css/core.css', 'core/resources/js/core.js'],
      publicDirectory: `../../html/${process.env.PROJECT}/public`,
      refresh: true,
    }),
    tailwindcss(),
  ],
});