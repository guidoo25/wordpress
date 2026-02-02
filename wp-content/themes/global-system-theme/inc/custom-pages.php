<?php
/**
 * Custom Meta Boxes para todas las páginas editables
 * Permite crear y editar contenido de productos, servicios, galerías, etc.
 */

// Registrar Meta Boxes para pages editables
add_action('add_meta_boxes', 'gs_register_page_metaboxes');

function gs_register_page_metaboxes() {
    // Solo para páginas (no posts ni custom post types)
    add_meta_box(
        'gs_page_settings',
        'Configuración de Página',
        'gs_page_settings_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gs_hero_section_page',
        'Sección Hero',
        'gs_hero_section_page_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gs_products_section',
        'Sección de Productos',
        'gs_products_section_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gs_services_section',
        'Sección de Servicios',
        'gs_services_section_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gs_gallery_section',
        'Sección Galería',
        'gs_gallery_section_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gs_contact_section',
        'Sección de Contacto',
        'gs_contact_section_callback',
        'page',
        'normal',
        'high'
    );
}

/**
 * Meta Box: Configuración General de Página
 */
function gs_page_settings_callback($post) {
    wp_nonce_field('gs_page_settings_nonce', 'gs_page_settings_nonce');
    
    $page_type = get_post_meta($post->ID, 'gs_page_type', true) ?: 'default';
    $enable_hero = get_post_meta($post->ID, 'gs_enable_hero', true);
    
    ?>
    <div class="gs-settings-group">
        <label for="gs_enable_hero">
            <input type="checkbox" name="gs_enable_hero" id="gs_enable_hero" value="1" 
                <?php checked($enable_hero, 1); ?>>
            <strong>Mostrar sección Hero</strong>
        </label>
        <p class="description">Añade una sección de introducción al inicio de la página</p>
        
        <hr style="margin: 20px 0;">
        
        <label for="gs_page_type" style="display: block; margin-bottom: 10px;">
            <strong>Tipo de Página:</strong>
        </label>
        <select name="gs_page_type" id="gs_page_type">
            <option value="default" <?php selected($page_type, 'default'); ?>>Página por defecto</option>
            <option value="products" <?php selected($page_type, 'products'); ?>>Productos y Servicios</option>
            <option value="services" <?php selected($page_type, 'services'); ?>>Servicios</option>
            <option value="about" <?php selected($page_type, 'about'); ?>>Sobre Nosotros</option>
            <option value="gallery" <?php selected($page_type, 'gallery'); ?>>Galería</option>
        </select>
        <p class="description">Elige el tipo de página para mostrar secciones específicas</p>
    </div>
    <?php
}

/**
 * Meta Box: Sección Hero para Páginas
 */
function gs_hero_section_page_callback($post) {
    wp_nonce_field('gs_hero_page_nonce', 'gs_hero_page_nonce');
    
    $hero_title = get_post_meta($post->ID, 'gs_hero_title', true);
    $hero_subtitle = get_post_meta($post->ID, 'gs_hero_subtitle', true);
    $hero_image_id = get_post_meta($post->ID, 'gs_hero_image_id', true);
    $hero_image_url = $hero_image_id ? wp_get_attachment_url($hero_image_id) : '';
    
    ?>
    <div class="gs-hero-group">
        <div class="form-group" style="margin-bottom: 20px;">
            <label for="gs_hero_title" style="display: block; margin-bottom: 8px;">
                <strong>Título del Hero:</strong>
            </label>
            <input type="text" name="gs_hero_title" id="gs_hero_title" 
                value="<?php echo esc_attr($hero_title); ?>" 
                placeholder="Ej: Nuestros Productos y Servicios"
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label for="gs_hero_subtitle" style="display: block; margin-bottom: 8px;">
                <strong>Subtítulo del Hero:</strong>
            </label>
            <textarea name="gs_hero_subtitle" id="gs_hero_subtitle" rows="4"
                placeholder="Descripción adicional..."
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"><?php echo wp_kses_post($hero_subtitle); ?></textarea>
        </div>
        
        <div class="form-group">
            <label style="display: block; margin-bottom: 8px;">
                <strong>Imagen del Hero:</strong>
            </label>
            <input type="hidden" name="gs_hero_image_id" id="gs_hero_image_id" value="<?php echo esc_attr($hero_image_id); ?>">
            <div id="gs_hero_image_preview" style="margin-bottom: 10px;">
                <?php if ($hero_image_url): ?>
                    <img src="<?php echo esc_url($hero_image_url); ?>" style="max-width: 300px; height: auto;">
                <?php endif; ?>
            </div>
            <button type="button" class="button button-secondary gs-media-upload" data-target="gs_hero_image_id">
                Subir Imagen
            </button>
        </div>
    </div>
    <?php
}

