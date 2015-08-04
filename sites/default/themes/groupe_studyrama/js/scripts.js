/**
 * @file
 */

(function ($) {

  'use strict';

  /**
   *
   * @param group
   */
  $.equalHeight = function (group) {
    var tallest = 0;
    group.removeAttr('style').each(function () {
      var thisHeight = $(this).height();
      if (thisHeight > tallest) {
        tallest = thisHeight;
      }
    });
    group.height(tallest);
  };

  var cTimer = false;
  /**
   *
   * @param elm
   * @param p
   * @param step
   * @param h
   * @param steps
   */
  $.spriteOpen = function (elm, p, step, h, steps) {
    if (step == -1) {
      $('.second', p).hide();
      $('.first', p).fadeOut('fast', function () {
        $('.sprite', p).show();
        step = parseInt(step) + 1;
        $.spriteOpen(elm, p, step, h, steps);
      });
    } else if (step < steps) {
      if (step == (steps - 3)) {
        $(p).addClass('open');
        $('.second', p).fadeIn('slow');
      }
      var cpos = parseInt(h) * step;
      cpos = cpos * -1;
      $(elm).css({'top': cpos + 'px'});
      step = parseInt(step) + 1;
      cTimer = setTimeout(function () {
        $.spriteOpen(elm, p, step, h, steps);
      }, 26);
    } else {
      clearTimeout(cTimer);
      $('.sprite', p).hide();
      $('.second', p).show();
    }
  };

  /**
   *
   * @type {{attach: Function}}
   */
  Drupal.behaviors.equalHeight = {
    attach: function (context, settings) {
      var /*$mainBlocks = $('.main-blocks .col, .main-blocks .col > .twitter-timeline', context),*/
        $mainBlocksTexts = $('.main-blocks .main-caption p', context);

      //$.equalHeight($mainBlocks);
      $.equalHeight($mainBlocksTexts);
      $(window).resize(function () {
        //$.equalHeight($mainBlocks);
        $.equalHeight($mainBlocksTexts);
      });
    }
  };

  /**
   * Only works if the iFrame content is from the same parent domain.
   *
   * @type {{attach: Function}}
   */
  //Drupal.behaviors.common = {
  //  attach: function (context, settings) {
  //    var $twitter_timeline = $('iframe.twitter-timeline', context);
  //    $twitter_timeline.load(function () {
  //      $twitter_timeline.contents().find('head')
  //        .append($("<style type='text/css'> .root.timeline{max-width:100%;} </style>"));
  //    });
  //  }
  //};

  /**
   *
   * @type {{attach: Function}}
   */
  Drupal.behaviors.images = {
    attach: function (context, settings) {
      $('.main-container img', context).addClass('img-responsive');
      //$('.view-articles.latest-articles img', context).addClass('img-thumbnail');
    }
  };

  Drupal.behaviors.sliders = {
    attach: function (context, settings) {
      $.getScript("http://commons.studyrama.com/js/jquery/flexslider/jquery.flexslider-min.js", function () {
        $('.flexslider .view-content .item-list', context).flexslider({
          animation: "slide",
          animationLoop: true,
          itemMargin: 0,
          slideshowSpeed: 3000
        });
      });

      //var $pressReleaseBlock = $('#block-bean-communiques-de-presse .entity-bean .content', context),
      //  pathToTheme = Drupal.settings.basePath + "sites/default/themes/" + Drupal.settings.ajaxPageState.theme;
      //$pressReleaseBlock.find('.item').hide();
      //$pressReleaseBlock.find('.item').first().show();
      //$pressReleaseBlock.each(function () {
      //  $('.item', this).append('<div class="clickE"></div>');
      //  $(this).append('<div class="sprite"><img src="' + pathToTheme + '/images/sprite.png"/></div>');
      //});
      //$pressReleaseBlock.find('.item .clickE').click(function () {
      //  var elm = $('.sprite img', this.parentNode.parentNode)[0];
      //  $.spriteOpen(elm, this.parentNode.parentNode, -1, 220, 24);
      //});
      //$("#block-bean-communiques-de-presse .entity-bean .content", context).jFlip(300, 295, {
      //  background: '#fff',
      //  cornersTop: true,
      //  scale: 'noresize',
      //  gradientColors: ['#c9c9c9', '#d6d6d6', '#fff'],
      //  curlSize: 0.06
      //});
    }
  };

  Drupal.behaviors.isotope = {
    attach: function (context, settings) {
      var /*$mainBlocks = $('.main-blocks', context),*/
        $nodeImages = $('.node .field-name-field-image .field-items', context);

      //$nodeImages.isotope({
      //  itemSelector: '.col'
      //});

      if ($nodeImages.find('.field-item').length > 1) {
        $nodeImages.addClass('many');
        $nodeImages.imagesLoaded(function () {
          $nodeImages.isotope({
            itemSelector: '.field-item'
          });
        });
      }
    }
  };

})(jQuery);
