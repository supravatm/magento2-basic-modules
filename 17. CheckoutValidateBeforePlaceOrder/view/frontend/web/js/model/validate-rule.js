define(
    ['mage/translate', 'Magento_Ui/js/model/messageList'],
    function ($t, messageList) {
        'use strict';
        return {
            validate: function () {
                const isValid = true; //Put your validation logic here
                messageList.addSuccessMessage({ message: $t('a possible failure message ...  ') });
                if (!isValid) {
                    messageList.addErrorMessage({ message: $t('a possible failure message ...  ') });
                }
                
                return isValid;
            }
        }
    }
);
