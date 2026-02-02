<?php
/**
 * Front page template
 *
 * @package Wordpress-Land
 */

get_header();
?>

<!-- Product Modals JavaScript -->
<script>
// Función para abrir modal de producto
function openProductModal(product) {
    var modalId = product + 'Modal';
    var modal = document.getElementById(modalId);
    if (modal) {
        document.body.style.overflow = 'hidden';
        modal.classList.add('active');
    }
}

// Función para cerrar modal de producto
function closeProductModal(product) {
    var modalId = product + 'Modal';
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Cerrar modales de productos con tecla Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeProductModal('dashcam');
        closeProductModal('temperature');
        closeProductModal('fuel');
        // Vehicle modals
        closeVehicleModal('truck');
        closeVehicleModal('car');
        closeVehicleModal('motorcycle');
        closeVehicleModal('trailer');
        closeVehicleModal('container');
        closeVehicleModal('bus');
        closeVehicleModal('machinery');
    }
});

// Cerrar modal al hacer clic fuera del contenido
document.querySelectorAll('.product-modal-overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            var modalId = overlay.id;
            // For vehicle modals
            if (modalId.startsWith('vehicle')) {
                var vehicleMap = {
                    'vehicleTruckModal': 'truck',
                    'vehicleCarModal': 'car',
                    'vehicleMotorcycleModal': 'motorcycle',
                    'vehicleTrailerModal': 'trailer',
                    'vehicleContainerModal': 'container',
                    'vehicleBusModal': 'bus',
                    'vehicleMachineryModal': 'machinery'
                };
                if (vehicleMap[modalId]) {
                    closeVehicleModal(vehicleMap[modalId]);
                }
            } else {
                // For product modals (dashcam, temperature, fuel)
                var product = modalId.replace('Modal', '');
                closeProductModal(product);
            }
        }
    });
});

// Funciones para modales de vehiculos
function openVehicleModal(vehicle) {
    var modalNames = {
        'truck': 'vehicleTruckModal',
        'car': 'vehicleCarModal',
        'motorcycle': 'vehicleMotorcycleModal',
        'trailer': 'vehicleTrailerModal',
        'container': 'vehicleContainerModal',
        'bus': 'vehicleBusModal',
        'machinery': 'vehicleMachineryModal'
    };
    var modalId = modalNames[vehicle];
    var modal = document.getElementById(modalId);
    if (modal) {
        document.body.style.overflow = 'hidden';
        modal.classList.add('active');
    }
}

function closeVehicleModal(vehicle) {
    var modalNames = {
        'truck': 'vehicleTruckModal',
        'car': 'vehicleCarModal',
        'motorcycle': 'vehicleMotorcycleModal',
        'trailer': 'vehicleTrailerModal',
        'container': 'vehicleContainerModal',
        'bus': 'vehicleBusModal',
        'machinery': 'vehicleMachineryModal'
    };
    var modalId = modalNames[vehicle];
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}
</script>

<!-- Quote Modal Styles -->
<style>
/* Modal Animations */
@keyframes modal-expand {
    0% {
        transform: scale(0.1);
        opacity: 0;
        border-radius: 100px;
    }
    100% {
        transform: scale(1);
        opacity: 1;
        border-radius: 24px;
    }
}

@keyframes modal-collapse {
    0% {
        transform: scale(1);
        opacity: 1;
        border-radius: 24px;
    }
    100% {
        transform: scale(0.1);
        opacity: 0;
        border-radius: 100px;
    }
}

