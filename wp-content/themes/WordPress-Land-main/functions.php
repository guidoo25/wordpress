<?php
/**
 * Theme Functions.
 *
 * @package Wordpress-Land
 */

function sina_load_assets() {
  wp_enqueue_script('ourmainjs', get_theme_file_uri('/build/index.js'), array('wp-element'), '1.0', true);
  wp_enqueue_style('ourmaincss', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'sina_load_assets');

function sina_add_support() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'sina_add_support');

function mytheme_setup() {
    // Enable support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,  // Optional default height
        'width'       => 300,  // Optional default width
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action( 'after_setup_theme', 'mytheme_setup' );

function mytheme_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu'),
        'footer'  => __('Footer Menu')
    ));
}
add_action('init', 'mytheme_register_menus');

// Habilitar soporte para Gutenberg (Compatible con Tailwind)
function mytheme_add_gutenberg_support() {
    // Soporte para editor de ancho completo
    add_theme_support('align-wide');
    
    // Soporte para bloques de Gutenberg
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    
    // Colores personalizados para el editor
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => 'Stripe Purple',
            'slug'  => 'stripe-purple',
            'color' => '#635bff',
        ),
        array(
            'name'  => 'Stripe Cyan',
            'slug'  => 'stripe-cyan',
            'color' => '#00d4ff',
        ),
        array(
            'name'  => 'Stripe Pink',
            'slug'  => 'stripe-pink',
            'color' => '#ff80b5',
        ),
        array(
            'name'  => 'Stripe Dark',
            'slug'  => 'stripe-dark',
            'color' => '#0a2540',
        ),
    ));
}
add_action('after_setup_theme', 'mytheme_add_gutenberg_support');

