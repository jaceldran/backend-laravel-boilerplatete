/** @type {import('tailwindcss').Config} */

import tailwind from "tailwindcss/colors";

const neon = {
  50: "#EFEBF4",
  100: "#DFD8E8",
  150: "#CFC4DD",
  200: "#BFB0D2",
  250: "#AF9DC6",
  300: "#A089BB",
  350: "#9075B0",
  400: "#8062A5",
  500: "#715493",
  600: "#61497F",
  700: "#523E6C",
  800: "#433358",
  900: "#342744",
  950: "#241b2f",
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
      colors: { neon },
      textColor: {
        lightest: tailwind.slate[100],
        lighter: tailwind.slate[200],
        light: tailwind.slate[300],
        normal: tailwind.slate[600],
        dark: tailwind.slate[800],
        // darker: "#222",

        // lightest: "#ddd",
        // lighter: "#a6a6a6",
        // light: "#999",
        // normal: "#444",
        // dark: "#333",
        // darker: "#222",
      },
      borderColor: {
        // normal: tailwind.slate[600],
        dark: tailwind.slate[600],
      },
      backgroundColor: {
        light: tailwind.stone[50],
        normal: tailwind.stone[100],
        dark: tailwind.slate[700],
        darker: tailwind.slate[800],
        darkest: tailwind.slate[950],
      },
      // gradientColorStops: colorSet,
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
