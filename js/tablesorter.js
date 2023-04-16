$(document).ready(function () {
    $("table.sortable").tablesorter({
        headers: {
            '.sort-false': {
                sorter: false
            }
        },
        widgets: ['staticRow']
    });
});