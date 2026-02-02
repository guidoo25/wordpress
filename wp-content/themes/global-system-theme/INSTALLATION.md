# Instalación Rápida - Página Principal Editable

## ✅ Archivos Instalados

Se han añadido los siguientes archivos a tu tema:

```
global-system-theme/
├── front-page.php                    [NUEVO] Template principal
├── inc/
│   └── custom-front-page.php         [NUEVO] Campos personalizados
├── functions.php                     [MODIFICADO] Carga de campos
├── FRONT-PAGE-SETUP.md               [NUEVO] Documentación completa
└── VISUAL-PREVIEW.md                 [NUEVO] Vista previa del diseño
```

## 🚀 Pasos para Activar

### 1. Crear/Configurar la Página Principal en WordPress

1. Ve a **WordPress Admin**
2. **Páginas** → **Añadir Nueva**
3. Escribe el título: `Inicio` o `Home` (lo que prefieras)
4. **Guardar**
5. Copia el ID de la página (lo ves en la URL o en la barra de Páginas)

### 2. Asignar como Página Principal

1. Ve a **Ajustes** → **Lectura**
2. Busca "La página principal muestra"
3. Selecciona **"Una página estática"**
4. En **"Página principal"**, selecciona la página que creaste
5. **Guardar cambios**

### 3. Editar el Contenido

1. Ve a **Páginas** → abre tu página principal
2. Desplázate hacia abajo del editor
3. Verás 3 nuevas secciones editables:

   ✏️ **Sección Hero (Portada)**
   - Imagen personalizada
   - Título y destacado
   - Descripción
   - 2 Botones de acción

   ✏️ **Sección de Características**
   - Título y subtítulo
   - 3+ características con título y descripción

   ✏️ **Llamada a la Acción Final**
   - Título y descripción
   - Botón personalizado

4. **Publica** los cambios

## 📋 Contenido Sugerido

### Hero Section
```
Título: Rastreo GPS de precisión, simplificado.
Destacado: simplificado.
Descripción: Monitorea tus activos en tiempo real con tecnología de vanguardia. Seguridad, control y eficiencia para tu flota en una sola plataforma.

Botón 1:
  Texto: Comenzar prueba gratuita
  URL: https://ubi.globalsystemgps.com/

Botón 2:
  Texto: Ver demostración en vivo
  URL: https://demo.globalsystemgps.com/
```

### Features Section
```
Título: Por qué elegir Global System GPS
Subtítulo: Soluciones inteligentes para tu negocio

Característica 1:
  Título: Rastreo en Tiempo Real
  Descripción: Monitorea tu flota con actualizaciones cada segundo

Característica 2:
  Título: Seguridad Avanzada
  Descripción: Encriptación de datos y protección total de tu información

Característica 3:
  Título: Reportes Detallados
  Descripción: Análisis completo de rutas, tiempos y consumo de combustible
```

### CTA Section
```
Título: ¿Listo para transformar tu flota?
Descripción: Únete a cientos de empresas que confían en Global System GPS
Texto Botón: Comenzar ahora
URL: https://registro.globalsystemgps.com/
```

## 🎨 Personalización de Colores

Si quieres cambiar los colores (indigo, azul marino, etc.):

1. Abre `tailwind.config.js`
2. Busca la sección `theme.extend.colors`
3. Modifica los valores HEX según necesites

Ejemplo:
```javascript
colors: {
    brand: {
        indigo: '#635BFF',  // Color principal - Cámbialo aquí
        dark: '#0A2540',    // Títulos
        slate: '#425466',   // Párrafos
        light: '#F6F9FC',   // Fondo
    }
}
```

4. Compila el CSS (si usas Vite/Webpack)

## 🔍 Verificación

Para asegurarte de que todo funciona:

1. ✅ La página principal carga sin errores
2. ✅ Los campos editables aparecen en el panel de Páginas
3. ✅ Se guarda el contenido al publicar
4. ✅ El diseño se ve bien en móvil, tablet y desktop
5. ✅ Los botones enlazan a las URLs correctas

## 📱 Testing Responsivo

Prueba tu página en:
- ✔️ Desktop (1920px+)
- ✔️ Tablet (768px - 1024px)
- ✔️ Móvil (< 768px)

Usa DevTools de Chrome para probar (F12 → Modo responsivo)

## 🆘 Solución de Problemas

### Los campos no aparecen
- Vacía la caché del navegador (Ctrl+Shift+Delete)
- Verifica que `functions.php` incluya: `require_once __DIR__ . '/inc/custom-front-page.php';`
- Recarga la página de edición

### Los estilos no se aplican
- Asegúrate de que Tailwind CSS está compilado
- Ejecuta: `npm run dev` (si usas Vite)
- Vacía la caché de WordPress

### Las imágenes no se cargan
- Verifica que tienes permiso para subir archivos
- Comprueba el límite de tamaño de archivo en php.ini
- Usa imágenes menores a 5MB

## 📚 Documentación

Para más detalles, lee:
- [FRONT-PAGE-SETUP.md](./FRONT-PAGE-SETUP.md) - Guía completa
- [VISUAL-PREVIEW.md](./VISUAL-PREVIEW.md) - Vista previa visual

## ✨ Características Principales

✅ **Editable sin código** - Panel visual en WordPress
✅ **Totalmente responsive** - Funciona en todos los dispositivos
✅ **SEO optimizado** - Estructura semántica correcta
✅ **Alto rendimiento** - Sin dependencias pesadas
✅ **Seguro** - Sanitización y escapado correcto
✅ **Compatible ACF** - Funciona con Advanced Custom Fields
✅ **Meta Box nativo** - Sin plugins requeridos
✅ **Tailwind CSS** - Estilos modernos y limpios

## 🎯 Próximos Pasos

1. **Instala ACF Pro** (opcional) para más opciones
2. **Agrega analytics** - Google Analytics, GTM
3. **Configura formularios** - Contact Form 7, WPForms
4. **Añade testimonios** - Seção de clientes
5. **Integra chat** - Zendesk, Intercom, etc.

---

**Instalación completada exitosamente** ✅

Si tienes dudas, revisa la documentación en FRONT-PAGE-SETUP.md
