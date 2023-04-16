var dialogComposite = {
    Row: null,
    Quantity: '',
    Name: '',

    init: function () {
        this.Name = $("input.variant");
        this.Quantity = $('#txtQty');



    },
    clear: function () {
        this.Quantity.val('');
        this.Name.val('');
        this.Row = null;
    },
    fillRowData: function (row) {
        this.Row = row;
        var item = row.data("item");
        this.Name.val(item.Variant.value);
        this.Name.data("item", item.Variant);
        this.Quantity.autoNumeric('set', item.Quantity)

        this.open();
    },
    reflectRowData: function (row) {
        var item = row.data("item");
        var code = item.Variant.Variant.Code;
        row.children().eq(1).text(item.Variant.Variant.Name);
        if (Constants.IsNotEmpty(code)) {
            row.children().eq(2).text(code);
        } else {
            row.children().eq(2).text("");
        }
        row.children().eq(3).text(Formatter.Number(item.Quantity));
        row.children().eq(5).text(Formatter.Number(item.Variant.Variant.UnitCost));
        row.children().eq(6).text(Formatter.Number(item.Variant.Variant.UnitCost * item.Quantity));
    },
    get: function () {
        var v = this.Name.data("item");
        var item = {
            Variant: v,
            Quantity: this.Quantity.autoNumeric('get')
        };
        return item;
    },
    open: function () {
        $("#dialogVariantComponent").dialog('open');
    }


}

var ProductManager = {
    DefaultModel: 'Default'
}

var variantAliasManager = {
    txtProduct: '',
    hfProductID: '',
    txtVariant: '',
    txtAlias: '',
    txtParent: '',
    init: function () {
        this.txtProduct = $(".txtProduct");
        this.hfProductID = $("#" + this.txtProduct.attr("hfID"));
        this.txtVariant = $("#txtModel");
        this.txtAlias = $("#txtName");
        this.txtParent = $(".txtVariantParent");
        this.txtVariant.keyup(function () {
            variantAliasManager.ChangeAlias();
        });
        this.txtProduct.keyup(function () {
            variantAliasManager.ChangeAlias();
        });
        this.txtParent.keyup(function () {
            variantAliasManager.ChangeParent();
        });
    },
    ChangeAlias: function (productName) {
        productName = productName || this.txtProduct.val();
        var alias = $.validator.format("{0} ({1})", productName, this.txtVariant.val());
        if (this.txtVariant.val() == ProductManager.DefaultModel) {
            alias = productName
        }
        this.txtAlias.val(alias);
    },
    ChangeParent: function () {
        var variantName = $("#txtModel").val();
        var alias = $.validator.format("Ratio towards this product ({0} to {1} ({2})) ", this.txtParent.val(), this.txtProduct.val(), variantName);
        $("#headRatio").text(alias);
    }
}

function OnProductSelect(ui) {
    variantAliasManager.ChangeAlias(ui.item.label);
};

function insertComponentRow(item) {
    var tableCart = $("table.component tbody");
    var formatRow = "<tr><td>{0}</td><td>{1}</td><td>{2}</td><td class='number'>{3}</td><td>{4}</td><td class='number cost'>{5}</td><td class='number cost'>{6}</td></tr>";
    var rowDeleteHTML = "<img src='/Images/Icon/Op/Delete.png' />";
    var UOM = '';
    if (item.Variant.Variant.UOM != null) {
        UOM = item.Variant.Variant.UOM;
    }
    rowCartHTML = jQuery.validator.format(formatRow, rowDeleteHTML, item.Variant.Variant.Name, item.Variant.Variant.Code, item.Quantity, UOM, item.Variant.Variant.UnitCost, item.Variant.id);
    var rowCartObject = $(rowCartHTML);

    rowCartObject.find("img").click(function () {
        $(this).closest("tr").remove();
        UpdateCost();
    });

    rowCartObject.dblclick(function () {
        var row = $(this);
        dialogComposite.fillRowData(row);
    });

    tableCart.append(rowCartObject);
    dialogComposite.clear();
    rowCartObject.data("item", item);
    dialogComposite.reflectRowData(rowCartObject);
    if (dialogOutletPrice.hfUnitCostByRole.val() == "False") {
        $(".cost").hide();
    }

}
function OnComponentOK() {
    var item = dialogComposite.get();

    if (dialogComposite.Row == null) {
        insertComponentRow(item);
    } else {
        var row = dialogComposite.Row;
        row.data("item", item);
        dialogComposite.reflectRowData(row);
    }
    dialogComposite.clear();
    UpdateCost();
}

