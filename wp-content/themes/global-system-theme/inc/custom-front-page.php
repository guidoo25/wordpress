<?php
/**
 * Register Custom Fields for Front Page
 * 
 * Este archivo registra los campos personalizados para la página principal
 * sin necesidad de ACF (usando Meta Boxes de WordPress)
 * 
 * @package TailPress
 */

/**
 * Register Meta Boxes para Front Page
 */
function gs_register_front_page_metabox() {
    add_meta_box(
        'gs_hero_section',
        'Sección Hero (Portada)',
        'gs_hero_section_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gs_features_section',
        'Sección de Características',
        'gs_features_section_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gs_cta_section',
        'Llamada a la Acción Final',
        'gs_cta_section_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'gs_register_front_page_metabox');

/**
 * Hero Section Callback
 */
function gs_hero_section_callback($post) {
    wp_nonce_field('gs_hero_section', 'gs_hero_section_nonce');
    
    $hero_image = get_post_meta($post->ID, '_gs_hero_image', true);
    $hero_title = get_post_meta($post->ID, '_gs_hero_title', true) ?: 'Rastreo GPS de precisión, simplificado.';
    $hero_highlight = get_post_meta($post->ID, '_gs_hero_highlight', true) ?: 'simplificado.';
    $hero_description = get_post_meta($post->ID, '_gs_hero_description', true) ?: 'Monitorea tus activos en tiempo real con tecnología de vanguardia.';
    $cta_primary = get_post_meta($post->ID, '_gs_cta_primary_text', true) ?: 'Comenzar prueba gratuita';
    $cta_primary_url = get_post_meta($post->ID, '_gs_cta_primary_url', true) ?: '#';
    $cta_secondary = get_post_meta($post->ID, '_gs_cta_secondary_text', true) ?: 'Ver demostración en vivo';
    $cta_secondary_url = get_post_meta($post->ID, '_gs_cta_secondary_url', true) ?: '#';
    ?>
    
    <div class="gs-metabox">
        <p>
            <label for="gs_hero_image"><strong>Imagen Hero:</strong></label><br>
            <input type="hidden" id="gs_hero_image" name="gs_hero_image" value="<?php echo esc_attr($hero_image); ?>">
            <button type="button" class="button button-secondary" id="gs_upload_hero_image">Seleccionar Imagen</button>
            <?php if ($hero_image): ?>
                <div style="margin-top: 10px;">
                    <?php echo wp_get_attachment_image($hero_image, 'thumbnail'); ?>
                </div>
            <?php endif; ?>
        </p>
        
        <p>
            <label for="gs_hero_title"><strong>Título Principal:</strong></label><br>
            <textarea id="gs_hero_title" name="gs_hero_title" rows="2" style="width:100%;" placeholder="Ej: Rastreo GPS de precisión"><?php echo esc_textarea($hero_title); ?></textarea>
        </p>
        
        <p>
            <label for="gs_hero_highlight"><strong>Parte Destacada del Título:</strong></label><br>
            <input type="text" id="gs_hero_highlight" name="gs_hero_highlight" value="<?php echo esc_attr($hero_highlight); ?>" style="width:100%;" placeholder="Ej: simplificado.">
            <small>Esta palabra/frase aparecerá en color indigo</small>
        </p>
        
        <p>
            <label for="gs_hero_description"><strong>Descripción:</strong></label><br>
            <textarea id="gs_hero_description" name="gs_hero_description" rows="3" style="width:100%;" placeholder="Descripción breve del servicio"><?php echo esc_textarea($hero_description); ?></textarea>
        </p>
        
        <p>
            <label for="gs_cta_primary_text"><strong>Botón Primario - Texto:</strong></label><br>
            <input type="text" id="gs_cta_primary_text" name="gs_cta_primary_text" value="<?php echo esc_attr($cta_primary); ?>" style="width:100%;">
        </p>
        
        <p>
            <label for="gs_cta_primary_url"><strong>Botón Primario - URL:</strong></label><br>
            <input type="url" id="gs_cta_primary_url" name="gs_cta_primary_url" value="<?php echo esc_url($cta_primary_url); ?>" style="width:100%;">
        </p>
        
        <p>
            <label for="gs_cta_secondary_text"><strong>Botón Secundario - Texto:</strong></label><br>
            <input type="text" id="gs_cta_secondary_text" name="gs_cta_secondary_text" value="<?php echo esc_attr($cta_secondary); ?>" style="width:100%;">
        </p>
        
        <p>
            <label for="gs_cta_secondary_url"><strong>Botón Secundario - URL:</strong></label><br>
            <input type="url" id="gs_cta_secondary_url" name="gs_cta_secondary_url" value="<?php echo esc_url($cta_secondary_url); ?>" style="width:100%;">
        </p>
    </div>
    
    <script>
        jQuery(function($) {
            $('#gs_upload_hero_image').on('click', function(e) {
                e.preventDefault();
                var mediaUploader = wp.media({
                    title: 'Seleccionar Imagen',
                    button: { text: 'Usar esta imagen' },
                    multiple: false
                }).on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#gs_hero_image').val(attachment.id);
                    location.reload();
                }).open();
            });
        });
    </script>
    <?php
}

