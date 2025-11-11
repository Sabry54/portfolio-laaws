<?php
/**
 * Template Name: Galerie de Projets
 * Template Post Type: page
 * Description: Page template pour afficher une galerie de projets WordPress dynamique avec filtrage
 */

get_header(); ?>

<section id="gallery" class="py-24 bg-theme px-4 md:px-12">
  <div class="max-w-7xl mx-auto">
    <!-- En-tête de la galerie -->
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-secondary mb-4">Galerie de Projets</h1>
      <p class="text-lg text-theme max-w-2xl mx-auto">Découvrez mes réalisations, filtrées par catégorie</p>
    </div>

    <!-- Barre de filtres -->
    <div class="flex flex-wrap justify-center gap-3 md:gap-4 mb-12" id="gallery-filters">
      <button 
        class="filter-btn active px-6 py-3 rounded-lg font-semibold text-base md:text-lg transition-all duration-300 bg-accent text-white hover:bg-accent-hover shadow-md hover:shadow-lg transform hover:scale-105" 
        data-filter="all"
      >
        Tous
      </button>
      <?php
      // Récupérer les catégories de projets
      $categories = get_terms( array(
        'taxonomy' => 'categorie_projet',
        'hide_empty' => true,
      ) );

      if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
        foreach ( $categories as $category ) {
          $slug = sanitize_title( $category->name );
          ?>
          <button 
            class="filter-btn px-6 py-3 rounded-lg font-semibold text-base md:text-lg transition-all duration-300 bg-theme border-2 border-theme text-theme hover:bg-theme-light hover:border-accent hover:text-accent shadow-md hover:shadow-lg transform hover:scale-105" 
            data-filter="<?php echo esc_attr( $slug ); ?>"
          >
            <?php echo esc_html( $category->name ); ?>
          </button>
          <?php
        }
      }
      ?>
    </div>

    <!-- Grid des projets -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8" id="gallery-grid">
      <?php
      // Récupérer tous les projets
      $projets = new WP_Query( array(
        'post_type'      => 'projet',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'no_found_rows'  => true, // Optimisation
      ) );

      // Debug temporaire pour vérifier la requête
      if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        error_log( 'Galerie - Projets trouvés: ' . $projets->found_posts );
        error_log( 'Galerie - Post type: ' . $projets->query['post_type'] );
      }

      if ( $projets->have_posts() ) :
        while ( $projets->have_posts() ) : $projets->the_post();
          // Récupérer les catégories du projet
          $project_categories = get_the_terms( get_the_ID(), 'categorie_projet' );
          $category_slugs = array();
          $category_names = array();
          
          if ( $project_categories && ! is_wp_error( $project_categories ) ) {
            foreach ( $project_categories as $cat ) {
              $category_slugs[] = sanitize_title( $cat->name );
              $category_names[] = $cat->name;
            }
          }
          
          $category_classes = ! empty( $category_slugs ) ? implode( ' ', $category_slugs ) : '';
          $category_display = ! empty( $category_names ) ? $category_names[0] : 'Non catégorisé';
          
          // Image mise en avant
          $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
          if ( ! $thumbnail_url ) {
            $thumbnail_url = 'https://via.placeholder.com/600x400?text=' . urlencode( get_the_title() );
          }
          ?>
          <article 
            class="project-card gallery-item opacity-100 transform transition-all duration-500 ease-in-out" 
            data-categories="<?php echo esc_attr( $category_classes ); ?>"
          >
            <div class="bg-theme border border-theme rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group h-full flex flex-col">
              <!-- Image mise en avant -->
              <div class="relative overflow-hidden aspect-[4/3]">
                <img 
                  src="<?php echo esc_url( $thumbnail_url ); ?>" 
                  alt="<?php echo esc_attr( get_the_title() ); ?>" 
                  class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                  loading="lazy"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              </div>
              
              <!-- Contenu de la carte -->
              <div class="p-6 flex-grow flex flex-col">
                <h3 class="text-xl font-bold text-accent mb-3"><?php echo esc_html( get_the_title() ); ?></h3>
                
                <!-- Catégorie sous forme de tag/bouton -->
                <?php if ( ! empty( $category_names ) ) : ?>
                  <div class="mt-auto">
                    <?php foreach ( $category_names as $cat_name ) : 
                      $cat_slug = sanitize_title( $cat_name );
                    ?>
                      <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-accent/10 text-accent border border-accent/20 mr-2 mb-2">
                        <?php echo esc_html( $cat_name ); ?>
                      </span>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </article>
          <?php
        endwhile;
        wp_reset_postdata();
      else :
        ?>
        <div class="col-span-full text-center py-12">
          <p class="text-theme text-lg mb-4">Aucun projet trouvé.</p>
          <p class="text-theme-light text-sm">
            <?php
            // Vérifier si des projets existent mais ne sont pas publiés
            $all_projets = new WP_Query( array(
              'post_type'      => 'projet',
              'posts_per_page' => -1,
              'post_status'    => 'any', // Tous les statuts
            ) );
            
            if ( $all_projets->found_posts > 0 ) {
              echo 'Il y a ' . $all_projets->found_posts . ' projet(s) dans la base de données, mais aucun n\'est publié.';
            } else {
              echo 'Ajoutez des projets dans l\'administration WordPress (Projets → Ajouter un projet).';
            }
            wp_reset_postdata();
            ?>
          </p>
        </div>
        <?php
      endif;
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

