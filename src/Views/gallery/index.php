<?php
$title = 'Galería - SketchVibes';
$bodyClass = 'gallery-page';
$showNavbar = true;

ob_start();
?>

<div class="gallery-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="mb-2">Galería de Arte</h1>
                <p class="lead text-muted">Explora nuestra colección de dibujos únicos</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <?php if (SessionHelper::isAdmin()): ?>
                    <a href="/SketchVibes/public/add-image.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Imagen
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Filtros por categoría -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="filter-buttons">
                <button class="btn btn-outline-primary active" data-filter="all">Todas</button>
                <?php foreach ($categories as $category): ?>
                    <button class="btn btn-outline-primary" data-filter="<?= $category['id_categoria'] ?>">
                        <?= ucfirst($category['nombre']) ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <!-- Galería de imágenes -->
    <div class="row" id="gallery-grid">
        <?php if (empty($images)): ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-image fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No hay imágenes disponibles</h4>
                <?php if (SessionHelper::isAdmin()): ?>
                    <p class="text-muted">¡Sé el primero en agregar una imagen!</p>
                    <a href="/SketchVibes/public/add-image.php" class="btn btn-primary">Agregar Imagen</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <?php foreach ($images as $image): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 gallery-item" data-category="<?= $image['id_categoria'] ?>">
                    <div class="gallery-card">
                        <div class="image-container">
                            <img src="/SketchVibes/public/show-image.php?id=<?= $image['id_imagen'] ?>" 
                                 alt="<?= htmlspecialchars($image['titulo'] ?? 'Imagen') ?>" 
                                 class="gallery-image lightbox-trigger"
                                 data-image-id="<?= $image['id_imagen'] ?>"
                                 data-image-src="/SketchVibes/public/show-image.php?id=<?= $image['id_imagen'] ?>"
                                 data-image-title="<?= htmlspecialchars($image['titulo'] ?? 'Sin título') ?>"
                                 data-image-description="<?= htmlspecialchars($image['descripcion'] ?? 'Sin descripción') ?>"
                                 data-image-category="<?= htmlspecialchars($image['categoria_nombre'] ?? 'Sin categoría') ?>">
                            <div class="image-overlay">
                                <div class="overlay-content">
                                    <h6 class="image-title"><?= htmlspecialchars($image['titulo'] ?? 'Sin título') ?></h6>
                                    <span class="image-category"><?= htmlspecialchars($image['categoria_nombre'] ?? 'Sin categoría') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Lightbox personalizado para mostrar imagen ampliada -->
<div class="lightbox-overlay" id="lightboxOverlay">
    <div class="lightbox-container">
        <button class="lightbox-close" id="lightboxClose">
            <i class="fas fa-times"></i>
        </button>
        <div class="lightbox-content">
            <div class="lightbox-image-container">
                <img id="lightboxImage" src="" alt="" class="lightbox-image">
            </div>
            <div class="lightbox-info">
                <h3 id="lightboxTitle">Título de la imagen</h3>
                <p id="lightboxDescription" class="lightbox-description">Descripción de la imagen</p>
                <p class="lightbox-category">
                    <strong>Categoría:</strong> <span id="lightboxCategory"></span>
                </p>
                <div class="lightbox-actions">
                    <a id="lightboxDownloadBtn" href="#" class="btn btn-success">
                        <i class="fas fa-download"></i> Descargar
                    </a>
                    <?php if (SessionHelper::isAdmin()): ?>
                        <a id="lightboxEditBtn" href="#" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <button id="lightboxDeleteBtn" type="button" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$additionalCSS = '
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.gallery-page {
    background-color: #f8f9fa;
}

.gallery-header {
    background: white;
    border-bottom: 1px solid #dee2e6;
    padding: 2rem 0;
    margin-bottom: 2rem;
}

.filter-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
}

.filter-buttons .btn {
    border-radius: 25px;
}

.filter-buttons .btn.active {
    background-color: #667eea;
    border-color: #667eea;
    color: white;
}

.gallery-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 300px;
}

.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.image-container {
    position: relative;
    height: 100%;
    overflow: hidden;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.gallery-image:hover {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
    padding: 1rem;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.gallery-card:hover .image-overlay {
    transform: translateY(0);
}

.image-title {
    margin: 0;
    font-weight: 600;
}

.image-category {
    font-size: 0.875rem;
    opacity: 0.9;
}

.gallery-item {
    transition: opacity 0.3s ease;
}

.gallery-item.hidden {
    opacity: 0;
    pointer-events: none;
}

/* Lightbox personalizado */
.lightbox-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.lightbox-overlay.active {
    opacity: 1;
    visibility: visible;
}

.lightbox-container {
    position: relative;
    max-width: 95vw;
    max-height: 95vh;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    transform: scale(0.8);
    transition: transform 0.3s ease;
}

.lightbox-overlay.active .lightbox-container {
    transform: scale(1);
}

.lightbox-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.lightbox-close:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

.lightbox-content {
    display: flex;
    flex-direction: row;
    min-height: 400px;
    max-height: 90vh;
}

.lightbox-image-container {
    flex: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    min-height: 400px;
}

.lightbox-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 10px;
}

.lightbox-info {
    flex: 1;
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-width: 300px;
    background: white;
}

.lightbox-info h3 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 1.5rem;
    font-weight: 600;
}

.lightbox-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
    flex-grow: 1;
}

.lightbox-category {
    color: #888;
    margin-bottom: 25px;
    font-size: 0.95rem;
}

.lightbox-category strong {
    color: #333;
}

.lightbox-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.lightbox-actions .btn {
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}

.lightbox-actions .btn-success {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
}

.lightbox-actions .btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
}

