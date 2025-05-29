new Swiper('.slide-wraper', {
    loop: true,
    spaceBetween: 30,

    // pagination bullets
    pagination: {
      el: '.swiper-pagination',
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // Responsive Breakpoint
    breakpoints: {
      0:{
        slidersPerView: 1
      },
      768:{
        slidersPerView: 2
      },
      1024:{
        slidersPerView: 3
      },
    }
  });
  
  