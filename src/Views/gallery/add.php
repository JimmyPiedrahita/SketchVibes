<?php
$title = 'Agregar Imagen - SketchVibes';
$bodyClass = 'bg-light';
$showNavbar = true;

ob_start();
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus me-2"></i>Agregar Nueva Imagen
                    </h4>
                </div>
                <div class="card-body">
                    <?php FlashMessages::display(); ?>
                    
                    <form action="/SketchVibes/public/add-image.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="imagen" name="imagen" 
                                   accept="image/jpeg,image/png,image/gif,image/webp" required>
                            <div class="form-text">Formatos aceptados: JPG, PNG, GIF, WEBP. Tamaño máximo: 5MB</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" 
                                   value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>"
                                   placeholder="Título de la imagen (opcional)">
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" 
                                      rows="3" placeholder="Descripción de la imagen (opcional)"><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="">Seleccionar categoría</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id_categoria'] ?>" 
                                            <?= (($_POST['categoria'] ?? '') == $category['id_categoria']) ? 'selected' : '' ?>>
                                        <?= ucfirst($category['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/SketchVibes/public/home.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Imagen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview de imagen -->
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
            // Aquí podrías mostrar una preview de la imagen si quisieras
            console.log('Imagen cargada para preview');
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
