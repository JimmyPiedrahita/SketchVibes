/**
 * SketchVibes - Scripts principales
 * Funcionalidad para modales, descargas y filtros de galería
 */

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    initImageModal();
    initCategoryFilters();
    initDownloadButtons();
});

/**
 * Inicializar modal de imágenes
 */
function initImageModal() {
    const modal = document.getElementById('imageModal');
    if (!modal) return;

    const modalImage = document.getElementById('modal-image');
    const images = document.querySelectorAll('.gallery-image');
    
    images.forEach(img => {
        img.addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modalImage.src = this.src;
            modalImage.alt = this.alt;
            modal.show();
        });
    });
}

/**
 * Inicializar filtros de categoría
 */
function initCategoryFilters() {
    const filterButtons = document.querySelectorAll('[data-filter]');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Actualizar botones activos
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filtrar elementos
            galleryItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
}

/**
 * Inicializar botones de descarga
 */
function initDownloadButtons() {
    const downloadButtons = document.querySelectorAll('.download-btn');
    
    downloadButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const imageId = this.getAttribute('data-image-id');
            downloadImage(imageId);
        });
    });
}

/**
 * Descargar imagen
 */
function downloadImage(imageId) {
    fetch('/SketchVibes/public/download-image.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id_imagen=' + encodeURIComponent(imageId)
    })
    .then(response => {
        if (response.ok) {
            return response.blob();
        }
        throw new Error('Error al descargar la imagen');
    })
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = 'imagen_' + imageId + '.jpg';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al descargar la imagen');
    });
}

/**
 * Mostrar mensajes de alerta
 */
function showAlert(message, type = 'info') {
    const alertContainer = document.getElementById('alert-container');
    if (!alertContainer) return;
    
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show`;
    alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    alertContainer.appendChild(alert);
    
    // Auto-remover después de 5 segundos
    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 5000);
}
