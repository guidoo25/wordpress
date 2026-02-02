<?php
/**
 * Script de instalación rápida - Landing Page de Ejemplo
 * 
 * Este script crea automáticamente una página de ejemplo con los bloques configurados
 * Ejecutar UNA SOLA VEZ desde WordPress Admin -> Herramientas -> Editor de Temas
 * O pegar en functions.php temporalmente
 */

// DESCOMENTAR ESTA LÍNEA PARA EJECUTAR (luego comentar de nuevo)
// add_action('init', 'gs_create_example_landing_page', 1);

function gs_create_example_landing_page() {
    // Verificar que no se ejecute múltiples veces
    if (get_option('gs_landing_example_created')) {
        return;
    }

    // Contenido de los bloques en formato Gutenberg
    $content = '<!-- wp:acf/gs-hero {"id":"block_' . uniqid() . '","name":"acf/gs-hero","data":{"hero_pretitle":"¡GPS+ rastreó!","hero_title":"Plataforma nova con la mejor GPS","hero_description":"Administrador completo de tracking GPS con reportes avanzados y monitoreo en tiempo real de toda tu flota vehicular.","hero_button_text":"Agendar demo","hero_button_link":"#contacto","_hero_button_link":"field_hero_button_link"},"mode":"preview"} /-->

<!-- wp:acf/gs-benefits {"id":"block_' . uniqid() . '","name":"acf/gs-benefits","data":{"benefits_title":"Beneficios Clave","benefits_items":[{"icon":"location-arrow","title":"Rastreo preciso","description":"Sistema de rastreo GPS de alta precisión con actualizaciones en tiempo real cada 30 segundos."},{"icon":"shield-alt","title":"Seguridad confiable","description":"Protección avanzada de datos con encriptación de nivel empresarial y respaldo automático."},{"icon":"chart-line","title":"Analíticas avanzadas","description":"Reportes detallados y métricas para optimizar tu flota vehicular y reducir costos."}]},"mode":"preview"} /-->

<!-- wp:acf/gs-products {"id":"block_' . uniqid() . '","name":"acf/gs-products","data":{"products_pretitle":"Prihlizovanie","products_title":"plataforma productos","products_description":"Sistema completo de administración y monitoreo GPS para tu flota vehicular. Control total desde cualquier dispositivo.","products_button_text":"Ver producto","products_button_link":"#productos","products_reverse":false},"mode":"preview"} /-->

<!-- wp:acf/gs-products {"id":"block_' . uniqid() . '","name":"acf/gs-products","data":{"products_pretitle":"Nuestros Productos y Servicios","products_title":"Gestión de Flota Completa","products_description":"Optimiza tu operación con nuestro sistema integral de gestión vehicular. Reportes automáticos, alertas inteligentes y más.","products_button_text":"Conocer más","products_button_link":"#servicios","products_reverse":true},"mode":"preview"} /-->';

    // Crear la página
    $page_data = array(
        'post_title'    => 'Landing Page GPS - Ejemplo',
        'post_content'  => $content,
        'post_status'   => 'draft', // Publicar como borrador primero
        'post_type'     => 'page',
        'post_author'   => 1,
        'page_template' => 'template-landing.php'
    );

    $page_id = wp_insert_post($page_data);

    if ($page_id) {
        // Marcar como creado
        update_option('gs_landing_example_created', true);
        update_option('gs_landing_example_page_id', $page_id);
        
        // Mensaje de éxito
        add_action('admin_notices', function() use ($page_id) {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><strong>✅ ¡Página de ejemplo creada!</strong></p>
                <p>Se ha creado una página de ejemplo llamada "Landing Page GPS - Ejemplo" como borrador.</p>
                <p>
                    <a href="<?php echo get_edit_post_link($page_id); ?>" class="button button-primary">
                        Editar Página
                    </a>
                    <a href="<?php echo get_permalink($page_id); ?>" class="button" target="_blank">
                        Vista Previa
                    </a>
                </p>
            </div>
            <?php
        });
    }
}

/**
 * Función para resetear y poder crear la página de nuevo
 * Ejecutar desde WP CLI o pegar temporalmente en functions.php
 */
function gs_reset_landing_example() {
    $page_id = get_option('gs_landing_example_page_id');
    
    if ($page_id) {
        wp_delete_post($page_id, true);
    }
    
    delete_option('gs_landing_example_created');
    delete_option('gs_landing_example_page_id');
    
    echo "Landing page de ejemplo reseteada. Puedes ejecutar gs_create_example_landing_page() de nuevo.";
}

// USAR ESTO PARA RESETEAR (ejecutar desde wp-cli o pegar en functions.php temporalmente)
// add_action('init', 'gs_reset_landing_example', 1);
