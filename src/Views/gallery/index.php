<?php
$title = 'Galería - SketchVibes';
$bodyClass = 'bg-light';
$showNavbar = true;

ob_start();
?>

<div class="bg-white border-bottom mb-4">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="h2 mb-2">Galería de Arte</h1>
                <p class="text-muted mb-0">Explora nuestra colección de dibujos únicos</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <?php if (SessionHelper::isAdmin()): ?>
                    <a href="/SketchVibes/public/add-image.php" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Agregar Imagen
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
            <div class="d-flex flex-wrap justify-content-center gap-2">
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
    <div class="row g-4" id="gallery-grid">
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
                <div class="col-lg-3 col-md-4 col-sm-6 gallery-item" data-category="<?= $image['id_categoria'] ?>">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img src="/SketchVibes/public/show-image.php?id=<?= $image['id_imagen'] ?>" 
                                 alt="<?= htmlspecialchars($image['titulo'] ?? 'Imagen') ?>" 
                                 class="card-img-top h-100 lightbox-trigger"
                                 style="object-fit: cover; cursor: pointer;"
                                 data-image-id="<?= $image['id_imagen'] ?>"
                                 data-image-src="/SketchVibes/public/show-image.php?id=<?= $image['id_imagen'] ?>"
                                 data-image-title="<?= htmlspecialchars($image['titulo'] ?? 'Sin título') ?>"
                                 data-image-description="<?= htmlspecialchars($image['descripcion'] ?? 'Sin descripción') ?>"
                                 data-image-category="<?= htmlspecialchars($image['categoria_nombre'] ?? 'Sin categoría') ?>">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title mb-2"><?= htmlspecialchars($image['titulo'] ?? 'Sin título') ?></h6>
                            <p class="card-text text-muted small mb-0">
                                <i class="fas fa-tag me-1"></i><?= htmlspecialchars($image['categoria_nombre'] ?? 'Sin categoría') ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Modal de Bootstrap para mostrar imagen ampliada -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Título de la imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <img id="modalImage" src="" alt="" class="img-fluid rounded">
                    </div>
                    <div class="col-lg-4">
                        <h5 id="modalTitle">Título de la imagen</h5>
                        <p id="modalDescription" class="text-muted">Descripción de la imagen</p>
                        <p class="mb-3">
                            <strong>Categoría:</strong> 
                            <span id="modalCategory" class="badge bg-primary"></span>
                        </p>
                        <div class="d-grid gap-2">
                            <a id="modalDownloadBtn" href="#" class="btn btn-success">
                                <i class="fas fa-download me-2"></i>Descargar
                            </a>
                            <?php if (SessionHelper::isAdmin()): ?>
                                <a id="modalEditBtn" href="#" class="btn btn-warning">
                                    <i class="fas fa-edit me-2"></i>Editar
                                </a>
                                <button id="modalDeleteBtn" type="button" class="btn btn-danger">
                                    <i class="fas fa-trash me-2"></i>Eliminar
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
