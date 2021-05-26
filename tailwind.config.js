const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false,
  theme: {
    colors: {
      gray: colors.gray,
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      red: colors.red,
      yellow: colors.yellow,
      orange: colors.orange,
      blue: colors.blue,
      green: colors.green
    },
    extend: {
      fontFamily: {
        sans: ['Inter var'],
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
