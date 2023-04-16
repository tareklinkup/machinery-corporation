$(document).ready(function () {
    $(".periodpicker").change(function () {
        var period = $(".periodpicker").val()
        var ddlfrom = $(".periodpicker").attr("DatePickerFromID");
        var ddlto = $(".periodpicker").attr("DatePickerToID");
        var dateto = $.datepicker.formatDate('dd M yy', new Date());
        var datefrom = $.datepicker.formatDate('dd M yy', new Date());

        switch (period) {
            case "today":
                $("#" + ddlfrom).val(datefrom);
                $("#" + ddlto).val(dateto);
                break;
            case "thisweek":
                var datefrom = Date.monday();
                var dateto = Date.next().sunday();
                if (Date.today().is().sunday()) {
                    var datefrom = Date.previous().monday();
                    var dateto = Date.sunday();
                }
                var newfromdate = $.datepicker.formatDate('dd M yy', datefrom);
                var newtodate = $.datepicker.formatDate('dd M yy', dateto);

                $("#" + ddlfrom).val(newfromdate);
                $("#" + ddlto).val(newtodate);
                break;
            case "thismonth":
                var datefrom = Date.today().moveToFirstDayOfMonth();
                var dateto = Date.today().moveToLastDayOfMonth();
                var newfromdate = $.datepicker.formatDate('dd M yy', datefrom);
                var newtodate = $.datepicker.formatDate('dd M yy', dateto);

                $("#" + ddlfrom).val(newfromdate);
                $("#" + ddlto).val(newtodate);
                break;
            case "thisyear":
                var newfromdate = $.datepicker.formatDate('dd M yy', new Date(new Date().getFullYear(), 0, 1));
                var newtodate = $.datepicker.formatDate('dd M yy', new Date(new Date().getFullYear(), 11, 31));

                $("#" + ddlfrom).val(newfromdate);
                $("#" + ddlto).val(newtodate);
                break;
            case "yesterday":
                $("#" + ddlfrom).val(datefrom);
                var date = $("#" + ddlfrom).datepicker('getDate');
                date.setDate(date.getDate() - 1);
                var newdate = $.datepicker.formatDate('dd M yy', date);
                $("#" + ddlfrom).val(newdate);
                $("#" + ddlto).val(dateto);
                break;
            case "previousweek":
                var datefrom = Date.monday();
                var test = datefrom.getDate() - 7;
                var dateto = Date.next().sunday();
                if (Date.today().is().sunday()) {
                    var datefrom = Date.previous().monday();
                    var dateto = Date.sunday();
                }
                var newfromdate = $.datepicker.formatDate('dd M yy', new Date(datefrom.getFullYear(), datefrom.getMonth(), datefrom.getDate() - 7));
                var newtodate = $.datepicker.formatDate('dd M yy', new Date(dateto.getFullYear(), dateto.getMonth(), dateto.getDate() - 7));

                $("#" + ddlfrom).val(newfromdate);
                $("#" + ddlto).val(newtodate);
                break;
            case "previousmonth":
                var newfromdate = $.datepicker.formatDate('dd M yy', new Date(new Date().getFullYear(), new Date().getMonth() - 1, 1));
                var newtodate = $.datepicker.formatDate('dd M yy', new Date(new Date().getFullYear(), new Date().getMonth(), 0));

                $("#" + ddlfrom).val(newfromdate);
                $("#" + ddlto).val(newtodate);
                break;
            case "previousyear":
                var newfromdate = $.datepicker.formatDate('dd M yy', new Date(new Date().getFullYear() - 1, 0, 1));
                var newtodate = $.datepicker.formatDate('dd M yy', new Date(new Date().getFullYear() - 1, 11, 31));

                $("#" + ddlfrom).val(newfromdate);
                $("#" + ddlto).val(newtodate);
                break;
            default:
                break;
        }
    });
});
