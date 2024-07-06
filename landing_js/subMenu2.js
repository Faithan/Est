document.addEventListener('DOMContentLoaded', function() {
    const submenu2 = document.getElementById('submenu2');
    const subMenuContent2 = document.getElementById('subMenuContent2');

    submenu2.addEventListener('click', function() {
        if (subMenuContent2.style.display === 'block') {
            subMenuContent2.style.display = 'none';
        } else {
            subMenuContent2.style.display = 'block';
        }
    });
});