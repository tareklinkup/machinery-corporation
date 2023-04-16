var myProductManager = {
    ui: {
        name: '',
        cost: '',
        price: '',
        discount: '',
        type: '',
        uom: '',
        tagsInput: '',
        table: '',
        divTable: '',
        Image: '',
        hfUnitCostRole: '',
        
        init: function () {
            this.name = $("#txtName");
            this.cost = $("#txtUnitCost");
            this.price = $("#txtUnitPrice");
            this.discount = $("#txtUnitPriceDiscount");
            this.type = $("#ddlMultipleType_chosen");
            this.uom = $("#ddlMultipleUOM_chosen");
            this.tagsInput = $("#txtModelMultiple_tagsinput");
            this.table = $("table.cart tbody");
            this.divTable = $("#divTable");
            this.Image = $("#fuImage");
            this.hfUnitCostRole = $("#hfUnitCostRole");
        },
    },
    dialog: {
        object: {
            Dialog: '',
            Row: null, //temporary storage
            Model: '',
            Code: '',
            Price: '',
            Discount: '',
            Cost: '',
            TypeID: '',
            UOM: '',
            Name: '',
            UnitQuantity: '',
            Ratio: '',
            divRatio: '',
            hfContentVisible: '',
            divContent:'',

            init: function () {
                this.Dialog = $("#dialogItem");
                this.Model = $("#txtItemModel");
                this.Code = $("#txtItemCode");
                this.Price = $("#txtItemPrice");
                this.Discount = $("#txtItemPriceDiscount");
                this.Cost = $("#txtItemCost");
                this.TypeID = $("#ddlType");
                this.UOM = $("#ddlUOM");
                this.Name = $("#txtItemName");
                this.UnitQuantity = $("#txtUnitQuantity");
                this.Ratio = $("#txtRatio");
                this.divRatio = $("div.divRatio");
                this.hfContentVisible = $("#hfVisibleContent");
                this.divContent = $("div.divContent");
                this.divRatio.hide();

                this.TypeID.change(function () {
                    if ($(this).val() == 7) {
                        myProductManager.dialog.object.divRatio.show();
                    } else {
                        myProductManager.dialog.object.divRatio.hide();
                    }
                });
                this.Model.keyup(function () {
                    myProductManager.dialog.refreshPlaceholder();
                });

                if (myProductManager.dialog.object.hfContentVisible.val() == "False" ) {
                    this.divContent.addClass('display-none');
                }
            }
        },
        trigger: '',

        refreshPlaceholder: function () {
            var productNameInput = $("#txtName");
            var variantName = jQuery.validator.format("{0} ({1})", productNameInput.val(), myProductManager.dialog.object.Model.val());
            myProductManager.dialog.object.Name.attr("placeholder", variantName);
        },
        clear: function () {
            this.object.Model.val('');
            this.object.Code.val('');
            this.object.Price.val('');
            this.object.Discount.val('');
            this.object.Cost.val('');
            this.object.TypeID.val(1);
            this.object.TypeID.trigger("chosen:updated");
            this.object.UOM.val('');
            this.object.UOM.trigger("chosen:updated");
            this.object.UnitQuantity.val('');
            this.object.Name.val('');
            this.object.Ratio.val('');
            this.trigger = null;
            this.object.divRatio.hide();

        },
        fillRowData: function (row) {
            this.trigger = row;
            var item = row.data("item");
            if (item.TypeID == 7) {
                this.object.divRatio.show();
            } else {
                this.object.divRatio.hide();
            }

            this.object.Model.val(item.Model);
            this.object.Code.val(item.Code);
            this.object.Price.autoNumeric('set', item.Price);
            this.object.Discount.autoNumeric('set', item.Discount);
            if (myProductManager.ui.hfUnitCostRole.val() == "False")
            {
                $(".cost").hide();
            }
            this.object.Cost.autoNumeric('set', item.Cost);
            this.object.TypeID.val(item.TypeID);
            this.object.TypeID.trigger("chosen:updated");
            this.object.UOM.val(item.UOM);
            this.object.UOM.trigger("chosen:updated");
            this.object.UnitQuantity.autoNumeric('set', item.UnitQuantity);
            this.object.Ratio.autoNumeric('set', item.Ratio);


            //Update Placeholder
            this.refreshPlaceholder();

            this.open();
        },
        get: function () {
            var currentID = '';
            if (this.trigger != null) {
                currentID = this.trigger.data("item").ID;
            }

            var item = {
                ID: currentID,
                Model: this.object.Model.val(),
                Code: this.object.Code.val(),
                Price: this.object.Price.autoNumeric('get'),
                Discount: this.object.Discount.autoNumeric('get'),
                Cost: this.object.Cost.autoNumeric('get'),
                TypeID: this.object.TypeID.val(),
                UOM: this.object.UOM.val(),
                UnitQuantity: this.object.UnitQuantity.autoNumeric('get'),
                Name: this.object.Name.val(),
                Ratio: this.object.Ratio.autoNumeric('get')
            };

            return item;
        },
        open: function () {
            this.object.Dialog.dialog('open');
        }
    },
    multipleText: {
        Model: '',
        Price: '',
        Discount: '',
        Cost: '',
        UOM: '',
        TypeID: '1',
        tagText: '',
        thRatio: '',
        init: function () {
            this.Model = $("#txtModelMultiple");
            this.Price = $("#txtUnitPrice");
            this.Discount = $("#txtItemPriceDiscount");
            this.Cost = $("#txtUnitCost");
            this.TypeID = $("#ddlMultipleType");
            this.UOM = $("#ddlMultipleUOM");
            this.tagText = $("div.tagsinput span.tag");
            this.thRatio = $("td.ratio");

            this.TypeID.change(function () {
                var rows = myProductManager.ui.table.children();
                var type = $(this).val();
                if (rows.length > 0) {
                    var itemsJSON = [];
                    rows.each(function () {
                        var item = $(this).data("item");
                        if (Constants.IsEmpty(item.UOM)) {
                            item.UOM = Constants.GuidEmpty;
                        }
                        item.TypeID = type;
                        if (type == 7) {
                            item.Ratio = 1;
                            $(".ratio").show();
                        } else {
                            $(".ratio").hide();
                            item.Ratio = 0;
                        }
                        itemsJSON.push(item);
                    });
                    myProductManager.ui.table.children().remove();
                    $.each(itemsJSON, function (index, value) {
                        myProductManager.addObject(value);
                    });
                }
            });
        },
        create: function () {
            this.Model.tagsInput({
                defaultText: 'e.g. Red,Green,Blue',
                height: 20
            });
        },
        clear: function () {
            this.Model.val('');
            $("div.tagsinput span.tag").remove();
        },
        get: function () {
            var Ratio = 0;
            if(this.TypeID.val()==7){
                Ratio = 1;
            }
            var item = {
                Model: this.Model.val(),
                Price: this.Price.autoNumeric('get'),
                Discount: (this.Discount.val() != "") ? this.Discount.autoNumeric('get') : 0,
                Cost: this.Cost.autoNumeric('get'),
                TypeID: this.TypeID.val(),
                UOM: this.UOM.val(),
                Ratio: Ratio
            };
            return item;

        }
    },
    init: function () {
    },
    //add from dialog
    add: function (item) {
        if (item.Model == '') {
            alert("Model is required!");
            this.dialog.object.Model.focus();
            return false;
        }

        if (this.dialog.trigger == null) {
            if (!this.modelIsExist(item)) {
                this.addObject(item);
            }
            else {
                return false;
            }
        }
        else {
            var row = this.dialog.trigger;
            var x = row.ID;
            row.data("item", item);
            this.reflectRowData(row);
            this.dialog.clear();
        }

        
        
    },
    //add from input tags
    addArray: function (multipleItem) {
        var variantArray = multipleItem.Model.split(",");
        if (multipleItem.TypeID == 7) {
            myProductManager.multipleText.thRatio.show();
        } else {
            myProductManager.multipleText.thRatio.hide();
        }

        for (var i in variantArray) {
            var item = {
                ID: '',
                Model: variantArray[i],
                Code: '',
                Price: multipleItem.Price,
                Discount: multipleItem.Discount,
                Cost: multipleItem.Cost,
                TypeID: multipleItem.TypeID,
                UOM: multipleItem.UOM,
                UnitQuantity: 0,
                Ratio: multipleItem.Ratio
            };
            if (!this.modelIsExist(item)) {
                this.addObject(item);
            }
        }

        
    },
    addObject: function (variant) {
        var rowHTML = "<tr class='hoverHighlight' title='Click to Edit'><td>{0}</td><td></td><td></td><td class='number ratio'></td><td class='cost'></td><td class='price'></td><td class='number'></td></tr>";
        var rowDeleteHTML = "<img src='/Images/Icon/Op/Delete.png' title='Click to Remove'/>";

        var result = jQuery.validator.format(rowHTML, rowDeleteHTML);
        var row = $(result);
        row.find("img").click(function () {
            $(this).closest("tr").remove();
            var tableRow = myProductManager.ui.table.children('tr');
            if (tableRow.length < 1) {
                myProductManager.ui.divTable.css('display', 'none');
            }
        });

        row.click(function () {
            var row = $(this);

            myProductManager.dialog.fillRowData(row);
        });

        this.ui.table.append(row);
        this.dialog.clear();
        this.multipleText.clear();
        row.data("item", variant);
        this.reflectRowData(row);
        var tableRow = this.ui.table.children('tr');
        if (tableRow.length > 0) {
            this.ui.divTable.css('display', 'initial');
        }

        if (myProductManager.ui.hfUnitCostRole.val() == "False") {
            $(".cost").hide();
        }

        if (variant.TypeID == 7) {
            myProductManager.multipleText.thRatio.show();
            $(".ratio").show();
        }
    },
    remove: function (row) {

    },
    reflectRowData: function (row) {
        var item = row.data("item");

        row.children().eq(1).text(item.Model);

        if (item.Code != null) {
            row.children().eq(2).text(item.Code);
        }
        if (item.TypeID == 7) {
            row.children().eq(3).text((Formatter.Number(item.Ratio) != 0) ? Formatter.Number(item.Ratio) : "");
        }
        row.children().eq(4).text(Formatter.Number(item.Cost));
        row.children().eq(5).text(Formatter.Number(item.Price));
        row.children().eq(6).text((Formatter.Number(item.Discount) != 0) ? Formatter.Number(item.Discount) : "");
    },
    modelIsExist: function (item) {
        var rows = this.ui.table.children();
        var exist = false;
        rows.each(function () {
            var rowModel = $(this).data("item").Model.toLowerCase();
            var rowCode = $(this).data("item").Code;

            if (rowCode == null) {
                rowCode = "";
            } else {
                rowCode = rowCode.toLowerCase();
            }

            //Check if there is any variant with the same Name
            if (rowModel == item.Model.toLowerCase()) {
                if (rowCode == item.Code.toLowerCase()) {
                    exist = true;

                    if (item.Code != '') {
                        alert("Variant with name " + item.Model + " and code " + item.Code + " is already exist!");
                    } else {
                        alert("Variant with name " + item.Model + " is already exist!");
                    }
                }
            }
                //Check if there is duplicate variant code
            else if (rowCode == item.Code.toLowerCase()) {
                if (item.Code != '' && rowCode == item.Code.toLowerCase()) {
                    exist = true;
                    alert("Variant with code " + item.Code + " is already exist!");
                }
            }
        });

        return exist;
    }
}





