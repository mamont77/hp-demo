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

  /**
   *
   * @type {{attach: Function}}
   */
  //Drupal.behaviors.equalHeight = {
  //  attach: function (context, settings) {
  //    var /*$mainBlocks = $('.main-blocks .col, .main-blocks .col > .twitter-timeline', context),*/
  //      //$mainBlocksTexts = $('.main-blocks .main-caption p', context);
  //
  //    //$.equalHeight($mainBlocks);
  //    //$.equalHeight($mainBlocksTexts);
  //    $(window).resize(function () {
  //      //$.equalHeight($mainBlocks);
  //      //$.equalHeight($mainBlocksTexts);
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
    }
  };

  /**
   *
   * @type {{attach: Function}}
   */
  Drupal.behaviors.productImages = {
    attach: function (context, settings) {
      var $openAsPopup = $('.open-as-popup', context),
        $rollWrapper = $('.roll-wrapper', context),
        $videoField = $('.field-name-field-video', context);

      $openAsPopup.on('click', function () {
        $openAsPopup.attr({
          'href': $('#cloud-zoom', context).attr('href'),
          'title': $('h1.page-header', context).text()
        });
      });

      $rollWrapper.appendTo($('#wrap'));

      if ($videoField.length > 0) {
        $('.cloud-zoom-gallery-thumbs', context).append('<a href="#" ' +
          'class="cloud-zoom-gallery-video video_icon">' +
          '<img src="/sites/default/themes/hp/images/video_preview.png" width="40" height="40" alt="">' +
          '</a>');
        $videoField.prependTo($('.cloud-zoom-container', context));
        $('.video_icon').on('click', function (event) {
          event.preventDefault();
          $('#wrap', context).hide();
          //$('.roll-wrapper', context).hide();
          $videoField.show();
          return false;
        });
        $('.cloud-zoom-gallery').on('click', function () {
          $videoField.hide();
          $('#wrap', context).show();
          //$('.roll-wrapper', context).removeClass('roll-hidden');
        });

      }
    }
  };

  /**
   *
   * @type {{attach: Function}}
   */
  Drupal.behaviors.images = {
    attach: function (context, settings) {
      $('.pop', context).popover({ trigger: "manual" , html: true, animation:false})
          .on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(".popover").on("mouseleave", function () {
              $(_this).popover('hide');
            });
          }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
              if (!$(".popover:hover").length) {
                $(_this).popover("hide");
              }
            }, 300);
          });
    }
  };

})(jQuery);
