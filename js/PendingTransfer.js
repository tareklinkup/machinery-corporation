// PendingTransferDialog Fill Info
$(document).ready(function () {
    $('a.linkDialog').click(function () {
        var dialogID = $(this).attr('DialogID');
        var dialog = $('#' + dialogID);

        var hfCustID = dialog.attr('hfCustID');
        var lblCustomerID = dialog.attr('lblCustomerID');
        var decTransferAmountID = dialog.attr('decTransferAmountID');

        $('#' + hfCustID).val($(this).attr('custID'));
        $('#' + lblCustomerID).html($(this).attr('custName'));
        $('#' + decTransferAmountID).val($(this).attr('transferAmount'));
    });
});
