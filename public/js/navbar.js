let activateMenu = document.querySelector(".containerLogo");

function activeMenu() {
    document.querySelectorAll(".menu").forEach(menu => menu.classList.toggle("menuActiveUl"));
    document.querySelector("nav").classList.toggle("menuActiveNav");
    document.querySelector(".containerLogo").classList.toggle("menuActiveLogo");

    document.querySelectorAll(".menu").forEach(menu => menu.classList.remove("menudActiveUl", "dpNone"));
    document.querySelector("nav").classList.remove("menudActiveNav");
    document.querySelector(".containerLogo").classList.remove("menudActiveLogo");
};

function desactiveMenu() {
    document.querySelectorAll(".menu").forEach(menu => menu.classList.toggle("menudActiveUl"));
    document.querySelector("nav").classList.toggle("menudActiveNav");
    document.querySelector(".containerLogo").classList.toggle("menudActiveLogo");

    document.querySelectorAll(".menu").forEach(menu => menu.classList.remove("menuActiveUl"));
    document.querySelector("nav").classList.remove("menuActiveNav");
    document.querySelector(".containerLogo").classList.remove("menuActiveLogo");

    setTimeout(function() {
        document.querySelectorAll(".menu").forEach(menu => menu.classList.toggle("dpNone"));
    }, 695);
}

function Menu() {
    // si menu ouvert alors fermeture sinon ouverture
    if (activateMenu.classList.contains('menuActiveLogo')) {
        desactiveMenu();
    } else {
        activeMenu();
    }
}

activateMenu.addEventListener("click", Menu);