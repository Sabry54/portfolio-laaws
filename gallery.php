<?php
/**
 * Template Name: Galerie
 * Description: Page template pour afficher une galerie d'images
 */

get_header(); ?>

<section id="gallery" class="py-24 bg-theme px-4 md:px-12">
  <div class="max-w-7xl mx-auto">
    <!-- En-tête de la galerie -->
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-secondary mb-4">Galerie</h1>
      <p class="text-lg text-theme max-w-2xl mx-auto">Quelques créations visuelles et projets en images</p>
    </div>

    <!-- Grid de la galerie -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6" id="gallery-grid">
      <?php
      // Images de la galerie - vous pouvez les remplacer par des images de la médiathèque
      $gallery_images = [
        '002.png',
        'theme.png',
        'monsite.png',
        'kaizen.png',
      ];
      
      foreach($gallery_images as $image_name):
        $image_url = portfolio_get_image_url_by_filename($image_name);
        if ($image_url):
      ?>
        <div class="gallery-item group relative overflow-hidden rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer aspect-square">
          <img 
            src="<?php echo esc_url($image_url); ?>" 
            alt="<?php echo esc_attr($image_name); ?>" 
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            data-gallery-image="<?php echo esc_url($image_url); ?>"
            data-gallery-title="<?php echo esc_attr($image_name); ?>"
          >
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="absolute bottom-4 left-4 right-4">
              <p class="text-white text-sm font-medium truncate"><?php echo esc_html(pathinfo($image_name, PATHINFO_FILENAME)); ?></p>
            </div>
          </div>
        </div>
      <?php 
        endif;
      endforeach; 
      ?>
    </div>
  </div>
</section>

<!-- Modal pour afficher les images en grand -->
<div id="gallery-modal" class="gallery-modal hidden">
  <div class="gallery-modal__backdrop" data-gallery-close></div>
  <div class="gallery-modal__content" role="dialog" aria-modal="true">
    <button type="button" class="gallery-modal__close" data-gallery-close aria-label="Fermer l'image">
      &times;
    </button>
    <img id="gallery-modal-image" src="" alt="" class="gallery-modal__image">
    <p id="gallery-modal-title" class="gallery-modal__title text-secondary text-lg font-semibold mt-4"></p>
  </div>
</div>

<?php get_footer(); ?>

