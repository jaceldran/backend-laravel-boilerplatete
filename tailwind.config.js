/** @type {import('tailwindcss').Config} */
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
      fontFamily: {
        sans: [
          'Overpass',
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
