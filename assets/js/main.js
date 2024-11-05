function initializeSwiper() {
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    loop: true,
    spaceBetween: 30,
    freeMode: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  window.addEventListener("resize", function () {
    swiper.update();
  });
}

window.onload = function () {
  initializeSwiper();
};

// read more

$(".show-more-btn").click(function () {
  $(this).closest(".col-lt-content").find(".moretext").slideToggle();
  if ($(this).text() == "Show More") {
    $(this).text("Show Less");
  } else {
    $(this).text("Show More");
  }
});