$(document).ready(function () {
    myProductManager.dialog.object.init();
    myProductManager.ui.init();
    myProductManager.multipleText.init();
    myProductManager.multipleText.create();

    //Populate Cart with existing items
    var sessionItemsString = $("#hfItemsJSON").val();
    if (sessionItemsString != "") {
        var sessionItems = jQuery.parseJSON(sessionItemsString);
        $.each(sessionItems, function (index, value) {
            myProductManager.addObject(value);
        });
    }

    jQuery.extend(jQuery.validator.messages, {
        required: "*"
    });

    $("form").validate({
        ignore: ""
    });

    $("a.more").click(function () {
        $("table.more").toggle();
    });

    $('body').bind('keyup', function (e) {
        //Press F4 to open dialog
        if ((e.which && e.which == 115) || (e.keyCode && e.keyCode == 115)) {
            myProductManager.dialog.open();
        }
    });

    $('#chkMultiple').click(function () {
        $('#variantBlock').toggle(this.checked);
    })

    $('#removeImage').click(function () {
        if ($("#chkBoxRemoveImage").prop('checked') == true) {
            $("#chkBoxRemoveImage").prop('checked', false);
            $(this).removeClass('remove');
            $(this).prop('title', 'Click to Remove');
        } else {
            $("#chkBoxRemoveImage").prop('checked', true);
            $(this).addClass('remove');
            $(this).prop('title', 'Click to Cancel Remove');
        }
    })
});

