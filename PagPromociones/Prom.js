const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".indicadores span");

let actual = 0;

function cambiarSlide() {

    slides[actual].classList.remove("active");
    dots[actual].classList.remove("active");

    actual++;

    if(actual >= slides.length){
        actual = 0;
    }

    slides[actual].classList.add("active");
    dots[actual].classList.add("active");

}

setInterval(cambiarSlide,3000);

dots.forEach((dot,index)=>{

    dot.addEventListener("click",()=>{

        slides[actual].classList.remove("active");
        dots[actual].classList.remove("active");

        actual=index;

        slides[actual].classList.add("active");
        dots[actual].classList.add("active");

    });

});
