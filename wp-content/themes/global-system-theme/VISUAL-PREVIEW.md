<!-- Guía Visual de la Página Principal -->

# Vista Previa de la Página Principal

## Estructura de la Página

```
┌─────────────────────────────────────────────────────────┐
│                     HEADER/NAVEGACIÓN                    │
│              (Mantiene el header estándar)               │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│            SECCIÓN HERO (Portada Principal)              │
│                                                          │
│  [Título en grande]                                     │
│  Rastreo GPS de precisión, simplificado                │
│  (simplificado = en color indigo)                       │
│                                                          │
│  [Párrafo descriptivo]                                  │
│  Monitorea tus activos en tiempo real...               │
│                                                          │
│  [Botón 1 Indigo]    [Botón 2 Outline]                │
│  Comenzar prueba     Ver demostración                  │
│                                                          │
│              [Imagen Dashboard (derecha)]              │
│                                                          │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│          SECCIÓN DE CARACTERÍSTICAS (Fondo gris)         │
│                                                          │
│  "Por qué elegir Global System GPS"                    │
│  Soluciones inteligentes para tu negocio               │
│                                                          │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐ │
│  │  Característica  │  │  Característica  │  │  Característica  │ │
│  │        1         │  │        2         │  │        3         │ │
│  └──────────────┘  └──────────────┘  └──────────────┘ │
│                                                          │
│  [Más características si las añades]                   │
│                                                          │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│      SECCIÓN CTA FINAL (Gradiente Indigo)              │
│                                                          │
│  "¿Listo para transformar tu flota?"                  │
│                                                          │
│  Obtén acceso a nuestra plataforma premium...          │
│                                                          │
│              [Botón Blanco] Comenzar ahora             │
│                                                          │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│                    FOOTER                               │
│              (Mantiene el footer estándar)               │
└─────────────────────────────────────────────────────────┘
```

## Cómo se edita en WordPress

### En el Editor de Páginas, verás 3 secciones nuevas:

1. **Sección Hero (Portada)**
   ```
   [ ] Imagen Hero                     [Seleccionar Imagen]
   
   [ ] Título Principal
       [Rastreo GPS de precisión, simplificado.]
   
   [ ] Parte Destacada del Título
       [simplificado.]
       (Esta palabra/frase aparecerá en color indigo)
   
   [ ] Descripción
       [Monitorea tus activos en tiempo real...]
   
   [ ] Botón Primario - Texto
       [Comenzar prueba gratuita]
   
   [ ] Botón Primario - URL
       [https://demo.example.com]
   
   [ ] Botón Secundario - Texto
       [Ver demostración en vivo]
   
   [ ] Botón Secundario - URL
       [https://video.example.com]
   ```

2. **Sección de Características**
   ```
   [ ] Título de la Sección
       [Por qué elegir Global System GPS]
   
   [ ] Subtítulo
       [Soluciones inteligentes para tu negocio]
   
   CARACTERÍSTICAS:
   ┌─────────────────────────────────────────┐
   │ Característica 1 - Título               │
   │ [Rastreo en Tiempo Real]                │
   │                                         │
   │ Característica 1 - Descripción          │
   │ [Monitoreo continuo de tu flota...]     │
   └─────────────────────────────────────────┘
   
   ┌─────────────────────────────────────────┐
   │ Característica 2 - Título               │
   │ [Seguridad Avanzada]                    │
   │                                         │
   │ Característica 2 - Descripción          │
   │ [Encriptación de datos...]              │
   └─────────────────────────────────────────┘
   
   ┌─────────────────────────────────────────┐
   │ Característica 3 - Título               │
   │ [Reportes Detallados]                   │
   │                                         │
   │ Característica 3 - Descripción          │
   │ [Análisis completo de rutas...]         │
   └─────────────────────────────────────────┘
   ```

3. **Llamada a la Acción Final**
   ```
   [ ] Título
       [¿Listo para transformar tu flota?]
   
   [ ] Subtítulo/Descripción
       [Obtén acceso a nuestra plataforma premium...]
   
   [ ] Texto del Botón
       [Comenzar ahora]
   
   [ ] URL del Botón
       [https://registro.example.com]
   ```

## Ejemplo de Contenido

### Sección Hero
- Título: "Rastreo GPS de precisión, simplificado."
- Destacado: "simplificado."
- Descripción: "Monitorea tus activos en tiempo real con tecnología de vanguardia. Seguridad, control y eficiencia para tu flota en una sola plataforma."
- Botón 1: "Comenzar prueba gratuita" → https://ubi.globalsystemgps.com/
- Botón 2: "Ver demostración en vivo" → https://demo.globalsystemgps.com/

### Características
1. **Rastreo en Tiempo Real** - "Monitorea tu flota con actualizaciones cada segundo"
2. **Seguridad Avanzada** - "Encriptación de datos y protección total"
3. **Reportes Detallados** - "Análisis completo de rutas y consumo"

### CTA Final
- Título: "¿Listo para transformar tu flota?"
- Descripción: "Únete a cientos de empresas que confían en Global System GPS"
- Botón: "Comenzar ahora" → https://registro.globalsystemgps.com

## Responsive Design

La página se adapta automáticamente a todos los dispositivos:

```
DESKTOP (1024px+)
├─ 2 columnas (Texto + Imagen lado a lado)
├─ Características en 3 columnas
└─ Tipografía grande

TABLET (768px - 1023px)
├─ 2 columnas (textos más pequeños)
├─ Características en 2-3 columnas
└─ Tipografía media

MÓVIL (< 768px)
├─ 1 columna (Stack vertical)
├─ Características en 1 columna
└─ Tipografía pequeña optimizada
└─ Botones a ancho completo
```

## Colores Utilizados

- **Primario (Indigo)**: #635BFF
- **Títulos (Azul Marino)**: #0A2540
- **Párrafos (Gris)**: #425466
- **Fondo Claro**: #F6F9FC
- **Bordes**: Gris claro (200)
- **Sombras**: Sutiles y suaves

## Performance

- ✅ Carga rápida (sin dependencias pesadas)
- ✅ Optimizado para SEO
- ✅ Imágenes responsivas
- ✅ CSS purificado por Tailwind
- ✅ Compatible con todos los navegadores modernos

---

**Nota**: Este diseño es totalmente customizable desde el panel de WordPress sin tocar código.
