# Guía de Uso - Página Principal Editable

## Descripción
Se ha añadido un nuevo template `front-page.php` que muestra una página principal moderna y completamente editable desde el panel de WordPress. El diseño está optimizado con Tailwind CSS y sigue el estilo propuesto.

## Características

### 1. Sección Hero (Portada)
- **Imagen**: Selector de imagen personalizada
- **Título Principal**: Texto editable con capacidad de destacar parte del texto en color indigo
- **Descripción**: Párrafo con información sobre los servicios
- **Botones CTA**: Dos botones con textos y URLs personalizables

### 2. Sección de Características
- **Título y Subtítulo**: Personalizables
- **3+ Características**: Cada una con:
  - Título de la característica
  - Descripción detallada

### 3. Sección de Llamada a la Acción Final
- **Título y Descripción**: Editables
- **Botón**: Texto y URL personalizables
- **Fondo**: Gradiente indigo atractivo

## Cómo Usar

### Paso 1: Asignar la Página Principal

1. Ve a **WordPress Admin** → **Ajustes** → **Lectura**
2. En "La página principal muestra", selecciona "Una página estática"
3. En "Página principal", elige la página que deseas usar (crea una nueva si es necesario)
4. Guarda los cambios

### Paso 2: Editar el Contenido

1. Ve a **Páginas** en el menú de WordPress
2. Abre la página asignada como página principal
3. Desplázate hacia abajo para ver los tres nuevos panels:
   - **Sección Hero (Portada)**
   - **Sección de Características**
   - **Llamada a la Acción Final**

### Paso 3: Personalizar Cada Sección

#### Sección Hero
- **Imagen Hero**: Haz clic en "Seleccionar Imagen" para subir una imagen
- **Título Principal**: Escribe el título completo (ej: "Rastreo GPS de precisión, simplificado.")
- **Parte Destacada**: Escribe la palabra que debe aparecer en color indigo (ej: "simplificado.")
- **Descripción**: Párrafo con información del servicio
- **Botón Primario**: Texto y URL (ej: "Comenzar prueba gratuita" → https://demo.example.com)
- **Botón Secundario**: Texto y URL (ej: "Ver demostración" → https://video.example.com)

#### Sección de Características
- **Título**: "Por qué elegir Global System GPS" (o el que prefieras)
- **Subtítulo**: "Soluciones inteligentes para tu negocio"
- **Características**: Llena los 3 campos con:
  - Título (ej: "Rastreo en Tiempo Real")
  - Descripción (ej: "Monitoreo continuo de tu flota...")

#### Sección CTA Final
- **Título**: "¿Listo para transformar tu flota?"
- **Subtítulo**: Descripción motivacional
- **Texto del Botón**: "Comenzar ahora"
- **URL del Botón**: Enlace a registro o contacto

## Personalización de Estilos

Los estilos se encuentran en:
- `resources/css/app.css`
- `tailwind.config.js`

### Colores principales:
- **Indigo (Primario)**: `#635BFF` o `indigo-600`
- **Azul Marino (Títulos)**: `#0A2540`
- **Gris (Párrafos)**: `#425466`
- **Fondo Claro**: `#F6F9FC`

### Para cambiar colores:
Edita `tailwind.config.js` y modifica la sección `theme.extend.colors`

## Tecnología

- **Template**: `front-page.php` (utiliza WordPress hooks y funciones estándar)
- **Campos Meta**: Almacenados en la base de datos de WordPress
- **Seguridad**: Todos los datos se escapan y validan correctamente
- **Responsive**: Diseño completamente adaptable a móvil, tablet y desktop
- **CSS Framework**: Tailwind CSS

## Archivos Modificados

1. **Nuevo**: `front-page.php` - Template principal editable
2. **Nuevo**: `inc/custom-front-page.php` - Registro de campos personalizados
3. **Modificado**: `functions.php` - Cargar el archivo de campos personalizados

## Soporte para ACF (Advanced Custom Fields)

El template está optimizado para trabajar también con ACF Pro si lo instalas en el futuro. Usa estos nombres de campos ACF:

- `hero_main_title` - Título principal
- `hero_title_highlight` - Palabra destacada
- `hero_description` - Descripción
- `hero_image` - Imagen hero
- `cta_primary_text` - Texto botón primario
- `cta_primary_link` - URL botón primario
- `cta_secondary_text` - Texto botón secundario
- `cta_secondary_link` - URL botón secundario
- `features_title` - Título características
- `features_subtitle` - Subtítulo características
- `features_list` - Array de características
- `cta_final_title` - Título CTA final
- `cta_final_subtitle` - Subtítulo CTA final
- `cta_final_text` - Texto botón final
- `cta_final_link` - URL botón final

## Notas Importantes

- ✅ Compatible con Tailpress
- ✅ Uso de funciones nativas de WordPress
- ✅ Seguridad incorporada (sanitización y escapado)
- ✅ Responsive y mobile-first
- ✅ Optimizado para SEO
- ✅ Fácil de personalizar

## Próximos Pasos

Para mejorar aún más la página:
1. Instala [ACF Pro](https://www.advancedcustomfields.com/pro/) para más campos
2. Agrega animaciones con AOS (Animate On Scroll)
3. Integra formularios con Contact Form 7 o WPForms
4. Añade testimonios de clientes
5. Configura Google Analytics

---

**Versión**: 1.0
**Última actualización**: 2024
**Tema**: Global System GPS (Tailpress)
