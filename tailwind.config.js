/** @type {import('tailwindcss').Config} */

const neonSet = {
  "neon-light-lightest": "#EFEBF4",
  "neon-light-lighter": "#DFD8E8",
  "neon-light-light": "#CFC4DD",
  "neon-light-medium": "#BFB0D2",
  "neon-light-dark": "#AF9DC6",
  "neon-light-darker": "#A089BB",
  "neon-light-darkest": "#9075B0",
  "neon-dark-lightest": "#8062A5",
  "neon-dark-lighter": "#715493",
  "neon-dark-light": "#61497F",
  "neon-dark-medium": "#523E6C",
  "neon-dark-dark": "#433358",
  "neon-dark-darker": "#342744",
  "neon-dark-darkest": "#241b2f",

  "neon-50": "#EFEBF4",
  "neon-100": "#DFD8E8",
  "neon-150": "#CFC4DD",
  "neon-200": "#BFB0D2",
  "neon-250": "#AF9DC6",
  "neon-300": "#A089BB",
  "neon-350": "#9075B0",
  "neon-400": "#8062A5",
  "neon-500": "#715493",
  "neon-600": "#61497F",
  "neon-700": "#523E6C",
  "neon-800": "#433358",
  "neon-900": "#342744",
  "neon-950": "#241b2f",
};

export default {
  darkMode: "class",
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.svelte",
  ],
  theme: {
    extend: {
      screens: {

      },
      textColor: neonSet,
      borderColor: neonSet,
      backgroundColor: neonSet,
      gradientColorStops: neonSet,
      fontFamily: {
        sans: [
          'Inter',
          // 'Overpass',
          // 'Montserrat',
          'sans-serif',
        ]
      }
    },
    variants: {
      extend: {
        display: ['print'],
      }
    }
  },
  plugins: [],
}
