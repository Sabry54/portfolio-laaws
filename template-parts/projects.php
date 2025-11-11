<section id="projects" class="py-24 bg-theme px-4 md:px-12">
  <div class="max-w-6xl mx-auto">
    <!-- Titre et description -->
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">Projets récents</h2>
      <p class="text-lg text-theme max-w-2xl mx-auto">Découvrez quelques-uns de mes derniers projets, design, développement, optimisation, etc.</p>
    </div>

    <!-- Grid des projets -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php
      $project_1_image = portfolio_get_image_url_by_filename('002.png');
      $project_2_image = portfolio_get_image_url_by_filename('theme.png');
      $project_3_image = portfolio_get_image_url_by_filename('monsite.png');
      $projects = [
        [
          'title' => 'SF002',
          'description' => 'Composition aléatoire avec une image générée par Midjourney',
          'image' => $project_1_image ? $project_1_image : 'https://via.placeholder.com/600x400',
          'tags' => ['Midjourney', 'Photoshop'],
          'link' => 'https://www.instagram.com/p/DP0jPnUjL7d/',
          'link_text' => 'Un petit like svp :3'
        ],
        [
          'title' => 'Thème WordPress custom',
          'description' => 'Thème WordPress sur mesure avec intégration de plugins et API',
          'image' => $project_2_image ? $project_2_image : 'https://via.placeholder.com/600x400',
          'tags' => ['WordPress', 'Cursor', 'ChatGPT' , 'Github'],
          'link' => '',
          'link_text' => 'you are already here ^^'
        ],
        [
          'title' => 'Site web personnel',
          'description' => 'Site web developpé avec Cursor uniquement, de base un challenge transformé en CV en ligne',
          'image' => $project_3_image ? $project_3_image : 'https://via.placeholder.com/600x400',
          'tags' => ['Cursor'  , 'Me', 'Myself', 'and I'],
          'link' => 'https://www.ferrandsabry.fr/',
          'link_text' => 'Vers le site'
        ],
      ];
      
      foreach($projects as $project): ?>
        <div class="project-card bg-theme border border-theme rounded-xl shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group">
          <!-- Image avec effet hover -->
          <button 
            type="button" 
            class="relative overflow-hidden h-48 md:h-56 w-full cursor-pointer group/image"
            data-project-image="<?php echo esc_url($project['image']); ?>"
            data-project-title="<?php echo esc_attr($project['title']); ?>"
          >
            <img 
              src="<?php echo esc_url($project['image']); ?>" 
              alt="<?php echo esc_attr($project['title']); ?>" 
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 group-hover/image:scale-110"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-hover/image:opacity-100"></div>
            <span class="sr-only">Agrandir l'image du projet <?php echo esc_html($project['title']); ?></span>
          </button>
          
          <!-- Contenu de la card -->
          <div class="p-6">
            <h3 class="text-xl font-bold text-accent mb-2"><?php echo esc_html($project['title']); ?></h3>
            <p class="text-xs uppercase tracking-wide text-theme-light mb-3">
              <?php echo esc_html(implode(' • ', $project['tags'])); ?>
            </p>
            <p class="text-theme text-sm mb-4 leading-relaxed"><?php echo esc_html($project['description']); ?></p>
            
            <!-- Tags technologies -->
            <div class="flex flex-wrap gap-2 mb-4">
              <?php foreach($project['tags'] as $tag): ?>
                <span class="px-3 py-1 bg-theme-light text-theme text-xs font-medium rounded-full border border-theme">
                  <?php echo esc_html($tag); ?>
                </span>
              <?php endforeach; ?>
            </div>
            
            <?php if ( ! empty( $project['link'] ) && ! empty( $project['link_text'] ) ) : ?>
              <a 
                href="<?php echo esc_url($project['link']); ?>" 
                target="_blank" 
                rel="noopener noreferrer"
                class="inline-flex items-center text-accent hover:text-accent-hover font-semibold text-sm transition-colors duration-300 group/link"
              >
                <?php echo esc_html( $project['link_text'] ); ?>
                <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            <?php elseif ( empty( $project['link'] ) && ! empty( $project['link_text'] ) ) : ?>
              <span class="inline-flex items-center text-accent font-semibold text-sm">
                <?php echo esc_html( $project['link_text'] ); ?>
              </span>
            <?php endif; ?>
            
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
    <!-- Modal d'affichage des images de projets -->
    <div id="project-image-modal" class="project-image-modal hidden">
      <div class="project-image-modal__backdrop" data-project-image-close></div>
      <div class="project-image-modal__content" role="dialog" aria-modal="true" aria-labelledby="project-image-modal-title">
        <button type="button" class="project-image-modal__close" data-project-image-close aria-label="Fermer l'image">
          &times;
        </button>
        <h3 id="project-image-modal-title" class="project-image-modal__title text-secondary text-lg font-semibold mb-4"></h3>
        <div class="project-image-modal__image-wrapper">
          <img id="project-image-modal-image" src="" alt="" class="project-image-modal__image">
        </div>
      </div>
    </div>
  </div>
</section>
