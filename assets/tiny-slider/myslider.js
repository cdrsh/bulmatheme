function dom_ready() {
    var slider = tns({
        container: '.my-slider',
        items: 1,
        slideBy: 'page',
        autoplay: true,
        controls:false,
        controlsContainer:false,
        nav:false,
        navContainer:false,
        autoplayButtonOutput:false
    });
}

document.addEventListener("DOMContentLoaded", dom_ready);
