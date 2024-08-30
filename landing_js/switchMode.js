// Check localStorage for dark mode status specific to user
if (localStorage.getItem('userDarkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
    document.getElementById('icon').classList.remove('fa-moon');
    document.getElementById('icon').classList.add('fa-sun');
    document.getElementById('logoImg').classList.add('invert-color');
}

document.getElementById('icon').addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');
    var icon = document.getElementById('icon');
    
    if(icon.classList.contains('fa-moon')) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
    }

    var logoImg = document.getElementById('logoImg');
    logoImg.classList.toggle('invert-color', document.body.classList.contains('dark-mode'));

    // Save dark mode status to localStorage specific to user
    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('userDarkMode', 'enabled');
    } else {
        localStorage.removeItem('userDarkMode');
    }
});
