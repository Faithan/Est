
    document.addEventListener('DOMContentLoaded', function () {
        // Check localStorage for dark mode status specific to admin
        const darkMode = localStorage.getItem('adminDarkMode') === 'enabled';
        const body = document.body;
        const icon = document.getElementById('icon');
        const logoImg = document.getElementById('logoImg');

        // If dark mode is enabled, apply the relevant classes
        if (darkMode) {
            body.classList.add('dark-mode');
            if (icon) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
            if (logoImg) {
                logoImg.classList.add('invert-color');
            }
        }

        // Add event listener to toggle dark mode
        if (icon) {
            icon.addEventListener('click', function () {
                body.classList.toggle('dark-mode');

                if (body.classList.contains('dark-mode')) {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                    if (logoImg) {
                        logoImg.classList.add('invert-color');
                    }
                    localStorage.setItem('adminDarkMode', 'enabled');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                    if (logoImg) {
                        logoImg.classList.remove('invert-color');
                    }
                    localStorage.removeItem('adminDarkMode');
                }
            });
        }
    });

