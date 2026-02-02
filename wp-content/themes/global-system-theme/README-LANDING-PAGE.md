# 🚀 Landing Page Editable - Global System Theme

## 📋 Descripción

Sistema de landing page completamente editable usando bloques de Gutenberg personalizados. Todo el contenido se puede editar visualmente desde WordPress sin necesidad de tocar código.

## ✨ Características

- ✅ **100% Editable**: Todo el contenido se edita desde el editor de WordPress
- ✅ **Diseño Moderno**: Basado en la imagen de referencia con Tailwind CSS
- ✅ **Bloques Personalizados**: 3 bloques reutilizables para crear landing pages
- ✅ **Responsive**: Se adapta a todos los dispositivos
- ✅ **Sin Código**: No necesitas saber programar para editar el contenido

---

## 🔧 Requisitos Previos

### 1. Instalar Plugin ACF (Advanced Custom Fields)

Este sistema requiere el plugin **Advanced Custom Fields** (versión gratuita es suficiente).

**Instalación:**
1. Ve a `WordPress Admin → Plugins → Añadir nuevo`
2. Busca "Advanced Custom Fields"
3. Instala y activa el plugin

**O descarga manualmente:**
- URL: https://wordpress.org/plugins/advanced-custom-fields/

---

## 📝 Cómo Crear una Landing Page

### Paso 1: Crear Nueva Página

1. Ve a `WordPress Admin → Páginas → Añadir nueva`
2. Ponle un nombre a tu página (ej: "Home", "Landing GPS", etc.)
3. En el panel derecho, en **Atributos de página**, selecciona:
   - **Plantilla**: `Landing Page - Bloques Editables`

### Paso 2: Agregar Bloques

En el editor de contenido, haz clic en el botón `+` para agregar bloques.

Verás una nueva categoría llamada **"Global System Landing"** con 3 bloques disponibles:

#### 🎯 Bloque 1: Hero Section GPS
**Qué es**: La sección principal de la página (arriba de todo)

**Campos editables**:
- ✏️ Pre-título (ej: "¡GPS+ rastreó!")
- ✏️ Título Principal (grande y destacado)
- ✏️ Descripción (texto explicativo)
- ✏️ Texto del botón (ej: "Agendar demo")
- ✏️ Enlace del botón (URL a donde lleva)
- 🖼️ Imagen principal (captura del dashboard)

**Diseño**: Fondo azul oscuro con degradado, texto blanco, imagen a la derecha

---

#### ⭐ Bloque 2: Beneficios Clave
**Qué es**: Grid de 3 columnas mostrando características principales

**Campos editables**:
- ✏️ Título de la sección
- 📋 3 Items (cada uno con):
  - Icono (selecciona de una lista)
  - Título del beneficio
  - Descripción

**Iconos disponibles**:
- ✅ Check Circle
- 🛡️ Escudo
- ⏰ Reloj
- 📍 Ubicación
- 📊 Gráfico
- 👥 Usuarios

**Diseño**: Fondo blanco, 3 tarjetas con iconos azules

---

#### 📦 Bloque 3: Productos y Servicios
**Qué es**: Sección con imagen y descripción (puede repetirse)

**Campos editables**:
- ✏️ Pre-título pequeño (ej: "Prihlizovanie")
- ✏️ Título principal
- ✏️ Descripción (editor de texto rico)
- ✏️ Texto del botón
- ✏️ Enlace del botón
- 🖼️ Imagen del producto
- 🔄 Invertir diseño (imagen izquierda/derecha)

**Diseño**: Dos columnas, imagen en un lado, texto en el otro

---

### Paso 3: Organizar los Bloques

**Orden recomendado**:
1. Hero Section GPS (arriba)
2. Beneficios Clave
3. Productos y Servicios (puedes agregar varios)

**Puedes agregar más bloques de "Productos y Servicios" para mostrar múltiples servicios**

---

## 🎨 Ejemplo de Estructura Completa

```
┌─────────────────────────────────────┐
│   HERO SECTION GPS                  │
│   (Fondo azul, título grande)       │
└─────────────────────────────────────┘
┌─────────────────────────────────────┐
│   BENEFICIOS CLAVE                  │
│   [Icon] [Icon] [Icon]              │
│   Título  Título  Título            │
└─────────────────────────────────────┘
┌─────────────────────────────────────┐
│   PRODUCTOS - Producto 1            │
│   [Imagen] | Descripción            │
└─────────────────────────────────────┘
┌─────────────────────────────────────┐
│   PRODUCTOS - Producto 2            │
│   Descripción | [Imagen]            │
└─────────────────────────────────────┘
```