<script>
// Script de filtrage des projets (Vanilla JavaScript, sans jQuery)
document.addEventListener('DOMContentLoaded', function() {
  const filterButtons = document.querySelectorAll('.filter-btn');
  const projectCards = document.querySelectorAll('.project-card');
  
  // Fonction pour filtrer les projets
  function filterProjects(filterValue) {
    let visibleCount = 0;
    
    projectCards.forEach(function(card) {
      const categories = card.getAttribute('data-categories') || '';
      const categoryArray = categories.split(' ').filter(cat => cat.length > 0);
      
      // Si "all" est sélectionné ou si la carte contient la catégorie sélectionnée
      const shouldShow = filterValue === 'all' || categoryArray.includes(filterValue);
      
      if (shouldShow) {
        // Afficher la carte avec animation fade-in
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(function() {
          card.style.display = 'block';
          card.style.opacity = '1';
          card.style.transform = 'translateY(0)';
        }, 50);
        
        visibleCount++;
      } else {
        // Masquer la carte avec animation fade-out
        card.style.opacity = '0';
        card.style.transform = 'translateY(-20px)';
        
        setTimeout(function() {
          card.style.display = 'none';
        }, 300);
      }
    });
    
    // Afficher un message si aucun projet n'est visible
    const grid = document.getElementById('gallery-grid');
    let noResultsMsg = document.getElementById('no-results-message');
    
    if (visibleCount === 0) {
      if (!noResultsMsg) {
        noResultsMsg = document.createElement('div');
        noResultsMsg.id = 'no-results-message';
        noResultsMsg.className = 'col-span-full text-center py-12';
        noResultsMsg.innerHTML = '<p class="text-theme text-lg">Aucun projet trouvé dans cette catégorie.</p>';
        grid.appendChild(noResultsMsg);
      }
    } else {
      if (noResultsMsg) {
        noResultsMsg.remove();
      }
    }
  }
  
  // Gérer les clics sur les boutons de filtre
  filterButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      const filterValue = this.getAttribute('data-filter');
      
      // Mettre à jour l'état actif des boutons
      filterButtons.forEach(function(btn) {
        btn.classList.remove('active', 'bg-accent', 'text-white', 'border-accent');
        btn.classList.add('bg-theme', 'border-theme', 'text-theme');
      });
      
      this.classList.add('active', 'bg-accent', 'text-white', 'border-accent');
      this.classList.remove('bg-theme', 'border-theme', 'text-theme');
      
      // Filtrer les projets
      filterProjects(filterValue);
    });
  });
  
  // Initialiser l'affichage (tous les projets visibles)
  projectCards.forEach(function(card) {
    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    card.style.opacity = '1';
    card.style.transform = 'translateY(0)';
  });
});
</script>

<?php get_footer(); ?>

