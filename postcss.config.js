// postcss.config.js
module.exports = {
  plugins: {
    'tailwindcss/nesting': {}, // Este es importante si usas anidamiento
    tailwindcss: {},
    autoprefixer: {}, // Opcional, pero recomendado
  }
}