<?php
// Sécurité : empêche un accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue styles et scripts du thème
 */
function portfolio_theme_enqueue() {
    // CSS principal
    wp_enqueue_style( 'portfolio-style', get_stylesheet_uri() );

    // JS 
    wp_enqueue_script( 'portfolio-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'portfolio_theme_enqueue' );

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
 * Menu par défaut si aucun menu n'est configuré (Desktop)
 */
function portfolio_default_menu() {
    // URL GitHub - à modifier selon votre profil
    $github_url = 'https://github.com/votre-profil'; // Remplacez par votre URL GitHub
    
    echo '<ul class="flex items-center space-x-1 xl:space-x-2">';
    echo '<li><a href="#hero" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">Accueil</a></li>';
    echo '<li><a href="#skills" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">Compétences</a></li>';
    echo '<li><a href="#projects" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">Projets</a></li>';
    echo '<li><a href="#contact" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">Contact</a></li>';
    echo '<li><a href="' . esc_url( $github_url ) . '" target="_blank" rel="noopener noreferrer" class="menu-link-underline px-3 py-2 text-theme hover:text-primary transition font-medium">GitHub</a></li>';
    echo '</ul>';
}

/**
 * Menu par défaut si aucun menu n'est configuré (Mobile)
 */
function portfolio_default_menu_mobile() {
    // URL GitHub - à modifier selon votre profil
    $github_url = 'https://github.com/votre-profil'; // Remplacez par votre URL GitHub
    
    echo '<ul class="flex flex-col space-y-1">';
    echo '<li><a href="#hero" class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">Accueil</a></li>';
    echo '<li><a href="#skills" class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">Compétences</a></li>';
    echo '<li><a href="#projects" class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">Projets</a></li>';
    echo '<li><a href="#contact" class="menu-link-underline-mobile block px-4 py-3 text-theme hover:bg-theme-light hover:text-primary rounded-md transition font-medium">Contact</a></li>';
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
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

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
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

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