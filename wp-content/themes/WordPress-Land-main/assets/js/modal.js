/**
 * Quote Modal JavaScript
 * Global System GPS - WordPress Land Theme
 */

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

// Initialize modal event listeners when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeQuoteModal();
        }
    });

    // Close on click outside
    const modalOverlay = document.getElementById('quoteModal');
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                closeQuoteModal();
            }
        });
    }

    // Form submission
    const quoteForm = document.getElementById('quoteForm');
    if (quoteForm) {
        quoteForm.addEventListener('submit', function(e) {
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
    }
});
