<?php

if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
    require_once __DIR__.'/vendor/autoload_packages.php';
}

function tailpress(): TailPress\Framework\Theme
{
    return TailPress\Framework\Theme::instance()
        ->assets(fn($manager) => $manager
            ->withCompiler(new TailPress\Framework\Assets\ViteCompiler, fn($compiler) => $compiler
                ->registerAsset('resources/css/app.css')
                ->registerAsset('resources/js/app.js')
                ->editorStyleFile('resources/css/editor-style.css')
            )
            ->enqueueAssets()
        )
        ->features(fn($manager) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
        ->menus(fn($manager) => $manager->add('primary', __( 'Primary Menu', 'tailpress')))
        ->themeSupport(fn($manager) => $manager->add([
            'title-tag',
            'custom-logo',
            'post-thumbnails',
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
            'html5' => [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        ]));
}

tailpress();

// Cargar campos personalizados para la página principal
if (is_file(__DIR__ . '/inc/custom-front-page.php')) {
    require_once __DIR__ . '/inc/custom-front-page.php';
}

// Cargar campos personalizados para páginas internas
if (is_file(__DIR__ . '/inc/custom-pages.php')) {
    require_once __DIR__ . '/inc/custom-pages.php';
}

// Cargar scripts para Meta Boxes
add_action('admin_enqueue_scripts', 'gs_enqueue_metabox_scripts');

function gs_enqueue_metabox_scripts($hook) {
    global $post;
    
    if (!$post || ($post->post_type !== 'page' && $post->post_type !== 'post')) {
        return;
    }
    
    // Cargar Media Library
    wp_enqueue_media();
    
    // Cargar script personalizado
    wp_enqueue_script(
        'gs-meta-boxes',
        get_theme_file_uri('/resources/js/meta-boxes.js'),
        array('jquery', 'media-upload'),
        filemtime(get_theme_file_path('/resources/js/meta-boxes.js'))
    );
}
