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
                                 class="gallery-image"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal"
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

<!-- Modal para mostrar imagen ampliada -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalImageTitle">Título de la imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid mb-3">
                <p id="modalImageDescription" class="text-muted"></p>
                <p><strong>Categoría:</strong> <span id="modalImageCategory"></span></p>
            </div>
            <div class="modal-footer">
                <a id="downloadBtn" href="#" class="btn btn-success">
                    <i class="fas fa-download"></i> Descargar
                </a>
                <?php if (SessionHelper::isAdmin()): ?>
                    <a id="editBtn" href="#" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <button id="deleteBtn" type="button" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                <?php endif; ?>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
    
    // Modal de imagen
    const imageModal = document.getElementById("imageModal");
    imageModal.addEventListener("show.bs.modal", function(event) {
        const trigger = event.relatedTarget;
        const imageId = trigger.getAttribute("data-image-id");
        const imageSrc = trigger.getAttribute("data-image-src");
        const imageTitle = trigger.getAttribute("data-image-title");
        const imageDescription = trigger.getAttribute("data-image-description");
        const imageCategory = trigger.getAttribute("data-image-category");
        
        // Actualizar contenido del modal
        document.getElementById("modalImage").src = imageSrc;
        document.getElementById("modalImageTitle").textContent = imageTitle;
        document.getElementById("modalImageDescription").textContent = imageDescription;
        document.getElementById("modalImageCategory").textContent = imageCategory;
        
        // Actualizar enlaces
        document.getElementById("downloadBtn").href = "/SketchVibes/public/download-image.php?id=" + imageId;
        
        <?php if (SessionHelper::isAdmin()): ?>
        document.getElementById("editBtn").href = "/SketchVibes/public/edit-image.php?id=" + imageId;
        document.getElementById("deleteBtn").onclick = function() {
            if (confirm("¿Estás seguro de que quieres eliminar esta imagen?")) {
                window.location.href = "/SketchVibes/public/delete-image.php?id=" + imageId;
            }
        };
        <?php endif; ?>
    });
});
</script>
';

include __DIR__ . '/../src/Views/layouts/main.php';
?>
