$(document).ready(function () {
    var txtFirstName = $("#txtFirstName");
    var txtLoginID = $("#txtLoginID");
    txtLoginID.keyup(function () {
        txtFirstName.val(txtLoginID.val());
    });

    $("input.button").click(function () {
        var noGroup = true;
        $("ul.userGroups input:checkbox:checked").each(function () {
            noGroup = false;
        });
        if (noGroup) {
            alert("No group selected, please select a group!")
            return false;
        }
        var allNoAccess = true;
        $("table.security input:radio:checked").each(function () {
            if ($(this).val() != 'radioNoAccess') {
                allNoAccess = false;
            }
        });      


        if (allNoAccess) {
            if (confirm("This user has no outlet assigned yet. Continue?")) {
                $(".general").parent().click();
                return true;
            } else {
                $(".security").parent().click();
                return false;
            }
        } else {
            $(".general").parent().click();
        }
    });
});