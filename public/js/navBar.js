var prevScrollpos = window.scrollY;
window.onscroll = function () {
    var currentScrollPos = window.scrollY;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.bottom = "1rem";
    } else {
        document.getElementById("navbar").style.bottom = "-10rem";
    }
    prevScrollpos = currentScrollPos;
}