/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    './core/resources/views/**/*.blade.php',
    './core/resources/js/**/*.js',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/postcss'),
    require('autoprefixer'),
  ],
}