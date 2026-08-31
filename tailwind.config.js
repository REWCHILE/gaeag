/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./app/**/*.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      colors: {
        gae: {
          green: '#277017',
          'green-dark': '#1e5812',
          blue: '#1a6494',
          'blue-dark': '#134e75',
          amber: '#f59e0b',
        }
      }
    },
  },
  plugins: [],
}
