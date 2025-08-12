
define([
    'jquery',
    'jquery/ui'
    ], function($){
        $.widget('mage.myCustomWidget', {
            options: {
                abcd: 1,
                passvalue:'test'
            },
            /**
             * Widget initialization
             * @private
             */
             _create: function() {
                console.log('widget created');
                console.log(this.element);
                console.log(this.options);
            }
        });
 
    return $.mage.myCustomWidget;
});
