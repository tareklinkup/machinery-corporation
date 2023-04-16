var myPaymentDialog = {
    inputs: '',
    details: '',
    radioDelivery: '',
    init: function () {
        this.inputs = $("ul.paymentType input");
        this.details = $("div.paymentDetail table");
        this.radioDelivery = $('ul.delivery input');

        this.inputs.click(function () {
            var radio = $(this);
            if (radio.is(':checked')) {
                myPaymentDialog.refreshUI();
            }
        });
        
        this.radioDelivery.change(function () {
            myPaymentDialog.refreshDeliveryUI();
        });

        this.refreshUI();
        this.refreshDeliveryUI();
    },
    refreshUI: function () {
        var idx = this.inputs.filter(':checked').parent().index();
        if (idx != -1) {
            this.details.each(function (index, o) {
                if (index == idx) {                   
                    $(o).show();                    
                }
                else {
                    $(o).hide();
                }
            });
        }
        if (idx == 0) {
            $('.dialogAmount').focus();
        } else {          
            $('.txtDaysDue').focus();
        }

        this.radioDelivery.find(':checked');
    },
    refreshDeliveryUI: function () {
        var input = this.radioDelivery.filter(':checked');
        if (input.val() == "true") {
            $('tr.stock').show();
        }
        else {
            $('tr.stock').hide();
        }
    },
    hideOption: function()
    {
        this.inputs.eq(0).closest('table').hide();
    },
    showOption: function () {
        this.inputs.eq(0).closest('table').show();
    }
}

$(document).ready(function () {
    myPaymentDialog.init();
});

