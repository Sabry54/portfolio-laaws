<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- GSAP CDN -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="bg-theme shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">
            <!-- Logo / Nom du site -->
            <div class="flex-shrink-0">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-xl md:text-2xl font-bold text-secondary hover:text-primary transition">
                    <?php bloginfo('name'); ?>
                </a>
            </div>

            <!-- Menu Desktop -->
            <nav class="hidden lg:flex items-center space-x-1 xl:space-x-2 flex-1 justify-center">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => 'flex items-center space-x-1 xl:space-x-2',
                    'fallback_cb' => 'portfolio_default_menu',
                    'walker' => new Portfolio_Menu_Walker(),
                ) );
                ?>
            </nav>

            <!-- Menu Mobile Toggle -->
            <div class="flex items-center space-x-3 md:space-x-4">
                <!-- Bouton Menu Mobile -->
                <button id="mobile-menu-toggle" class="lg:hidden p-2 rounded-md text-theme hover:text-primary hover:bg-theme-light focus:outline-none focus:ring-2 focus:ring-primary" aria-label="Menu">
                    <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="lg:hidden hidden border-t border-theme bg-theme">
        <div class="px-4 pt-2 pb-4 space-y-1">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'flex flex-col space-y-1',
                'fallback_cb' => 'portfolio_default_menu_mobile',
                'walker' => new Portfolio_Mobile_Menu_Walker(),
            ) );
            ?>
        </div>
    </div>
</header>

<script>
// Toggle menu mobile
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('mobile-menu-toggle');
    const menu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    if (toggle && menu) {
        toggle.addEventListener('click', function() {
            menu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Fermer le menu quand on clique sur un lien
        const menuLinks = menu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                menu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            });
        });
    }
});
</script>
