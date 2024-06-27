document.addEventListener('DOMContentLoaded', function() {
    const submenu1 = document.getElementById('submenu1');
    const subMenuContent1 = document.getElementById('subMenuContent1');

    submenu1.addEventListener('click', function() {
        if (subMenuContent1.style.display === 'block') {
            subMenuContent1.style.display = 'none';
        } else {
            subMenuContent1.style.display = 'block';
        }
    });
});