/**
 * Meta Box: Sección de Productos
 */
function gs_products_section_callback($post) {
    wp_nonce_field('gs_products_nonce', 'gs_products_nonce');
    
    $products = get_post_meta($post->ID, 'gs_products', true) ?: array();
    
    ?>
    <div class="gs-products-group">
        <p class="description">Añade hasta 6 productos principales</p>
        
        <div id="gs_products_list" style="margin: 20px 0;">
            <?php
            for ($i = 0; $i < 6; $i++) {
                $product = $products[$i] ?? array();
                $product_title = $product['title'] ?? '';
                $product_desc = $product['desc'] ?? '';
                $product_image_id = $product['image_id'] ?? '';
                $product_image_url = $product_image_id ? wp_get_attachment_url($product_image_id) : '';
                
                ?>
                <div class="gs-product-item" style="border: 1px solid #ddd; padding: 20px; border-radius: 4px; margin-bottom: 15px; background: #f9f9f9;">
                    <h4>Producto <?php echo $i + 1; ?></h4>
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;"><strong>Título:</strong></label>
                        <input type="text" name="gs_products[<?php echo $i; ?>][title]" 
                            value="<?php echo esc_attr($product_title); ?>"
                            placeholder="Ej: GPS Device"
                            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;"><strong>Descripción:</strong></label>
                        <textarea name="gs_products[<?php echo $i; ?>][desc]" rows="3"
                            placeholder="Descripción del producto..."
                            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;"><?php echo esc_textarea($product_desc); ?></textarea>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 5px;"><strong>Imagen:</strong></label>
                        <input type="hidden" name="gs_products[<?php echo $i; ?>][image_id]" 
                            class="product-image-id" value="<?php echo esc_attr($product_image_id); ?>">
                        <div class="product-image-preview" style="margin-bottom: 10px;">
                            <?php if ($product_image_url): ?>
                                <img src="<?php echo esc_url($product_image_url); ?>" style="max-width: 200px; height: auto;">
                            <?php endif; ?>
                        </div>
                        <button type="button" class="button button-secondary gs-product-media-upload" data-index="<?php echo $i; ?>">
                            Subir Imagen
                        </button>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}

/**
 * Meta Box: Sección de Servicios
 */
function gs_services_section_callback($post) {
    wp_nonce_field('gs_services_nonce', 'gs_services_nonce');
    
    $services = get_post_meta($post->ID, 'gs_services', true) ?: array();
    
    ?>
    <div class="gs-services-group">
        <p class="description">Añade hasta 3 servicios principales</p>
        
        <div id="gs_services_list" style="margin: 20px 0;">
            <?php
            for ($i = 0; $i < 3; $i++) {
                $service = $services[$i] ?? array();
                $service_title = $service['title'] ?? '';
                $service_desc = $service['desc'] ?? '';
                $service_icon = $service['icon'] ?? '';
                
                ?>
                <div class="gs-service-item" style="border: 1px solid #ddd; padding: 20px; border-radius: 4px; margin-bottom: 15px; background: #f9f9f9;">
                    <h4>Servicio <?php echo $i + 1; ?></h4>
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;"><strong>Título:</strong></label>
                        <input type="text" name="gs_services[<?php echo $i; ?>][title]" 
                            value="<?php echo esc_attr($service_title); ?>"
                            placeholder="Ej: Rastreo en Tiempo Real"
                            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;"><strong>Descripción:</strong></label>
                        <textarea name="gs_services[<?php echo $i; ?>][desc]" rows="3"
                            placeholder="Descripción del servicio..."
                            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;"><?php echo esc_textarea($service_desc); ?></textarea>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 5px;"><strong>Emoji/Icono:</strong></label>
                        <input type="text" name="gs_services[<?php echo $i; ?>][icon]" 
                            value="<?php echo esc_attr($service_icon); ?>"
                            placeholder="Ej: 📍"
                            maxlength="2"
                            style="width: 100px; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 24px; text-align: center;">
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}

/**
 * Meta Box: Sección Galería
 */
function gs_gallery_section_callback($post) {
    wp_nonce_field('gs_gallery_nonce', 'gs_gallery_nonce');
    
    $gallery_images = get_post_meta($post->ID, 'gs_gallery_images', true) ?: array();
    
    ?>
    <div class="gs-gallery-group">
        <p class="description">Galería de imágenes (Instagram, trabajos, etc.)</p>
        
        <div id="gs_gallery_preview" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px; margin: 20px 0;">
            <?php
            foreach ($gallery_images as $image_id) {
                $image_url = wp_get_attachment_url($image_id);
                if ($image_url) {
                    ?>
                    <div style="position: relative; overflow: hidden; border-radius: 4px;">
                        <img src="<?php echo esc_url($image_url); ?>" style="width: 100%; height: 150px; object-fit: cover;">
                        <button type="button" class="gs-remove-gallery-image button-link" data-image-id="<?php echo esc_attr($image_id); ?>" 
                            style="position: absolute; top: 5px; right: 5px; background: #c23030; color: white; border-radius: 50%; width: 30px; height: 30px; border: none; cursor: pointer;">✕</button>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        
        <input type="hidden" name="gs_gallery_images" id="gs_gallery_images" value="<?php echo esc_attr(implode(',', $gallery_images)); ?>">
        
        <button type="button" class="button button-primary gs-media-gallery-upload">
            Agregar Imágenes a la Galería
        </button>
    </div>
    <?php
}

/**
 * Meta Box: Sección de Contacto
 */
function gs_contact_section_callback($post) {
    wp_nonce_field('gs_contact_nonce', 'gs_contact_nonce');
    
    $show_contact_form = get_post_meta($post->ID, 'gs_show_contact_form', true);
    $contact_title = get_post_meta($post->ID, 'gs_contact_title', true) ?: '¿Listo para comenzar?';
    $contact_subtitle = get_post_meta($post->ID, 'gs_contact_subtitle', true) ?: 'Contáctanos y te ayudaremos';
    $contact_email = get_post_meta($post->ID, 'gs_contact_email', true) ?: get_option('admin_email');
    
    ?>
    <div class="gs-contact-group">
        <div style="margin-bottom: 15px;">
            <label>
                <input type="checkbox" name="gs_show_contact_form" value="1" <?php checked($show_contact_form, 1); ?>>
                <strong>Mostrar formulario de contacto</strong>
            </label>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label for="gs_contact_title" style="display: block; margin-bottom: 5px;"><strong>Título:</strong></label>
            <input type="text" name="gs_contact_title" id="gs_contact_title"
                value="<?php echo esc_attr($contact_title); ?>"
                placeholder="Ej: ¿Listo para comenzar?"
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label for="gs_contact_subtitle" style="display: block; margin-bottom: 5px;"><strong>Subtítulo:</strong></label>
            <textarea name="gs_contact_subtitle" id="gs_contact_subtitle" rows="3"
                placeholder="Descripción del formulario..."
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"><?php echo esc_textarea($contact_subtitle); ?></textarea>
        </div>
        
        <div>
            <label for="gs_contact_email" style="display: block; margin-bottom: 5px;"><strong>Email para recibir mensajes:</strong></label>
            <input type="email" name="gs_contact_email" id="gs_contact_email"
                value="<?php echo esc_attr($contact_email); ?>"
                placeholder="correo@ejemplo.com"
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
    </div>
    <?php
}

/**
 * Guardar Meta Boxes
 */
add_action('save_post_page', 'gs_save_page_metaboxes');

function gs_save_page_metaboxes($post_id) {
    // Verificar nonces
    if (!wp_verify_nonce($_POST['gs_page_settings_nonce'] ?? '', 'gs_page_settings_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }
    
    // Guardar configuración general
    update_post_meta($post_id, 'gs_page_type', sanitize_text_field($_POST['gs_page_type'] ?? 'default'));
    update_post_meta($post_id, 'gs_enable_hero', isset($_POST['gs_enable_hero']) ? 1 : 0);
    
    // Guardar Hero
    if (isset($_POST['gs_hero_title'])) {
        update_post_meta($post_id, 'gs_hero_title', sanitize_text_field($_POST['gs_hero_title']));
    }
    if (isset($_POST['gs_hero_subtitle'])) {
        update_post_meta($post_id, 'gs_hero_subtitle', sanitize_textarea_field($_POST['gs_hero_subtitle']));
    }
    if (isset($_POST['gs_hero_image_id'])) {
        update_post_meta($post_id, 'gs_hero_image_id', intval($_POST['gs_hero_image_id']));
    }
    
    // Guardar Productos
    if (isset($_POST['gs_products'])) {
        $products = array();
        foreach ($_POST['gs_products'] as $product) {
            if (!empty($product['title'])) {
                $products[] = array(
                    'title' => sanitize_text_field($product['title']),
                    'desc' => sanitize_textarea_field($product['desc']),
                    'image_id' => intval($product['image_id'] ?? 0),
                );
            }
        }
        update_post_meta($post_id, 'gs_products', $products);
    }
    
    // Guardar Servicios
    if (isset($_POST['gs_services'])) {
        $services = array();
        foreach ($_POST['gs_services'] as $service) {
            if (!empty($service['title'])) {
                $services[] = array(
                    'title' => sanitize_text_field($service['title']),
                    'desc' => sanitize_textarea_field($service['desc']),
                    'icon' => sanitize_text_field($service['icon']),
                );
            }
        }
        update_post_meta($post_id, 'gs_services', $services);
    }
    
    // Guardar Galería
    if (isset($_POST['gs_gallery_images'])) {
        $images = array_filter(array_map('intval', explode(',', $_POST['gs_gallery_images'])));
        update_post_meta($post_id, 'gs_gallery_images', $images);
    }
    
    // Guardar Contacto
    update_post_meta($post_id, 'gs_show_contact_form', isset($_POST['gs_show_contact_form']) ? 1 : 0);
    if (isset($_POST['gs_contact_title'])) {
        update_post_meta($post_id, 'gs_contact_title', sanitize_text_field($_POST['gs_contact_title']));
    }
    if (isset($_POST['gs_contact_subtitle'])) {
        update_post_meta($post_id, 'gs_contact_subtitle', sanitize_textarea_field($_POST['gs_contact_subtitle']));
    }
    if (isset($_POST['gs_contact_email'])) {
        update_post_meta($post_id, 'gs_contact_email', sanitize_email($_POST['gs_contact_email']));
    }
}

/**
 * Funciones para mostrar secciones
 */

function gs_display_products_section($post_id) {
    $products = get_post_meta($post_id, 'gs_products', true) ?: array();
    if (empty($products)) return;
    
    ?>
    <section class="py-16 lg:py-24 bg-slate-50">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                foreach ($products as $product) {
                    $image_url = $product['image_id'] ? wp_get_attachment_url($product['image_id']) : 'https://via.placeholder.com/400x300?text=Producto';
                    ?>
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($product['title']); ?>" 
                            class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-slate-900 mb-2">
                                <?php echo esc_html($product['title']); ?>
                            </h3>
                            <p class="text-slate-600">
                                <?php echo wp_kses_post($product['desc']); ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}

function gs_display_services_section($post_id) {
    $services = get_post_meta($post_id, 'gs_services', true) ?: array();
    if (empty($services)) return;
    
    ?>
    <section class="py-16 lg:py-24">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <?php
                foreach ($services as $service) {
                    ?>
                    <div class="bg-white rounded-lg p-8 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 bg-indigo-100 rounded-lg mb-4 flex items-center justify-center text-3xl">
                            <?php echo esc_html($service['icon'] ?: '✓'); ?>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-2">
                            <?php echo esc_html($service['title']); ?>
                        </h3>
                        <p class="text-slate-600">
                            <?php echo wp_kses_post($service['desc']); ?>
                        </p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}

function gs_display_gallery_section($post_id) {
    $gallery_images = get_post_meta($post_id, 'gs_gallery_images', true) ?: array();
    if (empty($gallery_images)) return;
    
    ?>
    <section class="py-16 lg:py-24 bg-slate-900 text-white">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php
                foreach ($gallery_images as $image_id) {
                    $image_url = wp_get_attachment_url($image_id);
                    if ($image_url) {
                        ?>
                        <div class="overflow-hidden rounded-lg">
                            <img src="<?php echo esc_url($image_url); ?>" alt="Galería" 
                                class="w-full h-64 object-cover hover:scale-105 transition-transform">
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}

function gs_display_about_section($post_id) {
    $about_text = get_post_meta($post_id, 'gs_about_text', true);
    
    if (!$about_text) return;
    
    ?>
    <section class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-3xl mx-auto prose prose-lg">
                <?php echo wp_kses_post($about_text); ?>
            </div>
        </div>
    </section>
    <?php
}

function gs_display_contact_form($post_id) {
    $contact_title = get_post_meta($post_id, 'gs_contact_title', true) ?: '¿Listo para comenzar?';
    $contact_subtitle = get_post_meta($post_id, 'gs_contact_subtitle', true) ?: 'Contáctanos';
    
    ?>
    <section class="bg-gradient-to-r from-indigo-600 to-indigo-700 py-16 lg:py-24 text-white">
        <div class="container mx-auto px-4 md:px-8 text-center">
            <h2 class="text-4xl font-extrabold mb-4">
                <?php echo esc_html($contact_title); ?>
            </h2>
            <p class="text-lg text-indigo-100 mb-8">
                <?php echo wp_kses_post($contact_subtitle); ?>
            </p>
            
            <form class="max-w-md mx-auto bg-white text-slate-900 p-8 rounded-lg shadow-lg">
                <div class="mb-4">
                    <input type="text" name="name" placeholder="Tu nombre"  
                        class="w-full px-4 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        required>
                </div>
                <div class="mb-4">
                    <input type="email" name="email" placeholder="Tu correo"
                        class="w-full px-4 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        required>
                </div>
                <div class="mb-6">
                    <textarea name="message" placeholder="Tu mensaje" rows="4"
                        class="w-full px-4 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
                        required></textarea>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-md hover:bg-indigo-700 transition">
                    Enviar Mensaje
                </button>
            </form>
        </div>
    </section>
    <?php
}