@keyframes content-fade-in {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes mesh-gradient {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

.quote-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

.quote-modal-overlay.active {
    opacity: 1;
    pointer-events: auto;
}

.quote-modal {
    position: relative;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    transform: scale(0.1);
    opacity: 0;
    border-radius: 100px;
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), 
                opacity 0.3s ease,
                border-radius 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.quote-modal-overlay.active .quote-modal {
    transform: scale(1);
    opacity: 1;
    border-radius: 24px;
}

.quote-modal-content {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.4s ease 0.15s, transform 0.4s ease 0.15s;
}

.quote-modal-overlay.active .quote-modal-content {
    opacity: 1;
    transform: translateY(0);
}

/* Mesh Gradient Background */
.mesh-gradient-bg {
    background: linear-gradient(-45deg, #1993cf, #22597f, #73bfe8, #1993cf);
    background-size: 400% 400%;
    animation: mesh-gradient 15s ease infinite;
}

/* Button trigger animation */
.cta-button-wrapper {
    position: relative;
    display: inline-block;
}

.cta-button-wrapper .cta-bg {
    position: absolute;
    inset: 0;
    background: #0a2540;
    border-radius: 100px;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.cta-button-wrapper:hover .cta-bg {
    transform: scale(1.02);
}

.cta-button-wrapper button,
.cta-button-wrapper a {
    position: relative;
    z-index: 1;
}

/* Form input styles */
.quote-form-input {
    width: 100%;
    padding: 10px 16px;
    border-radius: 8px;
    background: rgba(0, 31, 99, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: white;
    font-size: 14px;
    transition: all 0.2s ease;
}

.quote-form-input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.quote-form-input:focus {
    outline: none;
    border-color: rgba(255, 255, 255, 0.3);
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
}

.quote-form-label {
    display: block;
    font-size: 10px;
    font-family: monospace;
    font-weight: normal;
    color: white;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.quote-form-select {
    width: 100%;
    padding: 10px 16px;
    border-radius: 8px;
    background: rgba(0, 31, 99, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: white;
    font-size: 14px;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
}

.quote-form-select:focus {
    outline: none;
    border-color: rgba(255, 255, 255, 0.3);
}

/* ============================================== */
/* ESTILOS PARA MODALES DE PRODUCTOS */
/* ============================================== */

/* Product Modal Overlay */
.product-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: none; /* Oculto por defecto */
    align-items: center;
    justify-content: center;
    padding: 12px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

.product-modal-overlay.active {
    display: flex; /* Mostrar cuando esté activo */
    opacity: 1;
    pointer-events: auto;
}

.product-modal {
    position: relative;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    transform: scale(0.1);
    opacity: 0;
    border-radius: 100px;
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), 
                opacity 0.3s ease,
                border-radius 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.product-modal-overlay.active .product-modal {
    transform: scale(1);
    opacity: 1;
    border-radius: 24px;
}

.product-modal-content {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.4s ease 0.15s, transform 0.4s ease 0.15s;
}

.product-modal-overlay.active .product-modal-content {
    opacity: 1;
    transform: translateY(0);
}

/* Gradient Backgrounds para cada modal */
.mesh-gradient-dashcam {
    background: linear-gradient(-45deg, #0a2540, #1993cf, #22597f, #0a2540);
    background-size: 400% 400%;
    animation: mesh-gradient 15s ease infinite;
}

.mesh-gradient-temperature {
    background: linear-gradient(-45deg, #7c2d12, #ea580c, #f97316, #c2410c);
    background-size: 400% 400%;
    animation: mesh-gradient 15s ease infinite;
}

.mesh-gradient-fuel {
    background: linear-gradient(-45deg, #064e3b, #059669, #10b981, #047857);
    background-size: 400% 400%;
    animation: mesh-gradient 15s ease infinite;
}

/* Product Cards Hover */
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Feature Item en modales de productos */
.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.feature-icon {
    flex-shrink: 0;
    width: 28px;
    height: 28px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-icon svg {
    width: 16px;
    height: 16px;
}
</style>

<!-- Quote Modal -->
<div id="quoteModal" class="quote-modal-overlay">
    <div class="quote-modal mesh-gradient-bg">
        <!-- Close Button -->
        <button onclick="closeQuoteModal()" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="quote-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1100px] mx-auto items-center p-6 sm:p-10 lg:p-16 gap-8 lg:gap-16">
            <!-- Left Side - Info -->
            <div class="flex-1 flex flex-col justify-center space-y-4 w-full">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-none tracking-tight">
                    Solicita tu cotización
                </h2>

                <div class="space-y-4 sm:space-y-6 pt-4">
                    <div class="flex gap-3 sm:gap-4">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-white/10 flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm sm:text-base text-white leading-relaxed">
                                Descubre cómo Global System puede proteger tu vehículo con monitoreo GPS en tiempo real y precios accesibles.
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-3 sm:gap-4">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-white/10 flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm sm:text-base text-white leading-relaxed">
                                Instalación rápida, soporte técnico 24/7 y acceso inmediato a nuestra plataforma de monitoreo.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 sm:pt-8 mt-6 sm:mt-8 border-t border-white/20">
                    <p class="text-lg sm:text-xl lg:text-2xl text-white leading-relaxed mb-4">
                        "Global System nos da la tranquilidad de saber que nuestra flota está protegida las 24 horas."
                    </p>
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gradient-to-br from-stripe-purple to-stripe-cyan flex items-center justify-center text-white font-bold text-lg">
                            CM
                        </div>
                        <div>
                            <p class="text-base sm:text-lg lg:text-xl text-white">Carlos Mendoza</p>
                            <p class="text-sm sm:text-base text-white/70">TransportesVE</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="flex-1 w-full">
                <form class="space-y-4 sm:space-y-5" id="quoteForm">
                    <!-- Name Field -->
                    <div>
                        <label for="quote_name" class="quote-form-label">NOMBRE COMPLETO *</label>
                        <input type="text" id="quote_name" name="name" required class="quote-form-input" placeholder="Tu nombre">
                    </div>

                    <!-- Phone Field -->
                    <div>
                        <label for="quote_phone" class="quote-form-label">TELÉFONO *</label>
                        <input type="tel" id="quote_phone" name="phone" required class="quote-form-input" placeholder="+58 412 123 4567">
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="quote_email" class="quote-form-label">CORREO ELECTRÓNICO</label>
                        <input type="email" id="quote_email" name="email" class="quote-form-input" placeholder="tu@email.com">
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <!-- Vehicle Type -->
                        <div class="flex-1">
                            <label for="quote_vehicle" class="quote-form-label">TIPO DE VEHÍCULO</label>
                            <select id="quote_vehicle" name="vehicle" class="quote-form-select">
                                <option value="sedan">Sedán</option>
                                <option value="suv">SUV / Camioneta</option>
                                <option value="truck">Camión</option>
                                <option value="motorcycle">Moto</option>
                                <option value="bus">Bus / Autobús</option>
                                <option value="fleet">Flota (múltiples)</option>
                                <option value="other">Otro</option>
                            </select>
                        </div>
                        <!-- Quantity -->
                        <div class="sm:w-32 w-full">
                            <label for="quote_qty" class="quote-form-label">CANTIDAD</label>
                            <select id="quote_qty" name="quantity" class="quote-form-select">
                                <option value="1">1</option>
                                <option value="2-5">2-5</option>
                                <option value="6-10">6-10</option>
                                <option value="11-20">11-20</option>
                                <option value="20+">20+</option>
                            </select>
                        </div>
                    </div>

                    <!-- Message Field -->
                    <div>
                        <label for="quote_message" class="quote-form-label">MENSAJE ADICIONAL</label>
                        <textarea id="quote_message" name="message" rows="3" class="quote-form-input resize-none" placeholder="Cuéntanos más sobre tus necesidades..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full px-8 py-3 rounded-full bg-white text-stripe-purple font-semibold hover:bg-white/90 transition-colors tracking-tight">
                        Enviar solicitud
                    </button>

                    <p class="text-xs text-white/60 text-center">
                        Al enviar, aceptas nuestros términos y condiciones de servicio.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

// Tipos de vehículos que se pueden monitorear
$vehicle_types = [
    ['name' => 'Camiones', 'icon' => 'truck'],
    ['name' => 'Carros', 'icon' => 'car'],
    ['name' => 'Remolques', 'icon' => 'trailer'],
    ['name' => 'Motos', 'icon' => 'motorcycle'],
    ['name' => 'Contenedores', 'icon' => 'container'],
    ['name' => 'Buses', 'icon' => 'bus'],
    ['name' => 'Flotas', 'icon' => 'fleet'],
    ['name' => 'Maquinaria', 'icon' => 'machinery'],
];

// Servicios/Productos
$products = [
    ['name' => 'Rastreo GPS', 'color' => '#1993cf'],
    ['name' => 'Plataforma Web', 'color' => '#73bfe8'],
    ['name' => 'App Móvil', 'color' => '#9ccfec'],
    ['name' => 'Alertas', 'color' => '#11efa4'],
    ['name' => 'Cercas Virtuales', 'color' => '#ffc233'],
    ['name' => 'Reportes', 'color' => '#8956ff'],
    ['name' => 'Apagado Remoto', 'color' => '#0073e6'],
    ['name' => 'Soporte 24/7', 'color' => '#00a67d'],
];

// Features - Beneficios
$features = [
    [
        'title' => 'Localización GPS',
        'description' => 'Equipos de alta calidad para rastreo GPS de vehículos con precisión en tiempo real.',
        'icon' => 'globe',
        'color' => 'stripe-purple'
    ],
    [
        'title' => 'Plataforma Web',
        'description' => 'Monitorea tu vehículo en tiempo real desde cualquier navegador con nuestra plataforma intuitiva.',
        'icon' => 'trending-up',
        'color' => 'stripe-cyan'
    ],
    [
        'title' => 'Aplicación Móvil',
        'description' => 'La posición de tu vehículo al alcance de tu celular. Disponible en Google Play y App Store.',
        'icon' => 'shield',
        'color' => 'stripe-pink'
    ],
    [
        'title' => 'Soporte 24/7',
        'description' => 'Servicio post venta técnico y atención al cliente las 24 horas, los 7 días de la semana.',
        'icon' => 'server',
        'color' => 'stripe-dark'
    ],
];

// Stripe Arrow Icon Function
function stripe_arrow_icon($color = '#1993cf') {
    echo '<svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="' . $color . '" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
    </svg>';
}
?>

<!-- Hero Section -->
<section id="inicio" class="relative overflow-hidden hero-gradient">
    <!-- Grid Lines Background -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="max-w-7xl mx-auto h-full px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 h-full">
                <div class="border-l border-gray-200/50"></div>
                <div class="border-l border-dashed border-gray-200/30 hidden md:block"></div>
                <div class="border-l border-dashed border-gray-200/30 hidden md:block"></div>
                <div class="border-l border-r border-gray-200/50"></div>
            </div>
        </div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24 lg:pt-24 lg:pb-32">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Text Content -->
            <div class="space-y-8">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 bg-stripe-dark/80 backdrop-blur text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                    <span>Global System</span>
                    <span class="text-stripe-gray">•</span>
                    <a href="#" onclick="openQuoteModal(); return false;" class="group inline-flex items-center gap-1 text-stripe-cyan hover:underline" role="button" aria-haspopup="dialog" aria-controls="quoteModal">
                        Protege tu vehículo hoy
                        <?php stripe_arrow_icon('#73bfe8'); ?>
                    </a>
                </div>

                <!-- Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold tracking-tight text-stripe-dark leading-[1.1] text-balance">
                    Sistema de rastreo y 
                    <span class="bg-gradient-to-r from-stripe-purple via-stripe-cyan to-stripe-pink bg-clip-text text-transparent">
                        protección vehicular
                    </span>
                </h1>

                <!-- Description -->
                <p class="text-lg lg:text-xl text-stripe-gray max-w-xl leading-relaxed">
                    Proporcionamos telemetría avanzada con datos de análisis para empresas: km recorridos, horas de motor, tiempos de conducción y paradas, excesos de velocidad y más.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- Primary CTA - Opens Modal -->
                    <div class="cta-button-wrapper">
                        <div class="cta-bg"></div>
                        <button 
                            type="button" 
                            onclick="openQuoteModal()"
                            class="group inline-flex items-center justify-center gap-2 h-12 px-8 text-white text-sm font-semibold rounded-full transition-all"
                        >
                            Cotizar ahora
                            <?php stripe_arrow_icon('white'); ?>
                        </button>
                    </div>
                    
                    <!-- Secondary CTA - Centro de Pagos -->
                    <a 
                        href="https://cobro.globalrastreo.com" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="group inline-flex items-center justify-center gap-2 h-12 px-6 bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white text-sm font-semibold rounded-full transition-all shadow-lg hover:shadow-emerald-500/25"
                    >
                        <span>Consulta / Reporta / Paga</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>

                <!-- Link to services -->
                <a href="#productos" class="group inline-flex items-center gap-2 text-stripe-purple font-semibold hover:underline">
                    Ver productos y servicios
                    <?php stripe_arrow_icon('#1993cf'); ?>
                </a>
            </div>

            <!-- Device Mockups Preview -->
            <div class="relative lg:pl-8">
                <!-- Gradient Background Blobs -->
                <div class="absolute -top-16 -right-16 w-80 h-80 bg-gradient-to-br from-sky-300 via-blue-400 to-cyan-500 rounded-full blur-3xl opacity-40 animate-float"></div>
                <div class="absolute top-20 right-0 w-64 h-64 bg-gradient-to-br from-cyan-300 via-blue-400 to-sky-500 rounded-full blur-3xl opacity-30 animate-float" style="animation-delay: 1s;"></div>
                <div class="absolute -bottom-10 left-10 w-48 h-48 bg-gradient-to-br from-blue-300 to-cyan-400 rounded-full blur-2xl opacity-30 animate-float" style="animation-delay: 0.5s;"></div>

                <!-- Desktop Browser Mockup -->
                <div class="relative ml-16 animate-float" style="animation-delay: 0.2s;">
                    <div class="bg-white rounded-xl shadow-2xl shadow-purple-500/20 overflow-hidden border border-gray-200/50 w-full max-w-md">
                        <!-- Browser Header -->
                        <div class="bg-gray-100 px-4 py-3 flex items-center gap-3 border-b border-gray-200">
                            <div class="flex items-center gap-1.5">
                                <span class="w-3 h-3 rounded-full bg-red-400"></span>
                                <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                                <span class="w-3 h-3 rounded-full bg-green-400"></span>
                            </div>
                            <div class="flex-1 bg-white rounded-md px-3 py-1.5 text-xs text-gray-400 border border-gray-200">
                                servei.globalsystemgps.com/login
                            </div>
                        </div>
                        <!-- Browser Content -->
                        <div class="p-6 bg-gradient-to-br from-gray-50 to-white min-h-[280px]">
                            <!-- Dashboard Stats Preview -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="h-3 w-24 bg-gray-200 rounded"></div>
                                    <div class="h-3 w-16 bg-green-200 rounded"></div>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                                        <div class="h-2 w-12 bg-gray-200 rounded mb-2"></div>
                                        <div class="h-5 w-20 bg-stripe-purple/20 rounded"></div>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                                        <div class="h-2 w-12 bg-gray-200 rounded mb-2"></div>
                                        <div class="h-5 w-20 bg-stripe-cyan/20 rounded"></div>
                                    </div>
                                </div>
                                <!-- Mini Chart -->
                                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                                    <div class="h-16 flex items-end gap-1">
                                        <?php 
                                        $heights = [30, 45, 35, 55, 40, 65, 50, 75, 60, 85, 70, 90];
                                        foreach ($heights as $h): 
                                        ?>
                                        <div class="flex-1 bg-gradient-to-t from-stripe-purple to-stripe-cyan rounded-t" style="height: <?php echo $h; ?>%"></div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Smartphone Mockup -->
                <div class="absolute -left-4 top-8 lg:-left-8 z-10 animate-float">
                    <!-- Phone Frame -->
                    <div class="relative">
                        <!-- Phone Outer Shell -->
                        <div class="w-36 sm:w-44 bg-gradient-to-b from-gray-100 via-gray-50 to-gray-200 rounded-[2.5rem] p-1.5 shadow-2xl shadow-gray-400/30">
                            <!-- Phone Inner Bezel -->
                            <div class="bg-gradient-to-b from-gray-200 to-gray-100 rounded-[2rem] p-0.5">
                                <!-- Phone Screen Container -->
                                <div class="bg-white rounded-[1.8rem] overflow-hidden relative">
                                    <!-- Dynamic Island / Notch -->
                                    <div class="absolute top-2 left-1/2 -translate-x-1/2 z-20">
                                        <div class="w-16 h-5 bg-black rounded-full flex items-center justify-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-gray-800 ring-1 ring-gray-700"></span>
                                        </div>
                                    </div>
                                    
                                    <!-- Screen Content with Gradient -->
                                    <div class="h-72 sm:h-80 bg-gradient-to-br from-gray-100 via-gray-50 to-purple-50 pt-10 px-3 pb-3">
                                        <!-- App Content -->
                                        <div class="space-y-3">
                                            <!-- Header -->
                                            <div class="flex items-center justify-between px-1">
                                                <div class="h-2 w-12 bg-gray-300 rounded"></div>
                                                <div class="w-5 h-5 rounded-full bg-stripe-purple/20"></div>
                                            </div>
                                            <!-- Vehicle Status Card -->
                                            <div class="bg-gradient-to-br from-stripe-purple to-stripe-cyan rounded-xl p-3 text-white">
                                                <p class="text-[8px] opacity-80">Mi Vehículo</p>
                                                <p class="text-sm font-bold">En movimiento</p>
                                            </div>
                                            <!-- Quick Actions -->
                                            <div class="grid grid-cols-3 gap-2">
                                                <div class="bg-white rounded-lg p-2 flex flex-col items-center shadow-sm">
                                                    <div class="w-4 h-4 rounded-full bg-green-100 mb-1"></div>
                                                    <span class="text-[6px] text-gray-500">Ubicar</span>
                                                </div>
                                                <div class="bg-white rounded-lg p-2 flex flex-col items-center shadow-sm">
                                                    <div class="w-4 h-4 rounded-full bg-blue-100 mb-1"></div>
                                                    <span class="text-[6px] text-gray-500">Historial</span>
                                                </div>
                                                <div class="bg-white rounded-lg p-2 flex flex-col items-center shadow-sm">
                                                    <div class="w-4 h-4 rounded-full bg-purple-100 mb-1"></div>
                                                    <span class="text-[6px] text-gray-500">Alertas</span>
                                                </div>
                                            </div>
                                            <!-- Transaction List -->
                                            <div class="bg-white rounded-lg p-2 space-y-2 shadow-sm">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-4 h-4 rounded-full bg-gray-100"></div>
                                                    <div class="flex-1">
                                                        <div class="h-1.5 w-12 bg-gray-200 rounded"></div>
                                                    </div>
                                                    <div class="h-1.5 w-8 bg-green-200 rounded"></div>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <div class="w-4 h-4 rounded-full bg-gray-100"></div>
                                                    <div class="flex-1">
                                                        <div class="h-1.5 w-10 bg-gray-200 rounded"></div>
                                                    </div>
                                                    <div class="h-1.5 w-6 bg-red-200 rounded"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Home Indicator -->
                                    <div class="absolute bottom-1.5 left-1/2 -translate-x-1/2">
                                        <div class="w-20 h-1 bg-gray-300 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Phone Side Buttons -->
                        <div class="absolute -left-0.5 top-20 w-0.5 h-6 bg-gray-300 rounded-l"></div>
                        <div class="absolute -left-0.5 top-32 w-0.5 h-10 bg-gray-300 rounded-l"></div>
                        <div class="absolute -right-0.5 top-24 w-0.5 h-8 bg-gray-300 rounded-r"></div>
                    </div>
                </div>

                <!-- Floating GPS Notification -->
                <div class="absolute -bottom-2 right-8 bg-white rounded-xl shadow-xl p-3 border border-gray-100 hidden lg:flex items-center gap-3 animate-float" style="animation-delay: 0.8s;">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-stripe-dark">Vehículo localizado</p>
                        <p class="text-sm font-bold text-green-600">GPS Activo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- APKs Download Section -->
<?php
$apks = array(
    array(
        'nombre' => get_option('apk_1_nombre', 'Global System GPS'),
        'desc' => get_option('apk_1_descripcion', 'App principal de monitoreo'),
        'url' => get_option('apk_1_archivo', ''),
        'icon' => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
        'color' => 'from-blue-500 to-cyan-500'
    ),
    array(
        'nombre' => get_option('apk_2_nombre', 'Alarma GPS'),
        'desc' => get_option('apk_2_descripcion', 'Sistema de alarmas y alertas'),
        'url' => get_option('apk_2_archivo', ''),
        'icon' => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>',
        'color' => 'from-amber-500 to-orange-500'
    ),
    array(
        'nombre' => get_option('apk_3_nombre', 'Global v3'),
        'desc' => get_option('apk_3_descripcion', 'Versión actualizada del rastreador'),
        'url' => get_option('apk_3_archivo', ''),
        'icon' => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
        'color' => 'from-green-500 to-emerald-500'
    ),
    array(
        'nombre' => get_option('apk_4_nombre', 'Rutas Global'),
        'desc' => get_option('apk_4_descripcion', 'Gestión de rutas y recorridos'),
        'url' => get_option('apk_4_archivo', ''),
        'icon' => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>',
        'color' => 'from-purple-500 to-pink-500'
    )
);
// Filter out APKs without URL
$apks_with_url = array_filter($apks, function($apk) { return !empty($apk['url']); });
?>
<?php if (!empty($apks_with_url)): ?>
<section id="descargas-apk" class="py-12 bg-gradient-to-br from-slate-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-green-100 text-green-700 text-xs font-semibold rounded-full uppercase tracking-wider mb-3">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.523 2H6.477a2 2 0 00-2 2v16a2 2 0 002 2h11.046a2 2 0 002-2V4a2 2 0 00-2-2zM12 18.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm4-8.5H8V5h8v5z"/></svg>
                Descarga Directa
            </span>
            <h2 class="text-2xl sm:text-3xl font-bold text-stripe-dark">Nuestras Apps Android</h2>
            <p class="text-stripe-gray mt-2">Descarga los APK directamente a tu dispositivo</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php foreach ($apks_with_url as $apk): ?>
            <a href="<?php echo esc_url($apk['url']); ?>" download class="group bg-white rounded-xl p-4 shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-stripe-purple/30 hover:-translate-y-1">
                <div class="flex flex-col items-center text-center">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br <?php echo $apk['color']; ?> flex items-center justify-center text-white mb-3 group-hover:scale-110 transition-transform">
                        <?php echo $apk['icon']; ?>
                    </div>
                    <h3 class="font-semibold text-stripe-dark text-sm mb-1"><?php echo esc_html($apk['nombre']); ?></h3>
                    <p class="text-xs text-stripe-gray mb-3"><?php echo esc_html($apk['desc']); ?></p>
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Descargar APK
                    </span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- App Download Section - Compacta -->
<section id="descarga-app" class="py-10 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-64 h-64 bg-stripe-purple/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-stripe-cyan/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <!-- Left: Text -->
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-stripe-purple to-stripe-cyan rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl lg:text-2xl font-bold text-white">Descarga nuestra App</h3>
                    <p class="text-white/60 text-sm">Monitorea tu flota desde cualquier lugar</p>
                </div>
            </div>
            
            <!-- Right: Download Buttons -->
            <div class="flex flex-wrap gap-3">
                <!-- Google Play Store -->
                <a 
                    href="https://play.google.com/store/apps/details?id=com.globalsystemgps.gps" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 bg-black hover:bg-gray-900 text-white pl-3 pr-4 py-2.5 rounded-xl transition-all border border-white/20 hover:border-white/40 hover:scale-105"
                >
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.198l2.807 1.626a1 1 0 010 1.73l-2.808 1.626L15.206 12l2.492-2.491zM5.864 2.658L16.8 9.99l-2.302 2.302-8.634-8.634z"/>
                    </svg>
                    <div class="text-left">
                        <div class="text-[9px] uppercase tracking-wider leading-none text-white/60">Disponible en</div>
                        <div class="text-sm font-bold leading-tight">Google Play</div>
                    </div>
                </a>
                
                <!-- Apple App Store -->
                <a 
                    href="https://apps.apple.com/us/app/global-system-gps-v3/id6449100199" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 bg-black hover:bg-gray-900 text-white pl-3 pr-4 py-2.5 rounded-xl transition-all border border-white/20 hover:border-white/40 hover:scale-105"
                >
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                    </svg>
                    <div class="text-left">
                        <div class="text-[9px] uppercase tracking-wider leading-none text-white/60">Descarga en</div>
                        <div class="text-sm font-bold leading-tight">App Store</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- ============================================== -->
<!-- SECCIÓN DE TARJETAS DE PRODUCTOS -->
<!-- ============================================== -->
<section id="productos-destacados" class="py-20 lg:py-32 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block px-4 py-1.5 bg-stripe-purple/10 text-stripe-purple text-xs font-semibold rounded-full uppercase tracking-wider mb-4">
                Productos Destacados
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-stripe-dark tracking-tight mb-6">
                Soluciones inteligentes para tu flota
            </h2>
            <p class="text-lg text-stripe-gray leading-relaxed">
                Descubre nuestra gama de productos diseñados para optimizar la seguridad, eficiencia y control de tus operaciones de transporte.
            </p>
        </div>

        <!-- Product Cards Grid -->
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Card 1: DashCam -->
            <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden cursor-pointer group" onclick="openProductModal('dashcam')">
                <div class="h-48 relative overflow-hidden">
                    <img src="https://d29rw3zaldax51.cloudfront.net/assets/images/dashcam-4k-image/Adas-D_features.jpg" alt="DashCam Inteligente" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-stripe-dark mb-2">DashCam Inteligente</h3>
                    <p class="text-stripe-gray text-sm mb-4 leading-relaxed">
                        Monitoreo visual en tiempo real con tecnología ADAS y DMS para máxima seguridad.
                    </p>
                    <span class="inline-flex items-center gap-2 text-stripe-purple font-semibold text-sm group-hover:gap-3 transition-all">
                        Ver más detalles
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Card 2: Sensor de Temperatura -->
            <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden cursor-pointer group" onclick="openProductModal('temperature')">
                <div class="h-48 relative overflow-hidden">
                    <img src="https://bonitel.com.pe/wp-content/uploads/2024/01/temperatura-sliders.webp" alt="Sensor de Temperatura" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-stripe-dark mb-2">Sensor de Temperatura</h3>
                    <p class="text-stripe-gray text-sm mb-4 leading-relaxed">
                        Control térmico inteligente para proteger tu mercancía refrigerada en todo momento.
                    </p>
                    <span class="inline-flex items-center gap-2 text-stripe-purple font-semibold text-sm group-hover:gap-3 transition-all">
                        Ver más detalles
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Card 3: Monitoreo de Combustible -->
            <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden cursor-pointer group" onclick="openProductModal('fuel')">
                <div class="h-48 relative overflow-hidden">
                    <img src="https://mcontrolenergy.com/wp-content/uploads/2017/10/telemt.jpg" alt="Monitoreo de Combustible" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-stripe-dark mb-2">Monitoreo de Combustible</h3>
                    <p class="text-stripe-gray text-sm mb-4 leading-relaxed">
                        Detecta robos, optimiza consumos y reduce costos operativos hasta un 30%.
                    </p>
                    <span class="inline-flex items-center gap-2 text-stripe-purple font-semibold text-sm group-hover:gap-3 transition-all">
                        Ver más detalles
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Vehicle Types Section - Professional Frame Design -->
<section id="vehiculos" class="py-16 lg:py-24 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 relative overflow-hidden">
    <!-- Background decorations -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-stripe-purple/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-stripe-cyan/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur text-white text-xs font-semibold px-4 py-2 rounded-full mb-4 border border-white/10">
                <svg class="w-4 h-4 text-stripe-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span>Soluciones para cada tipo de vehiculo</span>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-4">
                Monitoreamos 
                <span class="bg-gradient-to-r from-stripe-cyan via-stripe-purple to-stripe-pink bg-clip-text text-transparent">todo tipo</span> 
                de vehiculos
            </h2>
            <p class="text-white/60 max-w-2xl mx-auto">
                 Conoce todas las funcionalidades disponibles
            </p>
        </div>
        
        <!-- Vehicle Grid with Professional Frame Design -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
            
            <!-- Camiones - Freightliner Style -->
            <div onclick="openVehicleModal('truck')" class="vehicle-frame group cursor-pointer">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/src/cards/camion.png" alt="Camiones" class="w-full h-auto hover:scale-105 transition-transform duration-300">
                <div class="mt-3 text-center">
                    <h3 class="text-white font-semibold">Camiones</h3>
                    <p class="text-white/50 text-xs mt-1">6 funciones disponibles</p>
                </div>
            </div>
            
            <!-- Carros - Kia Rio Style -->
            <div onclick="openVehicleModal('car')" class="vehicle-frame group cursor-pointer">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/src/cards/sedan.png" alt="Carros" class="w-full h-auto hover:scale-105 transition-transform duration-300">
                <div class="mt-3 text-center">
                    <h3 class="text-white font-semibold">Carros</h3>
                    <p class="text-white/50 text-xs mt-1">6 funciones disponibles</p>
                </div>
            </div>
            
            <!-- Motos - Yamaha Style -->
            <div onclick="openVehicleModal('motorcycle')" class="vehicle-frame group cursor-pointer">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/src/cards/moto.png" alt="Motos" class="w-full h-auto hover:scale-105 transition-transform duration-300">
                <div class="mt-3 text-center">
                    <h3 class="text-white font-semibold">Motos</h3>
                    <p class="text-white/50 text-xs mt-1">15 funciones disponibles</p>
                </div>
            </div>
            
            <!-- Remolques - Semi-Trailer Style -->
            <div onclick="openVehicleModal('trailer')" class="vehicle-frame group cursor-pointer">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/src/cards/remolque.png" alt="Remolques" class="w-full h-auto hover:scale-105 transition-transform duration-300">
                <div class="mt-3 text-center">
                    <h3 class="text-white font-semibold">Remolques</h3>
                    <p class="text-white/50 text-xs mt-1">6 funciones disponibles</p>
                </div>
            </div>
            
            <!-- Contenedores -->
            <div onclick="openVehicleModal('container')" class="vehicle-frame group cursor-pointer">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/src/cards/contenedor.png" alt="Contenedores" class="w-full h-auto hover:scale-105 transition-transform duration-300">
                <div class="mt-3 text-center">
                    <h3 class="text-white font-semibold">Contenedores</h3>
                    <p class="text-white/50 text-xs mt-1">6 funciones disponibles</p>
                </div>
            </div>
            
            <!-- Buses - Coach Style -->
            <div onclick="openVehicleModal('bus')" class="vehicle-frame group cursor-pointer">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/src/cards/bus.png" alt="Buses" class="w-full h-auto hover:scale-105 transition-transform duration-300">
                <div class="mt-3 text-center">
                    <h3 class="text-white font-semibold">Buses</h3>
                    <p class="text-white/50 text-xs mt-1">6 funciones disponibles</p>
                </div>
            </div>
            
            <!-- Maquinaria - John Deere Excavator Style -->
            <div onclick="openVehicleModal('machinery')" class="vehicle-frame group cursor-pointer">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/src/cards/maquinaria.png" alt="Maquinaria" class="w-full h-auto hover:scale-105 transition-transform duration-300">
                <div class="mt-3 text-center">
                    <h3 class="text-white font-semibold">Maquinaria</h3>
                    <p class="text-white/50 text-xs mt-1">7 funciones disponibles</p>
                </div>
            </div>
            
            <!-- Flotas - Multiple vehicles -->
            <div onclick="openVehicleModal('truck')" class="vehicle-frame group cursor-pointer">
                <div class="relative bg-gradient-to-b from-gray-700 to-gray-800 rounded-[1.5rem] p-1.5 shadow-2xl border border-white/10 hover:border-indigo-400/50 transition-all duration-300 hover:scale-[1.02]">
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-[1.25rem] p-4 h-44 flex flex-col items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-indigo-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        
                        <!-- Fleet SVG - Multiple vehicles -->
                        <svg viewBox="0 0 180 110" class="w-full h-28 relative z-10" xmlns="http://www.w3.org/2000/svg">
                            <!-- Mini truck 1 -->
                            <g transform="translate(10, 15) scale(0.5)">
                                <rect x="5" y="25" width="50" height="30" rx="2" fill="#475569"/>
                                <path d="M55 25 L55 55 L80 55 L80 40 L70 25 Z" fill="#8956ff"/>
                                <circle cx="20" cy="60" r="8" fill="#1e293b"/>
                                <circle cx="65" cy="60" r="8" fill="#1e293b"/>
                            </g>
                            
                            <!-- Mini car -->
                            <g transform="translate(90, 10) scale(0.45)">
                                <path d="M15 45 L25 30 L75 30 L90 45 L90 55 L15 55 Z" fill="#0891b2"/>
                                <path d="M30 30 L38 18 L62 18 L75 30" fill="#0e7490"/>
                                <circle cx="30" cy="58" r="8" fill="#1e293b"/>
                                <circle cx="75" cy="58" r="8" fill="#1e293b"/>
                            </g>
                            
                            <!-- Mini truck 2 -->
                            <g transform="translate(5, 55) scale(0.5)">
                                <rect x="5" y="25" width="50" height="30" rx="2" fill="#475569"/>
                                <path d="M55 25 L55 55 L80 55 L80 40 L70 25 Z" fill="#22c55e"/>
                                <circle cx="20" cy="60" r="8" fill="#1e293b"/>
                                <circle cx="65" cy="60" r="8" fill="#1e293b"/>
                            </g>
                            
                            <!-- Mini bus -->
                            <g transform="translate(85, 50) scale(0.4)">
                                <rect x="5" y="20" width="90" height="40" rx="4" fill="#3b82f6"/>
                                <rect x="12" y="25" width="10" height="12" rx="1" fill="#bfdbfe" opacity="0.7"/>
                                <rect x="27" y="25" width="10" height="12" rx="1" fill="#bfdbfe" opacity="0.7"/>
                                <rect x="42" y="25" width="10" height="12" rx="1" fill="#bfdbfe" opacity="0.7"/>
                                <rect x="57" y="25" width="10" height="12" rx="1" fill="#bfdbfe" opacity="0.7"/>
                                <circle cx="25" cy="65" r="8" fill="#1e293b"/>
                                <circle cx="70" cy="65" r="8" fill="#1e293b"/>
                            </g>
                            
                            <!-- Connection lines (network) -->
                            <line x1="45" y1="35" x2="100" y2="25" stroke="#8956ff" stroke-width="1" stroke-dasharray="3,3" opacity="0.6">
                                <animate attributeName="stroke-dashoffset" values="0;6" dur="1s" repeatCount="indefinite"/>
                            </line>
                            <line x1="45" y1="80" x2="100" y2="70" stroke="#22c55e" stroke-width="1" stroke-dasharray="3,3" opacity="0.6">
                                <animate attributeName="stroke-dashoffset" values="0;6" dur="1s" repeatCount="indefinite"/>
                            </line>
                            <line x1="50" y1="35" x2="50" y2="75" stroke="#1993cf" stroke-width="1" stroke-dasharray="3,3" opacity="0.6">
                                <animate attributeName="stroke-dashoffset" values="0;6" dur="1s" repeatCount="indefinite"/>
                            </line>
                            
                            <!-- Central GPS hub -->
                            <circle cx="90" cy="55" r="8" fill="#1e293b" stroke="#8956ff" stroke-width="2"/>
                            <circle cx="90" cy="55" r="4" fill="#8956ff">
                                <animate attributeName="r" values="4;6;4" dur="1s" repeatCount="indefinite"/>
                            </circle>
                            <circle cx="90" cy="55" r="14" fill="none" stroke="#8956ff" stroke-width="1" opacity="0.4">
                                <animate attributeName="r" values="14;22;14" dur="1.5s" repeatCount="indefinite"/>
                                <animate attributeName="opacity" values="0.4;0;0.4" dur="1.5s" repeatCount="indefinite"/>
                            </circle>
                        </svg>
                        
                        <div class="absolute bottom-2 left-0 right-0 text-center">
                            <span class="text-white/40 text-[10px] font-medium">Multi-Fleet</span>
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <h3 class="text-white font-semibold">Flotas</h3>
                    <p class="text-white/50 text-xs mt-1">Todas las funciones</p>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- ============================================== -->
<!-- MODALS FOR VEHICLE TYPES -->
<!-- ============================================== -->

<!-- Modal: Camiones -->
<div id="vehicleTruckModal" class="product-modal-overlay">
    <div class="product-modal" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
        <button onclick="closeVehicleModal('truck')" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="product-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1100px] mx-auto items-center p-6 sm:p-10 lg:p-12 gap-8">
            <!-- Left: Animated Blueprint SVG -->
            <div class="flex-shrink-0 w-full lg:w-1/2 flex justify-center relative">
                <!-- Background Grid -->
                <div class="absolute inset-0 border border-white/5 rounded-xl pointer-events-none" 
                     style="background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 20px 20px;">
                </div>
                
                <svg viewBox="0 0 320 220" class="w-full h-auto max-h-[300px]" xmlns="http://www.w3.org/2000/svg">
                    <!-- Floor/Ground -->
                    <line x1="10" y1="180" x2="310" y2="180" stroke="#334155" stroke-width="2"/>
                    
                     <!-- Trailer (Ghost/Outline) -->
                    <rect x="20" y="55" width="130" height="90" rx="4" fill="none" stroke="#64748b" stroke-width="1.5" stroke-dasharray="5,5" opacity="0.5"/>
                    <line x1="40" y1="55" x2="40" y2="145" stroke="#64748b" stroke-width="1" opacity="0.3"/>
                    <line x1="60" y1="55" x2="60" y2="145" stroke="#64748b" stroke-width="1" opacity="0.3"/>
                    
                    <!-- Cabin Shape (Freightliner Style) -->
                    <path d="M150 45 L150 145 L240 145 L240 95 L210 45 Z" fill="#1e293b" stroke="#a78bfa" stroke-width="2"/>
                    
                    <!-- Windshield -->
                    <path d="M160 55 L180 55 L210 85 L210 120 L160 120 Z" fill="#334155" opacity="0.5"/>
                    
                    <!-- Wheels (Tech style) -->
                    <g transform="translate(60, 160)">
                        <circle r="18" fill="#0f172a" stroke="#475569" stroke-width="2"/>
                        <circle r="10" fill="none" stroke="#475569" stroke-width="1" stroke-dasharray="2,2"/>
                    </g>
                    <g transform="translate(190, 160)">
                        <circle r="18" fill="#0f172a" stroke="#a78bfa" stroke-width="2"/>
                        <circle r="6" fill="#a78bfa" opacity="0.5"/>
                    </g>
                    
                    <!-- FUNCTIONAL HIGHLIGHTS -->
                    
                    <!-- 1. GPS Antenna -->
                    <line x1="190" y1="45" x2="190" y2="25" stroke="#22c55e" stroke-width="2"/>
                    <circle cx="190" cy="25" r="4" fill="#22c55e">
                        <animate attributeName="r" values="4;7;4" dur="1.5s" repeatCount="indefinite"/>
                        <animate attributeName="opacity" values="1;0.5;1" dur="1.5s" repeatCount="indefinite"/>
                    </circle>
                    <g transform="translate(200, 25)">
                         <text x="0" y="5" font-family="monospace" font-size="10" fill="#22c55e" font-weight="bold">GPS / ANTENA</text>
                         <line x1="-5" y1="0" x2="-25" y2="0" stroke="#22c55e" stroke-width="1" opacity="0.5"/>
                    </g>
                    
                    <!-- 2. Engine (Motor) -->
                    <rect x="210" y="100" width="25" height="30" fill="none" stroke="#ef4444" stroke-width="2" stroke-dasharray="3,3">
                        <animate attributeName="stroke-dashoffset" values="0;20" dur="1s" repeatCount="indefinite"/>
                    </rect>
                    <line x1="235" y1="115" x2="260" y2="115" stroke="#ef4444" stroke-width="1"/>
                    <text x="265" y="120" font-family="monospace" font-size="10" fill="#ef4444" font-weight="bold">MOTOR / IGNICIÓN</text>
                    
                    <!-- 3. Fuel Tank -->
                    <rect x="160" y="125" width="40" height="20" rx="3" fill="#1e293b" stroke="#f59e0b" stroke-width="2"/>
                    <path d="M165 130 L195 130 L195 140 L165 140 Z" fill="#f59e0b" opacity="0.2">
                        <animate attributeName="opacity" values="0.2;0.5;0.2" dur="2s" repeatCount="indefinite"/>
                    </path>
                    <line x1="180" y1="145" x2="180" y2="165" stroke="#f59e0b" stroke-width="1"/>
                    <text x="160" y="175" font-family="monospace" font-size="10" fill="#f59e0b" font-weight="bold" text-anchor="middle">CONTROL COMBUSTIBLE</text>

                </svg>
            </div>
            <!-- Right: Content -->
            <div class="flex-1 w-full">
                <span class="inline-block px-3 py-1 bg-white/10 border border-white/20 rounded-full text-xs font-semibold text-stripe-purple uppercase tracking-wider mb-4">
                    Freightliner & Mack Series
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight mb-6">
                    Camiones <span class="text-stripe-purple">Inteligentes</span>
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar">
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-green-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Rastreo satelital híbrido (GPRS/Iridium)</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Telemetría de motor por CANBUS</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Control de combustible preciso</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-red-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Apagado remoto de motor</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Cámaras de fatiga y distracción</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-cyan-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Sensores de enganche/desenganche</span>
                    </div>
                </div>
                <button onclick="closeVehicleModal('truck'); openQuoteModal();" class="mt-8 inline-flex items-center gap-2 bg-stripe-purple text-white font-semibold px-8 py-3 rounded-full hover:bg-stripe-purple/90 transition-all shadow-lg shadow-stripe-purple/25">
                    Solicitar Cotización
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Carros -->
<div id="vehicleCarModal" class="product-modal-overlay">
    <div class="product-modal" style="background: linear-gradient(135deg, #0f172a 0%, #164e63 100%);">
        <button onclick="closeVehicleModal('car')" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="product-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1100px] mx-auto items-center p-6 sm:p-10 lg:p-12 gap-8">
            <div class="flex-shrink-0 w-full lg:w-1/2 flex justify-center relative">
                 <!-- Background Grid -->
                <div class="absolute inset-0 border border-white/5 rounded-xl pointer-events-none" 
                     style="background-image: linear-gradient(rgba(6,182,212,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(6,182,212,0.05) 1px, transparent 1px); background-size: 20px 20px;">
                </div>
                
                <svg viewBox="0 0 320 200" class="w-full h-auto max-h-[280px]" xmlns="http://www.w3.org/2000/svg">
                    <!-- Floor/Ground -->
                    <line x1="20" y1="170" x2="300" y2="170" stroke="#155e75" stroke-width="2"/>
                    
                    <!-- Car Body Ghost -->
                    <path d="M40 135 L65 100 L235 100 L275 135 L275 160 L40 160 Z" fill="none" stroke="#22d3ee" stroke-width="1" stroke-dasharray="3,3" opacity="0.3"/>
                    
                    <!-- Car Body (Kia Rio Style) -->
                    <g transform="translate(60, 60) scale(1.1)">
                        <path d="M20 55 L35 35 L135 35 L160 55 L160 70 L20 70 Z" fill="#164e63" stroke="#06b6d4" stroke-width="1.5">
                        </path>
                        <!-- Windows -->
                        <path d="M45 35 L60 18 L120 18 L135 35" fill="none" stroke="#06b6d4" stroke-width="1.5"/>
                        <path d="M50 35 L62 20 L85 20 L85 35 Z" fill="#0891b2" opacity="0.4"/>
                        <path d="M90 35 L90 20 L118 20 L130 35 Z" fill="#0891b2" opacity="0.4"/>
                        
                        <!-- Wheels -->
                        <g transform="translate(50, 75)">
                            <circle r="14" fill="#0f172a" stroke="#06b6d4" stroke-width="2"/>
                            <circle r="8" fill="none" stroke="#06b6d4" stroke-width="1"/>
                        </g>
                        <g transform="translate(130, 75)">
                            <circle r="14" fill="#0f172a" stroke="#06b6d4" stroke-width="2"/>
                            <circle r="8" fill="none" stroke="#06b6d4" stroke-width="1"/>
                        </g>
                    </g>

                    <!-- FUNCTIONAL HIGHLIGHTS -->
                    
                    <!-- 1. GPS -->
                    <line x1="160" y1="80" x2="160" y2="40" stroke="#22c55e" stroke-width="2"/>
                    <circle cx="160" cy="40" r="4" fill="#22c55e">
                        <animate attributeName="r" values="4;7;4" dur="1.5s" repeatCount="indefinite"/>
                        <animate attributeName="opacity" values="1;0.5;1" dur="1.5s" repeatCount="indefinite"/>
                    </circle>
                    <g transform="translate(170, 40)">
                         <text x="0" y="5" font-family="monospace" font-size="10" fill="#22c55e" font-weight="bold">GPS / UBICACIÓN</text>
                    </g>
                    
                    <!-- 2. Immobilizer (Engine) -->
                    <circle cx="230" cy="120" r="15" fill="none" stroke="#ef4444" stroke-width="2" stroke-dasharray="3,3">
                         <animate attributeName="stroke-dashoffset" values="0;20" dur="2s" repeatCount="indefinite"/>
                    </circle>
                    <line x1="245" y1="120" x2="270" y2="120" stroke="#ef4444" stroke-width="1"/>
                    <text x="275" y="125" font-family="monospace" font-size="10" fill="#ef4444" font-weight="bold">CORTE MOTOR</text>
                    
                    <!-- 3. Door Sensors -->
                    <circle cx="150" cy="120" r="3" fill="#fbbf24"/>
                    <line x1="150" y1="120" x2="150" y2="160" stroke="#fbbf24" stroke-width="1"/>
                    <text x="140" y="175" font-family="monospace" font-size="10" fill="#fbbf24" font-weight="bold" text-anchor="middle">SENSORES DE PUERTA</text>
                    
                </svg>
            </div>
            <div class="flex-1 w-full">
                <span class="inline-block px-3 py-1 bg-white/10 border border-white/20 rounded-full text-xs font-semibold text-cyan-400 uppercase tracking-wider mb-4">
                    Vehiculos Particulares & Flotas Ligeras
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight mb-6">
                    Control de <span class="text-stripe-cyan">Vehículos</span>
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar">
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-green-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Ubicación en tiempo real</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-cyan-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Historial de recorridos</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-red-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Inmovilización remota del motor</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Uso autorizado/fuera de horario</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Alerta de exceso de velocidad</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Auditoría de manejo (Eco-Driving)</span>
                    </div>
                </div>
                <button onclick="closeVehicleModal('car'); openQuoteModal();" class="mt-8 inline-flex items-center gap-2 bg-stripe-cyan text-white font-semibold px-8 py-3 rounded-full hover:bg-stripe-cyan/90 transition-all shadow-lg shadow-stripe-cyan/25">
                    Solicitar Cotización
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Motos -->
<div id="vehicleMotorcycleModal" class="product-modal-overlay">
    <div class="product-modal" style="background: linear-gradient(135deg, #022c22 0%, #14532d 100%);">
        <button onclick="closeVehicleModal('motorcycle')" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="product-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1100px] mx-auto items-center p-6 sm:p-10 lg:p-12 gap-8">
            <div class="flex-shrink-0 w-full lg:w-1/2 flex justify-center relative">
                 <!-- Background Grid -->
                <div class="absolute inset-0 border border-white/5 rounded-xl pointer-events-none" 
                     style="background-image: linear-gradient(rgba(34,197,94,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(34,197,94,0.05) 1px, transparent 1px); background-size: 20px 20px;">
                </div>
                
                <svg viewBox="0 0 320 200" class="w-full h-auto max-h-[280px]" xmlns="http://www.w3.org/2000/svg">
                    <!-- Floor/Ground -->
                    <line x1="20" y1="170" x2="300" y2="170" stroke="#166534" stroke-width="2"/>

                    <!-- Moto Ghost -->
                     <path d="M60 160 L90 110 L190 100 L260 160" fill="none" stroke="#22c55e" stroke-width="1" stroke-dasharray="3,3" opacity="0.3"/>
                    
                    <!-- Moto body (Yamaha Style) -->
                    <g transform="translate(70, 60) scale(1.1)">
                        <!-- Back wheel -->
                        <circle cx="35" cy="80" r="22" fill="#1e293b" stroke="#15803d" stroke-width="2"/>
                        <circle cx="35" cy="80" r="17" fill="#022c22"/>
                        <circle cx="35" cy="80" r="4" fill="#22c55e"/>
                        
                        <!-- Front wheel -->
                        <circle cx="145" cy="80" r="22" fill="#1e293b" stroke="#15803d" stroke-width="2"/>
                        <circle cx="145" cy="80" r="17" fill="#022c22"/>
                        <circle cx="145" cy="80" r="4" fill="#22c55e"/>
                        
                        <!-- Frame -->
                        <path d="M35 80 L55 55 L100 50 L145 80" fill="none" stroke="#22c55e" stroke-width="5" stroke-linecap="round"/>
                        
                        <!-- Engine block -->
                        <rect x="55" y="60" width="30" height="20" rx="3" fill="#1e293b" stroke="#15803d" stroke-width="1"/>
                        
                        <!-- Fuel tank -->
                        <path d="M60 50 Q75 35 95 40 Q105 42 100 50 L65 55 Z" fill="#15803d" stroke="#16a34a" stroke-width="1.5">
                            <animate attributeName="fill" values="#15803d;#16a34a;#15803d" dur="3s" repeatCount="indefinite"/>
                        </path>
                        
                        <!-- Seat -->
                        <path d="M55 48 Q70 38 90 42 L90 52 L55 55 Z" fill="#022c22" stroke="#14532d" stroke-width="1"/>
                        
                        <!-- Fairing -->
                        <path d="M100 50 L125 45 L145 60 L140 70 L100 65 Z" fill="#15803d" stroke="#16a34a" stroke-width="1"/>
                        
                        <!-- Handlebar -->
                        <path d="M115 45 L130 35 L145 30" fill="none" stroke="#334155" stroke-width="3" stroke-linecap="round"/>
                    </g>
                    
                    <!-- FUNCTIONAL HIGHLIGHTS -->
                    
                    <!-- 1. GPS Tracker -->
                    <circle cx="180" cy="115" r="5" fill="#22c55e">
                        <animate attributeName="r" values="5;8;5" dur="1s" repeatCount="indefinite"/>
                        <animate attributeName="opacity" values="1;0.5;1" dur="1s" repeatCount="indefinite"/>
                    </circle>
                    <line x1="180" y1="115" x2="200" y2="90" stroke="#22c55e" stroke-width="1"/>
                    <text x="205" y="90" font-family="monospace" font-size="10" fill="#22c55e" font-weight="bold">GPS COMPACTO</text>
                    
                    <!-- 2. Remote Cutoff (Corte Motor) -->
                    <rect x="135" y="130" width="20" height="15" fill="none" stroke="#ef4444" stroke-width="2" stroke-dasharray="2,2"/>
                    <line x1="145" y1="145" x2="145" y2="165" stroke="#ef4444" stroke-width="1"/>
                    <text x="145" y="175" font-family="monospace" font-size="10" fill="#ef4444" font-weight="bold" text-anchor="middle">CORTE MOTOR</text>
                    
                    <!-- 3. Vibration Sensor -->
                    <path d="M110 120 L120 125 L110 130" fill="none" stroke="#fbbf24" stroke-width="2">
                         <animate attributeName="d" values="M110 120 L120 125 L110 130;M108 120 L118 125 L108 130;M110 120 L120 125 L110 130" dur="0.2s" repeatCount="indefinite"/>
                    </path>
                    <line x1="105" y1="125" x2="80" y2="125" stroke="#fbbf24" stroke-width="1"/>
                     <text x="75" y="130" font-family="monospace" font-size="10" fill="#fbbf24" font-weight="bold" text-anchor="end">D. VIBRACIÓN</text>
                    
                </svg>
            </div>
            <div class="flex-1 w-full">
                <span class="inline-block px-3 py-1 bg-white/10 border border-white/20 rounded-full text-xs font-semibold text-green-400 uppercase tracking-wider mb-4">
                    Motos Lineales & Delivery
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight mb-6">
                    Seguridad para <span class="text-green-500">Motos</span>
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar">
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-green-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Ubicación en tiempo real</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-yellow-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Alertas por encendido no autorizado</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-orange-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Detección de vibración</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-red-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Corte remoto de motor</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Seguimiento en caso de robo</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Alerta de exceso de velocidad</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-cyan-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Alerta de exceso de ralentí del motor</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-pink-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Informes de kilómetros recorridos</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Informes de consumo de combustible</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-teal-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Horas de trabajo</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-gray-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Horas detenido</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-lime-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Horas en movimiento</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-rose-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Tiempo efectivo de conducción</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Respaldo de información histórica por 6 meses</span>
                    </div>
                </div>
                <button onclick="closeVehicleModal('motorcycle'); openQuoteModal();" class="mt-8 inline-flex items-center gap-2 bg-green-600 text-white font-semibold px-8 py-3 rounded-full hover:bg-green-500 transition-all shadow-lg shadow-green-600/25">
                    Solicitar Cotización
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Remolques -->
<div id="vehicleTrailerModal" class="product-modal-overlay">
    <div class="product-modal" style="background: linear-gradient(135deg, #451a03 0%, #78350f 100%);">
        <button onclick="closeVehicleModal('trailer')" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="product-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1100px] mx-auto items-center p-6 sm:p-10 lg:p-12 gap-8">
            <div class="flex-shrink-0 w-full lg:w-1/2 flex justify-center relative">
                 <!-- Background Grid -->
                <div class="absolute inset-0 border border-white/5 rounded-xl pointer-events-none" 
                     style="background-image: linear-gradient(rgba(245,158,11,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(245,158,11,0.05) 1px, transparent 1px); background-size: 20px 20px;">
                </div>
                
                <svg viewBox="0 0 320 200" class="w-full h-auto max-h-[280px]" xmlns="http://www.w3.org/2000/svg">
                    <!-- Floor/Ground -->
                    <line x1="20" y1="170" x2="300" y2="170" stroke="#92400e" stroke-width="2"/>
                    
                    <!-- Trailer Ghost -->
                    <rect x="35" y="55" width="220" height="85" rx="3" fill="none" stroke="#f59e0b" stroke-width="1" stroke-dasharray="3,3" opacity="0.3"/>
                    
                    <!-- Basic Trailer Shape -->
                    <g transform="translate(60, 60) scale(1.1)">
                        <rect x="5" y="25" width="140" height="55" rx="3" fill="#78350f" stroke="#d97706" stroke-width="1.5"/>
                         <!-- Ridges -->
                        <line x1="25" y1="25" x2="25" y2="80" stroke="#92400e" stroke-width="1"/>
                        <line x1="45" y1="25" x2="45" y2="80" stroke="#92400e" stroke-width="1"/>
                        <line x1="65" y1="25" x2="65" y2="80" stroke="#92400e" stroke-width="1"/>
                        <line x1="85" y1="25" x2="85" y2="80" stroke="#92400e" stroke-width="1"/>
                        <line x1="105" y1="25" x2="105" y2="80" stroke="#92400e" stroke-width="1"/>
                        
                        <!-- Logo area -->
                        <rect x="55" y="40" width="40" height="20" rx="2" fill="#d97706" opacity="0.5"/>
                         <!-- Hitch -->
                        <path d="M145 52 L170 52" stroke="#64748b" stroke-width="5" stroke-linecap="round"/>
                        
                         <!-- Wheels -->
                        <circle cx="35" cy="88" r="11" fill="#1e293b" stroke="#d97706" stroke-width="2"/>
                        <circle cx="60" cy="88" r="11" fill="#1e293b" stroke="#d97706" stroke-width="2"/>
                    </g>
                    
                    <!-- FUNCTIONAL HIGHLIGHTS -->
                    
                    <!-- 1. GPS Solar/Battery -->
                    <rect x="180" y="85" width="20" height="10" fill="#22c55e" opacity="0.8">
                        <animate attributeName="opacity" values="0.8;1;0.8" dur="2s" repeatCount="indefinite"/>
                    </rect>
                    <line x1="210" y1="90" x2="230" y2="70" stroke="#22c55e" stroke-width="1"/>
                    <text x="235" y="70" font-family="monospace" font-size="10" fill="#22c55e" font-weight="bold">GPS AUTÓNOMO</text>
                    
                    <!-- 2. Door Sensor -->
                    <circle cx="215" cy="115" r="4" fill="#fbbf24"/>
                    <line x1="215" y1="115" x2="235" y2="135" stroke="#fbbf24" stroke-width="1"/>
                    <text x="240" y="140" font-family="monospace" font-size="10" fill="#fbbf24" font-weight="bold">SENSOR PUERTAS</text>

                     <!-- 3. Landing Gear (Support) -->
                     <line x1="230" y1="140" x2="230" y2="170" stroke="#94a3b8" stroke-width="4" stroke-linecap="round"/>
                     <line x1="220" y1="170" x2="240" y2="170" stroke="#94a3b8" stroke-width="2"/>
                </svg>
            </div>
            <div class="flex-1 w-full">
                <span class="inline-block px-3 py-1 bg-white/10 border border-white/20 rounded-full text-xs font-semibold text-amber-500 uppercase tracking-wider mb-4">
                    Carga Seca & Refrigerada
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight mb-6">
                    Seguridad de <span class="text-amber-500">Carga</span>
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar">
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-green-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Rastreo independiente del vehículo tractor</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-red-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Alertas de movimiento no autorizado</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Notificación de desacople/acople</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Geocercas en patios logísticos</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Monitoreo de batería del dispositivo</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-cyan-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Respaldo de información histórica por 6 meses</span>
                    </div>
                </div>
                <button onclick="closeVehicleModal('trailer'); openQuoteModal();" class="mt-8 inline-flex items-center gap-2 bg-amber-600 text-white font-semibold px-8 py-3 rounded-full hover:bg-amber-500 transition-all shadow-lg shadow-amber-600/25">
                    Solicitar Cotización
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Contenedores -->
<div id="vehicleContainerModal" class="product-modal-overlay">
    <div class="product-modal" style="background: linear-gradient(135deg, #431407 0%, #7c2d12 100%);">
        <button onclick="closeVehicleModal('container')" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="product-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1100px] mx-auto items-center p-6 sm:p-10 lg:p-12 gap-8">
            <div class="flex-shrink-0 w-full lg:w-1/2 flex justify-center relative">
                 <!-- Background Grid -->
                <div class="absolute inset-0 border border-white/5 rounded-xl pointer-events-none" 
                     style="background-image: linear-gradient(rgba(249,115,22,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(249,115,22,0.05) 1px, transparent 1px); background-size: 20px 20px;">
                </div>
                
                <svg viewBox="0 0 320 200" class="w-full h-auto max-h-[280px]" xmlns="http://www.w3.org/2000/svg">
                    <!-- Floor/Ground -->
                    <line x1="20" y1="170" x2="300" y2="170" stroke="#7c2d12" stroke-width="2"/>
                    
                    <!-- Container Ghost -->
                    <rect x="40" y="60" width="220" height="90" fill="none" stroke="#ea580c" stroke-width="1" stroke-dasharray="3,3" opacity="0.3"/>
                    
                    <!-- Container 3D (Based on Card SVG) -->
                    <g transform="translate(60, 60) scale(1.1)">
                         <!-- Back Shadow -->
                        <rect x="5" y="65" width="150" height="8" rx="4" fill="black" opacity="0.3"/>
                        
                        <!-- Main Face -->
                        <rect x="10" y="20" width="160" height="60" rx="2" fill="#7c2d12" stroke="#ea580c" stroke-width="2"/>
                        
                        <!-- Top Face -->
                         <path d="M10 20 L20 12 L170 12 L170 20 Z" fill="#9a3412" stroke="#ea580c" stroke-width="1"/>
                         
                         <!-- Side Face -->
                        <path d="M170 20 L170 12 L178 18 L178 78 L170 80 Z" fill="#431407" stroke="#ea580c" stroke-width="1"/>
                        
                        <!-- Ridges -->
                        <g stroke="#ea580c" stroke-width="2" opacity="0.5">
                            <line x1="30" y1="20" x2="30" y2="80"/>
                            <line x1="50" y1="20" x2="50" y2="80"/>
                            <line x1="70" y1="20" x2="70" y2="80"/>
                            <line x1="90" y1="20" x2="90" y2="80"/>
                            <line x1="110" y1="20" x2="110" y2="80"/>
                            <line x1="130" y1="20" x2="130" y2="80"/>
                            <line x1="150" y1="20" x2="150" y2="80"/>
                        </g>

                         <!-- Door Locking Mechanism -->
                         <rect x="158" y="30" width="6" height="40" fill="#9a3412"/>
                    </g>
                    
                    <!-- FUNCTIONAL HIGHLIGHTS -->
                    
                    <!-- 1. Magnetic GPS -->
                    <circle cx="160" cy="70" r="5" fill="#3b82f6"/>
                    <line x1="160" y1="70" x2="160" y2="40" stroke="#3b82f6" stroke-width="1"/>
                    <text x="160" y="35" font-family="monospace" font-size="10" fill="#3b82f6" font-weight="bold" text-anchor="middle">GPS MAGNÉTICO</text>
                    
                    <!-- 2. Electronic Lock (Sello) -->
                    <rect x="230" y="100" width="15" height="15" rx="3" fill="#22c55e">
                         <animate attributeName="fill" values="#22c55e;#4ade80;#22c55e" dur="2s" repeatCount="indefinite"/>
                    </rect>
                    <line x1="245" y1="107" x2="265" y2="107" stroke="#22c55e" stroke-width="1"/>
                    <text x="270" y="110" font-family="monospace" font-size="10" fill="#22c55e" font-weight="bold">CANDADO INTELIGENTE</text>
                    
                    <!-- 3. Aperture Sensor -->
                    <circle cx="255" cy="80" r="3" fill="#fbbf24"/>
                    <line x1="255" y1="80" x2="270" y2="80" stroke="#fbbf24" stroke-width="1" stroke-dasharray="2,2"/>
                     <text x="275" y="83" font-family="monospace" font-size="10" fill="#fbbf24" font-weight="bold">SENSOR LUZ/APERTURA</text>

                </svg>
            </div>
            <div class="flex-1 w-full">
                <span class="inline-block px-3 py-1 bg-white/10 border border-white/20 rounded-full text-xs font-semibold text-orange-500 uppercase tracking-wider mb-4">
                    Logística Internacional
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight mb-6">
                    Rastreo de <span class="text-orange-500">Contenedores</span>
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar">
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-green-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Rastreo en tiempo real</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-red-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Alertas de apertura</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Geocercas</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Historial completo</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Alertas por desvíos</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-cyan-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Respaldo histórico</span>
                    </div>
                </div>
                <button onclick="closeVehicleModal('container'); openQuoteModal();" class="mt-8 inline-flex items-center gap-2 bg-orange-600 text-white font-semibold px-8 py-3 rounded-full hover:bg-orange-500 transition-all shadow-lg shadow-orange-600/25">
                    Solicitar Cotización
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Buses -->
<div id="vehicleBusModal" class="product-modal-overlay">
    <div class="product-modal" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
        <button onclick="closeVehicleModal('bus')" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
           <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="product-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1100px] mx-auto items-center p-6 sm:p-10 lg:p-12 gap-8">
            <div class="flex-shrink-0 w-full lg:w-1/2 flex justify-center relative">
                 <!-- Background Grid -->
                <div class="absolute inset-0 border border-white/5 rounded-xl pointer-events-none" 
                     style="background-image: linear-gradient(rgba(59,130,246,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(59,130,246,0.05) 1px, transparent 1px); background-size: 20px 20px;">
                </div>
                
                <svg viewBox="0 0 320 200" class="w-full h-auto max-h-[280px]" xmlns="http://www.w3.org/2000/svg">
                    <!-- Floor/Ground -->
                    <line x1="20" y1="170" x2="300" y2="170" stroke="#1e3a8a" stroke-width="2"/>
                    
                    <!-- Bus Body -->
                    <!-- Main Body -->
                    <path d="M40 140 L40 60 L60 40 L260 40 L280 60 L280 140 Z" fill="#1e3a8a" stroke="#60a5fa" stroke-width="2"/>
                    
                    <!-- Windows -->
                    <g fill="#1e40af" stroke="#60a5fa" stroke-width="1">
                         <!-- Front Window -->
                         <path d="M60 45 L60 90 L270 90 L260 45 Z" opacity="0.8"/>
                         
                         <!-- Side Windows -->
                         <rect x="70" y="55" width="40" height="30" rx="2"/>
                         <rect x="120" y="55" width="40" height="30" rx="2"/>
                         <rect x="170" y="55" width="40" height="30" rx="2"/>
                         <rect x="220" y="55" width="40" height="30" rx="2"/>
                    </g>
                    
                    <!-- Wheels -->
                    <g fill="#0f172a" stroke="#60a5fa" stroke-width="2">
                        <circle cx="80" cy="140" r="18"/>
                        <circle cx="240" cy="140" r="18"/>
                    </g>
                    <g fill="#60a5fa">
                         <circle cx="80" cy="140" r="6"/>
                         <circle cx="240" cy="140" r="6"/>
                    </g>
                    
                    <!-- Lights -->
                    <path d="M280 120 L282 130" stroke="#f87171" stroke-width="3"/>
                    <path d="M40 120 L38 130" stroke="#fcd34d" stroke-width="3"/>
                    
                    <!-- FUNCTIONAL HIGHLIGHTS -->
                    
                    <!-- 1. Passenger Counter / Camera (Near door) -->
                    <circle cx="230" cy="50" r="4" fill="#60a5fa">
                         <animate attributeName="opacity" values="1;0.4;1" dur="1.5s" repeatCount="indefinite"/>
                    </circle>
                    <path d="M230 50 L210 30" stroke="#60a5fa" stroke-width="1" stroke-dasharray="2,2"/>
                    <text x="210" y="25" font-family="monospace" font-size="10" fill="#60a5fa" font-weight="bold" text-anchor="end">CÁMARA/CONTEO</text>
                    
                    <!-- 2. Panic Button (Driver) -->
                    <circle cx="65" cy="100" r="3" fill="#ef4444">
                        <animate attributeName="r" values="3;6;3" dur="1s" repeatCount="indefinite"/>
                    </circle>
                    <text x="50" y="115" font-family="monospace" font-size="10" fill="#ef4444" font-weight="bold" text-anchor="end">PÁNICO</text>
                    
                     <!-- 3. Audio (Mic) -->
                     <rect x="90" y="45" width="10" height="6" fill="#fbbf24"/>
                     <line x1="95" y1="45" x2="95" y2="25" stroke="#fbbf24" stroke-width="1"/>
                     <text x="95" y="20" font-family="monospace" font-size="10" fill="#fbbf24" font-weight="bold" text-anchor="middle">AUDIO</text>

                </svg>
            </div>
            <div class="flex-1 w-full">
                <span class="inline-block px-3 py-1 bg-white/10 border border-white/20 rounded-full text-xs font-semibold text-blue-400 uppercase tracking-wider mb-4">
                    Transporte de Pasajeros
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight mb-6">
                    Seguridad en <span class="text-blue-500">Buses</span>
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar">
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Botón de pánico silencioso</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Escucha remota de cabina</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-sky-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Conteo de pasajeros (por cámara)</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-red-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Paro de motor remoto</span>
                    </div>
                     <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Control de velocidad y rutas</span>
                    </div>
                     <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Gestión de conductores</span>
                    </div>
                </div>
                <button onclick="closeVehicleModal('bus'); openQuoteModal();" class="mt-8 inline-flex items-center gap-2 bg-blue-600 text-white font-semibold px-8 py-3 rounded-full hover:bg-blue-500 transition-all shadow-lg shadow-blue-600/25">
                    Solicitar Cotización
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Maquinaria -->
<div id="vehicleMachineryModal" class="product-modal-overlay">
    <div class="product-modal" style="background: linear-gradient(135deg, #713f12 0%, #a16207 100%);">
        <button onclick="closeVehicleModal('machinery')" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
           <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="product-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1100px] mx-auto items-center p-6 sm:p-10 lg:p-12 gap-8">
            <div class="flex-shrink-0 w-full lg:w-1/2 flex justify-center relative">
                 <!-- Background Grid -->
                <div class="absolute inset-0 border border-white/5 rounded-xl pointer-events-none" 
                     style="background-image: linear-gradient(rgba(234,179,8,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(234,179,8,0.05) 1px, transparent 1px); background-size: 20px 20px;">
                </div>
                
                <svg viewBox="0 0 320 200" class="w-full h-auto max-h-[280px]" xmlns="http://www.w3.org/2000/svg">
                    <!-- Floor/Ground -->
                    <line x1="20" y1="170" x2="300" y2="170" stroke="#a16207" stroke-width="2"/>
                    <path d="M20 170 L300 170" stroke="#facc15" stroke-width="2" stroke-dasharray="10,10" opacity="0.3"/>
                    
                    
                    <!-- Excavator Body -->
                    <!-- Tracks -->
                    <path d="M40 130 L200 130 L210 160 L30 160 Z" fill="#422006" stroke="#fbbf24" stroke-width="2"/>
                    <g stroke="#fbbf24" stroke-width="2">
                        <circle cx="50" cy="145" r="8" fill="#422006"/>
                        <circle cx="80" cy="145" r="8" fill="#422006"/>
                        <circle cx="110" cy="145" r="8" fill="#422006"/>
                        <circle cx="140" cy="145" r="8" fill="#422006"/>
                        <circle cx="170" cy="145" r="8" fill="#422006"/>
                    </g>
                    
                    <!-- Main Cabin -->
                    <rect x="60" y="60" width="120" height="80" rx="4" fill="#a16207" stroke="#fbbf24" stroke-width="2"/>
                    
                    <!-- Window -->
                    <path d="M70 70 L70 110 L140 110 L140 70 Z" fill="#ca8a04" opacity="0.5" stroke="#fbbf24" stroke-width="1"/>
                    
                    <!-- Arm System -->
                    <path d="M160 90 L240 50" stroke="#fbbf24" stroke-width="12" stroke-linecap="round"/>
                    <path d="M240 50 L280 100" stroke="#fbbf24" stroke-width="10" stroke-linecap="round"/>
                    <path d="M280 100 L260 130" stroke="#fbbf24" stroke-width="8" stroke-linecap="round"/>
                    
                     <!-- Bucket -->
                     <path d="M250 130 L290 130 L280 160 L240 150 Z" fill="#422006" stroke="#fbbf24" stroke-width="2"/>
                     
                     <!-- Hydraulics -->
                     <line x1="170" y1="80" x2="220" y2="55" stroke="#1d4ed8" stroke-width="4" stroke-linecap="round"/>
                    
                    
                    <!-- FUNCTIONAL HIGHLIGHTS -->
                    
                    <!-- 1. Engine Hours (Rear) -->
                    <circle cx="50" cy="80" r="15" fill="none" stroke="#22c55e" stroke-width="1" stroke-dasharray="2,2"/>
                    <text x="50" y="85" font-family="monospace" font-size="16" fill="#22c55e" font-weight="bold" text-anchor="middle">⏳</text>
                     <text x="50" y="55" font-family="monospace" font-size="10" fill="#22c55e" font-weight="bold" text-anchor="middle">HORAS MOTOR</text>
                    
                    <!-- 2. Hydraulic Sensor (Boom) -->
                    <circle cx="240" cy="50" r="5" fill="#3b82f6"/>
                    <circle cx="240" cy="50" r="10" fill="none" stroke="#3b82f6" stroke-width="1">
                        <animate attributeName="r" values="8;12;8" dur="2s" repeatCount="indefinite"/>
                         <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"/>
                    </circle>
                    <text x="240" y="30" font-family="monospace" font-size="10" fill="#3b82f6" font-weight="bold" text-anchor="middle">SENSOR HIDRÁULICO</text>
                    
                     <!-- 3. Idle Detection (Cabin) -->
                     <text x="160" y="65" font-family="monospace" font-size="12" fill="#fff" font-weight="bold">Zzz</text>
                     <text x="160" y="50" font-family="monospace" font-size="10" fill="#fff" font-weight="bold">RELENTÍ</text>

                </svg>
            </div>
            <div class="flex-1 w-full">
                <span class="inline-block px-3 py-1 bg-white/10 border border-white/20 rounded-full text-xs font-semibold text-yellow-400 uppercase tracking-wider mb-4">
                    Maquinaria Amarilla
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight mb-6">
                    Control de <span class="text-yellow-500">Maquinaria</span>
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar">
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-yellow-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Control de horas de motor</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-orange-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Detección de uso fuera de horario</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-red-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Alertas por inactividad (Relentí)</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Mantenimiento preventivo</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Geocercas de obra</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Eficiencia de combustible</span>
                    </div>
                    <div class="flex items-start gap-2 bg-slate-800/50 border border-white/5 rounded-lg p-3 hover:bg-slate-700/50 transition-colors">
                        <div class="w-1.5 h-1.5 rounded-full bg-cyan-400 mt-2"></div>
                        <span class="text-slate-300 text-sm">Respaldo histórico por 6 meses</span>
                    </div>
                </div>
                <button onclick="closeVehicleModal('machinery'); openQuoteModal();" class="mt-8 inline-flex items-center gap-2 bg-yellow-600 text-white font-semibold px-8 py-3 rounded-full hover:bg-yellow-500 transition-all shadow-lg shadow-yellow-600/25">
                    Solicitar Cotización
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL 1: DASHCAM -->
<!-- ============================================== -->
<div id="dashcamModal" class="product-modal-overlay">
    <div class="product-modal mesh-gradient-dashcam">
        <!-- Close Button -->
        <button onclick="closeProductModal('dashcam')" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="product-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1200px] mx-auto items-center p-6 sm:p-10 lg:p-16 gap-8 lg:gap-12">
            <!-- Left Side - Image -->
            <div class="flex-1 flex flex-col justify-center w-full">
                <div class="relative rounded-2xl overflow-hidden bg-white/10 backdrop-blur-sm border border-white/20 aspect-video flex items-center justify-center">
                    <img src="https://d29rw3zaldax51.cloudfront.net/assets/images/dashcam-4k-image/Adas-D_features.jpg" alt="DashCam Inteligente" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Right Side - Content -->
            <div class="flex-1 flex flex-col justify-center space-y-6 w-full">
                <div>
                    <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-xs font-semibold text-white uppercase tracking-wider mb-4">
                        Seguridad Avanzada
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight tracking-tight">
                        ¿POR QUÉ<br>ELEGIR NUESTRA<br>DASHCAM?
                    </h2>
                </div>

                <div class="space-y-4">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Monitoreo en tiempo real:</strong> visualiza los trayectos en vivo desde cualquier lugar.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Almacenamiento de grabaciones</strong> por al menos 30 días.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Tecnología ADAS:</strong> detecta riesgos y activa alertas preventivas.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Sistema DMS:</strong> detecta fatiga o distracción del conductor.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Alerta de colisión</strong> y alarmas sonoras configurables.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Consulta de historial</strong> de rutas y eventos críticos.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Mejora la seguridad de la flota</strong> y reduce costos por incidentes.
                        </p>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="pt-4">
                    <button onclick="closeProductModal('dashcam'); setTimeout(function(){ openQuoteModal(); }, 300);" class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-white text-gray-900 font-semibold rounded-full hover:bg-white/90 transition-colors">
                        Solicitar cotización
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL 2: SENSOR DE TEMPERATURA -->
<!-- ============================================== -->
<div id="temperatureModal" class="product-modal-overlay">
    <div class="product-modal mesh-gradient-temperature">
        <!-- Close Button -->
        <button onclick="closeProductModal('temperature')" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="product-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1200px] mx-auto items-center p-6 sm:p-10 lg:p-16 gap-8 lg:gap-12">
            <!-- Left Side - Image -->
            <div class="flex-1 flex flex-col justify-center w-full">
                <div class="relative rounded-2xl overflow-hidden bg-white/10 backdrop-blur-sm border border-white/20 aspect-video flex items-center justify-center">
                    <img src="https://bonitel.com.pe/wp-content/uploads/2024/01/temperatura-sliders.webp" alt="Sensor de Temperatura" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Right Side - Content -->
            <div class="flex-1 flex flex-col justify-center space-y-5 w-full">
                <div>
                    <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-xs font-semibold text-white uppercase tracking-wider mb-4">
                        Control Térmico
                    </span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight tracking-tight mb-2">
                        Control térmico inteligente para la protección de tu mercancía
                    </h2>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white/80 leading-tight">
                        ¿POR QUÉ MONITOREAR LA TEMPERATURA?
                    </h3>
                </div>

                <div class="space-y-4 text-white/90 text-sm sm:text-base leading-relaxed">
                    <p>
                        En operaciones de transporte y logística, la temperatura es un factor crítico. Una mínima variación fuera del rango permitido puede comprometer el estado de la mercancía, generar pérdidas económicas, reclamos de clientes o incluso el rechazo total de la carga.
                    </p>
                    <p>
                        El <strong>Sensor de Temperatura</strong> integrado a nuestra plataforma de telemetría permite supervisar en tiempo real las condiciones térmicas dentro de cavas, contenedores, trailers o espacios de carga refrigerada, asegurando que cada traslado se realice bajo parámetros óptimos y controlados.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-3 pt-2">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm leading-relaxed">Monitoreo en tiempo real</p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm leading-relaxed">Alertas configurables</p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm leading-relaxed">Historial de registros</p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm leading-relaxed">Reportes automáticos</p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm leading-relaxed">Protección de mercancía</p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm leading-relaxed">Cumplimiento normativo</p>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="pt-4">
                    <button onclick="closeProductModal('temperature'); setTimeout(function(){ openQuoteModal(); }, 300);" class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-white text-gray-900 font-semibold rounded-full hover:bg-white/90 transition-colors">
                        Solicitar cotización
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- MODAL 3: MONITOREO DE COMBUSTIBLE -->
<!-- ============================================== -->
<div id="fuelModal" class="product-modal-overlay">
    <div class="product-modal mesh-gradient-fuel">
        <!-- Close Button -->
        <button onclick="closeProductModal('fuel')" class="absolute right-4 top-4 sm:right-6 sm:top-6 z-20 flex h-10 w-10 items-center justify-center text-white bg-transparent hover:bg-white/10 rounded-full transition-colors" aria-label="Cerrar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="product-modal-content relative z-10 flex flex-col lg:flex-row h-full w-full max-w-[1200px] mx-auto items-center p-6 sm:p-10 lg:p-16 gap-8 lg:gap-12">
            <!-- Left Side - Image -->
            <div class="flex-1 flex flex-col justify-center w-full">
                <div class="relative rounded-2xl overflow-hidden bg-white/10 backdrop-blur-sm border border-white/20 aspect-video flex items-center justify-center">
                    <img src="https://mcontrolenergy.com/wp-content/uploads/2017/10/telemt.jpg" alt="Monitoreo de Combustible" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Right Side - Content -->
            <div class="flex-1 flex flex-col justify-center space-y-5 w-full">
                <div>
                    <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-xs font-semibold text-white uppercase tracking-wider mb-4">
                        Control de Flota
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight tracking-tight">
                        MONITOREO DE COMBUSTIBLE
                    </h2>
                </div>

                <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                    El combustible representa uno de los mayores costos operativos en flotas de transporte. Nuestro sistema de monitoreo permite detectar consumos anormales, robos de combustible y optimizar el rendimiento de cada vehículo con precisión del 98%.
                </p>

                <div class="space-y-3">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Nivel de combustible en tiempo real</strong> con precisión del 98%.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Detección de cargas y descargas</strong> de combustible.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Alertas de robo</strong> o drenaje sospechoso.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Historial de consumo</strong> por vehículo y conductor.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Reportes de rendimiento</strong> km/litro automáticos.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Integración con GPS</strong> para correlación de datos.
                        </p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            <strong>Reducción de costos</strong> operativos hasta un 30%.
                        </p>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="pt-4">
                    <button onclick="closeProductModal('fuel'); setTimeout(function(){ openQuoteModal(); }, 300);" class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-white text-gray-900 font-semibold rounded-full hover:bg-white/90 transition-colors">
                        Solicitar cotización
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Products Section -->
<section id="productos" class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-stripe-purple font-semibold mb-4">¿Por qué escogernos?</p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-stripe-dark tracking-tight mb-6 text-balance">
                Beneficios y funcionalidades completas
            </h2>
            <p class="text-lg text-stripe-gray leading-relaxed">
                Aumenta la productividad, supervisa el cumplimiento de rutas, mejora la vigilancia y seguridad de tu flota, minimiza gastos de operación y protege la vida útil de tus unidades.
            </p>
        </div>

        <!-- Products Pills -->
        <div class="flex flex-wrap justify-center gap-3 mb-16">
            <?php foreach ($products as $product): ?>
            <a href="#" class="group inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 hover:border-stripe-purple/30 bg-white hover:bg-stripe-purple/5 transition-all">
                <span class="w-2 h-2 rounded-full" style="background-color: <?php echo $product['color']; ?>"></span>
                <span class="text-sm font-medium text-stripe-dark"><?php echo $product['name']; ?></span>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        </div>
    </div>
</section>
<!-- International Coverage Section -->
<section id="cobertura-internacional" class="py-20 lg:py-32 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 relative overflow-hidden">
    <!-- Background pattern -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-stripe-purple/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-stripe-cyan/20 rounded-full blur-3xl"></div>
        <!-- Grid pattern -->
        <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur text-white text-xs font-semibold px-4 py-2 rounded-full mb-6 border border-white/10">
                <svg class="w-4 h-4 text-stripe-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Cobertura Internacional</span>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight text-balance mb-4">
                Únete al rastreo satelital con
                <span class="bg-gradient-to-r from-stripe-cyan via-stripe-purple to-stripe-pink bg-clip-text text-transparent">
                    cobertura internacional
                </span>
            </h2>
            <p class="text-lg text-white/70 max-w-3xl mx-auto leading-relaxed">
                Nuestras líneas multioperador funcionan en <strong class="text-white">Venezuela, Colombia y Brasil</strong>. Sin fronteras ni limitaciones para el viaje de tus unidades.
            </p>
        </div>
        
        <div class="grid lg:grid-cols-5 gap-8 lg:gap-12 items-center">
            <!-- Left: Phone Mockups (2 cols) -->
            <div class="lg:col-span-2 relative flex justify-center order-2 lg:order-1">
                <!-- Glow effect -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-br from-stripe-purple/30 to-stripe-cyan/30 rounded-full blur-3xl"></div>
                
                <!-- Phone Frame 1 (Back) -->
                <div class="relative -mr-16 z-10" style="transform: rotate(-6deg);">
                    <div class="w-40 h-72 sm:w-48 sm:h-80 bg-gradient-to-b from-gray-700 to-gray-800 rounded-[2rem] p-1.5 shadow-2xl border border-white/10">
                        <div class="w-full h-full bg-gradient-to-br from-stripe-dark to-slate-800 rounded-[1.75rem] overflow-hidden flex items-center justify-center">
                            <div class="text-center p-3">
                                <div class="w-20 h-20 mx-auto flex items-center justify-center mb-3">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/src/img/imgi_72_GLOBAL-1-196x300.png' ); ?>" class="w-full h-auto" alt="Global System">
                                </div>
                                <p class="text-white/80 text-xs font-medium">Global GPS</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Phone Frame 2 (Front) -->
                <div class="relative z-20" style="transform: rotate(6deg);">
                    <div class="w-44 h-80 sm:w-52 sm:h-[22rem] bg-gradient-to-b from-gray-700 to-gray-800 rounded-[2rem] p-1.5 shadow-2xl border border-white/10">
                        <div class="w-full h-full bg-gradient-to-br from-slate-900 to-stripe-dark rounded-[1.75rem] overflow-hidden">
                            <!-- Status bar -->
                            <div class="flex items-center justify-between px-3 py-1.5 bg-black/30">
                                <span class="text-white/60 text-[9px]">9:41</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-2.5 h-2.5 text-white/60" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 20.5a2.5 2.5 0 002.5-2.5h-5a2.5 2.5 0 002.5 2.5zM18 14V9c0-3.07-1.63-5.64-4.5-6.32V2a1.5 1.5 0 00-3 0v.68C7.64 3.36 6 5.92 6 9v5l-2 2v1h16v-1l-2-2z"/>
                                    </svg>
                                    <svg class="w-2.5 h-2.5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M15.67 4H14V2h-4v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4z"/>
                                    </svg>
                                </div>
                            </div>
                            <!-- Content -->
                            <div class="p-2.5 space-y-2">
                                <div class="bg-white/10 rounded-lg p-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 bg-green-500/20 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white text-[10px] font-semibold">GPS Activo</p>
                                            <p class="text-white/50 text-[8px]">Venezuela - Colombia</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white/5 rounded-lg p-2">
                                    <p class="text-white/70 text-[8px] mb-0.5">Velocidad</p>
                                    <p class="text-white text-lg font-bold">67 <span class="text-xs font-normal text-white/50">km/h</span></p>
                                </div>
                                <div class="grid grid-cols-2 gap-1.5">
                                    <div class="bg-green-500/20 rounded-lg p-1.5">
                                        <p class="text-white/70 text-[7px]">VE</p>
                                        <p class="text-green-400 text-xs font-bold">Activo</p>
                                    </div>
                                    <div class="bg-amber-500/20 rounded-lg p-1.5">
                                        <p class="text-white/70 text-[7px]">CO</p>
                                        <p class="text-amber-400 text-xs font-bold">Activo</p>
                                    </div>
                                    <div class="bg-blue-500/20 rounded-lg p-1.5">
                                        <p class="text-white/70 text-[7px]">BR</p>
                                        <p class="text-blue-400 text-xs font-bold">Activo</p>
                                    </div>
                                    <div class="bg-stripe-purple/20 rounded-lg p-1.5">
                                        <p class="text-white/70 text-[7px]">Alertas</p>
                                        <p class="text-white text-xs font-bold">3</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right: Map Visualization (3 cols) -->
            <div class="lg:col-span-3 relative order-1 lg:order-2">
                <!-- Map Container -->
                <div class="relative bg-gradient-to-br from-sky-900/50 via-slate-800/50 to-blue-900/50 rounded-3xl p-4 lg:p-6 shadow-xl border border-white/10 overflow-hidden backdrop-blur-sm">
                    <!-- Dot pattern overlay -->
                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #1993cf 1px, transparent 1px); background-size: 20px 20px;"></div>
                    
                    <!-- SVG Map -->
                    <svg viewBox="0 0 400 300" class="w-full h-auto relative z-10" xmlns="http://www.w3.org/2000/svg">
                        <!-- Ocean/Background -->
                        <defs>
                            <linearGradient id="oceanGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#1e293b;stop-opacity:0.5" />
                                <stop offset="100%" style="stop-color:#0f172a;stop-opacity:0.5" />
                            </linearGradient>
                            <linearGradient id="routeGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" style="stop-color:#1993cf;stop-opacity:1" />
                                <stop offset="50%" style="stop-color:#8956ff;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#1993cf;stop-opacity:1" />
                            </linearGradient>
                            <filter id="glow">
                                <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                                <feMerge>
                                    <feMergeNode in="coloredBlur"/>
                                    <feMergeNode in="SourceGraphic"/>
                                </feMerge>
                            </filter>
                        </defs>
                        
                        <!-- Countries shapes (simplified) -->
                        <!-- Colombia -->
                        <path d="M50,70 L120,50 L150,80 L140,130 L100,170 L60,150 L40,110 Z" 
                              fill="#fef3c7" fill-opacity="0.3" stroke="#f59e0b" stroke-width="2"/>
                        <text x="85" y="115" class="text-[11px] font-bold" fill="#fbbf24" text-anchor="middle">COLOMBIA</text>
                        
                        <!-- Venezuela -->
                        <path d="M150,40 L250,30 L300,60 L290,110 L240,140 L180,130 L150,90 Z" 
                              fill="#dcfce7" fill-opacity="0.3" stroke="#22c55e" stroke-width="2"/>
                        <text x="220" y="85" class="text-[11px] font-bold" fill="#4ade80" text-anchor="middle">VENEZUELA</text>
                        
                        <!-- Brazil (partial) -->
                        <path d="M100,170 L180,150 L260,160 L320,190 L350,260 L280,290 L180,280 L100,240 L80,200 Z" 
                              fill="#dbeafe" fill-opacity="0.3" stroke="#3b82f6" stroke-width="2"/>
                        <text x="220" y="230" class="text-[11px] font-bold" fill="#60a5fa" text-anchor="middle">BRASIL</text>
                        
                        <!-- Route line with animation -->
                        <path d="M80,100 Q120,70 160,80 Q200,60 240,75 Q280,90 260,130 Q240,170 200,190 Q160,210 180,250 Q200,280 240,270" 
                              fill="none" stroke="url(#routeGradient)" stroke-width="4" stroke-linecap="round" filter="url(#glow)" stroke-dasharray="8,4">
                            <animate attributeName="stroke-dashoffset" values="0;24" dur="1.5s" repeatCount="indefinite"/>
                        </path>
                        
                        <!-- City markers - Colombia -->
                        <g class="city-marker">
                            <circle cx="90" cy="130" r="7" fill="#f59e0b" stroke="white" stroke-width="2"/>
                            <text x="90" y="147" class="text-[8px]" fill="white" fill-opacity="0.8" text-anchor="middle">Bogota</text>
                        </g>
                        <g class="city-marker">
                            <circle cx="60" cy="90" r="5" fill="#fbbf24" stroke="white" stroke-width="1.5"/>
                            <text x="60" y="105" class="text-[7px]" fill="white" fill-opacity="0.7" text-anchor="middle">Medellin</text>
                        </g>
                        
                        <!-- City markers - Venezuela -->
                        <g class="city-marker">
                            <circle cx="260" cy="60" r="7" fill="#22c55e" stroke="white" stroke-width="2"/>
                            <text x="260" y="77" class="text-[8px]" fill="white" fill-opacity="0.8" text-anchor="middle">Caracas</text>
                        </g>
                        <g class="city-marker">
                            <circle cx="190" cy="85" r="5" fill="#4ade80" stroke="white" stroke-width="1.5"/>
                            <text x="190" y="100" class="text-[7px]" fill="white" fill-opacity="0.7" text-anchor="middle">Maracaibo</text>
                        </g>
                        <g class="city-marker">
                            <circle cx="230" cy="105" r="5" fill="#4ade80" stroke="white" stroke-width="1.5"/>
                            <text x="230" y="120" class="text-[7px]" fill="white" fill-opacity="0.7" text-anchor="middle">Valencia</text>
                        </g>
                        <g class="city-marker">
                            <circle cx="280" cy="90" r="4" fill="#86efac" stroke="white" stroke-width="1"/>
                            <text x="280" y="103" class="text-[6px]" fill="white" fill-opacity="0.6" text-anchor="middle">Barquisimeto</text>
                        </g>
                        
                        <!-- City markers - Brazil -->
                        <g class="city-marker">
                            <circle cx="290" cy="260" r="7" fill="#3b82f6" stroke="white" stroke-width="2"/>
                            <text x="290" y="277" class="text-[8px]" fill="white" fill-opacity="0.8" text-anchor="middle">Sao Paulo</text>
                        </g>
                        <g class="city-marker">
                            <circle cx="200" cy="210" r="5" fill="#60a5fa" stroke="white" stroke-width="1.5"/>
                            <text x="200" y="225" class="text-[7px]" fill="white" fill-opacity="0.7" text-anchor="middle">Brasilia</text>
                        </g>
                        <g class="city-marker">
                            <circle cx="150" cy="180" r="4" fill="#93c5fd" stroke="white" stroke-width="1"/>
                            <text x="150" y="193" class="text-[6px]" fill="white" fill-opacity="0.6" text-anchor="middle">Manaus</text>
                        </g>
                        
                        <!-- GPS tracking points on route -->
                        <g filter="url(#glow)">
                            <circle cx="120" cy="75" r="5" fill="#1993cf">
                                <animate attributeName="r" values="4;6;4" dur="2s" repeatCount="indefinite"/>
                            </circle>
                            <circle cx="200" cy="68" r="5" fill="#8956ff">
                                <animate attributeName="r" values="4;6;4" dur="2s" repeatCount="indefinite" begin="0.3s"/>
                            </circle>
                            <circle cx="250" cy="110" r="5" fill="#1993cf">
                                <animate attributeName="r" values="4;6;4" dur="2s" repeatCount="indefinite" begin="0.6s"/>
                            </circle>
                            <circle cx="220" cy="170" r="5" fill="#8956ff">
                                <animate attributeName="r" values="4;6;4" dur="2s" repeatCount="indefinite" begin="0.9s"/>
                            </circle>
                        </g>
                        
                        <!-- Legend -->
                        <g transform="translate(10, 10)">
                            <rect x="0" y="0" width="85" height="65" rx="6" fill="black" fill-opacity="0.4" stroke="white" stroke-opacity="0.1"/>
                            <circle cx="12" cy="15" r="4" fill="#22c55e"/>
                            <text x="22" y="18" class="text-[8px]" fill="white" fill-opacity="0.8">Venezuela</text>
                            <circle cx="12" cy="32" r="4" fill="#f59e0b"/>
                            <text x="22" y="35" class="text-[8px]" fill="white" fill-opacity="0.8">Colombia</text>
                            <circle cx="12" cy="49" r="4" fill="#3b82f6"/>
                            <text x="22" y="52" class="text-[8px]" fill="white" fill-opacity="0.8">Brasil</text>
                        </g>
                    </svg>
                    
                    <!-- Floating badge -->
                    <div class="absolute -bottom-2 -right-2 bg-gradient-to-r from-stripe-purple to-stripe-cyan text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg">
                        Multioperador Activo
                    </div>
                </div>
                
                <!-- Benefits row below map -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-6">
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 border border-white/10 text-center">
                        <div class="w-8 h-8 mx-auto mb-2 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <p class="text-white text-xs font-semibold">Sin fronteras</p>
                    </div>
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 border border-white/10 text-center">
                        <div class="w-8 h-8 mx-auto mb-2 bg-gradient-to-br from-stripe-cyan to-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <p class="text-white text-xs font-semibold">Tiempo real</p>
                    </div>
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 border border-white/10 text-center">
                        <div class="w-8 h-8 mx-auto mb-2 bg-gradient-to-br from-stripe-purple to-indigo-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.14 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                            </svg>
                        </div>
                        <p class="text-white text-xs font-semibold">Multioperador</p>
                    </div>
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 border border-white/10 text-center">
                        <div class="w-8 h-8 mx-auto mb-2 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <p class="text-white text-xs font-semibold">Todas las funciones</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Development Services Section - Bento Style -->
<section id="desarrollo" class="py-20 lg:py-32 bg-stripe-light overflow-hidden">
    <style>
        /* Map pulse animation */
        @keyframes map-pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0; }
        }
        
        .map-marker-pulse {
            animation: map-pulse 2s ease-in-out infinite;
        }
        
        /* Vehicle movement animation */
        @keyframes vehicle-move {
            0% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(30px) translateY(-10px); }
            50% { transform: translateX(50px) translateY(5px); }
            75% { transform: translateX(20px) translateY(15px); }
            100% { transform: translateX(0) translateY(0); }
        }
        
        .vehicle-animated {
            animation: vehicle-move 8s ease-in-out infinite;
        }
        
        /* Integration flow animation */
        @keyframes flow-pulse {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }
        
        @keyframes data-flow {
            0% { stroke-dashoffset: 100; }
            100% { stroke-dashoffset: 0; }
        }
        
        .integration-line {
            stroke-dasharray: 8 4;
            animation: data-flow 2s linear infinite;
        }
        
        @keyframes icon-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        .float-icon {
            animation: icon-float 3s ease-in-out infinite;
        }
        
        .float-icon-delay-1 { animation-delay: 0.5s; }
        .float-icon-delay-2 { animation-delay: 1s; }
        .float-icon-delay-3 { animation-delay: 1.5s; }
    </style>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-stripe-purple font-semibold mb-4">Servicios de Desarrollo</p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-stripe-dark tracking-tight mb-6 text-balance">
                Soluciones tecnológicas a tu medida
            </h2>
            <p class="text-lg text-stripe-gray leading-relaxed">
                Además del rastreo GPS, ofrecemos servicios de desarrollo de software para impulsar tu negocio.
            </p>
        </div>

        <!-- Bento Grid - 2 Large Cards -->
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Card 1: Monitoring Platform (Larger) -->
            <div class="bg-stripe-dark rounded-3xl p-8 lg:p-10 shadow-xl overflow-hidden relative group hover:shadow-2xl transition-shadow min-h-[500px] flex flex-col">
                <!-- Link icon -->
                <a href="#" class="absolute top-6 right-6 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white/70 hover:bg-white hover:text-stripe-dark transition-all z-10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
                
                <div class="mb-8">
                    <h3 class="text-2xl lg:text-3xl font-bold text-white mb-4">
                        Plataformas de monitoreo
                    </h3>
                    <p class="text-gray-400 leading-relaxed">
                        Sistemas personalizados de rastreo y monitoreo GPS para empresas con flotas vehiculares. Visualiza todos tus vehículos en tiempo real.
                    </p>
                </div>
                
                <!-- Large Map Dashboard Preview -->
                <div class="flex-1 relative">
                    <div class="bg-[#1a1f36] rounded-2xl overflow-hidden border border-white/10 shadow-2xl h-full">
                        <!-- Dashboard Header -->
                        <div class="px-4 py-3 border-b border-white/10 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-white/60 font-mono uppercase tracking-wider">Monitoreo en vivo</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                                    <span class="text-xs text-green-400">8 activos</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                                    <span class="text-xs text-yellow-400">2 detenidos</span>
                                </div>
                            </div>
                        </div>
                        <!-- Map Content -->
                        <div class="h-64 lg:h-72 relative bg-gradient-to-br from-[#0a1628] to-[#1a2744]">
                            <!-- Map Grid Lines -->
                            <svg class="absolute inset-0 w-full h-full opacity-20">
                                <defs>
                                    <pattern id="mapGridLarge" width="30" height="30" patternUnits="userSpaceOnUse">
                                        <path d="M 30 0 L 0 0 0 30" fill="none" stroke="#4a5568" stroke-width="0.5"/>
                                    </pattern>
                                </defs>
                                <rect width="100%" height="100%" fill="url(#mapGridLarge)"/>
                            </svg>
                            
                            <!-- Roads -->
                            <svg class="absolute inset-0 w-full h-full">
                                <path d="M0,100 Q80,60 160,100 T320,80 T480,100" stroke="#3b82f6" fill="none" stroke-width="3" opacity="0.3"/>
                                <path d="M80,0 Q100,80 60,160 T100,280" stroke="#22c55e" fill="none" stroke-width="3" opacity="0.25"/>
                                <path d="M200,0 Q180,100 220,200 T180,300" stroke="#8b5cf6" fill="none" stroke-width="2" opacity="0.2"/>
                            </svg>
                            
                            <!-- Vehicle Markers -->
                            <div class="absolute top-12 left-12 vehicle-animated">
                                <div class="w-7 h-7 bg-stripe-purple rounded-full flex items-center justify-center shadow-lg shadow-stripe-purple/50">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                    </svg>
                                </div>
                                <div class="absolute inset-0 w-7 h-7 bg-stripe-purple rounded-full map-marker-pulse"></div>
                            </div>
                            
                            <div class="absolute top-24 right-16" style="animation: vehicle-move 10s ease-in-out infinite reverse;">
                                <div class="w-7 h-7 bg-stripe-cyan rounded-full flex items-center justify-center shadow-lg shadow-stripe-cyan/50">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="absolute bottom-20 left-1/4" style="animation: vehicle-move 12s ease-in-out infinite;">
                                <div class="w-7 h-7 bg-green-500 rounded-full flex items-center justify-center shadow-lg shadow-green-500/50">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="absolute top-32 left-1/2" style="animation: vehicle-move 9s ease-in-out infinite 2s;">
                                <div class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center shadow-lg shadow-orange-500/50">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Side Panel -->
                            <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-sm rounded-xl p-3 w-36">
                                <p class="text-[10px] text-white/60 mb-2 font-mono">RESUMEN</p>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-[10px] text-white/80">En ruta</span>
                                        <span class="text-xs font-bold text-green-400">8</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-[10px] text-white/80">Detenidos</span>
                                        <span class="text-xs font-bold text-yellow-400">2</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-[10px] text-white/80">Alertas</span>
                                        <span class="text-xs font-bold text-red-400">1</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Info Overlay -->
                            <div class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-sm rounded-xl px-3 py-2">
                                <p class="text-[10px] text-white/80">Última actualización: hace 3 seg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Integration with CRM/ERP -->
            <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-xl border border-gray-100 overflow-hidden relative group hover:shadow-2xl transition-shadow min-h-[500px] flex flex-col">
                <!-- Link icon -->
                <a href="#" class="absolute top-6 right-6 w-10 h-10 rounded-full bg-stripe-light flex items-center justify-center text-stripe-gray hover:bg-stripe-purple hover:text-white transition-all z-10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
                
                <div class="mb-8">
                    <h3 class="text-2xl lg:text-3xl font-bold text-stripe-dark mb-4">
                        Integración web con cualquier sistema
                    </h3>
                    <p class="text-stripe-gray leading-relaxed">
                        Conectamos tu plataforma de CRM, ERP con software de gestión de flotas y sistemas administrativos existentes.
                    </p>
                </div>
                
                <!-- Integration Visual -->
                <div class="flex-1 relative">
                    <div class="bg-gradient-to-br from-stripe-light to-white rounded-2xl p-6 h-full border border-gray-200 overflow-hidden">
                        <!-- Central Hub -->
                        <div class="relative h-full flex items-center justify-center">
                            <!-- Connection Lines SVG -->
                            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 400 300">
                                <!-- Lines from center to corners -->
                                <line x1="200" y1="150" x2="60" y2="50" stroke="url(#lineGrad1)" stroke-width="2" class="integration-line"/>
                                <line x1="200" y1="150" x2="340" y2="50" stroke="url(#lineGrad2)" stroke-width="2" class="integration-line" style="animation-delay: 0.5s;"/>
                                <line x1="200" y1="150" x2="60" y2="250" stroke="url(#lineGrad3)" stroke-width="2" class="integration-line" style="animation-delay: 1s;"/>
                                <line x1="200" y1="150" x2="340" y2="250" stroke="url(#lineGrad4)" stroke-width="2" class="integration-line" style="animation-delay: 1.5s;"/>
                                
                                <defs>
                                    <linearGradient id="lineGrad1" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#635bff" stop-opacity="0.2"/>
                                        <stop offset="100%" stop-color="#635bff"/>
                                    </linearGradient>
                                    <linearGradient id="lineGrad2" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#00d4ff" stop-opacity="0.2"/>
                                        <stop offset="100%" stop-color="#00d4ff"/>
                                    </linearGradient>
                                    <linearGradient id="lineGrad3" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#22c55e" stop-opacity="0.2"/>
                                        <stop offset="100%" stop-color="#22c55e"/>
                                    </linearGradient>
                                    <linearGradient id="lineGrad4" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#f59e0b" stop-opacity="0.2"/>
                                        <stop offset="100%" stop-color="#f59e0b"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                            
                            <!-- Center - Global System Hub -->
                            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
                                <div class="w-20 h-20 lg:w-24 lg:h-24 bg-gradient-to-br from-stripe-purple to-stripe-cyan rounded-2xl shadow-xl flex items-center justify-center">
                                    <svg class="w-10 h-10 lg:w-12 lg:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <p class="text-center text-xs font-semibold text-stripe-dark mt-2">Global GPS</p>
                            </div>
                            
                            <!-- Corner Icons - CRM -->
                            <div class="absolute top-4 left-4 float-icon">
                                <div class="w-14 h-14 lg:w-16 lg:h-16 bg-white rounded-xl shadow-lg border border-gray-100 flex items-center justify-center">
                                    <svg class="w-7 h-7 lg:w-8 lg:h-8 text-stripe-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <p class="text-center text-[10px] font-medium text-stripe-gray mt-1">CRM</p>
                            </div>
                            
                            <!-- Corner Icons - ERP -->
                            <div class="absolute top-4 right-4 float-icon float-icon-delay-1">
                                <div class="w-14 h-14 lg:w-16 lg:h-16 bg-white rounded-xl shadow-lg border border-gray-100 flex items-center justify-center">
                                    <svg class="w-7 h-7 lg:w-8 lg:h-8 text-stripe-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <p class="text-center text-[10px] font-medium text-stripe-gray mt-1">ERP</p>
                            </div>
                            
                            <!-- Corner Icons - Fleet Management -->
                            <div class="absolute bottom-4 left-4 float-icon float-icon-delay-2">
                                <div class="w-14 h-14 lg:w-16 lg:h-16 bg-white rounded-xl shadow-lg border border-gray-100 flex items-center justify-center">
                                    <svg class="w-7 h-7 lg:w-8 lg:h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 17h.01M15 17h.01M9 17H7a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1h3l3 3v4a2 2 0 01-2 2h-1M9 17a2 2 0 100-4 2 2 0 000 4zM15 17a2 2 0 100-4 2 2 0 000 4z"/>
                                    </svg>
                                </div>
                                <p class="text-center text-[10px] font-medium text-stripe-gray mt-1">Flotas</p>
                            </div>
                            
                            <!-- Corner Icons - Admin Systems -->
                            <div class="absolute bottom-4 right-4 float-icon float-icon-delay-3">
                                <div class="w-14 h-14 lg:w-16 lg:h-16 bg-white rounded-xl shadow-lg border border-gray-100 flex items-center justify-center">
                                    <svg class="w-7 h-7 lg:w-8 lg:h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <p class="text-center text-[10px] font-medium text-stripe-gray mt-1">Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Feature Tags -->
                <div class="flex flex-wrap gap-2 mt-6">
                    <span class="px-3 py-1 bg-stripe-purple/10 text-stripe-purple text-xs font-medium rounded-full">API REST</span>
                    <span class="px-3 py-1 bg-stripe-cyan/10 text-stripe-cyan text-xs font-medium rounded-full">Webhooks</span>
                    <span class="px-3 py-1 bg-green-100 text-green-600 text-xs font-medium rounded-full">Tiempo real</span>
                    <span class="px-3 py-1 bg-orange-100 text-orange-600 text-xs font-medium rounded-full">Custom SDK</span>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Why Global System Section -->
<section id="nosotros" class="py-20 lg:py-32 bg-stripe-dark text-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Content -->
            <div class="space-y-8">
                <p class="text-stripe-cyan font-semibold">Sobre Nosotros</p>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight leading-tight text-balance">
                    Telemetría y análisis de datos para tu operación
                </h2>
                <p class="text-lg text-gray-300 leading-relaxed">
                    Proporcionamos datos de análisis avanzados para empresas: km recorridos, horas de funcionamiento del motor, tiempos de conducción y paradas, excesos de velocidad y más. Nos adaptamos a los requerimientos específicos que cada cliente desea controlar o analizar.
                </p>

                <!-- Stats -->
                <div class="grid grid-cols-2 gap-8 py-8 border-y border-white/10">
                    <div>
                        <p class="text-4xl lg:text-5xl font-bold text-white mb-2">24/7</p>
                        <p class="text-sm text-gray-400">Monitoreo y soporte continuo</p>
                    </div>
                    <div>
                        <p class="text-4xl lg:text-5xl font-bold text-white mb-2">GPS 3G/4G</p>
                        <p class="text-sm text-gray-400">Tecnología de alta velocidad</p>
                    </div>
                    <div>
                        <p class="text-4xl lg:text-5xl font-bold text-white mb-2">100%</p>
                        <p class="text-sm text-gray-400">Cobertura nacional</p>
                    </div>
                    <div>
                        <p class="text-4xl lg:text-5xl font-bold text-white mb-2">App</p>
                        <p class="text-sm text-gray-400">iOS y Android disponibles</p>
                    </div>
                </div>

                <a href="#" class="group inline-flex items-center gap-2 text-stripe-cyan font-semibold hover:underline">
                    Conoce nuestros productos y servicios
                    <?php stripe_arrow_icon('#00d4ff'); ?>
                </a>
            </div>

            <!-- Visual - Stripe Style Connected Grid -->
            <div class="relative">
                <!-- Glowing orb background -->
                <div class="absolute inset-0 bg-gradient-to-r from-stripe-purple/30 via-stripe-cyan/20 to-stripe-pink/30 blur-3xl opacity-50"></div>
                
                <!-- Connected Icons Grid -->
                <div class="relative bg-[#1a1f36] rounded-2xl p-8 overflow-hidden border border-white/5">
                    <!-- SVG Connection Lines -->
                    <svg class="absolute inset-0 w-full h-full pointer-events-none" preserveAspectRatio="none">
                        <defs>
                            <!-- Gradient 1: Green to Cyan -->
                            <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#11efa4"/>
                                <stop offset="100%" stop-color="#00d4ff"/>
                            </linearGradient>
                            <!-- Gradient 2: Cyan to Purple -->
                            <linearGradient id="grad2" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#00d4ff"/>
                                <stop offset="100%" stop-color="#9966ff"/>
                            </linearGradient>
                            <!-- Gradient 3: Purple to Pink -->
                            <linearGradient id="grad3" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#9966ff"/>
                                <stop offset="100%" stop-color="#ff80b5"/>
                            </linearGradient>
                            <!-- Gradient 4: Pink to Red -->
                            <linearGradient id="grad4" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#ff80b5"/>
                                <stop offset="100%" stop-color="#ff5959"/>
                            </linearGradient>
                            <!-- Gradient 5: Red to Yellow -->
                            <linearGradient id="grad5" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#ff5959"/>
                                <stop offset="100%" stop-color="#ffc233"/>
                            </linearGradient>
                            <!-- Gradient 6: Yellow to Green -->
                            <linearGradient id="grad6" x1="100%" y1="0%" x2="0%" y2="0%">
                                <stop offset="0%" stop-color="#ffc233"/>
                                <stop offset="100%" stop-color="#11efa4"/>
                            </linearGradient>
                            <!-- Vertical Gradient: Cyan to Purple -->
                            <linearGradient id="gradV1" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#00d4ff"/>
                                <stop offset="100%" stop-color="#ff80b5"/>
                            </linearGradient>
                            <!-- Central Gradient -->
                            <linearGradient id="gradCenter" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#635bff"/>
                                <stop offset="100%" stop-color="#00d4ff"/>
                            </linearGradient>
                        </defs>
                        
                        <!-- Horizontal Lines Row 1 -->
                        <path class="connection-line" d="M95,70 L200,70" stroke="url(#grad1)" stroke-width="2" fill="none" stroke-linecap="round">
                            <animate attributeName="stroke-dashoffset" from="105" to="0" dur="1.5s" fill="freeze" begin="0.2s"/>
                        </path>
                        <path class="connection-line" d="M295,70 L400,70" stroke="url(#grad2)" stroke-width="2" fill="none" stroke-linecap="round">
                            <animate attributeName="stroke-dashoffset" from="105" to="0" dur="1.5s" fill="freeze" begin="0.4s"/>
                        </path>
                        
                        <!-- Vertical Lines -->
                        <path class="connection-line" d="M247,95 L247,145" stroke="url(#gradV1)" stroke-width="2" fill="none" stroke-linecap="round">
                            <animate attributeName="stroke-dashoffset" from="50" to="0" dur="1s" fill="freeze" begin="0.6s"/>
                        </path>
                        
                        <!-- Horizontal Lines Row 2 -->
                        <path class="connection-line" d="M95,170 L200,170" stroke="url(#grad4)" stroke-width="2" fill="none" stroke-linecap="round">
                            <animate attributeName="stroke-dashoffset" from="105" to="0" dur="1.5s" fill="freeze" begin="0.8s"/>
                        </path>
                        <path class="connection-line" d="M295,170 L400,170" stroke="url(#grad5)" stroke-width="2" fill="none" stroke-linecap="round">
                            <animate attributeName="stroke-dashoffset" from="105" to="0" dur="1.5s" fill="freeze" begin="1s"/>
                        </path>
                        
                        <!-- Curved Connections -->
                        <path class="connection-line" d="M70,95 Q70,120 70,145" stroke="url(#grad3)" stroke-width="2" fill="none" stroke-linecap="round">
                            <animate attributeName="stroke-dashoffset" from="50" to="0" dur="1s" fill="freeze" begin="0.5s"/>
                        </path>
                        <path class="connection-line" d="M425,95 Q425,120 425,145" stroke="url(#grad6)" stroke-width="2" fill="none" stroke-linecap="round">
                            <animate attributeName="stroke-dashoffset" from="50" to="0" dur="1s" fill="freeze" begin="0.7s"/>
                        </path>
                    </svg>
                    
                    <!-- Central GPS Icon -->
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-20">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-stripe-purple to-stripe-cyan flex items-center justify-center shadow-lg shadow-stripe-purple/30 animate-pulse">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Icons Grid 3x2 -->
                    <div class="grid grid-cols-3 gap-x-8 gap-y-12 relative z-10">
                        <!-- Row 1 -->
                        <!-- Alertas -->
                        <div class="feature-icon-wrapper group flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-green-500/20 to-green-400/10 border border-green-500/30 flex items-center justify-center mb-3 transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-green-500/20">
                                <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-300 group-hover:text-white transition-colors">Alertas</span>
                        </div>
                        
                        <!-- Cercas Virtuales -->
                        <div class="feature-icon-wrapper group flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-500/20 to-cyan-400/10 border border-cyan-500/30 flex items-center justify-center mb-3 transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-cyan-500/20">
                                <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-300 group-hover:text-white transition-colors">Cercas</span>
                        </div>
                        
                        <!-- Reportes -->
                        <div class="feature-icon-wrapper group flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500/20 to-purple-400/10 border border-purple-500/30 flex items-center justify-center mb-3 transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-purple-500/20">
                                <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-300 group-hover:text-white transition-colors">Reportes</span>
                        </div>
                        
                        <!-- Row 2 -->
                        <!-- Apagado Remoto -->
                        <div class="feature-icon-wrapper group flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-pink-500/20 to-pink-400/10 border border-pink-500/30 flex items-center justify-center mb-3 transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-pink-500/20">
                                <svg class="w-7 h-7 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a5 5 0 01-7.072-7.072m0 0l2.829 2.829M3 3l2.829 2.829"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-300 group-hover:text-white transition-colors">Apagado</span>
                        </div>
                        
                        <!-- Historial -->
                        <div class="feature-icon-wrapper group flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-red-500/20 to-red-400/10 border border-red-500/30 flex items-center justify-center mb-3 transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-red-500/20">
                                <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-300 group-hover:text-white transition-colors">Historial</span>
                        </div>
                        
                        <!-- Gestión de Flotas -->
                        <div class="feature-icon-wrapper group flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-yellow-500/20 to-yellow-400/10 border border-yellow-500/30 flex items-center justify-center mb-3 transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-yellow-500/20">
                                <svg class="w-7 h-7 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-300 group-hover:text-white transition-colors">Flotas</span>
                        </div>
                    </div>
                    
                    <!-- Animated Dots on Lines -->
                    <div class="absolute inset-0 pointer-events-none">
                        <div class="absolute w-2 h-2 bg-green-400 rounded-full shadow-lg shadow-green-400/50 animate-ping" style="left: 25%; top: 28%;"></div>
                        <div class="absolute w-2 h-2 bg-cyan-400 rounded-full shadow-lg shadow-cyan-400/50 animate-ping" style="left: 65%; top: 28%; animation-delay: 0.3s;"></div>
                        <div class="absolute w-2 h-2 bg-purple-400 rounded-full shadow-lg shadow-purple-400/50 animate-ping" style="left: 50%; top: 50%; animation-delay: 0.5s;"></div>
                        <div class="absolute w-2 h-2 bg-pink-400 rounded-full shadow-lg shadow-pink-400/50 animate-ping" style="left: 25%; top: 72%; animation-delay: 0.7s;"></div>
                        <div class="absolute w-2 h-2 bg-yellow-400 rounded-full shadow-lg shadow-yellow-400/50 animate-ping" style="left: 65%; top: 72%; animation-delay: 0.9s;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section id="testimonios" class="py-20 lg:py-32 bg-stripe-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Quote -->
            <blockquote class="relative">
                <svg class="absolute -top-8 -left-4 w-16 h-16 text-stripe-purple/10" fill="currentColor" viewBox="0 0 32 32">
                    <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/>
                </svg>
                <p class="text-2xl sm:text-3xl lg:text-4xl font-medium text-stripe-dark leading-relaxed mb-8">
                    Global System me ha dado la tranquilidad que necesitaba. Puedo monitorear mi flota de vehículos en tiempo real y el soporte técnico siempre está disponible cuando lo necesito.
                </p>
            </blockquote>
            
            <!-- Author -->
            <div class="flex items-center justify-center gap-4">
                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-stripe-purple to-stripe-cyan flex items-center justify-center text-white font-bold text-xl">
                    CM
                </div>
                <div class="text-left">
                    <p class="font-semibold text-stripe-dark">Carlos Mendoza</p>
                    <p class="text-sm text-stripe-gray">Gerente de Flota, TransportesVE</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Instagram Feed Section -->
<section id="instagram" class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-500 via-pink-500 to-orange-500 text-white text-sm font-semibold px-4 py-2 rounded-full mb-6">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
                @globalsystemgps
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-stripe-dark tracking-tight mb-4 text-balance">
                Síguenos en Instagram
            </h2>
            <p class="text-lg text-stripe-gray leading-relaxed">
                Mantente al día con nuestras últimas noticias, tips de seguridad vehicular y promociones exclusivas.
            </p>
        </div>

        <!-- Instagram Grid - Real Feed from Trustindex -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Post 1: DASHCAM (Slider) -->
            <a href="https://www.instagram.com/p/DQ4ZngKkVDM" target="_blank" rel="nofollow" class="group relative aspect-square bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition-all">
                <img alt="DASHCAM - Tecnología de monitoreo" src="/images/design-mode/0m.webp" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </div>
                </div>
                <div class="absolute top-2 left-2 bg-white/80 backdrop-blur px-2 py-1 rounded text-xs font-semibold text-stripe-dark">DASHCAM</div>
            </a>

            <!-- Post 2: Refrigerated Transport (Slider) -->
            <a href="https://www.instagram.com/p/DQrQY4EDdml" target="_blank" rel="nofollow" class="group relative aspect-square bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition-all">
                <img alt="Transporte refrigerado" src="/images/design-mode/0m.webp" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </div>
                </div>
                <div class="absolute top-2 left-2 bg-white/80 backdrop-blur px-2 py-1 rounded text-xs font-semibold text-stripe-dark">Refrigerado</div>
            </a>

            <!-- Post 3: Safety Case (Video) -->
            <a href="https://www.instagram.com/reel/DP9nr5Djz4X" target="_blank" rel="nofollow" class="group relative aspect-square bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition-all">
                <img alt="Caso de seguridad" src="/images/design-mode/0s.webp" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center">
                            <svg class="w-6 h-6 text-stripe-purple" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="absolute top-2 left-2 bg-white/80 backdrop-blur px-2 py-1 rounded text-xs font-semibold text-stripe-dark">📹 Seguridad</div>
            </a>

            <!-- Post 4: Logistics Efficiency -->
            <a href="https://www.instagram.com/p/DPzD5RojxGy" target="_blank" rel="nofollow" class="group relative aspect-square bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition-all">
                <img alt="Logística" src="/images/design-mode/0m.webp" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </div>
                </div>
                <div class="absolute top-2 left-2 bg-white/80 backdrop-blur px-2 py-1 rounded text-xs font-semibold text-stripe-dark">Logística</div>
            </a>

            <!-- Post 5: Fleet Control (Video) -->
            <a href="https://www.instagram.com/reel/DPhWDcBCgmI" target="_blank" rel="nofollow" class="group relative aspect-square bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition-all">
                <img alt="Control de flotas" src="/images/design-mode/0s.webp" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center">
                            <svg class="w-6 h-6 text-stripe-purple" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="absolute top-2 left-2 bg-white/80 backdrop-blur px-2 py-1 rounded text-xs font-semibold text-stripe-dark">📹 Flotas</div>
            </a>

            <!-- Post 6: Fuel Sensor (Video) -->
            <a href="https://www.instagram.com/reel/DOejxw2j2Ru" target="_blank" rel="nofollow" class="group relative aspect-square bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition-all">
                <img alt="Sensor de combustible" src="/images/design-mode/0s.webp" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center">
                            <svg class="w-6 h-6 text-stripe-purple" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="absolute top-2 left-2 bg-white/80 backdrop-blur px-2 py-1 rounded text-xs font-semibold text-stripe-dark">📹 Combustible</div>
            </a>
        </div>
        <!-- Follow Button -->
        <div class="text-center mt-12">
            <a href="https://instagram.com/globalsystemgps/" target="_blank" class="group inline-flex items-center justify-center gap-3 h-14 px-8 bg-gradient-to-r from-purple-500 via-pink-500 to-orange-500 hover:from-purple-600 hover:via-pink-600 hover:to-orange-600 text-white font-semibold rounded-full transition-all shadow-lg shadow-pink-500/30 hover:shadow-pink-500/50">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
                Seguir en Instagram
                <?php stripe_arrow_icon('white'); ?>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="contacto" class="py-20 lg:py-32 bg-stripe-light relative overflow-hidden">
    <!-- Background Gradients -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-stripe-purple/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-stripe-cyan/10 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center space-y-8">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-stripe-dark tracking-tight text-balance">
                Optimiza tu operación con Global System
            </h2>
            <p class="text-lg text-stripe-gray leading-relaxed">
                Únete a las empresas que confían en nuestra telemetría para análisis de datos críticos y control de unidades. Nos adaptamos a tus requerimientos específicos.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <div class="cta-button-wrapper">
                    <div class="cta-bg"></div>
                    <button 
                        type="button" 
                        onclick="openQuoteModal()"
                        class="group inline-flex items-center justify-center gap-2 h-12 px-8 text-white font-semibold rounded-full transition-all"
                    >
                        Solicitar cotización
                        <?php stripe_arrow_icon('white'); ?>
                    </button>
                </div>
                <a href="https://servei.globalsystemgps.com/login" target="_blank" class="group inline-flex items-center justify-center gap-2 h-12 px-8 bg-white/10 backdrop-blur border border-stripe-dark/20 hover:bg-white/20 text-stripe-dark font-semibold rounded-full transition-all">
                    Acceder a plataforma
                    <?php stripe_arrow_icon('#0a2540'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-stripe-dark text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-12">
            <!-- Productos -->
            <div>
                <h4 class="font-semibold text-white mb-4">Productos</h4>
                <ul class="space-y-3">
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Equipo GPS 3G/4G</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">GPS + Plataforma</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Plataforma de Monitoreo</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">App Móvil</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Accesorios</a></li>
                </ul>
            </div>
            
            <!-- Servicios -->
            <div>
                <h4 class="font-semibold text-white mb-4">Servicios</h4>
                <ul class="space-y-3">
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Rastreo GPS</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Gestión de Flotas</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Cercas Virtuales</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Apagado Remoto</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Reportes</a></li>
                </ul>
            </div>
            
            <!-- Desarrollo -->
            <div>
                <h4 class="font-semibold text-white mb-4">Desarrollo</h4>
                <ul class="space-y-3">
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Páginas Web</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Apps Móviles</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Plataformas</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Sistemas</a></li>
                    <li><a href="#productos-destacados" class="text-gray-400 hover:text-white transition-colors text-sm">Consultoría</a></li>
                </ul>
            </div>
            
            <!-- Empresa -->
            <div>
                <h4 class="font-semibold text-white mb-4">Empresa</h4>
                <ul class="space-y-3">
                    <li><a href="#nosotros" class="text-gray-400 hover:text-white transition-colors text-sm">Sobre Nosotros</a></li>
                    <li><a href="#testimonios" class="text-gray-400 hover:text-white transition-colors text-sm">Clientes</a></li>
                    <li><a href="#testimonios" class="text-gray-400 hover:text-white transition-colors text-sm">Testimonios</a></li>
                </ul>
            </div>
            
            <!-- Contacto -->
            <div>
                <h4 class="font-semibold text-white mb-4">Contacto</h4>
                <ul class="space-y-3">
                    <li><a href="#contacto" class="text-gray-400 hover:text-white transition-colors text-sm">Soporte 24/7</a></li>
                    <li><a href="https://wa.me/your-number" target="_blank" class="text-gray-400 hover:text-white transition-colors text-sm">WhatsApp</a></li>
                    <li><button onclick="openQuoteModal()" class="text-gray-400 hover:text-white transition-colors text-sm text-left">Cotizaciones</button></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Términos</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors text-sm">Privacidad</a></li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom -->
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex-shrink-0">
                    <?php 
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo_url = $custom_logo_id ? wp_get_attachment_image_src($custom_logo_id, 'full')[0] : '';
                    if ($logo_url): ?>
                        <img src="<?php echo esc_url($logo_url); ?>" class="h-8 w-auto grayscale brightness-200" alt="Global System">
                    <?php else: ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/src/img/imgi_1_GLOBAL-SYSTEM-1024x514-blanco-150x75.png' ); ?>" class="h-8 w-auto" alt="Global System">
                    <?php endif; ?>
                </a>
                <span class="text-sm text-gray-400">© 2026 Global System, C.A.</span>
            </div>
            
            <!-- Social Links -->
            <div class="flex items-center gap-4">
                <!-- Instagram -->
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <!-- Facebook -->
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <!-- WhatsApp -->
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- Quote Modal JavaScript -->
<script>
function openQuoteModal() {
    const modal = document.getElementById('quoteModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeQuoteModal() {
    const modal = document.getElementById('quoteModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

// Close on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeQuoteModal();
    }
});

// Close on click outside
document.getElementById('quoteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeQuoteModal();
    }
});

// Form submission
document.getElementById('quoteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form data
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    // Here you would send the data to your server
    console.log('Quote form submitted:', data);
    
    // Show success message
    alert('¡Gracias! Te contactaremos pronto.');
    closeQuoteModal();
    this.reset();
});
</script>
