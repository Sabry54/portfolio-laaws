<section id="hero" class="relative overflow-hidden py-20 md:py-32 px-4 md:px-0 bg-gradient-to-br from-theme-light via-theme to-theme-light">
  <div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row items-center justify-between gap-12 md:gap-16">
      <!-- Contenu texte -->
      <div class="md:w-1/2 text-center md:text-left">
        <!-- H1 avec prénom en couleur d'accent -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 text-secondary leading-tight">
          Salut, je suis <span class="text-accent">Sabry</span> Ferrand
        </h1>
        
        <!-- Sous-titre / Description -->
        <p class="text-lg md:text-xl text-theme mb-8 leading-relaxed max-w-2xl mx-auto md:mx-0">
          Développeur WordPress passionné par le code propre et performant.
        </p>
        
        <!-- Phrase concise et percutante -->
        <p class="text-base md:text-lg text-theme-light mb-8 max-w-2xl mx-auto md:mx-0">
          Je transforme vos idées en solutions web performantes et élégantes.
        </p>
        
        <!-- Bouton CTA -->
        <div class="flex justify-center md:justify-start">
          <a href="#projects" class="bg-accent text-white px-8 py-4 rounded-lg hover:bg-accent-hover transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold text-base md:text-lg inline-block">
            Voir mes projets →
          </a>
        </div>
      </div>
      
      <!-- Image / Illustration -->
      <div class="md:w-1/2 mt-8 md:mt-0 flex justify-center md:justify-end">
        <div class="relative hero-image-container">
          <?php 
          $hero_image = portfolio_get_image_url_by_filename( 'kaizen.png' );
          if ( $hero_image ) : ?>
            <img 
              id="hero-image-3d"
              src="<?php echo esc_url( $hero_image ); ?>" 
              alt="Portfolio illustration - Kaizen" 
              class="hero-image-3d relative rounded-2xl shadow-2xl w-full max-w-md md:max-w-lg"
            >
          <?php else : ?>
            <img 
              id="hero-image-3d"
              src="https://via.placeholder.com/600x400" 
              alt="Portfolio illustration" 
              class="hero-image-3d relative rounded-2xl shadow-2xl w-full max-w-md md:max-w-lg"
            >
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