// Registrar campos personalizados para editar contenido (sin romper diseño)
function mytheme_register_custom_fields() {
    // ===== SECCIÓN INICIO (HERO) =====
    register_setting('mytheme_options', 'hero_badge_text');
    register_setting('mytheme_options', 'hero_badge_link_text');
    register_setting('mytheme_options', 'hero_title');
    register_setting('mytheme_options', 'hero_subtitle');
    register_setting('mytheme_options', 'hero_description');
    register_setting('mytheme_options', 'hero_button_primary');
    register_setting('mytheme_options', 'hero_button_secondary');
    register_setting('mytheme_options', 'hero_link_services');
    
    // ===== SECCIÓN DESCARGA APP =====
    register_setting('mytheme_options', 'app_badge');
    register_setting('mytheme_options', 'app_title');
    register_setting('mytheme_options', 'app_subtitle');
    register_setting('mytheme_options', 'app_description');
    
    // ===== SECCIÓN COBERTURA INTERNACIONAL =====
    register_setting('mytheme_options', 'cobertura_badge');
    register_setting('mytheme_options', 'cobertura_title_parte1');
    register_setting('mytheme_options', 'cobertura_title_parte2');
    register_setting('mytheme_options', 'cobertura_description');
    register_setting('mytheme_options', 'cobertura_beneficio1_titulo');
    register_setting('mytheme_options', 'cobertura_beneficio1_desc');
    register_setting('mytheme_options', 'cobertura_beneficio2_titulo');
    register_setting('mytheme_options', 'cobertura_beneficio2_desc');
    register_setting('mytheme_options', 'cobertura_beneficio3_titulo');
    register_setting('mytheme_options', 'cobertura_beneficio3_desc');
    
    // ===== SECCIÓN VEHÍCULOS =====
    register_setting('mytheme_options', 'vehiculos_intro');
    
    // ===== SECCIÓN PRODUCTOS =====
    register_setting('mytheme_options', 'productos_title');
    register_setting('mytheme_options', 'productos_subtitle');
    
    // Producto 1: DashCam
    register_setting('mytheme_options', 'dashcam_card_title');
    register_setting('mytheme_options', 'dashcam_card_description');
    register_setting('mytheme_options', 'dashcam_modal_title');
    register_setting('mytheme_options', 'dashcam_modal_beneficio1');
    register_setting('mytheme_options', 'dashcam_modal_beneficio2');
    register_setting('mytheme_options', 'dashcam_modal_beneficio3');
    register_setting('mytheme_options', 'dashcam_modal_beneficio4');
    register_setting('mytheme_options', 'dashcam_modal_cta');
    
    // Producto 2: Temperatura
    register_setting('mytheme_options', 'temperatura_card_title');
    register_setting('mytheme_options', 'temperatura_card_description');
    register_setting('mytheme_options', 'temperatura_modal_title');
    register_setting('mytheme_options', 'temperatura_modal_intro');
    register_setting('mytheme_options', 'temperatura_modal_descripcion');
    register_setting('mytheme_options', 'temperatura_modal_beneficio1');
    register_setting('mytheme_options', 'temperatura_modal_beneficio2');
    register_setting('mytheme_options', 'temperatura_modal_beneficio3');
    register_setting('mytheme_options', 'temperatura_modal_cta');
    
    // Producto 3: Combustible
    register_setting('mytheme_options', 'combustible_card_title');
    register_setting('mytheme_options', 'combustible_card_description');
    register_setting('mytheme_options', 'combustible_modal_title');
    register_setting('mytheme_options', 'combustible_modal_descripcion');
    register_setting('mytheme_options', 'combustible_modal_beneficio1');
    register_setting('mytheme_options', 'combustible_modal_beneficio2');
    register_setting('mytheme_options', 'combustible_modal_beneficio3');
    register_setting('mytheme_options', 'combustible_modal_beneficio4');
    register_setting('mytheme_options', 'combustible_modal_cta');
    
    // ===== MODAL DE COTIZACIÓN =====
    register_setting('mytheme_options', 'quote_modal_title');
    register_setting('mytheme_options', 'quote_modal_feature1');
    register_setting('mytheme_options', 'quote_modal_feature2');
    register_setting('mytheme_options', 'quote_modal_testimonial');
    register_setting('mytheme_options', 'quote_modal_testimonial_autor');
    register_setting('mytheme_options', 'quote_modal_testimonial_empresa');
    
    // ===== SECCIÓN NOSOTROS =====
    register_setting('mytheme_options', 'nosotros_title');
    register_setting('mytheme_options', 'nosotros_subtitle');
    register_setting('mytheme_options', 'nosotros_descripcion');
    register_setting('mytheme_options', 'nosotros_mision');
    register_setting('mytheme_options', 'nosotros_vision');
    
    // ===== CONTACTO/FOOTER =====
    register_setting('mytheme_options', 'contact_phone');
    register_setting('mytheme_options', 'contact_whatsapp');
    register_setting('mytheme_options', 'contact_email');
    register_setting('mytheme_options', 'contact_address');
    register_setting('mytheme_options', 'footer_descripcion');
    register_setting('mytheme_options', 'footer_copyright');
    
    // ===== ENLACES SOCIALES =====
    register_setting('mytheme_options', 'social_instagram');
    register_setting('mytheme_options', 'social_facebook');
    register_setting('mytheme_options', 'social_whatsapp');
    
    // ===== SECCIÓN APKs DESCARGABLES =====
    register_setting('mytheme_options', 'apk_1_nombre');
    register_setting('mytheme_options', 'apk_1_descripcion');
    register_setting('mytheme_options', 'apk_1_archivo');
    register_setting('mytheme_options', 'apk_2_nombre');
    register_setting('mytheme_options', 'apk_2_descripcion');
    register_setting('mytheme_options', 'apk_2_archivo');
    register_setting('mytheme_options', 'apk_3_nombre');
    register_setting('mytheme_options', 'apk_3_descripcion');
    register_setting('mytheme_options', 'apk_3_archivo');
    register_setting('mytheme_options', 'apk_4_nombre');
    register_setting('mytheme_options', 'apk_4_descripcion');
    register_setting('mytheme_options', 'apk_4_archivo');
}
add_action('admin_init', 'mytheme_register_custom_fields');

// Agregar página de opciones en el admin
function mytheme_add_theme_options_page() {
    add_menu_page(
        'Editar Contenido',           // Título de la página
        'Editar Contenido',           // Título del menú
        'manage_options',             // Capacidad requerida
        'mytheme-content-editor',     // Slug del menú
        'mytheme_content_editor_page', // Función callback
        'dashicons-edit',             // Icono
        61                            // Posición
    );
}
add_action('admin_menu', 'mytheme_add_theme_options_page');

