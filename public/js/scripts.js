/**
 * SketchVibes - Scripts principales
 * Funcionalidad para modales, descargas y filtros de galería
 */

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    initImageModal();
    initCategoryFilters();
});

/**
 * Inicializar modal de imágenes
 */
function initImageModal() {
    const modalElement = document.getElementById('imageModal');
    if (!modalElement) return;

    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalCategory = document.getElementById('modalCategory');
    const modalDownloadBtn = document.getElementById('modalDownloadBtn');
    const modalEditBtn = document.getElementById('modalEditBtn');
    const modalDeleteBtn = document.getElementById('modalDeleteBtn');
    
    const images = document.querySelectorAll('.lightbox-trigger');
    
    images.forEach(img => {
        img.addEventListener('click', function() {
            const imageId = this.getAttribute('data-image-id');
            const imageSrc = this.getAttribute('data-image-src');
            const imageTitle = this.getAttribute('data-image-title');
            const imageDescription = this.getAttribute('data-image-description');
            const imageCategory = this.getAttribute('data-image-category');
            
            // Actualizar contenido del modal
            modalImage.src = imageSrc;
            modalImage.alt = imageTitle;
            modalTitle.textContent = imageTitle;
            modalDescription.textContent = imageDescription;
            modalCategory.textContent = imageCategory;
            
            // Actualizar enlaces
            modalDownloadBtn.href = "/download-image.php?id=" + imageId;
            
            if (modalEditBtn) {
                modalEditBtn.href = "/edit-image.php?id=" + imageId;
            }
            
            if (modalDeleteBtn) {
                modalDeleteBtn.onclick = function() {
                    if (confirm("¿Estás seguro de que quieres eliminar esta imagen?")) {
                        window.location.href = "/delete-image.php?id=" + imageId;
                    }
                };
            }
            
            // Mostrar modal usando Bootstrap
            const modal = new bootstrap.Modal(modalElement);
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
            
            // Filtrar elementos con animación suave
            galleryItems.forEach(item => {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    item.classList.remove('d-none');
                } else {
                    item.classList.add('d-none');
                }
            });
        });
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
