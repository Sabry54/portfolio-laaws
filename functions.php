<?php
// Sécurité : empêche un accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue styles et scripts du thème
 */
function portfolio_theme_enqueue() {
    // Charger le CSS Tailwind compilé localement s'il est disponible
    $tailwind_path = get_template_directory() . '/assets/css/tailwind.css';
    $style_dependencies = array();

    if ( file_exists( $tailwind_path ) ) {
        wp_enqueue_style(
            'portfolio-tailwind',
            get_template_directory_uri() . '/assets/css/tailwind.css',
            array(),
            filemtime( $tailwind_path )
        );
        $style_dependencies[] = 'portfolio-tailwind';
    }

    // CSS principal du thème (style.css) pour les règles personnalisées
    $style_path = get_stylesheet_directory() . '/style.css';
    $style_version = file_exists( $style_path ) ? filemtime( $style_path ) : null;

    wp_enqueue_style(
        'portfolio-style',
        get_stylesheet_uri(),
        $style_dependencies,
        $style_version
    );

    // JS principal avec version basée sur la date de modification pour le cache busting
    $script_path = get_template_directory() . '/js/main.js';
    $script_version = file_exists( $script_path ) ? filemtime( $script_path ) : null;

    wp_enqueue_script(
        'portfolio-script',
        get_template_directory_uri() . '/js/main.js',
        array( 'jquery' ),
        $script_version,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'portfolio_theme_enqueue' );

/**
 * Support des fonctionnalités du thème
 */
function portfolio_theme_setup() {
    // Support des images mises en avant
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 800, 600, true );
    
    // Support des titres automatiques
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'portfolio_theme_setup' );

/**
 * Enregistrement des menus
 */
function portfolio_theme_menus() {
    register_nav_menus( array(
        'main-menu' => 'Menu Principal',
    ) );
}
add_action( 'after_setup_theme', 'portfolio_theme_menus' );

/**
 * Fonction helper pour gérer les URLs d'ancres (redirige vers la page d'accueil si nécessaire)
 */
function portfolio_fix_anchor_url( $url ) {
    if ( empty( $url ) ) {
        return $url;
    }
    
    // Si c'est une ancre simple (commence par #)
    if ( strpos( $url, '#' ) === 0 ) {
        // Vérifier si on est sur la page d'accueil
        $is_home = is_front_page() || is_home();
        
        if ( ! $is_home ) {
            // Si on n'est pas sur la page d'accueil, rediriger vers la page d'accueil avec l'ancre
            return home_url( '/' ) . $url;
        }
    }
    // Si l'URL contient une ancre mais pointe vers la page d'accueil
    elseif ( strpos( $url, '#' ) !== false && strpos( $url, home_url() ) === 0 ) {
        // Extraire l'ancre
        $anchor = substr( $url, strpos( $url, '#' ) );
        $is_home = is_front_page() || is_home();
        
        if ( ! $is_home ) {
            // Rediriger vers la page d'accueil avec l'ancre
            return home_url( '/' ) . $anchor;
        }
    }
    
    return $url;
}

/**
 * Menu par défaut si aucun menu n'est configuré (Desktop)
 */
function portfolio_default_menu() {
    // URL GitHub - à modifier selon votre profil
    $github_url = 'https://github.com/sabry54';
    
    // URLs des ancres avec redirection vers la page d'accueil si nécessaire
    $hero_url = portfolio_fix_anchor_url( '#hero' );
    $skills_url = portfolio_fix_anchor_url( '#skills' );
    $projects_url = portfolio_fix_anchor_url( '#projects' );
    $contact_url = portfolio_fix_anchor_url( '#contact' );
    $gallery_url = portfolio_get_gallery_url();
    
    echo '<ul class="flex items-center space-x-1 xl:space-x-2">';
    echo '<li><a href="' . esc_url( $hero_url ) . '" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">Accueil</a></li>';
    echo '<li><a href="' . esc_url( $skills_url ) . '" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">Compétences</a></li>';
    echo '<li><a href="' . esc_url( $projects_url ) . '" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">Projets</a></li>';
    echo '<li><a href="' . esc_url( $gallery_url ) . '" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">Galerie</a></li>';
    echo '<li><a href="' . esc_url( $contact_url ) . '" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">Contact</a></li>';
    echo '<li><a href="' . esc_url( $github_url ) . '" target="_blank" rel="noopener noreferrer" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">GitHub</a></li>';
    echo '</ul>';
}

/**
 * Menu par défaut si aucun menu n'est configuré (Mobile)
 */
function portfolio_default_menu_mobile() {
    // URL GitHub - à modifier selon votre profil
    $github_url = 'https://github.com/sabry54';
    
    // URLs des ancres avec redirection vers la page d'accueil si nécessaire
    $hero_url = portfolio_fix_anchor_url( '#hero' );
    $skills_url = portfolio_fix_anchor_url( '#skills' );
    $projects_url = portfolio_fix_anchor_url( '#projects' );
    $contact_url = portfolio_fix_anchor_url( '#contact' );
    $gallery_url = portfolio_get_gallery_url();
    
    echo '<ul class="flex flex-col space-y-1">';
    echo '<li><a href="' . esc_url( $hero_url ) . '" class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">Accueil</a></li>';
    echo '<li><a href="' . esc_url( $skills_url ) . '" class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">Compétences</a></li>';
    echo '<li><a href="' . esc_url( $projects_url ) . '" class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">Projets</a></li>';
    echo '<li><a href="' . esc_url( $gallery_url ) . '" class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">Galerie</a></li>';
    echo '<li><a href="' . esc_url( $contact_url ) . '" class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">Contact</a></li>';
    echo '<li><a href="' . esc_url( $github_url ) . '" target="_blank" rel="noopener noreferrer" class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">GitHub</a></li>';
    echo '</ul>';
}

