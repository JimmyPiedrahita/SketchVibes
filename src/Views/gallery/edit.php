<?php
$title = 'Editar Imagen - SketchVibes';
$bodyClass = 'bg-light';
$showNavbar = true;

ob_start();
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Editar Imagen
                    </h4>
                </div>
                <div class="card-body">
                    <?php FlashMessages::display(); ?>
                    
                    <form action="/SketchVibes/public/edit-image.php?id=<?= $image['id_imagen'] ?>" method="POST" enctype="multipart/form-data">
                        <!-- Preview de imagen actual -->
                        <div class="mb-3 text-center">
                            <div class="border rounded p-3 bg-light">
                                <img src="/SketchVibes/public/show-image.php?id=<?= $image['id_imagen'] ?>" 
                                     alt="<?= htmlspecialchars($image['titulo'] ?? 'Imagen actual') ?>" 
                                     class="img-fluid rounded" style="max-height: 300px;">
                                <p class="mt-2 text-muted">Imagen actual</p>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Cambiar Imagen (opcional)</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" 
                                   accept="image/jpeg,image/png,image/gif,image/webp">
                            <div class="form-text">Si no seleccionas una nueva imagen, se mantendrá la actual. Formatos aceptados: JPG, PNG, GIF, WEBP. Tamaño máximo: 5MB</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" 
                                   value="<?= htmlspecialchars($_POST['titulo'] ?? $image['titulo'] ?? '') ?>"
                                   placeholder="Título de la imagen (opcional)">
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" 
                                      rows="3" placeholder="Descripción de la imagen (opcional)"><?= htmlspecialchars($_POST['descripcion'] ?? $image['descripcion'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="">Seleccionar categoría</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id_categoria'] ?>" 
                                            <?php 
                                            $selected_category = $_POST['categoria'] ?? $image['id_categoria'] ?? '';
                                            echo ($selected_category == $category['id_categoria']) ? 'selected' : '';
                                            ?>>
                                        <?= ucfirst($category['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/SketchVibes/public/home.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning text-dark">
                                <i class="fas fa-save me-2"></i>Actualizar Imagen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview de nueva imagen -->
<script>
document.getElementById('imagen').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validar tamaño
        if (file.size > 5 * 1024 * 1024) { // 5MB
            alert('El archivo es demasiado grande. El tamaño máximo es 5MB.');
            this.value = '';
            return;
        }
        
        // Mostrar preview (opcional)
        const reader = new FileReader();
        reader.onload = function(e) {
            // Aquí podrías mostrar una preview de la nueva imagen si quisieras
            console.log('Nueva imagen cargada para preview');
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
