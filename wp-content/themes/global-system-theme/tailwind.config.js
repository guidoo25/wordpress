/** @type {import('tailwindcss').Config} */
module.exports = {
    // Escaneamos todos los PHP para detectar tus clases de Tailwind
    content: [
        './*.php',
        './inc/**/*.php',
        './templates/**/*.php',
        './template-parts/**/*.php',
        './resources/css/**/*.css',
        './resources/js/**/*.js',
        './safelist.txt'
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    indigo: '#635BFF', // El morado eléctrico icónico de Stripe
                    dark: '#0A2540',   // Azul marino profundo para títulos con autoridad
                    slate: '#425466',  // Gris suave para párrafos que no cansan la vista
                    light: '#F6F9FC',  // Fondo ultra limpio tipo SaaS
                    success: '#00D924', // Un verde tipo "GPS Online" estilo Coinbase
                }
            },
            fontFamily: {
                // Priorizamos Inter, la reina de las fuentes SaaS actuales
                sans: ['Inter', 'system-ui', 'sans-serif'],
            },
            // Estos añadidos son clave para el estilo que buscas:
            boxShadow: {
                'card': '0 2px 5px -1px rgba(50, 50, 93, 0.25), 0 1px 3px -1px rgba(0, 0, 0, 0.3)',
                'card-hover': '0 13px 27px -5px rgba(50, 50, 93, 0.25), 0 8px 16px -8px rgba(0, 0, 0, 0.3)',
                'stripe': '0 7px 14px 0 rgba(60, 66, 87, 0.1), 0 3px 6px 0 rgba(0, 0, 0, 0.07)',
            },
            borderRadius: {
                'xl': '0.75rem',
                '2xl': '1rem',
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
};