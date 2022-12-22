var effectsCarousel = jQuery(".owl-carousel");

effectsCarousel.owlCarousel({
  items: 4,
  loop: true,
  margin: 10,
  autoplay: true,
  responsive: {
    0: {
      items: 1,
    },

    768: {
      items: 4,
    },
  },
});