function UpdateCost() {
    txtCost = $("input.txtUnitCost");
    var rows = $("table.component  tbody tr");
    var cost = 0;
    $.each(rows, function (index, row) {
        var item = $(this).data("item");
        cost = cost + (item.Quantity * item.Variant.Variant.UnitCost);
    });
    if (cost > 0) {
        var strCost = Formatter.Number(cost);
        txtCost.val(strCost);
    }



}

function OnVariantSelect(ui) {
    var wsUrl = "/Authenticated/Services/Catalog.asmx/GetVariantByID";
    $.ajax({
        url: wsUrl,
        data: "{'id' : '" + ui.item.id + "', 'entityID' : ''}",
        dataType: "json",
        type: "POST",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            var variant = data.d;
            ui.item.Variant = variant;
            dialogComposite.Name.data("item", ui.item);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(textStatus);
        }
    });


    //move focus after variant is selected
    $("#txtQty").focus();
}

var dialogOutletPrice = {
    Row: null,
    Outlet: '',
    Cost: '',
    CostCurrency: '',
    Price: '',
    PriceCurrency: '',
    PriceDisc: '',
    hfUnitCostByRole: '',


    init: function () {
        this.Outlet = $('#ddlEntity');
        this.Cost = $('#decInputUnitCost');
        this.CostCurrency = $('#ddlCostCurrencyDialog')
        this.Price = $('#decInputUnitPrice');
        this.PriceCurrency = $('#ddlPriceCurrencyDialog');
        this.PriceDisc = $('#decInputDiscPrice');
        this.hfUnitCostByRole = $("#hfUnitCostByRole");
        if (dialogOutletPrice.hfUnitCostByRole.val() == "False") {
            $(".cost").hide();
        }

    },
    clear: function () {
        this.Outlet.val('');
        this.Outlet.trigger("chosen:updated");
        this.Cost.val('');
        var defaultCurrency = $('#hfCurrency').val();
        this.CostCurrency.val(defaultCurrency);
        this.CostCurrency.trigger("chosen:updated");
        this.Price.val('');
        this.PriceCurrency.val(defaultCurrency);
        this.PriceCurrency.trigger("chosen:updated");
        this.PriceDisc.val('');
        this.Row = null;
    },
    fillRowData: function (row) {
        this.Row = row;
        var item = row.data("item");
        this.Outlet.val(item.EntityID);
        this.Outlet.trigger("chosen:updated");
        this.Cost.autoNumeric('set', item.UnitCost);
        this.CostCurrency.val(item.CostCurrencyID);
        this.CostCurrency.trigger("chosen:updated");
        this.Price.autoNumeric('set', item.UnitPrice);
        this.PriceCurrency.val(item.PriceCurrencyID);
        this.PriceCurrency.trigger("chosen:updated");
        this.PriceDisc.autoNumeric('set', item.PriceDiscount);

        this.open();

    },
    reflectRowData: function (row) {
        var item = row.data("item");

        row.children().eq(1).text(item.EntityName);
        if (Constants.IsNotEmpty(item.UnitCost)) {
            row.children().eq(2).text(item.CostCurrency + " " + Formatter.Number(item.UnitCost));
        }
        else {
            row.children().eq(2).text(item.CostCurrency + " " + 0);
        }
        if (Constants.IsNotEmpty(item.UnitPrice)) {
            row.children().eq(3).text(item.PriceCurrency + " " + Formatter.Number(item.UnitPrice));
        }
        else {
            row.children().eq(3).text(item.PriceCurrency + " " + 0);
        }


        row.children().eq(4).text(Formatter.Number(item.PriceDiscount) + "%");

    },
    get: function () {
        var currentID = this.Row == null ? Constants.GuidEmpty : this.Row.data("item").VariantID;
        var item = {
            VariantID: currentID,
            EntityID: this.Outlet.find('option:selected').val(),
            EntityName: this.Outlet.find('option:selected').text(),
            UnitCost: this.Cost.autoNumeric('get'),
            CostCurrencyID: this.CostCurrency.find('option:selected').val(),
            CostCurrency: this.CostCurrency.find('option:selected').text(),
            UnitPrice: this.Price.autoNumeric('get'),
            PriceCurrencyID: this.PriceCurrency.find('option:selected').val(),
            PriceCurrency: this.PriceCurrency.find('option:selected').text(),
            PriceDiscount: this.PriceDisc.autoNumeric('get')

        };
        return item;
    },
    open: function () {
        $("#dialogOutletPrice").dialog('open');
    }
}