// Página de edición de contenido
function mytheme_content_editor_page() {
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'inicio';
    ?>
    <div class="wrap">
        <h1>✏️ Editor de Contenido - Global System</h1>
        <p>Edita todo el contenido de tu sitio web de forma visual y organizada. Los cambios se guardan automáticamente.</p>
        
        <style>
            .nav-tab-wrapper { margin-bottom: 20px; }
            .form-table th { width: 220px; padding: 15px 10px; }
            .form-table input[type="text"] { width: 100%; max-width: 600px; }
            .form-table textarea { width: 100%; max-width: 600px; }
            .section-header { 
                background: linear-gradient(135deg, #1993cf 0%, #73bfe8 100%);
                color: white; 
                padding: 12px 20px; 
                margin: 25px 0 15px 0;
                border-radius: 6px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .section-header h2 { 
                color: white; 
                margin: 0; 
                font-size: 17px;
                font-weight: 600;
            }
            .description { color: #666; font-size: 13px; margin-top: 5px; }
            .info-box {
                background: #e7f3ff;
                border-left: 4px solid #1993cf;
                padding: 15px;
                margin: 20px 0;
                border-radius: 4px;
            }
            .info-box h3 { margin-top: 0; color: #1993cf; }
        </style>
        
        <h2 class="nav-tab-wrapper">
            <a href="?page=mytheme-content-editor&tab=inicio" class="nav-tab <?php echo $active_tab == 'inicio' ? 'nav-tab-active' : ''; ?>">🏠 Inicio</a>
            <a href="?page=mytheme-content-editor&tab=productos" class="nav-tab <?php echo $active_tab == 'productos' ? 'nav-tab-active' : ''; ?>">📦 Productos</a>
            <a href="?page=mytheme-content-editor&tab=cobertura" class="nav-tab <?php echo $active_tab == 'cobertura' ? 'nav-tab-active' : ''; ?>">🌎 Cobertura</a>
            <a href="?page=mytheme-content-editor&tab=vehiculos" class="nav-tab <?php echo $active_tab == 'vehiculos' ? 'nav-tab-active' : ''; ?>">🚗 Vehículos</a>
            <a href="?page=mytheme-content-editor&tab=nosotros" class="nav-tab <?php echo $active_tab == 'nosotros' ? 'nav-tab-active' : ''; ?>">ℹ️ Nosotros</a>
            <a href="?page=mytheme-content-editor&tab=contacto" class="nav-tab <?php echo $active_tab == 'contacto' ? 'nav-tab-active' : ''; ?>">📞 Contacto</a>
            <a href="?page=mytheme-content-editor&tab=apks" class="nav-tab <?php echo $active_tab == 'apks' ? 'nav-tab-active' : ''; ?>">📲 APKs</a>
        </h2>
        
        <form method="post" action="options.php">
            <?php settings_fields('mytheme_options'); ?>
            
            <?php if ($active_tab == 'inicio'): ?>
                <!-- PESTAÑA INICIO -->
                <div class="section-header">
                    <h2>🎯 Sección Hero (Primera Impresión)</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="hero_badge_text">Texto del Badge Superior</label></th>
                        <td>
                            <input type="text" id="hero_badge_text" name="hero_badge_text" value="<?php echo esc_attr(get_option('hero_badge_text', 'Global System')); ?>" />
                            <p class="description">Aparece en la insignia superior de la página</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="hero_badge_link_text">Texto del Enlace en Badge</label></th>
                        <td>
                            <input type="text" id="hero_badge_link_text" name="hero_badge_link_text" value="<?php echo esc_attr(get_option('hero_badge_link_text', 'Protege tu vehículo hoy')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="hero_title">Título Principal</label></th>
                        <td>
                            <input type="text" id="hero_title" name="hero_title" value="<?php echo esc_attr(get_option('hero_title', 'Sistema de rastreo y')); ?>" />
                            <p class="description">Primera parte del título hero</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="hero_subtitle">Subtítulo (con gradiente)</label></th>
                        <td>
                            <input type="text" id="hero_subtitle" name="hero_subtitle" value="<?php echo esc_attr(get_option('hero_subtitle', 'protección vehicular')); ?>" />
                            <p class="description">Aparece con efecto degradado de color</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="hero_description">Descripción Principal</label></th>
                        <td>
                            <textarea id="hero_description" name="hero_description" rows="3"><?php echo esc_textarea(get_option('hero_description', 'En Global System nos encargamos de tu seguridad y la de cada uno de tus vehículos con monitoreo satelital GPS en tiempo real, respaldado por personal capacitado 24/7.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="hero_button_primary">Botón Principal</label></th>
                        <td>
                            <input type="text" id="hero_button_primary" name="hero_button_primary" value="<?php echo esc_attr(get_option('hero_button_primary', 'Cotizar ahora')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="hero_button_secondary">Botón Secundario (Pagos)</label></th>
                        <td>
                            <input type="text" id="hero_button_secondary" name="hero_button_secondary" value="<?php echo esc_attr(get_option('hero_button_secondary', 'Consulta / Reporta / Paga')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="hero_link_services">Texto Enlace a Servicios</label></th>
                        <td>
                            <input type="text" id="hero_link_services" name="hero_link_services" value="<?php echo esc_attr(get_option('hero_link_services', 'Ver productos y servicios')); ?>" />
                        </td>
                    </tr>
                </table>
                
                <div class="section-header">
                    <h2>📱 Sección Descarga de App</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="app_badge">Badge</label></th>
                        <td>
                            <input type="text" id="app_badge" name="app_badge" value="<?php echo esc_attr(get_option('app_badge', 'Disponible iOS & Android')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="app_title">Título (parte 1)</label></th>
                        <td>
                            <input type="text" id="app_title" name="app_title" value="<?php echo esc_attr(get_option('app_title', 'Tu flota en la')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="app_subtitle">Título (parte 2 - con gradiente)</label></th>
                        <td>
                            <input type="text" id="app_subtitle" name="app_subtitle" value="<?php echo esc_attr(get_option('app_subtitle', 'palma de tu mano')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="app_description">Descripción</label></th>
                        <td>
                            <textarea id="app_description" name="app_description" rows="3"><?php echo esc_textarea(get_option('app_description', 'Descarga nuestra aplicación móvil y monitorea todos tus vehículos en tiempo real desde cualquier lugar del mundo. Recibe alertas instantáneas y mantén el control total de tu flota.')); ?></textarea>
                        </td>
                    </tr>
                </table>
                
                <div class="section-header">
                    <h2>💬 Modal de Cotización</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="quote_modal_title">Título del Modal</label></th>
                        <td>
                            <input type="text" id="quote_modal_title" name="quote_modal_title" value="<?php echo esc_attr(get_option('quote_modal_title', 'Solicita tu cotización')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="quote_modal_feature1">Beneficio 1</label></th>
                        <td>
                            <textarea id="quote_modal_feature1" name="quote_modal_feature1" rows="2"><?php echo esc_textarea(get_option('quote_modal_feature1', 'Descubre cómo Global System puede proteger tu vehículo con monitoreo GPS en tiempo real y precios accesibles.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="quote_modal_feature2">Beneficio 2</label></th>
                        <td>
                            <textarea id="quote_modal_feature2" name="quote_modal_feature2" rows="2"><?php echo esc_textarea(get_option('quote_modal_feature2', 'Instalación rápida, soporte técnico 24/7 y acceso inmediato a nuestra plataforma de monitoreo.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="quote_modal_testimonial">Testimonio</label></th>
                        <td>
                            <textarea id="quote_modal_testimonial" name="quote_modal_testimonial" rows="2"><?php echo esc_textarea(get_option('quote_modal_testimonial', 'Global System nos da la tranquilidad de saber que nuestra flota está protegida las 24 horas.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="quote_modal_testimonial_autor">Autor del Testimonio</label></th>
                        <td>
                            <input type="text" id="quote_modal_testimonial_autor" name="quote_modal_testimonial_autor" value="<?php echo esc_attr(get_option('quote_modal_testimonial_autor', 'Carlos Mendoza')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="quote_modal_testimonial_empresa">Empresa del Testimonio</label></th>
                        <td>
                            <input type="text" id="quote_modal_testimonial_empresa" name="quote_modal_testimonial_empresa" value="<?php echo esc_attr(get_option('quote_modal_testimonial_empresa', 'TransportesVE')); ?>" />
                        </td>
                    </tr>
                </table>
                
            <?php elseif ($active_tab == 'productos'): ?>
                <!-- PESTAÑA PRODUCTOS -->
                <div class="info-box">
                    <h3>📦 Edita tus Productos y Servicios</h3>
                    <p>Modifica los textos de las tarjetas de productos y los modales con información detallada.</p>
                </div>
                
                <div class="section-header">
                    <h2>Título General de Productos</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="productos_title">Título de Sección</label></th>
                        <td>
                            <input type="text" id="productos_title" name="productos_title" value="<?php echo esc_attr(get_option('productos_title', 'Productos Especializados')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="productos_subtitle">Subtítulo</label></th>
                        <td>
                            <textarea id="productos_subtitle" name="productos_subtitle" rows="2"><?php echo esc_textarea(get_option('productos_subtitle', 'Soluciones tecnológicas avanzadas para el monitoreo y control de tu flota')); ?></textarea>
                        </td>
                    </tr>
                </table>
                
                <div class="section-header">
                    <h2>📹 DashCam Inteligente</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="dashcam_card_title">Título de Tarjeta</label></th>
                        <td>
                            <input type="text" id="dashcam_card_title" name="dashcam_card_title" value="<?php echo esc_attr(get_option('dashcam_card_title', 'DashCam Inteligente')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="dashcam_card_description">Descripción Corta</label></th>
                        <td>
                            <textarea id="dashcam_card_description" name="dashcam_card_description" rows="2"><?php echo esc_textarea(get_option('dashcam_card_description', 'Monitoreo visual en tiempo real con tecnología ADAS y DMS para máxima seguridad.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="dashcam_modal_title">Título del Modal</label></th>
                        <td>
                            <input type="text" id="dashcam_modal_title" name="dashcam_modal_title" value="<?php echo esc_attr(get_option('dashcam_modal_title', '¿POR QUÉ ELEGIR NUESTRA DASHCAM?')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="dashcam_modal_beneficio1">Beneficio 1</label></th>
                        <td>
                            <textarea id="dashcam_modal_beneficio1" name="dashcam_modal_beneficio1" rows="2"><?php echo esc_textarea(get_option('dashcam_modal_beneficio1', 'Monitoreo en tiempo real: visualiza los trayectos en vivo desde cualquier lugar.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="dashcam_modal_beneficio2">Beneficio 2</label></th>
                        <td>
                            <textarea id="dashcam_modal_beneficio2" name="dashcam_modal_beneficio2" rows="2"><?php echo esc_textarea(get_option('dashcam_modal_beneficio2', 'Grabación de video HD: evidencia clara en caso de incidentes o accidentes.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="dashcam_modal_beneficio3">Beneficio 3</label></th>
                        <td>
                            <textarea id="dashcam_modal_beneficio3" name="dashcam_modal_beneficio3" rows="2"><?php echo esc_textarea(get_option('dashcam_modal_beneficio3', 'Tecnología ADAS: alertas de colisión, cambio de carril y fatiga del conductor.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="dashcam_modal_beneficio4">Beneficio 4</label></th>
                        <td>
                            <textarea id="dashcam_modal_beneficio4" name="dashcam_modal_beneficio4" rows="2"><?php echo esc_textarea(get_option('dashcam_modal_beneficio4', 'Almacenamiento en la nube: accede a grabaciones desde cualquier dispositivo.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="dashcam_modal_cta">Botón de Acción</label></th>
                        <td>
                            <input type="text" id="dashcam_modal_cta" name="dashcam_modal_cta" value="<?php echo esc_attr(get_option('dashcam_modal_cta', 'Solicitar cotización')); ?>" />
                        </td>
                    </tr>
                </table>
                
                <div class="section-header">
                    <h2>🌡️ Sensor de Temperatura</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="temperatura_card_title">Título de Tarjeta</label></th>
                        <td>
                            <input type="text" id="temperatura_card_title" name="temperatura_card_title" value="<?php echo esc_attr(get_option('temperatura_card_title', 'Sensor de Temperatura')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="temperatura_card_description">Descripción Corta</label></th>
                        <td>
                            <textarea id="temperatura_card_description" name="temperatura_card_description" rows="2"><?php echo esc_textarea(get_option('temperatura_card_description', 'Control térmico inteligente para proteger tu mercancía refrigerada en todo momento.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="temperatura_modal_title">Título del Modal</label></th>
                        <td>
                            <input type="text" id="temperatura_modal_title" name="temperatura_modal_title" value="<?php echo esc_attr(get_option('temperatura_modal_title', '¿POR QUÉ MONITOREAR LA TEMPERATURA?')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="temperatura_modal_intro">Introducción</label></th>
                        <td>
                            <textarea id="temperatura_modal_intro" name="temperatura_modal_intro" rows="3"><?php echo esc_textarea(get_option('temperatura_modal_intro', 'En operaciones de transporte y logística, la temperatura es un factor crítico.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="temperatura_modal_descripcion">Descripción</label></th>
                        <td>
                            <textarea id="temperatura_modal_descripcion" name="temperatura_modal_descripcion" rows="3"><?php echo esc_textarea(get_option('temperatura_modal_descripcion', 'El Sensor de Temperatura integrado a nuestra plataforma permite supervisar en tiempo real las condiciones térmicas.')); ?></textarea>
                        </td>
                    </tr>
                </table>
                
                <div class="section-header">
                    <h2>⛽ Monitoreo de Combustible</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="combustible_card_title">Título de Tarjeta</label></th>
                        <td>
                            <input type="text" id="combustible_card_title" name="combustible_card_title" value="<?php echo esc_attr(get_option('combustible_card_title', 'Monitoreo de Combustible')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="combustible_card_description">Descripción Corta</label></th>
                        <td>
                            <textarea id="combustible_card_description" name="combustible_card_description" rows="2"><?php echo esc_textarea(get_option('combustible_card_description', 'Detecta robos, optimiza consumos y reduce costos operativos hasta un 30%.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="combustible_modal_title">Título del Modal</label></th>
                        <td>
                            <input type="text" id="combustible_modal_title" name="combustible_modal_title" value="<?php echo esc_attr(get_option('combustible_modal_title', 'MONITOREO DE COMBUSTIBLE')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="combustible_modal_descripcion">Descripción</label></th>
                        <td>
                            <textarea id="combustible_modal_descripcion" name="combustible_modal_descripcion" rows="3"><?php echo esc_textarea(get_option('combustible_modal_descripcion', 'El combustible representa uno de los mayores costos operativos en flotas de transporte.')); ?></textarea>
                        </td>
                    </tr>
                </table>
                
            <?php elseif ($active_tab == 'cobertura'): ?>
                <!-- PESTAÑA COBERTURA -->
                <div class="section-header">
                    <h2>🌎 Cobertura Internacional</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="cobertura_badge">Badge Superior</label></th>
                        <td>
                            <input type="text" id="cobertura_badge" name="cobertura_badge" value="<?php echo esc_attr(get_option('cobertura_badge', 'Cobertura Internacional')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cobertura_title_parte1">Título (parte 1)</label></th>
                        <td>
                            <input type="text" id="cobertura_title_parte1" name="cobertura_title_parte1" value="<?php echo esc_attr(get_option('cobertura_title_parte1', 'Únete al rastreo satelital con')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cobertura_title_parte2">Título (parte 2 - con gradiente)</label></th>
                        <td>
                            <input type="text" id="cobertura_title_parte2" name="cobertura_title_parte2" value="<?php echo esc_attr(get_option('cobertura_title_parte2', 'cobertura internacional')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cobertura_description">Descripción Principal</label></th>
                        <td>
                            <textarea id="cobertura_description" name="cobertura_description" rows="4"><?php echo esc_textarea(get_option('cobertura_description', 'Para mejorar la seguridad y la logística de tu transporte o empresa, tenemos nuestras líneas multioperador internacional. Podrá funcionar en Venezuela, Colombia y Brasil, conectándose a la red móvil que tenga cobertura disponible en esos países.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cobertura_beneficio1_titulo">Beneficio 1 - Título</label></th>
                        <td>
                            <input type="text" id="cobertura_beneficio1_titulo" name="cobertura_beneficio1_titulo" value="<?php echo esc_attr(get_option('cobertura_beneficio1_titulo', 'Conexión Automática')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cobertura_beneficio1_desc">Beneficio 1 - Descripción</label></th>
                        <td>
                            <textarea id="cobertura_beneficio1_desc" name="cobertura_beneficio1_desc" rows="2"><?php echo esc_textarea(get_option('cobertura_beneficio1_desc', 'El dispositivo se conecta automáticamente al operador con mejor señal en cada país.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cobertura_beneficio2_titulo">Beneficio 2 - Título</label></th>
                        <td>
                            <input type="text" id="cobertura_beneficio2_titulo" name="cobertura_beneficio2_titulo" value="<?php echo esc_attr(get_option('cobertura_beneficio2_titulo', 'Sin Interrupciones')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cobertura_beneficio2_desc">Beneficio 2 - Descripción</label></th>
                        <td>
                            <textarea id="cobertura_beneficio2_desc" name="cobertura_beneficio2_desc" rows="2"><?php echo esc_textarea(get_option('cobertura_beneficio2_desc', 'Rastrea tus vehículos sin perder señal al cruzar fronteras internacionales.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cobertura_beneficio3_titulo">Beneficio 3 - Título</label></th>
                        <td>
                            <input type="text" id="cobertura_beneficio3_titulo" name="cobertura_beneficio3_titulo" value="<?php echo esc_attr(get_option('cobertura_beneficio3_titulo', 'Optimiza tu Logística')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="cobertura_beneficio3_desc">Beneficio 3 - Descripción</label></th>
                        <td>
                            <textarea id="cobertura_beneficio3_desc" name="cobertura_beneficio3_desc" rows="2"><?php echo esc_textarea(get_option('cobertura_beneficio3_desc', 'Ideal para empresas de transporte internacional y distribución regional.')); ?></textarea>
                        </td>
                    </tr>
                </table>
                
            <?php elseif ($active_tab == 'vehiculos'): ?>
                <!-- PESTAÑA VEHÍCULOS -->
                <div class="section-header">
                    <h2>🚗 Tipos de Vehículos</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="vehiculos_intro">Texto Introductorio</label></th>
                        <td>
                            <input type="text" id="vehiculos_intro" name="vehiculos_intro" value="<?php echo esc_attr(get_option('vehiculos_intro', 'Protege tu vehículo con Global System')); ?>" class="large-text" />
                            <p class="description">Texto que aparece encima de los iconos de vehículos</p>
                        </td>
                    </tr>
                </table>
                
            <?php elseif ($active_tab == 'nosotros'): ?>
                <!-- PESTAÑA NOSOTROS -->
                <div class="section-header">
                    <h2>ℹ️ Sobre Nosotros</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="nosotros_title">Título</label></th>
                        <td>
                            <input type="text" id="nosotros_title" name="nosotros_title" value="<?php echo esc_attr(get_option('nosotros_title', 'Sobre Global System')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="nosotros_subtitle">Subtítulo</label></th>
                        <td>
                            <input type="text" id="nosotros_subtitle" name="nosotros_subtitle" value="<?php echo esc_attr(get_option('nosotros_subtitle', 'Líderes en tecnología GPS')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="nosotros_descripcion">Descripción</label></th>
                        <td>
                            <textarea id="nosotros_descripcion" name="nosotros_descripcion" rows="5"><?php echo esc_textarea(get_option('nosotros_descripcion', 'Somos una empresa especializada en sistemas de rastreo satelital GPS...')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="nosotros_mision">Misión</label></th>
                        <td>
                            <textarea id="nosotros_mision" name="nosotros_mision" rows="3"><?php echo esc_textarea(get_option('nosotros_mision', '')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="nosotros_vision">Visión</label></th>
                        <td>
                            <textarea id="nosotros_vision" name="nosotros_vision" rows="3"><?php echo esc_textarea(get_option('nosotros_vision', '')); ?></textarea>
                        </td>
                    </tr>
                </table>
                
            <?php elseif ($active_tab == 'contacto'): ?>
                <!-- PESTAÑA CONTACTO -->
                <div class="section-header">
                    <h2>📞 Información de Contacto</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="contact_phone">Teléfono Principal</label></th>
                        <td>
                            <input type="text" id="contact_phone" name="contact_phone" value="<?php echo esc_attr(get_option('contact_phone', '+58 412 123 4567')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="contact_whatsapp">WhatsApp</label></th>
                        <td>
                            <input type="text" id="contact_whatsapp" name="contact_whatsapp" value="<?php echo esc_attr(get_option('contact_whatsapp', '+58 412 123 4567')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="contact_email">Email</label></th>
                        <td>
                            <input type="email" id="contact_email" name="contact_email" value="<?php echo esc_attr(get_option('contact_email', 'info@globalsystemgps.com')); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="contact_address">Dirección</label></th>
                        <td>
                            <textarea id="contact_address" name="contact_address" rows="2"><?php echo esc_textarea(get_option('contact_address', 'Venezuela')); ?></textarea>
                        </td>
                    </tr>
                </table>
                
                <div class="section-header">
                    <h2>🔗 Redes Sociales</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="social_instagram">Instagram URL</label></th>
                        <td>
                            <input type="url" id="social_instagram" name="social_instagram" value="<?php echo esc_attr(get_option('social_instagram', '#')); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="social_facebook">Facebook URL</label></th>
                        <td>
                            <input type="url" id="social_facebook" name="social_facebook" value="<?php echo esc_attr(get_option('social_facebook', '#')); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="social_whatsapp">WhatsApp URL</label></th>
                        <td>
                            <input type="url" id="social_whatsapp" name="social_whatsapp" value="<?php echo esc_attr(get_option('social_whatsapp', '#')); ?>" class="large-text" />
                        </td>
                    </tr>
                </table>
                
                <div class="section-header">
                    <h2>📄 Footer</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="footer_descripcion">Descripción en Footer</label></th>
                        <td>
                            <textarea id="footer_descripcion" name="footer_descripcion" rows="3"><?php echo esc_textarea(get_option('footer_descripcion', 'Global System - Tecnología GPS avanzada para la protección de tu flota.')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="footer_copyright">Copyright</label></th>
                        <td>
                            <input type="text" id="footer_copyright" name="footer_copyright" value="<?php echo esc_attr(get_option('footer_copyright', '© 2026 Global System. Todos los derechos reservados.')); ?>" class="large-text" />
                        </td>
                    </tr>
                </table>
                
            <?php endif; ?>
            
            <?php if ($active_tab == 'apks'): ?>
                <!-- PESTAÑA APKs -->
                <div class="info-box">
                    <h3>📲 Gestión de APKs Descargables</h3>
                    <p>Sube los archivos APK a la <strong>Biblioteca de Medios</strong> de WordPress y pega aquí la URL del archivo. Los usuarios podrán descargarlos directamente desde la página.</p>
                </div>
                
                <div class="section-header">
                    <h2>📱 APK 1: Global System GPS</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="apk_1_nombre">Nombre de la App</label></th>
                        <td>
                            <input type="text" id="apk_1_nombre" name="apk_1_nombre" value="<?php echo esc_attr(get_option('apk_1_nombre', 'Global System GPS')); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="apk_1_descripcion">Descripción corta</label></th>
                        <td>
                            <input type="text" id="apk_1_descripcion" name="apk_1_descripcion" value="<?php echo esc_attr(get_option('apk_1_descripcion', 'App principal de monitoreo')); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="apk_1_archivo">URL del APK</label></th>
                        <td>
                            <input type="url" id="apk_1_archivo" name="apk_1_archivo" value="<?php echo esc_attr(get_option('apk_1_archivo', '')); ?>" class="large-text" />
                            <p class="description">Sube el APK a Medios y pega aquí la URL</p>
                        </td>
                    </tr>
                </table>
                
                <div class="section-header">
                    <h2>🔔 APK 2: Alarma GPS</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="apk_2_nombre">Nombre de la App</label></th>
                        <td>
                            <input type="text" id="apk_2_nombre" name="apk_2_nombre" value="<?php echo esc_attr(get_option('apk_2_nombre', 'Alarma GPS')); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="apk_2_descripcion">Descripción corta</label></th>
                        <td>
                            <input type="text" id="apk_2_descripcion" name="apk_2_descripcion" value="<?php echo esc_attr(get_option('apk_2_descripcion', 'Sistema de alarmas y alertas')); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="apk_2_archivo">URL del APK</label></th>
                        <td>
                            <input type="url" id="apk_2_archivo" name="apk_2_archivo" value="<?php echo esc_attr(get_option('apk_2_archivo', '')); ?>" class="large-text" />
                            <p class="description">Sube el APK a Medios y pega aquí la URL</p>
                        </td>
                    </tr>
                </table>
                
                <div class="section-header">
                    <h2>📍 APK 3: Global v3</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="apk_3_nombre">Nombre de la App</label></th>
                        <td>
                            <input type="text" id="apk_3_nombre" name="apk_3_nombre" value="<?php echo esc_attr(get_option('apk_3_nombre', 'Global v3')); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="apk_3_descripcion">Descripción corta</label></th>
                        <td>
                            <input type="text" id="apk_3_descripcion" name="apk_3_descripcion" value="<?php echo esc_attr(get_option('apk_3_descripcion', 'Versión actualizada del rastreador')); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="apk_3_archivo">URL del APK</label></th>
                        <td>
                            <input type="url" id="apk_3_archivo" name="apk_3_archivo" value="<?php echo esc_attr(get_option('apk_3_archivo', '')); ?>" class="large-text" />
                            <p class="description">Sube el APK a Medios y pega aquí la URL</p>
                        </td>
                    </tr>
                </table>
                
                <div class="section-header">
                    <h2>🗺️ APK 4: Rutas Global</h2>
                </div>
                <table class="form-table">
                    <tr>
                        <th><label for="apk_4_nombre">Nombre de la App</label></th>
                        <td>
                            <input type="text" id="apk_4_nombre" name="apk_4_nombre" value="<?php echo esc_attr(get_option('apk_4_nombre', 'Rutas Global')); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="apk_4_descripcion">Descripción corta</label></th>
                        <td>
                            <input type="text" id="apk_4_descripcion" name="apk_4_descripcion" value="<?php echo esc_attr(get_option('apk_4_descripcion', 'Gestión de rutas y recorridos')); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th><label for="apk_4_archivo">URL del APK</label></th>
                        <td>
                            <input type="url" id="apk_4_archivo" name="apk_4_archivo" value="<?php echo esc_attr(get_option('apk_4_archivo', '')); ?>" class="large-text" />
                            <p class="description">Sube el APK a Medios y pega aquí la URL</p>
                        </td>
                    </tr>
                </table>
                
            <?php endif; ?>
            
            <?php submit_button('💾 Guardar Cambios', 'primary large'); ?>
        </form>
        
        <div class="info-box" style="margin-top: 30px;">
            <h3>💡 Información Importante</h3>
            <ul>
                <li>✅ Los cambios se guardan automáticamente al hacer clic en "Guardar Cambios"</li>
                <li>🔄 Puedes volver a los textos originales dejando el campo vacío</li>
                <li>🎨 El diseño y estructura se mantienen intactos</li>
                <li>📱 Todos los cambios son responsive (se adaptan a móviles)</li>
                <li>⚡ Los cambios son instantáneos en el sitio</li>
            </ul>
        </div>
    </div>
    <?php
}

// Función helper para obtener contenido editable
function get_editable_content($field, $default = '') {
    $value = get_option($field, $default);
    return !empty($value) ? $value : $default;
}
