
jQuery(document).ready(function($){

  //header search toggle
  $('.header-search .header-search-form').hide();
  $('.search-toggle').on('click', function(){
    $(this).parent('.header-search').addClass('active');
    $('.header-search .header-search-form').fadeIn();
  });

  //add dropdown arrow
  $('.main-navigation ul > li.menu-item-has-children').append('<span class="fas fa-chevron-down"></span>');
  if($(window).width() <= 992) {
    $('.main-navigation ul ul').hide();
    $('.main-navigation ul li.menu-item-has-children .fas').on('click', function(){
      $(this).siblings('ul.sub-menu').slideToggle();
      $(this).toggleClass('open');
    });
  }

  //close search form
  $('.header-search-form .close').on('click', function(){
    $(this).parent('.header-search').removeClass('active');
    $('.header-search .header-search-form').fadeOut();
  });

  //responsive menu
  $('.menu-toggle').on('click', function(){
    $('.site').toggleClass('toggled');
  });


//sticky social icons
if($('body').hasClass('rightsidebar') && ($('.sticky-inner').length>0)){ //this condition should be removed in development
  if($(window).width() > 640){
    var sidebar = new StickySidebar('.sticky-inner', {
      topSpacing: 20,
      bottomSpacing: 20,
      containerSelector: '.site-main',
      innerWrapperSelector: '.sidebar__inner'
    });
  }
}

}); //document close

// (function($) {

//   function find_page_number( element ) {
//     element.find('span').remove();
//     return parseInt( element.html() );
//   }

// $(document).on( 'click', '.nav-links a', function( event ) {
//     event.preventDefault();
    
//     page = find_page_number( $(this).clone() );
      
//     $.ajax({
//       url: schema_ajax_script.ajaxurl,
//       type: 'post',
//       data: {
//         action: 'ajax_pagination',
//         page: page
//       },
//       success: function( response ) {
//         $('.site-main').html(response);
//       }
//     })
//   })
// })(jQuery);
