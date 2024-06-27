let burgerBtn = document.querySelector(".burger-icon");
let burgerMenu = document.querySelector(".burger-menu");

let isBurgerOpen = false;

burgerBtn.onclick = function(){
    if (!isBurgerOpen){
        burgerMenu.style.display = "block";
        burgerBtn.innerHTML = "<i class='fa-solid fa-xmark'></i>"; // Change the burger icon to 'xmark' icon
        isBurgerOpen = true;
    } else {
        burgerMenu.style.display = "none";
        burgerBtn.innerHTML = "<i class='fa-solid fa-bars'></i>"; // Replace 'fa-xmark' with the original burger icon HTML
        isBurgerOpen = false;
    }
}