/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery'
], function ($) {
    'use strict';

    /**
     * @param {String} url
     * @param {*} fromPages
     */
    function processComments(url, fromPages) {
        $.ajax({
            url: url,
            cache: true,
            dataType: 'html',
            showLoader: false,
            loaderContext: $('.product.data.items')
        }).done(function (data) {
            $('#product-comment-container').html(data);
            $('[data-role="product-comment"] .pages a').each(function (index, element) {
                $(element).click(function (event) { //eslint-disable-line max-nested-callbacks
                    processComments($(element).attr('href'), true);
                    event.preventDefault();
                });
            });
        }).complete(function () {
            if (fromPages == true) { //eslint-disable-line eqeqeq
                $('html, body').animate({
                    scrollTop: $('#comments').offset().top - 50
                }, 300);
            }
        });
    }

    return function (config) {
        var commentTab = $(config.commentsTabSelector),
            requiredCommentTabRole = 'tab';

        if (commentTab.attr('role') === requiredCommentTabRole && commentTab.hasClass('active')) {
            processComments(config.productCommentUrl);
        } else {
            commentTab.one('beforeOpen', function () {
                processComments(config.productCommentUrl);
            });
        }

        $(function () {
            $('.product-info-main .comments-actions a').click(function (event) {
                var anchor;

                event.preventDefault();
                anchor = $(this).attr('href').replace(/^.*?(#|$)/, '');
                $('.product.data.items [data-role="content"]').each(function (index) { //eslint-disable-line
                    if (this.id == 'comments') { //eslint-disable-line eqeqeq
                        $('.product.data.items').tabs('activate', index);
                        $('html, body').animate({
                            scrollTop: $('#' + anchor).offset().top - 50
                        }, 300);
                    }
                });
            });
        });
    };
});