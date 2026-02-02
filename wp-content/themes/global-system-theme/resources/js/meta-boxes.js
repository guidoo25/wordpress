/**
 * Manejo de Media Uploads en Meta Boxes
 */

(function($) {
    'use strict';

    // Upload de imagen Hero
    $(document).on('click', '.gs-media-upload', function(e) {
        e.preventDefault();
        
        const targetId = $(this).data('target');
        const frame = wp.media({
            title: 'Selecciona una imagen',
            button: { text: 'Usar esta imagen' },
            multiple: false
        });

        frame.on('select', function() {
            const attachment = frame.state().get('selection').first().toJSON();
            $('#' + targetId).val(attachment.id);
            
            // Mostrar preview
            const preview = $('#gs_hero_image_preview');
            preview.html('<img src="' + attachment.url + '" style="max-width: 300px; height: auto;">');
        });

        frame.open();
    });

    // Upload de imágenes de productos
    $(document).on('click', '.gs-product-media-upload', function(e) {
        e.preventDefault();
        
        const index = $(this).data('index');
        const frame = wp.media({
            title: 'Selecciona una imagen para el producto',
            button: { text: 'Usar esta imagen' },
            multiple: false
        });

        frame.on('select', function() {
            const attachment = frame.state().get('selection').first().toJSON();
            $('input[name="gs_products[' + index + '][image_id]"]').val(attachment.id);
            
            // Mostrar preview
            const preview = $(this).closest('.gs-product-item').find('.product-image-preview');
            preview.html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;">');
        }.bind(this));

        frame.open();
    });

    // Upload de múltiples imágenes para galería
    $(document).on('click', '.gs-media-gallery-upload', function(e) {
        e.preventDefault();
        
        const frame = wp.media({
            title: 'Selecciona imágenes para la galería',
            button: { text: 'Usar estas imágenes' },
            multiple: true
        });

        frame.on('select', function() {
            const attachments = frame.state().get('selection').toJSON();
            const imageIds = [];
            let previewHtml = '';

            attachments.forEach(function(attachment) {
                imageIds.push(attachment.id);
                previewHtml += '<div style="position: relative; overflow: hidden; border-radius: 4px;">' +
                    '<img src="' + attachment.url + '" style="width: 100%; height: 150px; object-fit: cover;">' +
                    '<button type="button" class="gs-remove-gallery-image button-link" data-image-id="' + attachment.id + '" ' +
                    'style="position: absolute; top: 5px; right: 5px; background: #c23030; color: white; border-radius: 50%; width: 30px; height: 30px; border: none; cursor: pointer;">✕</button>' +
                    '</div>';
            });

            const currentImages = $('#gs_gallery_images').val();
            const currentIds = currentImages ? currentImages.split(',') : [];
            const allIds = currentIds.concat(imageIds);
            
            $('#gs_gallery_images').val(allIds.join(','));
            $('#gs_gallery_preview').html(previewHtml);
        });

        frame.open();
    });

    // Remover imagen de galería
    $(document).on('click', '.gs-remove-gallery-image', function(e) {
        e.preventDefault();
        
        const imageId = $(this).data('image-id');
        const currentImages = $('#gs_gallery_images').val();
        const imageIds = currentImages ? currentImages.split(',') : [];
        const filteredIds = imageIds.filter(id => id != imageId);
        
        $('#gs_gallery_images').val(filteredIds.join(','));
        $(this).closest('div').remove();
    });

})(jQuery);
