// jQuery(window).scroll(function () {
  jQuery(window).on('scroll', function() {
    if (jQuery(this).scrollTop() > 300) {
      jQuery('.btn_goTop').show();
    } else {
      jQuery('.btn_goTop').hide();
    }
  });
  
  // jQuery('.btn_goTop').click(function () {
  jQuery('.btn_goTop').on('click', function() {
    jQuery('html, body').animate({ scrollTop: 0 }, 400);
    return false;
  });
  