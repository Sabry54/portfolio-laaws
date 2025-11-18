/**
 * @type {import('tailwindcss').Config}
 *
 * NOTE maintenance :
 * - Lancer `npm run dev:css` pendant le dev pour watcher Tailwind.
 * - Lancer `npm run build:css` avant déploiement pour régénérer `assets/css/tailwind.css`.
 * - Si le site paraît sans styles, vérifier que ce CSS compilé est bien daté et chargé.
 */
module.exports = {
  // Analyse tous les fichiers PHP/JS du thème pour générer uniquement les classes utilisées
  content: [
    "./*.php",
    "./**/*.php",
    "./js/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

