/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'goappy-primary': '#6366f1',
        'goappy-secondary': '#8b5cf6',
        'goappy-accent': '#ec4899',
      },
    },
  },
  plugins: [],
}
