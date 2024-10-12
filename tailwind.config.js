/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./webInterface/**/*"],
  theme: {
    extend: {
      colors: {
        'primary': '#313338',
        'secondary': '#1e1f22',
        'accent': '#0F7676',
        'shadow': '#0c0d0f'
      },
    },
  },
  plugins: [],
}

