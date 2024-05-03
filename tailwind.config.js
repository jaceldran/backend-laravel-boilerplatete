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
        lightest: tailwind.gray[100],
        lighter: tailwind.gray[200],
        light: tailwind.gray[300],
        normal: tailwind.gray[600],
        lessdark: tailwind.gray[400],
        dark: tailwind.gray[800],
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