function insertOutletRow(item) {
    var tableCart = $("table.outletprice tbody");
    var formatRow = "<tr><td>{0}</td><td>{1}</td><td class='number cost'>{2} {3}</td><td class='number'>{4} {5}</td><td>{6}%</td></tr>";
    var rowDeleteHTML = "<img src='/Images/Icon/Op/Delete.png' />";
    rowCartHTML = jQuery.validator.format(formatRow, rowDeleteHTML, item.EntityName, item.CostCurrency, item.UnitCost, item.PriceCurrency, item.UnitPrice, item.PriceDiscount, item.VariantID);
    var rowCartObject = $(rowCartHTML);

    rowCartObject.find("img").click(function () {
        $(this).closest("tr").remove();
    });

    rowCartObject.dblclick(function () {
        var row = $(this);
        dialogOutletPrice.fillRowData(row);
    });

    tableCart.append(rowCartObject);
    dialogOutletPrice.clear();
    rowCartObject.data("item", item);
    dialogOutletPrice.reflectRowData(rowCartObject);

    if (dialogOutletPrice.hfUnitCostByRole.val() == "False") {
        $(".cost").hide();
    }

}
function OnOutletPriceOK() {
    var item = dialogOutletPrice.get();

    if (dialogOutletPrice.Row == null) {
        insertOutletRow(item);
    } else {
        var row = dialogOutletPrice.Row;
        row.data("item", item);
        dialogOutletPrice.reflectRowData(row);
    }
    dialogOutletPrice.clear();
}

var dialogPricebook = {
    Row: null,
    Pricebook: '',
    UnitPrice: '',
    Disc: '',
    init: function () {
        this.Pricebook = $('#ddlPricebook');
        this.UnitPrice = $('#txtUnitPricePricebook');
        this.Disc = $('#txtDiscPricebook');
    },
    clear: function () {
        this.Pricebook.val('');
        this.UnitPrice.val('');
        this.Disc.val('');

        this.Pricebook.trigger("chosen:updated");

        this.Row = null;
    },
    fillRowData: function (row) {
        this.Row = row;
        var item = row.data("item");
        this.Pricebook.val(item.PricebookID);
        this.UnitPrice.val(item.UnitPrice);
        this.Disc.autoNumeric('set', item.PriceDiscount);

        this.Pricebook.trigger("chosen:updated");

        this.open();
    },
    reflectRowData: function (row) {
        var item = row.data("item");
        row.children().eq(1).text(item.PricebookName);
        if (Constants.IsNotEmpty(item.UnitPrice)) {
            row.children().eq(2).text(item.PriceCurrencySymbol + " " + Formatter.Number(item.UnitPrice));
        }
        else {
            row.children().eq(2).text(item.PriceCurrencySymbol + " " + 0);
        }
        row.children().eq(3).text(Formatter.Number(item.PriceDiscount) + "%");
    },
    get: function () {
        var currentID = this.Row == null ? Constants.GuidEmpty : this.Row.data("item").VariantID;
        var symbol = $("#ddlPriceCurrency")
        var item = {
            VariantID: currentID,
            PricebookID: this.Pricebook.find('option:selected').val(),
            PricebookName: this.Pricebook.find('option:selected').text(),
            PriceCurrencySymbol: symbol.find('option:selected').text(),
            UnitPrice: this.UnitPrice.autoNumeric('get'),
            PriceDiscount: this.Disc.autoNumeric('get')
        };
        return item;
    },
    open: function () {
        $("#dialogPricebook").dialog('open');

    }
}

