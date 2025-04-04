//INICIO de vista extendida de las imagenes
const modal = document.getElementById('modal');
const modalContent = document.querySelector('.modal-content');
const overlay = document.getElementById('overlay');
const closeModalBtn = document.getElementById('btn-cerrar-modal');
const images = document.querySelectorAll('.grid-item img');
var id_imagen;
images.forEach(img => {
    img.addEventListener('click', () => {
        modal.style.display = 'block';
        overlay.style.display = 'block';
        const modalImage = document.getElementById('modal-image');
        modalImage.src = img.src;
        id_imagen = img.id;
        document.getElementById('download-btn').href = img.src;
        document.getElementById('modificar-btn').href = "modificar.php?id_imagen=" + id_imagen;
        document.getElementById('eliminar-btn').href = "proceso-eliminar.php?id=" + id_imagen;
    });
});

closeModalBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    overlay.style.display = 'none';
});

overlay.addEventListener('click', () => {
    modal.style.display = 'none';
    overlay.style.display = 'none';
});

window.addEventListener('keydown', event => {
    if (event.key === 'Escape' && modal.style.display === 'block') {
        modal.style.display = 'none';
        overlay.style.display = 'none';
    }
});
//FIN de vista extendida de las imagenes

//INICIO boton de descaga
document.getElementById("download-btn").addEventListener('click', function () {
    //AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'controlador-descarga.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send('id_imagen_actual=' + id_imagen);
});
//FIN boton de descaga

//INICIO de buscador
const searchBar = document.getElementById('search-bar');
const gridItems = document.querySelectorAll('.elemento');

searchBar.addEventListener('input', () => {
    const searchTerm = searchBar.value.trim().toLowerCase();
    gridItems.forEach(item => {
        const filterValue = item.getAttribute('data-filter').toLowerCase();
        if (filterValue.includes(searchTerm)) {
            item.classList.add('filtered');
            item.style.display = 'block';
        } else {
            item.classList.remove('filtered');
            item.style.display = 'none';
        }
    });
});
//FIN de buscador