/**
 * Walker pour le menu desktop
 */
class Portfolio_Menu_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        // Vérifier si c'est un lien externe
        $is_external = ! empty( $item->url ) && ( strpos( $item->url, home_url() ) === false && strpos( $item->url, '#' ) !== 0 );
        
        $attributes = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        
        // Si c'est un lien externe sans target défini, ajouter target="_blank" et rel
        if ( $is_external && empty( $item->target ) ) {
            $attributes .= ' target="_blank" rel="noopener noreferrer"';
        }
        
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        
        // Gérer les URLs d'ancres (rediriger vers la page d'accueil si nécessaire)
        $item_url = ! empty( $item->url ) ? $item->url : '';
        $item_url = portfolio_fix_anchor_url( $item_url );
        $attributes .= ' href="' . esc_attr( $item_url ) . '"';

        $item_output = isset( $args->before ) ? $args->before : '';
        $item_output .= '<a' . $attributes . ' class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">';
        $item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . apply_filters( 'the_title', $item->title, $item->ID ) . ( isset( $args->link_after ) ? $args->link_after : '' );
        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Walker pour le menu mobile
 */
class Portfolio_Mobile_Menu_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        // Vérifier si c'est un lien externe
        $is_external = ! empty( $item->url ) && ( strpos( $item->url, home_url() ) === false && strpos( $item->url, '#' ) !== 0 );
        
        $attributes = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        
        // Si c'est un lien externe sans target défini, ajouter target="_blank" et rel
        if ( $is_external && empty( $item->target ) ) {
            $attributes .= ' target="_blank" rel="noopener noreferrer"';
        }
        
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        
        // Gérer les URLs d'ancres (rediriger vers la page d'accueil si nécessaire)
        $item_url = ! empty( $item->url ) ? $item->url : '';
        $item_url = portfolio_fix_anchor_url( $item_url );
        $attributes .= ' href="' . esc_attr( $item_url ) . '"';

        $item_output = isset( $args->before ) ? $args->before : '';
        $item_output .= '<a' . $attributes . ' class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">';
        $item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . apply_filters( 'the_title', $item->title, $item->ID ) . ( isset( $args->link_after ) ? $args->link_after : '' );
        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Récupère l'URL d'une image depuis la médiathèque WordPress par son nom de fichier
 */
function portfolio_get_image_url_by_filename( $filename ) {
    global $wpdb;
    
    $attachment = $wpdb->get_col( $wpdb->prepare( 
        "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND guid LIKE %s", 
        '%' . $wpdb->esc_like( $filename ) . '%' 
    ) );
    
    if ( ! empty( $attachment ) ) {
        $image_url = wp_get_attachment_image_url( $attachment[0], 'full' );
        return $image_url;
    }
    
    // Fallback : chercher par nom de fichier dans les posts
    $attachment = get_posts( array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => 1,
        'post_status' => 'inherit',
        'meta_query' => array(
            array(
                'key' => '_wp_attached_file',
                'value' => $filename,
                'compare' => 'LIKE'
            )
        )
    ) );
    
    if ( ! empty( $attachment ) ) {
        return wp_get_attachment_image_url( $attachment[0]->ID, 'full' );
    }
    
    return '';
}

/**
 * Crée automatiquement la page Galerie lors de l'activation du thème
 */
function portfolio_create_gallery_page() {
    // Vérifier si la page existe déjà
    $page_slug = 'galerie';
    $page = get_page_by_path( $page_slug );
    
    if ( ! $page ) {
        // Créer la page
        $page_data = array(
            'post_title'    => 'Galerie',
            'post_name'     => $page_slug,
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
        );
        
        $page_id = wp_insert_post( $page_data );
        
        // Assigner le template "Galerie de Projets" à la page
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            // Utiliser le template page-galerie.php (WordPress le détecte automatiquement par le slug)
            // Mais on peut aussi forcer avec le nom du template
            $template_file = locate_template( 'page-galerie.php' );
            if ( $template_file ) {
                update_post_meta( $page_id, '_wp_page_template', 'page-galerie.php' );
            }
        }
    } else {
        // Si la page existe déjà, s'assurer qu'elle utilise le bon template
        $template_file = locate_template( 'page-galerie.php' );
        if ( $template_file ) {
            update_post_meta( $page->ID, '_wp_page_template', 'page-galerie.php' );
        }
    }
}
add_action( 'after_switch_theme', 'portfolio_create_gallery_page' );

/**
 * Crée la page Galerie immédiatement si elle n'existe pas (pour les thèmes déjà actifs)
 */
function portfolio_check_gallery_page() {
    $page_slug = 'galerie';
    $page = get_page_by_path( $page_slug );
    
    if ( ! $page ) {
        portfolio_create_gallery_page();
    }
}
add_action( 'init', 'portfolio_check_gallery_page' );

/**
 * Retourne l'URL de la page Galerie, en la créant si nécessaire
 */
function portfolio_get_gallery_url() {
    $page_slug = 'galerie';
    $page = get_page_by_path( $page_slug );
    
    if ( ! $page ) {
        portfolio_create_gallery_page();
        // Recharger la page après création
        $page = get_page_by_path( $page_slug );
    }
    
    if ( $page ) {
        return get_permalink( $page->ID );
    }
    
    // Fallback
    return home_url( '/galerie' );
}

/**
 * NOTE: Le code des projets a été déplacé dans le plugin "Portfolio Projets"
 * Le plugin se trouve dans: /wp-content/plugins/portfolio-projets/
 * 
 * Le thème garde uniquement le template d'affichage (page-galerie.php)
 */