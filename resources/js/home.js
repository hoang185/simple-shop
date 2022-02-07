// header
var item = document.getElementsByClassName("left-item");

for (var i = 0; i < item.length; i++) {
    item[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("active-item");

        if (current.length > 0) {
            current[0].className = current[0].className.replace(" active-item", "");
        }
        this.className += " active-item";
    });
}
// new product
var btns = document.getElementsByClassName("btns");

for (let i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("active-toggle");
        var slide = document.getElementsByClassName("slider");
        var active = document.getElementsByClassName("active-slider");
        if (current.length > 0) {
            current[0].className = current[0].className.replace(" active-toggle", "");
        }
        this.className += " active-toggle";
        if (btns[1].classList.contains("active-toggle")) {
            active[0].className = active[0].className.replace(" active-slider", "");
            slide[0].className += " active-slider";
        } else {
            active[0].className = active[0].className.replace(" active-slider", "");
            slide[1].className += " active-slider";
        }
    });
}

// new product -slide

$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
        0: {
            items: 2,
            nav: true,
        },
        600: {
            items: 3,
            nav: true,
        },
        1000: {
            items: 4,
            nav: true,
        }
    }
})
// weekly best
var btn_weekly = document.getElementsByClassName("btn-weekly");

for (var i = 0; i < btns.length; i++) {
    btn_weekly[i].addEventListener("click", function () {
        var current_weekly = document.getElementsByClassName("active-weekly");
        var slide_weekly = document.getElementsByClassName("weekly-list");
        var active_weekly = document.getElementsByClassName("active-list");
        if (current_weekly.length > 0) {
            current_weekly [0].className = current_weekly [0].className.replace(" active-weekly", "");
        }
        this.className += " active-weekly";
        if (btn_weekly[1].classList.contains("active-weekly")) {
            active_weekly[0].className = active_weekly[0].className.replace(" active-list", "");
            slide_weekly[0].className += " active-list";
        } else {
            active_weekly[0].className = active_weekly[0].className.replace(" active-list", "");
            slide_weekly[1].className += " active-list";
        }
    });
}