/**
 * Features Section Callback
 */
function gs_features_section_callback($post) {
    wp_nonce_field('gs_features_section', 'gs_features_section_nonce');
    
    $features_title = get_post_meta($post->ID, '_gs_features_title', true) ?: 'Por qué elegir Global System GPS';
    $features_subtitle = get_post_meta($post->ID, '_gs_features_subtitle', true) ?: 'Soluciones inteligentes para tu negocio';
    $features = get_post_meta($post->ID, '_gs_features_list', true);
    if (!is_array($features)) $features = [];
    
    // Asegurar 3 características mínimas por defecto
    while (count($features) < 3) {
        $features[] = ['title' => '', 'description' => ''];
    }
    
    ?>
    <p>
        <label for="gs_features_title"><strong>Título de la Sección:</strong></label><br>
        <input type="text" id="gs_features_title" name="gs_features_title" value="<?php echo esc_attr($features_title); ?>" style="width:100%;">
    </p>
    
    <p>
        <label for="gs_features_subtitle"><strong>Subtítulo:</strong></label><br>
        <input type="text" id="gs_features_subtitle" name="gs_features_subtitle" value="<?php echo esc_attr($features_subtitle); ?>" style="width:100%;">
    </p>
    
    <div id="gs_features_container" style="margin-top: 20px;">
        <h4>Características:</h4>
        <?php foreach ($features as $index => $feature): ?>
            <div style="background: #f9f9f9; padding: 15px; margin-bottom: 10px; border-left: 4px solid #635BFF;">
                <p>
                    <label><strong>Característica <?php echo $index + 1; ?> - Título:</strong></label><br>
                    <input type="text" name="gs_features[<?php echo $index; ?>][title]" value="<?php echo esc_attr($feature['title'] ?? ''); ?>" style="width:100%;" placeholder="Ej: Rastreo en Tiempo Real">
                </p>
                <p>
                    <label><strong>Característica <?php echo $index + 1; ?> - Descripción:</strong></label><br>
                    <textarea name="gs_features[<?php echo $index; ?>][description]" rows="2" style="width:100%;" placeholder="Describe esta característica"><?php echo esc_textarea($feature['description'] ?? ''); ?></textarea>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}

/**
 * CTA Section Callback
 */
function gs_cta_section_callback($post) {
    wp_nonce_field('gs_cta_section', 'gs_cta_section_nonce');
    
    $cta_title = get_post_meta($post->ID, '_gs_cta_title', true) ?: '¿Listo para transformar tu flota?';
    $cta_subtitle = get_post_meta($post->ID, '_gs_cta_subtitle', true) ?: 'Obtén acceso a nuestra plataforma premium.';
    $cta_text = get_post_meta($post->ID, '_gs_cta_text', true) ?: 'Comenzar ahora';
    $cta_url = get_post_meta($post->ID, '_gs_cta_url', true) ?: '#';
    
    ?>
    <p>
        <label for="gs_cta_title"><strong>Título:</strong></label><br>
        <input type="text" id="gs_cta_title" name="gs_cta_title" value="<?php echo esc_attr($cta_title); ?>" style="width:100%;">
    </p>
    
    <p>
        <label for="gs_cta_subtitle"><strong>Subtítulo/Descripción:</strong></label><br>
        <textarea id="gs_cta_subtitle" name="gs_cta_subtitle" rows="2" style="width:100%;"><?php echo esc_textarea($cta_subtitle); ?></textarea>
    </p>
    
    <p>
        <label for="gs_cta_text"><strong>Texto del Botón:</strong></label><br>
        <input type="text" id="gs_cta_text" name="gs_cta_text" value="<?php echo esc_attr($cta_text); ?>" style="width:100%;">
    </p>
    
    <p>
        <label for="gs_cta_url"><strong>URL del Botón:</strong></label><br>
        <input type="url" id="gs_cta_url" name="gs_cta_url" value="<?php echo esc_url($cta_url); ?>" style="width:100%;">
    </p>
    <?php
}

