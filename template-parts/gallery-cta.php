<!-- Section CTA vers la galerie -->
<section class="py-16 md:py-20 bg-gradient-to-br from-theme-light via-theme to-theme-section px-4 md:px-0 relative overflow-hidden">
  <div class="max-w-4xl mx-auto text-center relative z-10">
    <div class="gallery-cta-content">
      <h2 class="text-2xl md:text-3xl font-bold text-secondary mb-4">Découvrez ma galerie</h2>
      <p class="text-theme text-lg mb-8 max-w-2xl mx-auto">Quelques créations visuelles et projets en images</p>
      <a 
        href="<?php echo esc_url(portfolio_get_gallery_url()); ?>" 
        class="gallery-cta-button inline-flex items-center gap-3 bg-accent text-white px-8 py-4 rounded-lg font-semibold text-base md:text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 group"
      >
        <span>Voir la galerie</span>
        <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
      </a>
    </div>
  </div>
  
  <!-- Effet de lumière animé en arrière-plan -->
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-accent rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
  </div>
</section>

