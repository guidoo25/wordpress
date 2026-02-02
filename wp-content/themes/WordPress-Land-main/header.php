<?php
/**
 * Header template.
 *
 * @package Wordpress-Land
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<script>
		tailwind.config = {
			theme: {
				extend: {
					fontFamily: {
						sans: ['Inter', 'system-ui', 'sans-serif'],
					},
					colors: {
						stripe: {
							purple: '#1993cf',
							cyan: '#73bfe8',
							pink: '#9ccfec',
							dark: '#0a2540',
							gray: '#425466',
							light: '#f6f9fc',
						}
					}
				}
			}
		}
	</script>
	<style>
		.gradient-bg {
			background: linear-gradient(
				180deg,
				rgba(25, 147, 207, 0.15) 0%,
				rgba(115, 191, 232, 0.1) 25%,
				rgba(156, 207, 236, 0.08) 50%,
				rgba(255, 255, 255, 1) 100%
			);
		}
		.hero-gradient {
			background: radial-gradient(ellipse 80% 50% at 50% -20%, rgba(25, 147, 207, 0.3), transparent),
						radial-gradient(ellipse 60% 40% at 80% 20%, rgba(115, 191, 232, 0.2), transparent),
						radial-gradient(ellipse 50% 30% at 20% 30%, rgba(156, 207, 236, 0.15), transparent);
		}
		.card-gradient {
			background: linear-gradient(135deg, rgba(25, 147, 207, 0.05) 0%, rgba(115, 191, 232, 0.05) 100%);
		}
		.animate-float {
			animation: float 6s ease-in-out infinite;
		}
		@keyframes float {
			0%, 100% { transform: translateY(0); }
			50% { transform: translateY(-10px); }
		}
		.stripe-arrow {
			transition: transform 0.2s ease;
		}
		.group:hover .stripe-arrow {
			transform: translateX(4px);
		}
	</style>
	<style>
		/* Smooth scroll behavior */
		html {
			scroll-behavior: smooth;
			scroll-padding-top: 80px; /* Offset for sticky header */
		}
	</style>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head(); ?>
</head>
<body <?php body_class('font-sans antialiased text-stripe-dark'); ?>>

<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}

// 1. Get Site Logo URL (Requires Site Logo to be set in Customizer)
$custom_logo_id = get_theme_mod('custom_logo');
$logo_url = $custom_logo_id ? wp_get_attachment_image_src($custom_logo_id, 'full')[0] : '';
$site_url = get_bloginfo('url');
$site_title = get_bloginfo('name');

// Helper function for the stripe arrow icon
if (!function_exists('stripe_arrow_icon')) {
    function stripe_arrow_icon($color = 'currentColor') {
    ?>
        <svg class="stripe-arrow" width="12" height="12" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.5 3L11.5 8L6.5 13" stroke="<?php echo $color; ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    <?php
    }
}
?>

<div id="page" class="site">
 
    <header id="masthead" class="site-header sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-100" role="banner">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="<?php echo esc_url($site_url); ?>" class="flex-shrink-0 flex items-center gap-2">
                    <?php if ($logo_url): ?>
                        <img src="<?php echo esc_url($logo_url); ?>" class="h-8 w-auto" alt="<?php echo esc_attr($site_title); ?>">
                    <?php else: ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/src/img/imgi_1_GLOBAL-SYSTEM-1024x514-blanco-150x75.png' ); ?>" class="h-8 w-auto" alt="<?php echo esc_attr($site_title); ?>">
                    <?php endif; ?>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center gap-8">
                    <a href="#inicio" class="text-sm font-medium text-stripe-gray hover:text-stripe-dark transition-colors">Inicio</a>
                    <a href="#productos" class="text-sm font-medium text-stripe-gray hover:text-stripe-dark transition-colors">Productos</a>
                    <a href="#cobertura-internacional" class="text-sm font-medium text-stripe-gray hover:text-stripe-dark transition-colors">Cobertura</a>
                    <a href="#vehiculos" class="text-sm font-medium text-stripe-gray hover:text-stripe-dark transition-colors">Vehículos</a>
                    <a href="#nosotros" class="text-sm font-medium text-stripe-gray hover:text-stripe-dark transition-colors">Nosotros</a>
                    <a href="#instagram" class="text-sm font-medium text-stripe-gray hover:text-stripe-dark transition-colors">Instagram</a>
                    <a href="#contacto" class="text-sm font-medium text-stripe-gray hover:text-stripe-dark transition-colors">Contacto</a>
                </div>

                <!-- CTA Buttons -->
                <div class="flex items-center gap-4">
                    <a href="https://servei.globalsystemgps.com/login" target="_blank" class="hidden sm:block text-sm font-medium text-stripe-gray hover:text-stripe-dark transition-colors">
                        Iniciar sesión
                    </a>
                    <button type="button" onclick="openQuoteModal()" class="group inline-flex items-center gap-2 bg-stripe-purple hover:bg-stripe-purple/90 text-white text-sm font-semibold px-4 py-2 rounded-full transition-all">
                        Empieza ahora
                        <?php stripe_arrow_icon('white'); ?>
                    </button>
                </div>

                <!-- Mobile menu button -->
                <button class="lg:hidden p-2 rounded-md text-stripe-gray hover:text-stripe-dark">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </nav>
    </header>
    <div id="content" class="site-content">

