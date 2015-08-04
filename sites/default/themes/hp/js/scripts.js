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

})(jQuery);
