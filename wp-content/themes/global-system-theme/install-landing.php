<?php
/**
 * AUTO-INSTALADOR DE LANDING PAGE
 * 
 * Este archivo crea automáticamente tu landing page y la configura como inicio
 * 
 * INSTRUCCIONES:
 * 1. Asegúrate de tener ACF instalado y activado
 * 2. Ve a: tu-sitio.com/wp-content/themes/global-system-theme/install-landing.php
 * 3. O copia este código en functions.php temporalmente
 * 4. Recarga tu sitio y listo!
 */

// Evitar acceso directo sin WordPress
if (!defined('ABSPATH')) {
    // Cargar WordPress - ajustar ruta correcta
    $wp_load = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
    if (file_exists($wp_load)) {
        require_once($wp_load);
    } else {
        die('Error: No se puede encontrar WordPress. Asegúrate de acceder desde tu instalación de WordPress.');
    }
}

// Verificar permisos
if (!current_user_can('manage_options')) {
    wp_die('No tienes permisos para ejecutar este instalador.');
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalador Landing Page GPS</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #1e3a8a;
            margin-bottom: 20px;
            font-size: 2.5em;
        }
        .status {
            background: #f0f9ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
        }
        .success {
            background: #d1fae5;
            border-left: 4px solid #10b981;
        }
        .error {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
        }
        .button {
            background: #3b82f6;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1.2em;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
        }
        .button:hover {
            background: #2563eb;
        }
        .button-secondary {
            background: #64748b;
        }
        .button-secondary:hover {
            background: #475569;
        }
        ul {
            margin: 15px 0 15px 30px;
        }
        li {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Instalador Landing Page GPS</h1>
        
        <?php
        // Opción para reinstalar (eliminar y crear de nuevo)
        if (isset($_GET['reinstall'])) {
            $old_page_id = get_option('gs_landing_page_id');
            if ($old_page_id) {
                wp_delete_post($old_page_id, true);
                echo '<div class="status success">✅ Página anterior eliminada</div>';
            }
            delete_option('gs_landing_installed');
            delete_option('gs_landing_page_id');
            echo '<div class="status">🔄 Reinstalando...</div>';
            echo '<script>window.location.href="?install=1";</script>';
            exit;
        }
        
        if (isset($_GET['install'])) {
            // EJECUTAR INSTALACIÓN
            echo '<div class="status">Iniciando instalación...</div>';
            
            // 1. Verificar ACF
            if (!function_exists('acf_add_local_field_group')) {
                echo '<div class="status error">❌ ERROR: Plugin ACF no está instalado. Por favor instálalo primero.</div>';
                echo '<a href="' . admin_url('plugin-install.php?s=advanced+custom+fields&tab=search') . '" class="button">Instalar ACF</a>';
                exit;
            }
            echo '<div class="status success">✅ ACF detectado correctamente</div>';
            
            // 2. Eliminar páginas de ejemplo
            $sample_pages = get_posts(array(
                'post_type' => 'page',
                'post_status' => array('publish', 'draft', 'pending'),
                'numberposts' => -1,
                'title' => 'Sample Page'
            ));
            
            foreach ($sample_pages as $page) {
                wp_delete_post($page->ID, true);
            }
            echo '<div class="status success">✅ Páginas de ejemplo eliminadas</div>';
            
            // 3. Buscar si ya existe una landing page
            $existing = get_posts(array(
                'post_type' => 'page',
                'meta_key' => '_wp_page_template',
                'meta_value' => 'template-landing.php',
                'numberposts' => 1
            ));
            
            if (!empty($existing)) {
                $landing_id = $existing[0]->ID;
                echo '<div class="status">⚠️ Ya existe una landing page. Usándola...</div>';
            } else {
                // 4. Crear la landing page
                // Verificar si ACF está activo para usar bloques o contenido simple
                $use_acf_blocks = function_exists('acf_register_block_type');
                
                if ($use_acf_blocks) {
                    // Usar bloques ACF
                    $landing_content = '<!-- wp:acf/gs-hero /-->

<!-- wp:acf/gs-benefits /-->

<!-- wp:acf/gs-products /-->';
                } else {
                    // Usar contenido HTML simple si ACF no está disponible
                    $landing_content = '<!-- wp:html -->
<div style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; padding: 80px 20px; text-align: center;">
    <h1 style="font-size: 3em; margin-bottom: 20px;">Plataforma nova con la mejor GPS</h1>
    <p style="font-size: 1.5em; margin-bottom: 30px;">Administrador completo de tracking GPS con reportes avanzados</p>
    <a href="#" style="background: white; color: #1e3a8a; padding: 15px 40px; text-decoration: none; border-radius: 50px; font-weight: bold;">Agendar demo</a>
</div>
<!-- /wp:html -->

<!-- wp:paragraph -->
<p style="text-align: center; margin: 60px 0 30px;"><strong style="font-size: 2em;">Beneficios Clave</strong></p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns">
    <div class="wp-block-column">
        <h3>📍 Rastreo preciso</h3>
        <p>Sistema de rastreo GPS de alta precisión con actualizaciones en tiempo real.</p>
    </div>
    <div class="wp-block-column">
        <h3>🛡️ Seguridad confiable</h3>
        <p>Protección avanzada de datos con encriptación de nivel empresarial.</p>
    </div>
    <div class="wp-block-column">
        <h3>📊 Analíticas avanzadas</h3>
        <p>Reportes detallados para optimizar tu flota vehicular.</p>
    </div>
</div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p style="text-align: center; margin-top: 60px;"><em>Para habilitar el editor visual completo, instala el plugin "Advanced Custom Fields" y edita esta página.</em></p>
<!-- /wp:paragraph -->';
                }

                $landing_data = array(
                    'post_title'    => 'Landing GPS - Inicio',
                    'post_content'  => $landing_content,
                    'post_status'   => 'publish',
                    'post_type'     => 'page',
                    'post_author'   => get_current_user_id(),
                    'comment_status' => 'closed',
                    'ping_status'   => 'closed'
                );

                $landing_id = wp_insert_post($landing_data);
                
                if ($landing_id) {
                    update_post_meta($landing_id, '_wp_page_template', 'template-landing.php');
                    echo '<div class="status success">✅ Landing page creada exitosamente</div>';
                } else {
                    echo '<div class="status error">❌ Error al crear la landing page</div>';
                    exit;
                }
            }
            
            // 5. Configurar como página de inicio
            update_option('show_on_front', 'page');
            update_option('page_on_front', $landing_id);
            
            // Forzar actualización de permalinks
            flush_rewrite_rules();
            
            echo '<div class="status success">✅ Configurada como página de inicio</div>';
            
            // 6. Eliminar "Hello World" post
            $hello_world = get_posts(array(
                'post_type' => 'post',
                'title' => 'Hello world!',
                'numberposts' => 1
            ));
            if (!empty($hello_world)) {
                wp_delete_post($hello_world[0]->ID, true);
                echo '<div class="status success">✅ Post de ejemplo eliminado</div>';
            }
            
            // ÉXITO TOTAL
            echo '<div class="status success" style="margin-top: 30px; padding: 25px;">
                <h2 style="color: #047857; margin-bottom: 15px;">🎉 ¡INSTALACIÓN COMPLETADA!</h2>
                <p style="font-size: 1.1em; margin-bottom: 20px;">Tu landing page está lista y configurada como página de inicio.</p>
                <a href="' . home_url() . '" class="button" target="_blank">🌐 Ver Landing Page</a>
                <a href="' . get_edit_post_link($landing_id) . '" class="button button-secondary">✏️ Editar Contenido</a>
            </div>';
            
            echo '<div class="status" style="margin-top: 20px;">
                <h3>📝 Próximos pasos:</h3>
                <ul>
                    <li>Edita los textos desde el editor de WordPress</li>
                    <li>Sube tus propias imágenes del dashboard GPS</li>
                    <li>Personaliza los beneficios según tus servicios</li>
                    <li>Configura los enlaces de los botones</li>
                </ul>
            </div>';
            
            // Marcar como instalado
            update_option('gs_landing_installed', true);
            update_option('gs_landing_page_id', $landing_id);
            
        } else {
            // MOSTRAR PANTALLA INICIAL
            ?>
            <div class="status">
                <h3>Este instalador va a:</h3>
                <ul>
                    <li>✅ Verificar que ACF esté instalado</li>
                    <li>🗑️ Eliminar páginas de ejemplo de WordPress</li>
                    <li>📄 Crear una landing page completa con bloques configurados</li>
                    <li>🏠 Configurarla como página de inicio de tu sitio</li>
                    <li>🧹 Limpiar contenido de demostración</li>
                </ul>
            </div>
            
            <div class="status" style="background: #fef3c7; border-color: #f59e0b;">
                <strong>⚠️ Importante:</strong> Asegúrate de tener instalado y activado el plugin <strong>Advanced Custom Fields (ACF)</strong> antes de continuar.
            </div>
            
            <div style="margin-top: 30px; text-align: center;">
                <?php if (get_option('gs_landing_installed')): ?>
                    <a href="?reinstall=1" class="button" style="font-size: 1.3em; padding: 20px 40px; background: #f59e0b;">
                        🔄 Reinstalar Landing Page
                    </a>
                    <p style="margin-top: 15px; color: #64748b;">Ya tienes una landing instalada. Usa este botón para reinstalar desde cero.</p>
                <?php else: ?>
                    <a href="?install=1" class="button" style="font-size: 1.3em; padding: 20px 40px;">
                        🚀 Instalar Landing Page Ahora
                    </a>
                <?php endif; ?>
            </div>
            
            <div style="margin-top: 20px; text-align: center;">
                <a href="<?php echo admin_url('plugins.php'); ?>" class="button button-secondary">
                    Ver Plugins Instalados
                </a>
                <?php if (get_option('gs_landing_installed')): ?>
                    <a href="<?php echo home_url(); ?>" class="button button-secondary" target="_blank">
                        🌐 Ver Landing Actual
                    </a>
                <?php endif; ?>
            </div>
            <?php
        }
        ?>
    </div>
</body>
</html>
