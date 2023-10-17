var wrapper = document.querySelector('.preloader svg')
var preloader = document.querySelector('.preloader')
var body = document.querySelector('#hidden');


var navIcon = document.querySelector('.menu')
var menu = document.querySelector('.menuNavigation');
var closeMenu = document.querySelector('.closeMenu')
var menuLink = document.querySelectorAll('.menuNav-link')
var leistungen = document.getElementsByClassName('leistungen');
var menuBootstrap = document.querySelector('.navbar-toggler');

menuBootstrap.addEventListener("click", () => {
       menu.style.display = "flex";
       console.log("clicked")
})
/*closeMenu.addEventListener("click", () => {

    menu.style.display = "none";
})*/
for (let i = 0; i < menuLink.length; i++) {
    let self = menuLink[i];
    self.addEventListener('click', () => {
        setTimeout(() => {
            menu.classList.add('fadeOutBig')
        }, 450)
    })
}

/*navIcon.addEventListener("click", () => {
    menu.style.display = "flex"
    menu.classList.remove('fadeOutBig')
    body.style.overflow = "hidden"
    let menuLine = gsap.timeline({
        scrollTrigger: {
            trigger: '#menuNav',
        }
    })
    menuLine.from('.menuNav-link', {x: -250, opacity: 0, delay: 0.5, duration: 0.6, stagger: 0.15})
})
navIcon.addEventListener("click", () => {
    menu.style.display = "flex"
})
/*closeMenu.addEventListener("click", () => {
    menu.classList.add('fadeOutBig')
    body.style.overflowY = "visible"
})*/

document.addEventListener("DOMContentLoaded", function(){
    wrapper.classList.add('active')
    preloader.style.overflow = "hidden"
    body.style.overflowX = "hidden";
    body.style.overflowY = "hidden";
});

let tHero = gsap.timeline({
    scrollTrigger: {
        trigger: '#hero',
    },
    defaults: {
        delay: 0.4,
    }

})
setTimeout(function () {
    preloader.classList.add('fadeOut');
    body.style.overflowX = "hidden";
    body.style.overflowY = "visible";
  /*  tHero.from('.welcome-image', {width: 0, opacity:0, duration: 1})
    tHero.from('.welcome-text h1', {x: 50, opacity: 0, duration: 1},"=-1")
    tHero.from('.welcome-text p', {x: 50, opacity: 0, duration: 1},"=-1")
    tHero.from('.welcome-location', {x: 50, opacity: 0 ,duration: 1}, "=-2") */

}, 4300)

setTimeout(function () {
    preloader.style.display = "none"
},  8000)

/*let tAbout = gsap.timeline({
    scrollTrigger: {
        trigger: '#aboutus',
        start: 'top center',
        stagger: 0.1,
    }
})
tAbout.from('#aboutus .section-title', {y: 70, opacity: 0, duration: 1})
tAbout.from('.features_box', {y: 100, opacity: 0, duration: 1, stagger: 0.2}, "=-.5")
tAbout.from('.serving-box .serving_image', {y: 100, opacity: 0,  duration: 1, stagger: 0.2}, "=-1")

let tRef = gsap.timeline({
    scrollTrigger: {
        trigger: '#references',
        start: 'top center',
    },
    defaults: {
        duration: 0.4,
        opacity: 0,
    }
})
tRef.from('#references .section-title', {y: 100, opacity: 0, duration: 0.8, stagger: 0.2})
tRef.from('.instagram-box img', {x: 100, opacity: 0, duration: 1.2, stagger: 0.2}, "=-0.8")


let tPricing = gsap.timeline({
    scrollTrigger: {
        trigger: '#pricing',
        start: 'top center',
    },
    defaults: {
        ease: Power1.easeIn,
        opacity: 0,
    }
})
tPricing.from('.pricing', {x: -250, opacity: 0, duration: 0.8, ease: Power1.easeIn})
tPricing.from('.price_img', {x: 50, opacity: 0, duration: 0.5})



/*
Menu
 */

let menuNav = document.querySelector('.menuNavigation');
let menuHome =  document.querySelector('.home');
let menuAboutus =  document.querySelector('.aboutus');
let menuServings =  document.querySelector('.servings');
let menuPricelist =  document.querySelector('.pricelist');
let menuSchool =  document.querySelector('.school');
let menuRef =  document.querySelector('.ref');
let menuConatct =  document.querySelector('.contact');
let menuNavItem = document.getElementById('menuNav');

/*menuHome.addEventListener('mouseover', () => {
    menuNav.style.transition = "0.3s ease"
    menuNav.style.backgroundSize = "cover"
    menuNav.style.backgroundColor = "white"
})
menuAboutus.addEventListener('mouseover', () => {
    menuNav.style.transition = "0.3s ease"
    menuNav.style.backgroundColor = "#d9d7ca"

})*/


$('document').ready(function(){
    $('nav').show();
    $('.leistungen').hide();
    $('.serving-box').on("click", function(){
        $('nav').fadeOut();
        $('.leistungen').fadeIn();
        $('.leistung_container').show()
        let tLeistungen = gsap.timeline({
            scrollTrigger: {
                trigger: '#section_leistung',
                start: 'top center',
                defaults: {
                    ease: Power1.easeIn,
                    opacity: 0,
                }
            }
        })
        tLeistungen.from('.leistung_container', {scaleY: 0})
        tLeistungen.from('.close_tab', {x: -30, opacity: 0, duration: 0.5, ease: Power4.easeInOut},"=-0.1")
        tLeistungen.from('.container_item', {y: 250, opacity: 0, duration: 1, ease: Power1.easeIn, stagger: 0.3})
        $('.logo-area-active').delay(1200).addClass('active');
    })
    $('.close_tab').on("click", function(){
        $('.logo-area-active').removeClass('active');
        $('.leistungen').fadeOut();
        $('nav').delay(400).slideDown();
    })
    $('.closeMenu').on("click", function() {
        $(this).parent().addClass('fadeOutBig');
    })
    $('.navbar-toggler').on("click", function(){
        $('#menuNav').removeClass('fadeOutBig')
        let tNavBar = gsap.timeline({
            scrollTrigger: {
                trigger: '#menuNav',
                start: 'top center',
                defaults: {
                    ease: Power1.easeIn,
                    opacity: 0,
                }
            }
        })
        tNavBar.from('.menuNav-link', {x:-600, opacity: 1, duration: 2, ease: Power1.easeInOut, stagger: 0.1},"=-1")
        tNavBar.from('.menu_insta', {x:-600, opacity: 1, duration: 1.5, ease:Power1.easeInOut},"=-1.6")
    })
})

$(document).on("click", ".leistungs_item", function (){
    let productId = $(this).data('expand-product')
    let elemThis = $(this);

    $('.leistungs_item_inner').each(function (){
        $(this).css( "display", "none");
        $('.leistungs_item').children('.material-icons').removeClass('arrowDown');
    })
    elemThis.children('.material-icons').addClass('arrowDown');
    $('#product-'+productId).slideToggle();
})