function FileUploadValidation() {
    var file = myProductManager.ui.Image.val();
    if (file) {
        var arrNameExt = file.split('.');
        arrNameExt.reverse();
        if ($.inArray(arrNameExt[0].toLowerCase(), Constants.ImageExtension) > -1) {
            return true;
        } else {
            alert("Please upload file image (JPG, JPEG, GIF or PNG)");
            return false;
        }
    } else {
        return true;
    }
}

function OnSubmit() {
    var multipleItem = myProductManager.multipleText.get();
    if (multipleItem.Model != '') {
        OnCartMultipleOK();
    }
    var fileIsValid = FileUploadValidation();
    var valid = $("form").valid();
    if (valid && fileIsValid) {
        var rows = myProductManager.ui.table.children();
        if (rows.length == 0 && ($("#chkMultiple").attr('checked') == false)) {
            valid = confirm("You have no variants for this product. You must have at least one variant to sell this product. Continue?");
        }

        if (valid) {
            var itemsJSON = [];
            rows.each(function () {
                var item = $(this).data("item");
                if (Constants.IsEmpty(item.UOM)) {
                    item.UOM = Constants.GuidEmpty;
                }
                itemsJSON.push(item);
            });

            var itemsJSONString = JSON.stringify(itemsJSON);
            $("#hfItemsJSON").val(itemsJSONString);
            return true;
        }
    }

    return false;
}

function OnCartOK() {
    var item = myProductManager.dialog.get();
    return myProductManager.add(item);
};

function OnCartMultipleOK() {
    var multipleItem = myProductManager.multipleText.get();
    if (multipleItem.Model == '') {
        alert("Please enter variant separated by comma Ex: Red,Green,Blue");
        return false;
    }
    myProductManager.addArray(multipleItem);
}

function openDialog() {
    myProductManager.dialog.clear();
    var firstVariant = myProductManager.ui.table.children('tr:first-child');

    myProductManager.dialog.object.Price.val(firstVariant.find('.price').html());
    myProductManager.dialog.object.Cost.val(firstVariant.find('.cost').html());
    myProductManager.dialog.open();
}