var prevScrollpos = window.scrollY;

function scrollNavBar() {
    var currentScrollPos = window.scrollY;
    if (prevScrollpos > currentScrollPos) {
        // menu réapparait lorsqu'on scroll vers le haut
        document.getElementById("navbar").style.bottom = "1rem";
    } else if (((window.innerHeight + Math.round(currentScrollPos)) >= document.body.offsetHeight)) {
        // menu réapparait lorsqu'on a scrollé tout en bas de la page
        document.getElementById("navbar").style.bottom = "1rem";
    } else if (prevScrollpos < currentScrollPos) {
        // menu disparait lorsqu'on scroll vers le bas
        document.getElementById("navbar").style.bottom = "-10rem";
    }
    prevScrollpos = currentScrollPos;
}

window.addEventListener('scroll', scrollNavBar);