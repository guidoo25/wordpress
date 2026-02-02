<?php
/**
 * Front Page Setup Checker
 * 
 * Ejecutar en browser: /wp-content/themes/global-system-theme/checker.php
 * O llamar a wp-cli: wp theme check --theme=global-system-theme
 */

// Cargar WordPress - Calcular ruta correcta
// Desde: wp-content/themes/global-system-theme/checker.php
// Ir a: wp-load.php (4 niveles hacia arriba)
$wp_load = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';

if (!file_exists($wp_load)) {
    die('Error: No se encontró wp-load.php en: ' . $wp_load . '<br>Verifica que este archivo está en la carpeta del tema correcto.');
}

require_once $wp_load;

// Verificar si es admin
if (!current_user_can('manage_options')) {
    wp_die('Necesitas permisos de administrador para ver esto.');
}

$checks = [];

// 1. Verificar que front-page.php existe
$checks[] = [
    'name' => 'Archivo front-page.php',
    'file' => 'front-page.php',
    'status' => file_exists(__DIR__ . '/front-page.php') ? '✅ OK' : '❌ Falta',
];

// 2. Verificar que inc/custom-front-page.php existe
$checks[] = [
    'name' => 'Archivo inc/custom-front-page.php',
    'file' => 'inc/custom-front-page.php',
    'status' => file_exists(__DIR__ . '/inc/custom-front-page.php') ? '✅ OK' : '❌ Falta',
];

// 3. Verificar que functions.php incluye el archivo
$functions_content = file_get_contents(__DIR__ . '/functions.php');
$checks[] = [
    'name' => 'functions.php incluye custom-front-page.php',
    'file' => 'functions.php',
    'status' => (strpos($functions_content, 'custom-front-page.php') !== false) ? '✅ OK' : '⚠️ No incluido',
];

// 4. Verificar hooks registrados
$checks[] = [
    'name' => 'Hooks de Meta Boxes registrados',
    'file' => 'WordPress Hooks',
    'status' => (has_action('add_meta_boxes', 'gs_register_front_page_metabox')) ? '✅ OK' : '❌ No registrado',
];

// 5. Verificar página principal asignada
$front_page_id = get_option('page_on_front');
$checks[] = [
    'name' => 'Página principal asignada',
    'file' => 'WordPress Settings',
    'status' => ($front_page_id) ? '✅ OK (ID: ' . $front_page_id . ')' : '⚠️ No asignada',
];

// 6. Verificar Tailwind CSS
$tailwind_config = file_exists(__DIR__ . '/tailwind.config.js');
$checks[] = [
    'name' => 'Configuración Tailwind CSS',
    'file' => 'tailwind.config.js',
    'status' => $tailwind_config ? '✅ OK' : '⚠️ No encontrado',
];

// 7. Verificar que TailPress está cargado
$checks[] = [
    'name' => 'TailPress Framework',
    'file' => 'vendor/autoload.php',
    'status' => (class_exists('TailPress\\Framework\\Theme')) ? '✅ OK' : '❌ No cargado',
];

// 8. Verificar permisos de escritura
$writable = is_writable(__DIR__);
$checks[] = [
    'name' => 'Permisos de escritura en tema',
    'file' => 'Tema',
    'status' => $writable ? '✅ OK' : '❌ Sin permiso',
];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación - Página Principal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #635BFF 0%, #4c3bb3 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .header p {
            opacity: 0.9;
            font-size: 16px;
        }
        
        .content {
            padding: 40px;
        }
        
        .checks {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .check-item {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        
        .check-item:hover {
            border-color: #635BFF;
            box-shadow: 0 4px 12px rgba(99, 91, 255, 0.1);
        }
        
        .check-item.ok {
            border-color: #28a745;
            background: #f0fdf4;
        }
        
        .check-item.warning {
            border-color: #ffc107;
            background: #fffbf0;
        }
        
        .check-item.error {
            border-color: #dc3545;
            background: #fdf0f0;
        }
        
        .check-name {
            font-weight: 600;
            color: #0a2540;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .check-file {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 8px;
            font-family: 'Courier New', monospace;
        }
        
        .check-status {
            font-weight: 700;
            font-size: 14px;
        }
        
        .status-ok {
            color: #28a745;
        }
        
        .status-warning {
            color: #ff9800;
        }
        
        .status-error {
            color: #dc3545;
        }
        
        .instructions {
            background: #f0fdf4;
            border-left: 4px solid #28a745;
            padding: 20px;
            margin-top: 40px;
            border-radius: 4px;
        }
        
        .instructions h3 {
            color: #28a745;
            margin-bottom: 10px;
        }
        
        .instructions ol {
            margin-left: 20px;
            color: #333;
            line-height: 1.8;
        }
        
        .instructions li {
            margin-bottom: 8px;
        }
        
        .footer {
            background: #f8f9fa;
            padding: 20px 40px;
            border-top: 1px solid #e9ecef;
            font-size: 13px;
            color: #6c757d;
            text-align: center;
        }
        
        .badge {
            display: inline-block;
            background: #635BFF;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✓ Verificación de Instalación</h1>
            <p>Página Principal Editable - Global System GPS</p>
        </div>
        
        <div class="content">
            <div class="checks">
                <?php foreach ($checks as $check): 
                    $is_ok = strpos($check['status'], '✅') !== false;
                    $is_warning = strpos($check['status'], '⚠️') !== false;
                    $is_error = strpos($check['status'], '❌') !== false;
                    
                    $class = $is_ok ? 'ok' : ($is_warning ? 'warning' : ($is_error ? 'error' : ''));
                    $status_class = $is_ok ? 'status-ok' : ($is_warning ? 'status-warning' : 'status-error');
                ?>
                    <div class="check-item <?php echo $class; ?>">
                        <div class="check-name">
                            <?php echo $check['name']; ?>
                        </div>
                        <div class="check-file">
                            <?php echo $check['file']; ?>
                        </div>
                        <div class="check-status <?php echo $status_class; ?>">
                            <?php echo $check['status']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="instructions">
                <h3>✨ Próximos Pasos</h3>
                <ol>
                    <li>Ve a <strong>Ajustes → Lectura</strong></li>
                    <li>Selecciona <strong>"Una página estática"</strong> como página principal</li>
                    <li>Elige la página que deseas editar (o crea una nueva)</li>
                    <li>Ve a <strong>Páginas → Editar</strong> tu página principal</li>
                    <li>Desplázate hacia abajo y rellena los campos editables</li>
                    <li>Publica los cambios</li>
                    <li>¡Listo! Tu página principal está personalizada</li>
                </ol>
            </div>
        </div>
        
        <div class="footer">
            <strong>Global System GPS Theme</strong> | Página Principal v1.0 | 
            <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" style="color: #635BFF; text-decoration: none;">
                Ver páginas →
            </a>
        </div>
    </div>
</body>
</html>
