<section id="projects" class="py-24 bg-theme px-4 md:px-12">
  <div class="max-w-6xl mx-auto">
    <!-- Titre et description -->
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">Projets récents</h2>
      <p class="text-lg text-theme max-w-2xl mx-auto">Découvrez quelques-uns de mes projets WordPress, du développement sur mesure à l'optimisation de performances.</p>
    </div>

    <!-- Grid des projets -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php
      $projects = [
        [
          'title' => 'Site Client 1',
          'description' => 'Site WordPress sur mesure avec thème personnalisé et intégrations API.',
          'image' => 'https://via.placeholder.com/600x400',
          'tags' => ['WordPress', 'PHP', 'Tailwind'],
          'link' => '#'
        ],
        [
          'title' => 'Site Client 2',
          'description' => 'E-commerce WordPress avec WooCommerce et optimisations de performance.',
          'image' => 'https://via.placeholder.com/600x400',
          'tags' => ['WordPress', 'WooCommerce', 'JavaScript'],
          'link' => '#'
        ],
        [
          'title' => 'Plugin personnalisé',
          'description' => 'Plugin WordPress développé sur mesure pour automatiser des workflows spécifiques.',
          'image' => 'https://via.placeholder.com/600x400',
          'tags' => ['WordPress', 'PHP', 'API'],
          'link' => '#'
        ],
      ];
      
      foreach($projects as $project): ?>
        <div class="project-card bg-theme border border-theme rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">
          <!-- Image avec effet hover -->
          <div class="relative overflow-hidden h-48 md:h-56">
            <img 
              src="<?php echo esc_url($project['image']); ?>" 
              alt="<?php echo esc_attr($project['title']); ?>" 
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
          
          <!-- Contenu de la card -->
          <div class="p-6">
            <h3 class="text-xl font-bold text-accent mb-3"><?php echo esc_html($project['title']); ?></h3>
            <p class="text-theme text-sm mb-4 leading-relaxed"><?php echo esc_html($project['description']); ?></p>
            
            <!-- Tags technologies -->
            <div class="flex flex-wrap gap-2 mb-4">
              <?php foreach($project['tags'] as $tag): ?>
                <span class="px-3 py-1 bg-theme-light text-theme text-xs font-medium rounded-full border border-theme">
                  <?php echo esc_html($tag); ?>
                </span>
              <?php endforeach; ?>
            </div>
            
            <!-- Lien vers le projet -->
            <a 
              href="<?php echo esc_url($project['link']); ?>" 
              class="inline-flex items-center text-accent hover:text-accent-hover font-semibold text-sm transition-colors duration-300 group/link"
            >
              Voir le projet
              <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
