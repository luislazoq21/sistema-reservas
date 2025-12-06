/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // La ruta a todas tus vistas PHP donde usas clases de Tailwind
    './resources/views/**/*.php', 
    './public/**/*.js', // Si usas archivos JS
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}