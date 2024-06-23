
    function changeIcon(element) {
        var icon = element.querySelector('i');
        icon.classList.remove('fa-arrow-right-to-bracket');
        icon.classList.add('fa-sign-in-alt');
    }

    function resetIcon(element) {
        var icon = element.querySelector('i');
        icon.classList.remove('fa-sign-in-alt');
        icon.classList.add('fa-arrow-right-to-bracket');
    }

