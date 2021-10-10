$(() => {
    $('.slider').slick( {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        arrows: false,
        fade: true,
        autoplay: true,
        autoplaySpeed: 3000,
        cssEase: 'linear',
    });
});

$(() => {
    $('.slider-bottom').slick( {
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        arrows: true,
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: false
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true
              }
            }
        ]
    });
});

function ShowImg (i) {
    let item  = document.querySelector('.decription__show img');
    item.src = i.dataset.src;
}
