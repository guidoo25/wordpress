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
        // Quote modal
        closeQuoteModal();
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

// Cerrar modal de cotización al hacer clic fuera
document.getElementById('quoteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeQuoteModal();
    }
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

// Función para abrir modal de cotización con tipo de vehículo
function openQuoteModal(vehicleType) {
    // Mapear tipos de vehículo a nombres legibles
    var vehicleNames = {
        'truck': 'Camiones',
        'car': 'Carros',
        'motorcycle': 'Motos',
        'trailer': 'Remolques',
        'container': 'Contenedores',
        'bus': 'Buses',
        'machinery': 'Maquinaria'
    };

    var vehicleName = vehicleNames[vehicleType] || 'Vehículo';

    // Mostrar mensaje temporal
    showVehicleSelectionMessage(vehicleName);

    // Abrir modal de cotización después de un breve delay
    setTimeout(function() {
        var modal = document.getElementById('quoteModal');
        if (modal) {
            document.body.style.overflow = 'hidden';
            modal.classList.add('active');

            // Pre-seleccionar el tipo de vehículo en el formulario
            setTimeout(function() {
                var select = document.getElementById('quote_vehicle');
                if (select) {
                    // Mapear a los valores del select
                    var selectValues = {
                        'truck': 'truck',
                        'car': 'sedan',
                        'motorcycle': 'motorcycle',
                        'trailer': 'truck', // Remolques como camión
                        'container': 'truck', // Contenedores como camión
                        'bus': 'bus',
                        'machinery': 'truck' // Maquinaria como camión
                    };
                    select.value = selectValues[vehicleType] || 'other';
                }
            }, 300);
        }
    }, 800);
}

// Función para mostrar mensaje de selección de vehículo
function showVehicleSelectionMessage(vehicleName) {
    // Crear elemento de mensaje
    var messageDiv = document.createElement('div');
    messageDiv.id = 'vehicle-selection-message';
    messageDiv.innerHTML = `
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-[10000] bg-gradient-to-r from-stripe-purple to-stripe-cyan text-white px-6 py-3 rounded-full shadow-lg border border-white/20 animate-bounce">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span class="font-semibold">Has seleccionado: ${vehicleName}</span>
            </div>
        </div>
    `;

    // Agregar al body
    document.body.appendChild(messageDiv);

    // Remover después de 2 segundos
    setTimeout(function() {
        if (messageDiv.parentNode) {
            messageDiv.parentNode.removeChild(messageDiv);
        }
    }, 2000);
}

// Función para cerrar modal de cotización
function closeQuoteModal() {
    var modal = document.getElementById('quoteModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}