function insertPricebookRow(item) {
    var tableCart = $("table.pricebook tbody");
    var formatRow = "<tr><td>{0}</td><td>{1}</td><td class='number'>{2} {3}</td><td>{4}%</td></tr>";
    var rowDeleteHTML = "<img src='/Images/Icon/Op/Delete.png' />";
    rowCartHTML = jQuery.validator.format(formatRow, rowDeleteHTML, item.PricebookName, item.PriceCurrencySymbol, item.UnitPrice, item.PriceDiscount, item.VariantID);
    var rowCartObject = $(rowCartHTML);

    rowCartObject.find("img").click(function () {
        $(this).closest("tr").remove();
    });

    rowCartObject.dblclick(function () {
        var row = $(this);
        dialogPricebook.fillRowData(row);
    });

    tableCart.append(rowCartObject);
    dialogPricebook.clear();
    rowCartObject.data("item", item);
    dialogPricebook.reflectRowData(rowCartObject);

}
function OnPricebookOK() {
    var item = dialogPricebook.get();

    if (dialogPricebook.Row == null) {
        insertPricebookRow(item);
    } else {
        var row = dialogPricebook.Row;
        row.data("item", item);
        dialogPricebook.reflectRowData(row);
    }
    dialogPricebook.clear();
}

$(document).ready(function () {
    dialogComposite.init();
    variantAliasManager.init();
    dialogOutletPrice.init();
    dialogPricebook.init();
    var sessionItemsString = $("#hfItemsJSON").val();
    if (sessionItemsString != "") {
        var sessionItems = jQuery.parseJSON(sessionItemsString);

        $.each(sessionItems, function (index, item) {
            insertComponentRow(item);
        });
    }
    var sessionItemOutletString = $("#hfitemOutletPriceJSON").val();
    if (sessionItemOutletString != "") {
        var sessionItems = jQuery.parseJSON(sessionItemOutletString);

        $.each(sessionItems, function (index, item) {
            insertOutletRow(item);
        });
    }
    var sessionItemPricebookString = $("#hfitemPriceBookJSON").val();
    if (sessionItemPricebookString != "") {
        var sessionItems = jQuery.parseJSON(sessionItemPricebookString);

        $.each(sessionItems, function (index, item) {
            insertPricebookRow(item);
        });
    }
    $("#btnAddPricebook").click(function () {
        dialogPricebook.clear();
    });
    $("#btnAddVariant").click(function () {
        dialogComposite.clear();
    });
    $("#btnAddOutletPrice").click(function () {
        dialogOutletPrice.clear();
    });
});

function CopyJSONData() {
    var rows = $("table.component  tbody tr");
    var component = [];

    $.each(rows, function (index, row) {
        var item = $(this).data("item");
        var newItem = {

            ComponentID: item.Variant.id,
            Quantity: item.Quantity

        };
        component.push(newItem);
    });

    var componentJSONString = JSON.stringify(component);
    $("#hfItemsJSON").val(componentJSONString);

    var entityrows = $("table.outletprice  tbody tr");
    var outletPrice = [];

    $.each(entityrows, function (index, row) {
        var itemOutletPrice = $(this).data("item");
        var newItem = {
            VariantID: itemOutletPrice.id,
            EntityID: itemOutletPrice.EntityID,
            UnitCost: itemOutletPrice.UnitCost,
            CostCurrencyID: itemOutletPrice.CostCurrencyID,
            UnitPrice: itemOutletPrice.UnitPrice,
            PriceCurrencyID: itemOutletPrice.PriceCurrencyID,
            PriceDiscount: itemOutletPrice.PriceDiscount
        };
        outletPrice.push(newItem);
    });

    var outletPriceJSONString = JSON.stringify(outletPrice);
    $("#hfitemOutletPriceJSON").val(outletPriceJSONString);

    var entityrows = $("table.pricebook  tbody tr");
    var pricebook = [];

    $.each(entityrows, function (index, row) {
        var itemPricebook = $(this).data("item");
        var newItem = {
            VariantID: itemPricebook.id,
            PricebookID: itemPricebook.PricebookID,
            UnitPrice: itemPricebook.UnitPrice,
            PriceDiscount: itemPricebook.PriceDiscount
        };
        pricebook.push(newItem);
    });

    var pricebookJSONString = JSON.stringify(pricebook);
    $("#hfitemPriceBookJSON").val(pricebookJSONString);
}