.lightbox-actions .btn-warning {
    background: linear-gradient(45deg, #ffc107, #fd7e14);
    color: white;
}

.lightbox-actions .btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
}

.lightbox-actions .btn-danger {
    background: linear-gradient(45deg, #dc3545, #e83e8c);
    color: white;
}

.lightbox-actions .btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
}

/* Responsive */
@media (max-width: 768px) {
    .filter-buttons {
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }
    
    .gallery-card {
        height: 250px;
    }
    
    .lightbox-content {
        flex-direction: column;
        max-height: 95vh;
        overflow-y: auto;
    }
    
    .lightbox-image-container {
        min-height: 250px;
        flex: none;
    }
    
    .lightbox-info {
        min-width: auto;
        padding: 20px;
        flex: none;
    }
    
    .lightbox-container {
        max-width: 98vw;
        max-height: 98vh;
        margin: 10px;
    }
    
    .lightbox-actions {
        justify-content: center;
    }
    
    .lightbox-actions .btn {
        flex: 1;
        justify-content: center;
        min-width: 120px;
    }
}

@media (max-width: 576px) {
    .lightbox-actions {
        flex-direction: column;
    }
    
    .lightbox-actions .btn {
        width: 100%;
    }
}

.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.image-container {
    position: relative;
    height: 100%;
    overflow: hidden;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.gallery-image:hover {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
    padding: 1rem;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.gallery-card:hover .image-overlay {
    transform: translateY(0);
}

.image-title {
    margin: 0;
    font-weight: 600;
}

.image-category {
    font-size: 0.875rem;
    opacity: 0.9;
}

.modal-dialog {
    max-width: 800px;
}

#modalImage {
    max-height: 500px;
    object-fit: contain;
}

.gallery-item {
    transition: opacity 0.3s ease;
}

.gallery-item.hidden {
    opacity: 0;
    pointer-events: none;
}

@media (max-width: 768px) {
    .filter-buttons {
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }
    
    .gallery-card {
        height: 250px;
    }
}
</style>
';

$additionalJS = '
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Filtros de categoría
    const filterButtons = document.querySelectorAll(".filter-buttons .btn");
    const galleryItems = document.querySelectorAll(".gallery-item");
    
    filterButtons.forEach(button => {
        button.addEventListener("click", function() {
            const filter = this.getAttribute("data-filter");
            
            // Actualizar botones activos
            filterButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            
            // Filtrar elementos
            galleryItems.forEach(item => {
                const category = item.getAttribute("data-category");
                if (filter === "all" || category === filter) {
                    item.style.display = "block";
                    setTimeout(() => item.classList.remove("hidden"), 10);
                } else {
                    item.classList.add("hidden");
                    setTimeout(() => item.style.display = "none", 300);
                }
            });
        });
    });
    
    // Lightbox personalizado
    const lightboxOverlay = document.getElementById("lightboxOverlay");
    const lightboxClose = document.getElementById("lightboxClose");
    const lightboxImage = document.getElementById("lightboxImage");
    const lightboxTitle = document.getElementById("lightboxTitle");
    const lightboxDescription = document.getElementById("lightboxDescription");
    const lightboxCategory = document.getElementById("lightboxCategory");
    const lightboxDownloadBtn = document.getElementById("lightboxDownloadBtn");
    
    // Obtener elementos admin si existen
    const lightboxEditBtn = document.getElementById("lightboxEditBtn");
    const lightboxDeleteBtn = document.getElementById("lightboxDeleteBtn");
    
    // Abrir lightbox al hacer clic en imagen
    document.querySelectorAll(".lightbox-trigger").forEach(img => {
        img.addEventListener("click", function() {
            const imageId = this.getAttribute("data-image-id");
            const imageSrc = this.getAttribute("data-image-src");
            const imageTitle = this.getAttribute("data-image-title");
            const imageDescription = this.getAttribute("data-image-description");
            const imageCategory = this.getAttribute("data-image-category");
            
            // Actualizar contenido del lightbox
            lightboxImage.src = imageSrc;
            lightboxImage.alt = imageTitle;
            lightboxTitle.textContent = imageTitle;
            lightboxDescription.textContent = imageDescription;
            lightboxCategory.textContent = imageCategory;
            
            // Actualizar enlaces
            lightboxDownloadBtn.href = "/SketchVibes/public/download-image.php?id=" + imageId;
            
            // Actualizar enlaces de admin si existen
            if (lightboxEditBtn) {
                lightboxEditBtn.href = "/SketchVibes/public/edit-image.php?id=" + imageId;
            }
            
            if (lightboxDeleteBtn) {
                lightboxDeleteBtn.onclick = function() {
                    if (confirm("¿Estás seguro de que quieres eliminar esta imagen?")) {
                        window.location.href = "/SketchVibes/public/delete-image.php?id=" + imageId;
                    }
                };
            }
            
            // Mostrar lightbox
            document.body.style.overflow = "hidden";
            lightboxOverlay.classList.add("active");
        });
    });
    
    // Cerrar lightbox
    function closeLightbox() {
        document.body.style.overflow = "";
        lightboxOverlay.classList.remove("active");
    }
    
    // Cerrar con botón X
    lightboxClose.addEventListener("click", closeLightbox);
    
    // Cerrar al hacer clic en el overlay (fondo)
    lightboxOverlay.addEventListener("click", function(e) {
        if (e.target === lightboxOverlay) {
            closeLightbox();
        }
    });
    
    // Cerrar con tecla Escape
    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape" && lightboxOverlay.classList.contains("active")) {
            closeLightbox();
        }
    });
    
    // Prevenir scroll del body cuando el lightbox está activo
    lightboxOverlay.addEventListener("wheel", function(e) {
        e.preventDefault();
    });
});
</script>
';

include __DIR__ . '/../layouts/main.php';
?>
