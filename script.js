// js file
// side nav
let show = document.querySelector(".show");
let hide = document.querySelector('.hide');
let nav = document.querySelector('.nav');
// 
show.addEventListener("click", function reveal() {
    show.style.display = "none";
    hide.style.display = "flex";
    nav.style.right = "0";
})
hide.addEventListener("click", function close() {
    show.style.display = "flex";
    hide.style.display = "none";
    nav.style.right = "-250px";
})

// slide show
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
}

// show password
function showPassword() {
    let x = document.getElementById("key");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function revealPassword() {
    let y = document.getElementsByClassName("key_show");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}

// let openDash = document.querySelector("#openDash");
// let closeDash = document.querySelector("#closeDash");
// let aside = document.querySelector("#aside");

// Open the sidebar
function show_dash() {
    let openDash = document.querySelector("#openDash");
    let closeDash = document.querySelector("#closeDash");
    let aside = document.querySelector("aside");
    openDash.style.display = "none";
    closeDash.style.display = "flex";
    aside.style.left = "0px";
};

// Close the sidebar
function hide_dash() {
    let openDash = document.querySelector("#openDash");
    let closeDash = document.querySelector("#closeDash");
    let aside = document.querySelector("aside");
    closeDash.style.display = "none";
    openDash.style.display = "flex";
    aside.style.left = "-270px"; // Change -250px to match your sidebar width
};