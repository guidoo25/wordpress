<?php
/**
 * Bloques personalizados de Gutenberg para Landing Page
 * Sistema editable sin usar la interfaz tradicional de WordPress
 */

// Registrar bloques personalizados
add_action('acf/init', 'gs_register_landing_blocks');

function gs_register_landing_blocks() {
    // Verificar que ACF esté disponible
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    // Bloque: Hero Section
    acf_register_block_type(array(
        'name'              => 'gs-hero',
        'title'             => __('Hero Section GPS'),
        'description'       => __('Sección principal con título, descripción e imagen'),
        'render_template'   => 'template-parts/blocks/hero.php',
        'category'          => 'gs-landing',
        'icon'              => 'cover-image',
        'keywords'          => array('hero', 'banner', 'gps'),
        'mode'              => 'edit',
        'supports'          => array(
            'align' => false,
            'mode' => true,
            'jsx' => true
        )
    ));

    // Bloque: Beneficios/Características
    acf_register_block_type(array(
        'name'              => 'gs-benefits',
        'title'             => __('Beneficios Clave'),
        'description'       => __('Grid de 3 beneficios con iconos'),
        'render_template'   => 'template-parts/blocks/benefits.php',
        'category'          => 'gs-landing',
        'icon'              => 'grid-view',
        'keywords'          => array('benefits', 'features', 'características'),
        'mode'              => 'edit',
        'supports'          => array(
            'align' => false,
            'mode' => true,
            'jsx' => true
        )
    ));

    // Bloque: Productos y Servicios
    acf_register_block_type(array(
        'name'              => 'gs-products',
        'title'             => __('Productos y Servicios'),
        'description'       => __('Showcase de productos con imagen y descripción'),
        'render_template'   => 'template-parts/blocks/products.php',
        'category'          => 'gs-landing',
        'icon'              => 'products',
        'keywords'          => array('products', 'services', 'productos'),
        'mode'              => 'edit',
        'supports'          => array(
            'align' => false,
            'mode' => true,
            'jsx' => true
        )
    ));
}

// Agregar categoría personalizada para bloques
add_filter('block_categories_all', 'gs_block_categories', 10, 2);

function gs_block_categories($categories, $post) {
    return array_merge(
        array(
            array(
                'slug'  => 'gs-landing',
                'title' => __('Global System Landing', 'tailpress'),
                'icon'  => 'location-alt',
            ),
        ),
        $categories
    );
}

// Registrar campos ACF para los bloques
add_action('acf/init', 'gs_register_block_fields');

function gs_register_block_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // Campos para Hero Section
    acf_add_local_field_group(array(
        'key' => 'group_hero_landing',
        'title' => 'Hero Section - Configuración',
        'fields' => array(
            array(
                'key' => 'field_hero_pretitle',
                'label' => 'Pre-título',
                'name' => 'hero_pretitle',
                'type' => 'text',
                'default_value' => '¡GPS+ rastreó!',
            ),
            array(
                'key' => 'field_hero_title',
                'label' => 'Título Principal',
                'name' => 'hero_title',
                'type' => 'text',
                'required' => 1,
                'default_value' => 'Plataforma nova con la mejor GPS',
            ),
            array(
                'key' => 'field_hero_description',
                'label' => 'Descripción',
                'name' => 'hero_description',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Administrador completo de tracking GPS con reportes avanzados y monitoreo en tiempo real.',
            ),
            array(
                'key' => 'field_hero_button_text',
                'label' => 'Texto del Botón',
                'name' => 'hero_button_text',
                'type' => 'text',
                'default_value' => 'Agendar demo',
            ),
            array(
                'key' => 'field_hero_button_link',
                'label' => 'Enlace del Botón',
                'name' => 'hero_button_link',
                'type' => 'url',
            ),
            array(
                'key' => 'field_hero_image',
                'label' => 'Imagen Principal',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/gs-hero',
                ),
            ),
        ),
    ));

    // Campos para Beneficios
    acf_add_local_field_group(array(
        'key' => 'group_benefits_landing',
        'title' => 'Beneficios - Configuración',
        'fields' => array(
            array(
                'key' => 'field_benefits_title',
                'label' => 'Título de la Sección',
                'name' => 'benefits_title',
                'type' => 'text',
                'default_value' => 'Beneficios Clave',
            ),
            array(
                'key' => 'field_benefits_items',
                'label' => 'Items de Beneficios',
                'name' => 'benefits_items',
                'type' => 'repeater',
                'min' => 3,
                'max' => 3,
                'layout' => 'block',
                'button_label' => 'Agregar Beneficio',
                'sub_fields' => array(
                    array(
                        'key' => 'field_benefit_icon',
                        'label' => 'Icono',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => array(
                            'check-circle' => 'Check Circle',
                            'shield-alt' => 'Escudo',
                            'clock' => 'Reloj',
                            'location-arrow' => 'Ubicación',
                            'chart-line' => 'Gráfico',
                            'users' => 'Usuarios',
                        ),
                        'default_value' => 'check-circle',
                    ),
                    array(
                        'key' => 'field_benefit_title',
                        'label' => 'Título',
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_benefit_description',
                        'label' => 'Descripción',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/gs-benefits',
                ),
            ),
        ),
    ));

    // Campos para Productos
    acf_add_local_field_group(array(
        'key' => 'group_products_landing',
        'title' => 'Productos - Configuración',
        'fields' => array(
            array(
                'key' => 'field_products_pretitle',
                'label' => 'Pre-título',
                'name' => 'products_pretitle',
                'type' => 'text',
                'default_value' => 'Prihlizovanie',
            ),
            array(
                'key' => 'field_products_title',
                'label' => 'Título Principal',
                'name' => 'products_title',
                'type' => 'text',
                'default_value' => 'plataforma productos',
            ),
            array(
                'key' => 'field_products_description',
                'label' => 'Descripción',
                'name' => 'products_description',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ),
            array(
                'key' => 'field_products_button_text',
                'label' => 'Texto del Botón',
                'name' => 'products_button_text',
                'type' => 'text',
                'default_value' => 'Para a producto',
            ),
            array(
                'key' => 'field_products_button_link',
                'label' => 'Enlace del Botón',
                'name' => 'products_button_link',
                'type' => 'url',
            ),
            array(
                'key' => 'field_products_image',
                'label' => 'Imagen del Producto',
                'name' => 'products_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_products_reverse',
                'label' => 'Invertir diseño (imagen a la izquierda)',
                'name' => 'products_reverse',
                'type' => 'true_false',
                'default_value' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/gs-products',
                ),
            ),
        ),
    ));
}
