var swiper = new Swiper(".home-slider", {
    pagination: {
       el: ".swiper-pagination",
       clickable:true,
    },
    autoplay: {
       delay:5000,
    }
 });
 
  var swiper = new Swiper(".category-slider", {
    pagination: {
       el: ".swiper-pagination",
       clickable:true,
    },
    loop:false,
    spaceBetween: 20,
    // autoplay: {
    //    false
    // },
 
    
    breakpoints: {
       0: {
          slidesPerView: 2,
        },
       650: {
         slidesPerView: 3,
       },
       768: {
         slidesPerView: 4,
       },
       1024: {
         slidesPerView: 5,
       },
    },
 });
 
 var swiper = new Swiper(".products-slider", {
    loop:true,
    spaceBetween: 20,
    pagination: {
       el: ".swiper-pagination",
       clickable:true,
    },
    breakpoints: {
       550: {
         slidesPerView: 2,
       },
       768: {
         slidesPerView: 2,
       },
       1024: {
         slidesPerView: 3,
       },
    },
 });