---

## 💡 Consejos de Uso

### Títulos Efectivos
- **Hero**: Hazlo impactante y claro (5-8 palabras)
- **Beneficios**: Concretos y orientados al valor
- **Productos**: Descriptivos del servicio

### Imágenes Recomendadas
- **Hero**: 800x600px mínimo (capturas del dashboard)
- **Productos**: 600x400px mínimo
- Formato: JPG o PNG
- Peso: Máximo 500KB (optimizar antes de subir)

### Textos
- **Descripción Hero**: 1-2 líneas máximo
- **Beneficios**: 2-3 líneas por beneficio
- **Productos**: 3-5 líneas de descripción

---

## 🔄 Editar Contenido Existente

1. Ve a `WordPress Admin → Páginas`
2. Encuentra tu página y haz clic en `Editar`
3. Haz clic en cualquier bloque para editarlo
4. Los cambios aparecerán en el panel derecho
5. Haz clic en `Actualizar` para guardar

---

## 🎯 Configurar como Página de Inicio

Para que tu landing page sea la página principal del sitio:

1. Ve a `WordPress Admin → Ajustes → Lectura`
2. En "Tu página de inicio muestra", selecciona: **Una página estática**
3. Selecciona tu landing page en el desplegable
4. Guarda los cambios

---

## 🖼️ Gestión de Imágenes

### Subir Imágenes
1. Haz clic en el campo de imagen del bloque
2. Botón `Subir archivos` o `Biblioteca de medios`
3. Selecciona tu imagen
4. Haz clic en `Seleccionar`

### Optimizar Imágenes
Usa herramientas online gratuitas antes de subir:
- TinyPNG: https://tinypng.com/
- Squoosh: https://squoosh.app/

---

## 🎨 Personalización de Colores

Los colores principales están en Tailwind CSS:

- **Azul primario**: `bg-blue-600`, `bg-blue-900`
- **Fondo claro**: `bg-gray-50`
- **Texto oscuro**: `text-gray-900`

Para cambiar colores, edita: `tailwind.config.js`

---

## 🐛 Solución de Problemas

### No veo los bloques en el editor
**Solución**: 
- Verifica que ACF esté instalado y activado
- Ve a `Apariencia → Editor` y limpia la caché

### Los estilos no se ven
**Solución**:
- Ejecuta `npm run build` en la carpeta del tema
- Verifica que Tailwind esté compilado

### Las imágenes no se cargan
**Solución**:
- Verifica permisos de la carpeta `wp-content/uploads`
- Aumenta el límite de subida en `php.ini`

---

## 📞 Estructura de Archivos

```
wp-content/themes/global-system-theme/
├── template-landing.php              ← Template principal
├── inc/
│   └── custom-blocks.php             ← Registro de bloques ACF
├── template-parts/
│   └── blocks/
│       ├── hero.php                  ← Bloque Hero
│       ├── benefits.php              ← Bloque Beneficios
│       └── products.php              ← Bloque Productos
└── resources/
    └── css/
        └── blocks.css                ← Estilos de bloques
```

---

## ✅ Checklist de Creación

- [ ] Plugin ACF instalado y activado
- [ ] Página creada con template "Landing Page - Bloques Editables"
- [ ] Bloque Hero agregado y configurado
- [ ] Bloque Beneficios agregado (3 items)
- [ ] Bloque(s) Productos agregado(s)
- [ ] Imágenes optimizadas y subidas
- [ ] Textos revisados sin errores
- [ ] Enlaces de botones configurados
- [ ] Vista previa revisada en móvil y desktop
- [ ] Página publicada

---

## 🚀 Próximos Pasos

Una vez creada tu landing page, considera:

1. **SEO**: Instalar Yoast SEO y optimizar meta descripciones
2. **Analytics**: Conectar Google Analytics
3. **Formularios**: Agregar Contact Form 7 para captación
4. **Velocidad**: Optimizar con WP Rocket o similar

---

¿Necesitas ayuda? Revisa los bloques de ejemplo o contacta al equipo de desarrollo.

**Última actualización**: Enero 2026