/**
 * Save Meta Box Data
 */
function gs_save_front_page_meta($post_id) {
    // Verificar nonces
    if (!isset($_POST['gs_hero_section_nonce']) || !wp_verify_nonce($_POST['gs_hero_section_nonce'], 'gs_hero_section')) {
        return;
    }
    
    // Evitar autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Verificar permisos
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }
    
    // Guardar Hero Section
    if (isset($_POST['gs_hero_image'])) {
        update_post_meta($post_id, '_gs_hero_image', intval($_POST['gs_hero_image']));
    }
    if (isset($_POST['gs_hero_title'])) {
        update_post_meta($post_id, '_gs_hero_title', sanitize_textarea_field($_POST['gs_hero_title']));
    }
    if (isset($_POST['gs_hero_highlight'])) {
        update_post_meta($post_id, '_gs_hero_highlight', sanitize_text_field($_POST['gs_hero_highlight']));
    }
    if (isset($_POST['gs_hero_description'])) {
        update_post_meta($post_id, '_gs_hero_description', sanitize_textarea_field($_POST['gs_hero_description']));
    }
    if (isset($_POST['gs_cta_primary_text'])) {
        update_post_meta($post_id, '_gs_cta_primary_text', sanitize_text_field($_POST['gs_cta_primary_text']));
    }
    if (isset($_POST['gs_cta_primary_url'])) {
        update_post_meta($post_id, '_gs_cta_primary_url', esc_url_raw($_POST['gs_cta_primary_url']));
    }
    if (isset($_POST['gs_cta_secondary_text'])) {
        update_post_meta($post_id, '_gs_cta_secondary_text', sanitize_text_field($_POST['gs_cta_secondary_text']));
    }
    if (isset($_POST['gs_cta_secondary_url'])) {
        update_post_meta($post_id, '_gs_cta_secondary_url', esc_url_raw($_POST['gs_cta_secondary_url']));
    }
    
    // Guardar Features Section
    if (isset($_POST['gs_features_title'])) {
        update_post_meta($post_id, '_gs_features_title', sanitize_text_field($_POST['gs_features_title']));
    }
    if (isset($_POST['gs_features_subtitle'])) {
        update_post_meta($post_id, '_gs_features_subtitle', sanitize_text_field($_POST['gs_features_subtitle']));
    }
    if (isset($_POST['gs_features'])) {
        $features = [];
        foreach ($_POST['gs_features'] as $feature) {
            $features[] = [
                'title' => sanitize_text_field($feature['title']),
                'description' => sanitize_textarea_field($feature['description']),
            ];
        }
        update_post_meta($post_id, '_gs_features_list', $features);
    }
    
    // Guardar CTA Section
    if (isset($_POST['gs_cta_title'])) {
        update_post_meta($post_id, '_gs_cta_title', sanitize_text_field($_POST['gs_cta_title']));
    }
    if (isset($_POST['gs_cta_subtitle'])) {
        update_post_meta($post_id, '_gs_cta_subtitle', sanitize_textarea_field($_POST['gs_cta_subtitle']));
    }
    if (isset($_POST['gs_cta_text'])) {
        update_post_meta($post_id, '_gs_cta_text', sanitize_text_field($_POST['gs_cta_text']));
    }
    if (isset($_POST['gs_cta_url'])) {
        update_post_meta($post_id, '_gs_cta_url', esc_url_raw($_POST['gs_cta_url']));
    }
}
add_action('save_post_page', 'gs_save_front_page_meta');

/**
 * Solo mostrar los metaboxes en la página designada como portada
 */
function gs_hide_metaboxes($hidden, $screen) {
    // Solo mostrar en pages
    if ($screen->id === 'page') {
        global $post;
        // Aquí puedes agregar lógica adicional si es necesario
    }
    return $hidden;
}
