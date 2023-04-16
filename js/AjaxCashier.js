var mySectionManager = {
    General: {
        Body: '',
        Form: '',
        LinkFullScreen: '',
        PageTitle: '',
        AllDialog: '',
        DialogItem: '',
        DialogEntity: '',
        Print: '',
        Loading: '',
        BtnPay: '',
        LinkAdd: '',
        TxtBarcode: '',
        divCreateVariant: '',
        fullscreenbuttonlist: '',
        BtnSendTransaction: '',
        BtnSyncProduct: '',
        LblNote: '',
        fullscreenbuttonright: '',
        BtnPark: '',
        BtnRetrieve: '',
        SpanMemberName: '',
        txtEmailInvoice: '',
        SectionSales: '',
        RadButtonQueryProduct: '',
        RadButtonQueryOrder: '',
        DialogQueryMode: '',
        DivCustomerGroup: '',
        DialogDiscount: '',
        DialogCache: '',
        init: function () {
            this.Body = $("body");
            this.Form = $("form");
            this.LinkFullScreen = $("a.fullscreen");
            this.PageTitle = $("header h1.sell span");
            this.AllDialog = $('.dialog');
            this.DialogItem = $("#dialogItem");
            this.DialogEntity = $("#dialogEntity");
            this.Print = $('div.print_containers');
            this.Loading = $('#loading');
            this.BtnPay = $("#buttonPay");
            this.LinkAdd = $("li.add a");
            this.TxtBarcode = $('input.txtBarcode');
            this.fullscreenbuttonlist = $(".fullscreen-button-list button");
            this.divCreateVariant = $("#divCreateVariant");
            this.BtnSendTransaction = $("#btnSendTransaction");
            this.BtnSyncProduct = $("#btnSyncProduct");
            this.LblNote = $('div.fullscreen-note p');
            this.fullscreenbuttonright = $('.fullscreen-button-right button');
            this.BtnPark = $('#btnPark');
            this.BtnRetrieve = $('#btnRetrieve');
            this.SpanMemberName = $("a.member span");
            this.txtEmailInvoice = $('#txtInvoiceReceiverEmail');
            this.SectionSales = $("section.sales");
            this.RadButtonQueryProduct = $("#queryProduct");
            this.RadButtonQueryOrder = $("#queryOrder");
            this.DialogQueryMode = $("#dialogQueryMode");
            this.DivCustomerGroup = $(".customer-group");
            this.DialogDiscount = $("#dialogDiscount");
            this.DialogCache = $("#dialogCache");

        },
        Clear: function () {
            if (myStorageManager.POSStorage.AppConfig.Park.Mode == 1) {
                this.BtnPark.attr("dialogid", "dialogParkSelect");
                this.BtnPark.attr("validate", "OnGetVacantTable");

            }
            this.DivCustomerGroup.html('');
        }
    },
    QuickKey: {
        Section: '',
        Tabs: '',
        Group: '',
        Key: '',
        LinkConfigureQuickkey: '',
        init: function () {
            this.Section = $("section.quickKeys");
            this.Tabs = $("section.quickKeys #tabs");
            this.Group = $("section.quickKeys > div > ul").children();
            this.LinkConfigureQuickkey = $("a#LinkConfigureQuickkey");
            this.Key = $("ul.quickKeyItems > li > a");
        }
    },
    Cashier: {
        Self: '',
        SalesOrder: {
            HfSalesOrderID: '',
            HfItemJson: '',
            myRegisterPicker: '',
            DPInvDate: '',
            TxtNumber: '',
            TxtContact: '',
            HfCustomer: '',
            LinkAddCustomer: '',
            DdlSales: '',
            DdlSalesChosen: '',
            HfSalesID: '',
            DdlPOType: '',
            TrPOType: '',
            DdlPromotion: '',
            trPromotion: '',
            TxtDisc1: '',
            TxtDisc2: '',
            TxtDiscAmount: '',
            BtnDiscount: '',
            TxtNote: '',
            DdlTax: '',
            DdlCurrency: '',
            TrCurrency: '',
            CurrencyRate: '',
            TxtCurrencyRate: '',
            LblCurrency: '',
            TxtMemberPoint: '',
            TxtParkLabel: '',
            TxtNoteOverall: '',
            TxtPONumber: '',
            TxtDeposit: '',
            DivDeposit: '',
            DdlDepositPaymentMethod: '',
            init: function () {
                this.HfSalesOrderID = $('#hfSalesOrderID');
                this.HfItemJson = $('#hfItemsJSON');
                this.myRegisterPicker = $('#myRegisterPicker');
                this.DPInvDate = $('.invDate');
                this.TxtNumber = $('#txtNumber');
                this.TxtContact = $('.txtContact');
                this.HfCustomer = $('#' + this.TxtContact.attr('hfID'));
                this.LinkAddCustomer = $("a.btn-add");
                this.DdlSales = $('#ddlSales');
                this.DdlSalesChosen = $('#ddlSales_chosen');
                this.HfSalesID = $("#hfSalesID");
                this.DdlPOType = $('#ddlPOType');
                this.TrPOType = $('#trPOType');
                this.DdlPromotion = $('#DdlPromotion');
                this.trPromotion = $('.trPromotion');
                this.TxtDisc1 = $('.disc1');
                this.TxtDisc2 = $('.disc2');
                this.TxtDiscAmount = $('.discAmount');
                this.BtnDiscount = $('#btnDiscount');
                this.TxtNote = $('#txtNote');
                this.DdlTax = $('#ddlTax');
                this.DdlCurrency = $('#ddlCurrency');
                this.TrCurrency = $("#trCurrency");
                this.CurrencyRate = $('.currency');
                this.TxtCurrencyRate = $('.currencyRate');
                this.TxtMemberPoint = $('.memberPoint');
                this.LblCurrency = $('#lblCurrency');
                this.TxtNoteOverall = $('.txtNote');
                this.TxtParkLabel = $('#txtParkLabel')
                this.TxtPONumber = $('#txtPONumber');
                this.TxtDeposit = $('#txtDeposit');
                this.DivDeposit = $('#divDeposit');
                this.DdlDepositPaymentMethod = $('#ddlDepositPaymentMethod');
            },
            Clear: function () {
                this.HfSalesOrderID.val(Constants.GuidEmpty);
                this.HfCustomer.val('');
                this.TxtContact.val('');
                this.DdlSales.val(this.DdlSales.attr("default"));
                this.DdlSales.trigger("chosen:updated");
                this.DdlPromotion.prop('selectedIndex', 0);
                this.DdlPromotion.trigger("chosen:updated");
                this.TxtDisc1.val('0');
                this.TxtDisc2.val('0');
                this.TxtDiscAmount.val('0');
                this.TxtNote.val('');
                this.TxtPONumber.val('');
                this.DdlTax.prop('selectedIndex', 0);
                var DefaultTaxType = myRegister.outletInfo.DefaultTaxType;
                if (Constants.IsNotEmpty(DefaultTaxType)) {
                    this.DdlTax.val(DefaultTaxType);
                }
                this.DdlTax.trigger("chosen:updated")
                this.TxtMemberPoint.val('0');
                this.TxtNoteOverall.val('');
                this.TxtParkLabel.val('');
                this.TxtDeposit.val('0');
                if (myStorageManager.POSStorage.AppConfig.Park.Deposit.Enabled) {
                    this.TxtDeposit.val(myStorageManager.POSStorage.AppConfig.Park.Deposit.DefaultAmount);
                }
                this.DdlDepositPaymentMethod.prop('selectedIndex', 0);
                this.DdlDepositPaymentMethod.trigger("chosen:updated");

            }
        },
        Payment: {
            DdlEntity: '',
            RadButtonPaymentTypeChecked: '',
            DPDateOn: '',
            TdFirstPaymentMethod: '',
            DdlPaymentMethod: '',
            DdlPaymentMethod2: '',
            TxtAmount: '',
            TxtChange: '',
            DivChange: '',
            LinkSecondPayment: '',
            DivSecondPayment: '',
            TxtCode: '',
            TxtNote: '',
            TxtDaysDue: '',
            DPDue: '',
            DPCustomField: '',
            DivCustomField: '',
            ThCustomField: '',
            RadButtonDeliveryChecked: '',
            TableMore: '',
            TablePaymentCash: '',
            TablePaymentCredit: '',
            TrRowDelivery: '',
            DialogPayment: '',
            DialogPark: '',
            DialogRetrieve: '',
            DialogBill: '',
            TableRowPaymentType: '',
            hrHeader: '',
            RadbuttonProcessDeliveryChecked: '',
            init: function () {
                this.DdlEntity = $('#ddlEntity');
                this.RadButtonPaymentTypeChecked = $('.paymentType');
                this.DPDateOn = $('.dialogDate');
                this.TdFirstPaymentMethod = $('#tdFirstPaymentMethod');
                this.DdlPaymentMethod = $('#ddlPaymentMethod');
                this.DdlPaymentMethod2 = $('#ddlPaymentMethod2');
                this.TxtAmount = $('.dialogAmount');
                this.TxtChange = $('.change');
                this.DivChange = $('div#divChange');
                this.LinkSecondPayment = $('a.btn-split');
                this.DivSecondPayment = $('div.secondPayment');
                this.TxtCode = $('.dialogCode');
                this.TxtNote = $('.dialogNote');
                this.TxtDaysDue = $('.txtDaysDue'),
                this.DPDue = $('.dialogDue');
                this.DPCustomField = $('.customField');
                this.DivCustomField = $("#divCustomField");
                this.ThCustomField = $("#thCustomField");
                this.RadButtonDeliveryChecked = $('.delivery');
                this.TableMore = $('table.more');
                this.TablePaymentCash = $('div.paymentDetail > table:first-child');
                this.TablePaymentCredit = $('div.paymentDetail > table:last-child');
                this.TrRowDelivery = $('tr.stock');
                this.DialogPayment = $('#dialogPayment');
                this.DialogPark = $('#dialogPark');;
                this.DialogRetrieve = $('#dialogRetrieve');;
                this.DialogBill = $('#dialogBill');;
                this.TableRowPaymentType = $('#trPaymentType');;
                this.hrHeader = $('#hrHeader');
                this.RadbuttonProcessDeliveryChecked = $('#rbtnProcessDelivery');
            },
            Clear: function () {
                this.TxtAmount.removeAttr('deposit');
                this.TxtAmount.removeAttr('depositDate');
                this.DdlPaymentMethod.prop('selectedIndex', 0);
                this.DdlPaymentMethod.trigger("chosen:updated");

                this.PaymentButtonClear();

                this.DdlPaymentMethod2.prop('selectedIndex', 0);
                this.DdlPaymentMethod2.trigger("chosen:updated");
                this.TxtCode.val('');
                this.TxtNote.val('');
                this.DivChange.hide();
                this.LinkSecondPayment.hide();
                this.DivSecondPayment.hide();
                this.TableMore.hide();
                this.DdlEntity.val(myRegister.getEntityID());
                this.DdlEntity.trigger("chosen:updated");
                this.PaymentTypeSetDefault();
                this.RadButtonDeliveryChecked.find('[value="' + myStorageManager.POSStorage.AppConfig.Delivery.InstantSalesOrderDelivery + '"]').attr('checked', 'checked');
                if (myStorageManager.POSStorage.AppConfig.Delivery.InstantSalesOrderDelivery) {
                    this.TrRowDelivery.show();
                }
                else {
                    this.TrRowDelivery.hide();
                }
            },
            PaymentTypeSetDefault: function () {

                if (myStorageManager.POSStorage.AppConfig.POS.PaymentTypeDefault == 0) {
                    this.RadButtonPaymentTypeChecked.find('[value="0"]').prop("checked", true);
                    this.TablePaymentCash.show();
                    this.TablePaymentCredit.hide();
                }
                else {
                    this.RadButtonPaymentTypeChecked.find('[value="1"]').prop("checked", true);
                    this.TablePaymentCash.hide();
                    this.TablePaymentCredit.show();
                    if (myStorageManager.POSStorage.AppConfig.Delivery.SalesOrderPaymentBeforeDelivery) {
                        this.RadbuttonProcessDeliveryChecked.find('[value="1"]').attr('checked', 'checked');
                    }
                }
            },
            PaymentButtonClear: function () {
                this.TdFirstPaymentMethod.find("a").removeClass("active");
                this.TdFirstPaymentMethod.find("a:first-child").addClass("active");
            },
            PaymentButtonSelect: function (paymentID) {
                this.TdFirstPaymentMethod.find("a").removeClass("active");
                this.TdFirstPaymentMethod.find("a[paymentID=" + paymentID + "]").addClass("active");
            },
            FirstPaymentMethodID: function () {
                if (myStorageManager.POSStorage.AppConfig.POS.PaymentInputType == PaymentInputType.Button) {
                    var selectedID = mySectionManager.Cashier.Payment.TdFirstPaymentMethod.find("a.active").attr("paymentID");
                    return Constants.IsNotEmpty(selectedID) ? selectedID : 0;
                } else {
                    return Constants.IsNotEmpty(mySectionManager.Cashier.Payment.DdlPaymentMethod.val()) ? mySectionManager.Cashier.Payment.DdlPaymentMethod.val() : 0;
                }

            }
        },
        init: function () {
            this.Self = $('section.cashier');
            this.SalesOrder.init();
            this.Payment.init();
        },
        Clear: function () {
            this.SalesOrder.Clear();
            this.Payment.Clear();
        },
    },
    Complete: {
        Self: '',
        LinkInvoiceNumber: '',
        LinkSalesOrder: '',
        LinkTax: '',
        LinkInvoice: '',
        LinkDelivery: '',
        LinkInvDlv: '',
        LinkQRCode: '',
        LinkNew: '',
        LinkEdit: '',
        LinkCommission: '',
        LiQrCode: '',
        LiCommission: '',
        DivAction: '',
        DivNotification: '',
        LinkRetrySubmit: '',
        init: function () {
            this.Self = $('section.complete');
            this.LinkInvoiceNumber = $('#linkInvoiceNumber');
            this.LinkSalesOrder = $("#linkSalesOrder")
            this.LinkTax = $('#linkTax');
            this.LinkInvoice = $('#linkInvoice');
            this.LinkDelivery = $('#linkDelivery');
            this.LinkInvDlv = $('#linkInvDlv');
            this.LinkQRCode = $('#linkQRCode');
            this.LinkNew = $('#aNew');
            this.LinkEdit = $('#aEdit');
            this.LinkCommission = $('#linkCommission');
            this.LiQrCode = $('#liQrCode');
            this.LiCommission = $('#liCommission');
            this.DivAction = $('#divCompleteAction');
            this.DivNotification = $('#divCompleteNotification');
            this.LinkRetrySubmit = $('#linkRetrySubmit');
        }
    },
    init: function () {
        this.General.init();
        this.QuickKey.init();
        this.Cashier.init();
        this.Complete.init();
    },
    Clear: function () {
        this.Cashier.Clear();
        this.General.Clear();
    },
    Switch: function () {
        this.Cashier.Self.toggle();
        this.Complete.Self.toggle();
    }
}
var myStorageManager = {
    POSStorage: '',
    init: function () {
        if (POSSettings.isOnline()) {
            this.FetchFromServer();
        } else {
            this.FetchFromStorage();
        }
    },
    // FetchFromServer: function () {
    //     $.ajax({
    //         url: "/Authenticated/Services/POS.asmx/GetPOSStorage",
    //         dataType: "json",
    //         type: "POST",
    //         async: false,
    //         contentType: "application/json; charset=utf-8",
    //         dataFilter: function (data) { return data; },
    //         success: function (data) {
    //             myStorageManager.POSStorage = data.d;

    //         },
    //         error: function (XMLHttpRequest, textStatus, errorThrown) {
    //             alert(posAlertMessage.failGetMenu);
    //         }
    //     });
    // },
    FetchFromStorage: function () {
        try {
            myStorageManager.POSStorage = new Object();
            myStorageManager.POSStorage = myLocalStorage.config.data;
            if (myStorageManager.POSStorage.AppConfig != undefined) {
            } else {
                //manifest use, offline and no local storage then cannot use offline support
                alert(posAlertMessage.failGetLocalPosStorage);
            }
        } catch (ex) {
            alert(posAlertMessage.failGetLocalPosStorage);
        }
    },
    GenerateCurrency: function () {
        var options = "";

        if (myStorageManager.POSStorage.Currencies.length > 0) {
            $.each(myStorageManager.POSStorage.Currencies, function (index, item) {
                var option = "<option value=\"" + item.ID + "\">" + item.Symbol + "</option>";
                options += option;
            })
        }
        if (myStorageManager.POSStorage.Currencies.length <= 1) {
            mySectionManager.Cashier.SalesOrder.TrCurrency.hide();
        }
        mySectionManager.Cashier.SalesOrder.DdlCurrency.html(options);
        mySectionManager.Cashier.SalesOrder.DdlCurrency.val(myStorageManager.POSStorage.AppConfig.Core.Defaults.CurrencyID);
        mySectionManager.Cashier.SalesOrder.LblCurrency.html(mySectionManager.Cashier.SalesOrder.DdlCurrency.find(":selected").text());
        mySectionManager.Cashier.SalesOrder.DdlCurrency.trigger("chosen:updated");
    },
    GeneratePOType: function () {
        var options = "";

        if (myStorageManager.POSStorage.PoTypes.length > 0) {
            $.each(myStorageManager.POSStorage.PoTypes, function (index, item) {
                var optionFormat = "<option value=\"{0}\" due=\"{1}\" >{2}</option>";
                var option = $.validator.format(optionFormat, item.ID, item.DueDays, item.Name);
                options += option;
            })
        }
        if (myStorageManager.POSStorage.PoTypes.length <= 1) {
            mySectionManager.Cashier.SalesOrder.TrPOType.hide();
        }
        mySectionManager.Cashier.SalesOrder.DdlPOType.html(options);
        mySectionManager.Cashier.SalesOrder.DdlPOType.trigger("chosen:updated");
    },
    GenerateTax: function () {
        var options = "";
        var optionFormat = "<option value=\"{0}\" rate=\"{1}\" type=\"{2}\">{3}</option>";
        if (myStorageManager.POSStorage.Taxes.length > 0) {
            $.each(myStorageManager.POSStorage.Taxes, function (index, item) {
                var option = $.validator.format(optionFormat, item.ID, item.Rate, item.CalculationType, item.Label);
                options += option;
            })
        }
        mySectionManager.Cashier.SalesOrder.DdlTax.html(options);

        mySectionManager.Cashier.SalesOrder.DdlTax.trigger("chosen:updated");
    },
    GenerateDeliveryOutlet: function () {
        if (Constants.IsNotEmpty(myStorageManager.POSStorage.Entities)) {
            mySectionManager.Cashier.Payment.DdlEntity.html('');

            $.each(myStorageManager.POSStorage.Entities, function (i, entity) {
                var option = "<option value=\"" + entity.ID + "\">" + entity.Name + "</option>";
                mySectionManager.Cashier.Payment.DdlEntity.append(option);

            });
            mySectionManager.Cashier.Payment.DdlEntity.trigger("chosen:updated");
        }
    },
    GeneratePayment: function () {
        var options = "";
        var buttons = "";
        if (myStorageManager.POSStorage.Payments.length > 0) {
            $.each(myStorageManager.POSStorage.Payments, function (index, item) {
                var option = "<option value=\"" + item.ID + "\">" + item.Name + "</option>";
                options += option;
                var button = "<a paymentID=\"" + item.ID + "\">" + item.Name + "</a>";
                buttons += button;
            })

        }
        if (myStorageManager.POSStorage.AppConfig.POS.PaymentInputType == PaymentInputType.Button) {
            mySectionManager.Cashier.Payment.TdFirstPaymentMethod.html(buttons);
            mySectionManager.Cashier.Payment.PaymentButtonClear();
            mySectionManager.Cashier.Payment.TdFirstPaymentMethod.find("a").click(function () {
                mySectionManager.Cashier.Payment.PaymentButtonSelect($(this).addClass("active").attr("paymentID"));
            });

        } else {
            mySectionManager.Cashier.Payment.DdlPaymentMethod.html(options);
            mySectionManager.Cashier.Payment.DdlPaymentMethod.trigger("chosen:updated");
        }


        mySectionManager.Cashier.SalesOrder.DdlDepositPaymentMethod.html(options);
        mySectionManager.Cashier.SalesOrder.DdlDepositPaymentMethod.trigger("chosen:updated");

        options = "<option value=\"\"></option>" + options;
        mySectionManager.Cashier.Payment.DdlPaymentMethod2.html(options);
        mySectionManager.Cashier.Payment.DdlPaymentMethod2.trigger("chosen:updated");
    },
    GeneratePromotion: function () {
        var options = "";

        if (myStorageManager.POSStorage.Promotion.length > 0) {
            options += "<option value=\"\"></option>"
            $.each(myStorageManager.POSStorage.Promotion, function (index, item) {
                option = "<option value=\"" + item.DiscountRate + "\">" + item.Name + "</option>";
                options += option;
            })
        } else {
            mySectionManager.Cashier.SalesOrder.trPromotion.hide();
        }
        mySectionManager.Cashier.SalesOrder.DdlPromotion.html(options);
        mySectionManager.Cashier.SalesOrder.DdlPromotion.trigger("chosen:updated");

    },
    IsInRole: function (role) {
        var match = jQuery.grep(this.POSStorage.Roles, function (n, i) {
            return (n == role);
        });
        if (match.length > 0) {
            return true;
        }
        return false;
    },
    GetTaxByID: function (id) {
        var tax = jQuery.grep(this.POSStorage.Taxes, function (item) {
            return item.ID == id;
        });
        if (tax.length > 0) {
            tax = tax[0];
        } else {
            tax = new Object();
        }
        return tax;
    }
}

var myMenuManager = {
    LeftMenu: '',
    LeffMenuFormat: '<li {0}><a class="{1}" href="{2}"><i></i><span>{3}</span></a></li>',
    TopMenu: '',
    init: function () {
        this.LeftMenu = $('nav');
        this.TopMenu = $('.profile > ul');
        myMenuManager.replace();
    },

    replace: function () {
        if (myStorageManager.POSStorage.UserMenu.Left != undefined) {
            var leftMenu = "";
            if (myStorageManager.POSStorage.UserMenu.Left.length > 0) {
                $.each(myStorageManager.POSStorage.UserMenu.Left, function (i, parent) {
                    if (Constants.IsNotEmpty(parent.Title)) {
                        leftMenu += $.validator.format("<strong>{0}</strong>", parent.Title);
                    }

                    if (parent.Items.length > 0) {
                        leftMenu += "<ul>"
                        $.each(parent.Items, function (i, child) {
                            var liClass = "";
                            if (child.Selected) {
                                liClass = 'class="selected"';
                            }
                            leftMenu += $.validator.format(myMenuManager.LeffMenuFormat, liClass, child.Title.toLowerCase(), child.Url, child.Title);
                        });
                        leftMenu += "</ul>"
                    }
                });
            }


            this.LeftMenu.html(leftMenu);
            this.LeftMenu.mCustomScrollbar({
                scrollButtons: {
                    enable: false
                },
                theme: "dark",
                autoHideScrollbar: true
            });
        }
        if (myStorageManager.POSStorage.UserMenu.Top != undefined) {
            var topMenu = '';
            if (myStorageManager.POSStorage.UserMenu.Top.length > 0) {
                $.each(myStorageManager.POSStorage.UserMenu.Top, function (i, item) {
                    topMenu += $.validator.format('<li><a href="{0}">{1}</a></li>', item.Url, item.Title);


                });
            }
            this.TopMenu.find("li:not(:last-child)").remove();
            this.TopMenu.prepend(topMenu);
        }
    }
}


var AppRole = {
    Contacts: "Contacts",
    Discount: "Discount",
    Price: "Price",
    Cost: "Cost",
    NumberEditor: "NumberEditor",
    SalesmanEditor: "SalesmanEditor",
    DateEditor: "DateEditor",
    CustomerInputLock: "CustomerInputLock",
    PaymentRestriction: "PaymentRestriction",
    RetrieveRestriction: "RetrieveRestriction",
    Return: "Return",
    GlobalEditor: "GlobalEditor",
    OrdersEditor: "OrdersEditor",
    Setup: "Setup",
    CreditSalesLock: "CreditSalesLock",
    Inventory: 'Inventory',
    Commission: 'Commission',
    IsOrderEditor: function () {
        return (myStorageManager.IsInRole(AppRole.GlobalEditor) || myStorageManager.IsInRole(AppRole.OrdersEditor));
    }
};

var AjaxForm = {
    init: function () {
        this.BindQueryMode();
        this.BindControl();
        this.BindRoleControl();
    },
    BindControl: function () {

        ///general////
        mySectionManager.General.DialogQueryMode.bind('dialogclose', function () {
            AjaxForm.BindQueryMode();
        });
        //tabling
        mySectionManager.General.SpanMemberName.html(myStorageManager.POSStorage.UserName);

        if (myStorageManager.POSStorage.AppConfig.Park.Mode == 1) {
            mySectionManager.General.BtnPark.attr("dialogid", "dialogParkSelect");
            mySectionManager.General.BtnPark.attr("validate", "OnGetVacantTable");

        }
        myFlag.init();
        if (myStorageManager.POSStorage.AppConfig.AdvanceConfig.Sell.Flag.Enabled) {
            myFlag.object.show();
            mySectionManager.Cashier.SalesOrder.TxtNote.hide();
            myFlag.generate();

        } else {
            myFlag.object.hide();
            mySectionManager.Cashier.SalesOrder.TxtNote.show();
        }

        //retrieve
        if (myStorageManager.IsInRole(AppRole.RetrieveRestriction)) {
            mySectionManager.General.BtnRetrieve.hide();
        }

        if (!myStorageManager.POSStorage.AppConfig.Park.Advanced.BillNOutstandingEnabled) {
            mySectionManager.General.fullscreenbuttonright.hide();
        }
        //required message
        jQuery.extend(jQuery.validator.messages, {
            required: "*"
        });
        //input keayboard on cashier body case
        mySectionManager.General.Body.bind('keyup', function (e) {
            AjaxForm.BodyKey(e);
        });
        //full screen button
        mySectionManager.General.LinkFullScreen.click(function () {
            mySectionManager.General.Form.toggleClass("full_screen");
            if (mySectionManager.General.Form.hasClass("full_screen")) {
                mySectionManager.General.LinkFullScreen.attr("title", "Exit Full Screen");
            } else {
                mySectionManager.General.LinkFullScreen.attr("title", "Full Screen");
            }
        });
        if (!myStorageManager.POSStorage.AppConfig.Park.Advanced.BillNOutstandingEnabled) {
            mySectionManager.General.fullscreenbuttonright.hide();
        }
        //quick key
        if (mySectionManager.QuickKey.Group.length == 0) {
            mySectionManager.QuickKey.Section.addClass("bgQuickkeyIllustration");
            quickKeyManager.GenerateLinkConfigure(Constants.GuidEmpty);

        }

        //dialong variant cart & button / enable crate variant
        mySectionManager.General.LinkAdd.click(function () {
            dialogCart.clear();
        });
        mySectionManager.General.DialogItem.bind('dialogclose', function () {
            dialogCart.clear();
        });
        var autoFillQty = 0;
        if (myStorageManager.POSStorage.AppConfig.POS.QuantityDefault) {
            autoFillQty = 1;
        }
        if (myStorageManager.POSStorage.AppConfig.POS.NumberPad.Enabled) {
            mySectionManager.Cashier.Payment.TxtAmount.numpad(
                {
                    ID: "paymentNumpad",
                    onChange: function (event, value) {
                        mySectionManager.Cashier.Payment.TxtAmount.autoNumeric('set', value);
                        AjaxForm.OnPaymentAmountChange(mySectionManager.Cashier.Payment.TxtAmount);
                    }
                });
            mySectionManager.Cashier.Payment.DialogPayment.bind('dialogclose', function () {
                $("#paymentNumpad").hide();
            });


            mySectionManager.Cashier.SalesOrder.TxtDisc1.numpad(
               {
                   ID: "discountNumpad1",
                   onChange: function (event, value) {
                       mySectionManager.Cashier.SalesOrder.TxtDisc1.autoNumeric('set', value);
                       amountUI.update();
                       disc.Clear();

                   }
               });
            mySectionManager.Cashier.SalesOrder.TxtDisc2.numpad(
              {
                  ID: "discountNumpad2",
                  onChange: function (event, value) {
                      mySectionManager.Cashier.SalesOrder.TxtDisc2.autoNumeric('set', value);
                      amountUI.update();

                  }
              });
            mySectionManager.Cashier.SalesOrder.TxtDiscAmount.numpad(
              {
                  ID: "discountNumpadAmount",
                  onChange: function (event, value) {
                      mySectionManager.Cashier.SalesOrder.TxtDiscAmount.autoNumeric('set', value);
                      amountUI.update();

                  }
              });
            mySectionManager.General.DialogDiscount.bind('dialogclose', function () {
                $("[id*='discountNumpad']").hide();
            });
        }


        mySectionManager.General.DialogItem.attr("autoFillQuantity", autoFillQty);
        mySectionManager.General.divCreateVariant.attr("isenabled", myStorageManager.POSStorage.AppConfig.POS.QuickCreateProductEnabled);


        //barcode auto complete thubnail & enter case
        if (myStorageManager.POSStorage.AppConfig.POS.AutoCompleteThumbnail) {
            mySectionManager.General.TxtBarcode.addClass("autocomplete_thumbnail");
        }
        mySectionManager.General.TxtBarcode.keypress(function (e) {
            if (e.keyCode == 13) {
                var inputBarcode = $(this);
                AjaxForm.SelectVariantByCode(inputBarcode.val(), true, true);
                inputBarcode.val("");
            }
        });

        ///Sales Order////
        //get dropdown list
        myStorageManager.GenerateCurrency();
        myStorageManager.GeneratePOType();
        myStorageManager.GenerateTax();
        myStorageManager.GenerateDeliveryOutlet();
        myStorageManager.GeneratePayment();
        myStorageManager.GeneratePromotion();
        //update all note when typing one of the text box 
        mySectionManager.Cashier.SalesOrder.TxtNoteOverall.on('keyup', function () {
            mySectionManager.Cashier.SalesOrder.TxtNoteOverall.val($(this).val());
        });
        //currency changes
        this.OnCurrencyChange();
        mySectionManager.Cashier.SalesOrder.DdlCurrency.change(AjaxForm.OnCurrencyChange);
        //sales changes
        mySectionManager.Cashier.SalesOrder.DdlSales.change(function () {
            AjaxForm.OnSalesChange();
        });
        //assign loyalty discount
        if (myStorageManager.POSStorage.AppConfig.POS.LoyaltyDiscount > 0) {
            mySectionManager.Cashier.SalesOrder.TxtMemberPoint.attr("cashDiscount", myStorageManager.POSStorage.AppConfig.POS.LoyaltyDiscount);

        }
        //customer  required
        if (myStorageManager.POSStorage.AppConfig.POS.CustomerRequired) {
            mySectionManager.Cashier.SalesOrder.TxtContact.addClass("required");
        }

        //Sales person
        if (myStorageManager.POSStorage.AppConfig.POS.SalesPersonRequired) {
            mySectionManager.Cashier.SalesOrder.DdlSales.addClass("required");
        }


        ///Payment////
        //payment amount 

        mySectionManager.Cashier.Payment.TxtAmount.on('keyup', function () {
            AjaxForm.OnPaymentAmountChange($(this));
        });
        mySectionManager.Cashier.Payment.LinkSecondPayment.click(function () {
            mySectionManager.Cashier.Payment.DivSecondPayment.toggle();
        });
        //custom field
        if (Constants.IsNotEmpty(myStorageManager.POSStorage.AppConfig.Labels.InvoiceCustomDateFieldStorage)) {
            mySectionManager.Cashier.Payment.DivCustomField.show();
            mySectionManager.Cashier.Payment.ThCustomField.text(myStorageManager.POSStorage.AppConfig.Labels.InvoiceCustomDateFieldStorage);
        }
        if (!myStorageManager.POSStorage.AppConfig.Park.Deposit.Enabled) {
            mySectionManager.Cashier.SalesOrder.DivDeposit.hide();
        }
        mySectionManager.General.BtnPark.find("span").text(myStorageManager.POSStorage.AppConfig.Park.UI.ParkButton);
        mySectionManager.General.BtnRetrieve.find("span").text(myStorageManager.POSStorage.AppConfig.Park.UI.RetrieveButton);

        mySectionManager.Cashier.Payment.DialogPark.attr('title', myStorageManager.POSStorage.AppConfig.Park.UI.ParkDialogTitle);

        mySectionManager.Cashier.SalesOrder.TxtParkLabel.attr("placeholder", myStorageManager.POSStorage.AppConfig.Park.UI.ParkLabelPlaceholder);

        mySectionManager.Cashier.Payment.DialogRetrieve.attr('title', myStorageManager.POSStorage.AppConfig.Park.UI.RetrieveDialogTitle);
        //default delivery
        mySectionManager.Cashier.Payment.RadButtonDeliveryChecked.find('[value="' + myStorageManager.POSStorage.AppConfig.Delivery.InstantSalesOrderDelivery + '"]').attr('checked', 'checked');
        //default payment
        mySectionManager.Cashier.Payment.PaymentTypeSetDefault();
        if (myStorageManager.POSStorage.AppConfig.Park.Deposit.Enabled) {
            mySectionManager.Cashier.SalesOrder.TxtDeposit.val(myStorageManager.POSStorage.AppConfig.Park.Deposit.DefaultAmount);
        }

        mySectionManager.Cashier.Payment.TxtDaysDue.on('keyup', function () {
            if (mySectionManager.Cashier.Payment.DPDue.length > 0) {
                var days = $(this).autoNumeric('get');
                var datePicker = mySectionManager.Cashier.SalesOrder.DPInvDate;
                var invDate = datePicker.datepicker("getDate");
                var invDate = datePicker.datepicker("getDate");
                invDate.setDate(invDate.getDate() + days);

                mySectionManager.Cashier.Payment.DPDue.datepicker("setDate", invDate);

            }
        });


        mySectionManager.Cashier.Payment.RadButtonPaymentTypeChecked.find("input").click(function () {
            AjaxForm.OnDeliveryRequiredPaymentCheck();
        });
        if (!myStorageManager.POSStorage.AppConfig.QR.Enabled) {
            mySectionManager.Complete.LiQrCode.hide();
        }


        //New Order Button Click Handler in Complete section
        mySectionManager.Complete.LinkNew.click(function () { AjaxForm.Renew(); });

        mySectionManager.Complete.LinkRetrySubmit.click(function () {
            mySectionManager.Switch();
            myOrderManager.Submit(SubmissionType.Payment, true);
        })
      
    },
    BindRoleControl: function () {
        ///Sales Order///
        if (myStorageManager.IsInRole(AppRole.PaymentRestriction)) {
            mySectionManager.General.BtnPay.hide();
        }

        if (myStorageManager.IsInRole(AppRole.CustomerInputLock)) {
            mySectionManager.Cashier.SalesOrder.TxtContact.addClass("keyboardLock");
            mySectionManager.Cashier.SalesOrder.TxtContact.removeClass("autocomplete");
        }
        if (myStorageManager.IsInRole(AppRole.CreditSalesLock)) {
            mySectionManager.Cashier.Payment.TableRowPaymentType.hide();
            mySectionManager.Cashier.Payment.hrHeader.hide();
        }
        $(".keyboardLock").keydown(function (event) {
            var input = $(this);
            var value = input.val();

            //Store first entry
            if (value.length == 0) {
                var stamp = new Date();
                input.data("timestamp", stamp);
            }
            else if (value.length >= 1) {
                //Duration of completion should not exceed span
                var start = input.data("timestamp");
                var end = new Date();

                var span = end.getTime() - start.getTime();
                if (span > 200) {
                    input.val('');
                    return false;
                }
            }
        });

        //customer quick create            
        if (!myStorageManager.IsInRole(AppRole.Contacts) || !myStorageManager.POSStorage.AppConfig.POS.CustomerQuickCreate) {
            mySectionManager.Cashier.SalesOrder.LinkAddCustomer.hide();
        }
        //not allowed change date
        if (myStorageManager.IsInRole(AppRole.DateEditor) || myStorageManager.IsInRole(AppRole.GlobalEditor)) {
            mySectionManager.Cashier.SalesOrder.DPInvDate.removeAttr("disabled");
        }
        //not allowed edit invoice number
        if (!myStorageManager.IsInRole(AppRole.NumberEditor) && !myStorageManager.IsInRole(AppRole.GlobalEditor)) {
            mySectionManager.Cashier.SalesOrder.TxtNumber.attr("readonly", "readonly");
        }
        //salesmen
        if (myStorageManager.IsInRole(AppRole.SalesmanEditor)) {

            if (Constants.IsNotEmpty(myStorageManager.POSStorage.SalesID)) {
                mySectionManager.Cashier.SalesOrder.DdlSales.attr("default", myStorageManager.POSStorage.SalesID);
            }
        }

        //complete
        if (!AppRole.IsOrderEditor()) {
            mySectionManager.Complete.LinkEdit.parent().hide();
        }



    },
    BindQueryMode: function () {
        if (myLocalStorage.queryMode.GetProduct() == "1") {
            mySectionManager.General.RadButtonQueryProduct.find('[value="1"]').attr('checked', 'checked');
        }
        else {
            mySectionManager.General.RadButtonQueryProduct.find('[value="0"]').attr('checked', 'checked');
        }

        if (myLocalStorage.queryMode.GetOrder() == "1") {
            mySectionManager.General.RadButtonQueryOrder.find('[value="1"]').attr('checked', 'checked');
        }
        else {
            mySectionManager.General.RadButtonQueryOrder.find('[value="0"]').attr('checked', 'checked');
        }
    },
    SaveQueryMode: function () {
        var queryMode = {
            Product: mySectionManager.General.RadButtonQueryProduct.find("input:checked").val(),
            Order: mySectionManager.General.RadButtonQueryOrder.find("input:checked").val()
        }
        myLocalStorage.queryMode.data = queryMode;
        myLocalStorage.queryMode.save();
    },
    BodyKey: function (e) {
        //Press F4 to open dialog
        if ((e.which && e.which == 115) || (e.keyCode && e.keyCode == 115)) {
            dialogCart.open();
        }

        //Press F8 to Pay
        if ((e.which && e.which == 119) || (e.keyCode && e.keyCode == 119)) {
            if (mySectionManager.General.BtnPay.is(':visible')) {
                if (mySectionManager.Cashier.Self.is(':visible')) {
                    mySectionManager.General.BtnPay.click();
                }
                else {
                    mySectionManager.Complete.LinkNew.click();
                }
            }
        }
    },
    PopulateCart: function () {
        var sessionItemsString = mySectionManager.Cashier.SalesOrder.HfItemJson.val();
        if (sessionItemsString != "" && sessionItemsString != undefined) {
            LoadAutoNumeric();

            var sessionItems = jQuery.parseJSON(sessionItemsString);
            $.each(sessionItems, function (index, value) {
                myCashier.additem(value);
            });
        }
    },
    // OnVariantSelectID: function (id, appendToCart, appendQty, queryPricebook) {
    //     if (id != '') {
    //         var entityID = myRegister.getEntityID();
    //         if (POSSettings.queryRealtime()) {
    //             $.ajax({
    //                 url: "/Authenticated/Services/Catalog.asmx/GetVariantByID",
    //                 data: "{ 'id': '" + id + "', 'entityID' : '" + entityID + "'}",
    //                 dataType: "json",
    //                 type: "POST",
    //                 contentType: "application/json; charset=utf-8",
    //                 dataFilter: function (data) { return data; },
    //                 success: function (data) {
    //                     var variant = data.d;
    //                     DoVariantSelect(variant, appendToCart, queryPricebook);
    //                     if (appendToCart) {
    //                         OnCartOK(appendQty);
    //                     }
    //                 },
    //                 error: function (XMLHttpRequest, textStatus, errorThrown) {
    //                     alert(posAlertMessage.failGetVariant);
    //                 }
    //             });
    //         }
    //         else {

    //             var variant = myIndexeddb.Products.GetVariantByID(id, myRegister.getEntityID());
    //             if (variant != null) {
    //                 DoVariantSelect(variant, appendToCart, queryPricebook);
    //                 if (appendToCart) {
    //                     OnCartOK(appendQty);
    //                     mySectionManager.General.TxtBarcode.val("");
    //                 }
    //             } else {
    //                 alert(posAlertMessage.failGetLocalVariant);
    //             }


    //         }
    //     }
    // },
    // SelectVariantByCode: function (code, appendToCart, queryPricebook) {
    //     var entityID = myRegister.getEntityID();
    //     if (POSSettings.queryRealtime()) {
    //         var validCode = Formatter.ClearInvalidCharacter(code);
    //         $.ajax({
    //             url: "/Authenticated/Services/Catalog.asmx/GetVariantByCode",
    //             data: "{ 'code': '" + validCode + "', 'entityID' : '" + entityID + "'}",
    //             dataType: "json",
    //             type: "POST",
    //             contentType: "application/json; charset=utf-8",
    //             dataFilter: function (data) { return data; },
    //             success: function (data) {
    //                 var variant = data.d;
    //                 if (data.d != null) {
    //                     DoVariantSelect(variant, appendToCart, queryPricebook);
    //                     if (appendToCart) {
    //                         OnCartOK(true);
    //                     }
    //                 }
    //                 else {
    //                     var msg = jQuery.validator.format(posAlertMessage.emptyBarcodeFormat, code);
    //                     alert(msg);
    //                 }
    //             },
    //             error: function (XMLHttpRequest, textStatus, errorThrown) {
    //                 alert(posAlertMessage.failGetVariant);
    //             }

    //         });
    //     }
    //     else {

    //         var variant = myIndexeddb.Products.GetVariantByCode(code, myRegister.getEntityID());
    //         if (variant != null) {
    //             DoVariantSelect(variant, appendToCart, queryPricebook);
    //             if (appendToCart) {
    //                 OnCartOK(true);
    //             }
    //         } else {
    //             var msg = jQuery.validator.format(posAlertMessage.emptyBarcodeFormat, code);
    //             alert(msg);
    //         }


    //     }

    // },
    OnCurrencyChange: function () {
        if (mySectionManager.Cashier.SalesOrder.DdlCurrency.val() != myStorageManager.POSStorage.AppConfig.Core.Defaults.CurrencyID) {
            mySectionManager.Cashier.SalesOrder.CurrencyRate.css('display', 'inline-block');
            var selectedID = mySectionManager.Cashier.SalesOrder.DdlCurrency.val();
            var result = $.grep(myStorageManager.POSStorage.Currencies, function (e) { return e.ID == selectedID; });
            if (result.length != 0) {
                mySectionManager.Cashier.SalesOrder.CurrencyRate.val(result[0].ExchangeRate);
            } else {
                mySectionManager.Cashier.SalesOrder.CurrencyRate.val(1);
            }
        }
        else {
            mySectionManager.Cashier.SalesOrder.CurrencyRate.hide();
            mySectionManager.Cashier.SalesOrder.CurrencyRate.val(1);
        }
        mySectionManager.Cashier.SalesOrder.LblCurrency.html(mySectionManager.Cashier.SalesOrder.DdlCurrency.find(":selected").text());
    },
    OnSalesChange: function () {
        var ddlSalesText = mySectionManager.Cashier.SalesOrder.DdlSales.find(":selected").val();
        var hfSalesID = mySectionManager.Cashier.SalesOrder.HfSalesID;
        hfSalesID.val(ddlSalesText);
    },
    OnPaymentAmountChange: function (TxtAmount) {
        var paidAmount = TxtAmount.autoNumeric('get');
        var totalAmount = amountUI.Total;
        var diff = paidAmount - totalAmount;

        var inputDiff = mySectionManager.Cashier.Payment.TxtChange;
        var divDiff = mySectionManager.Cashier.Payment.DivChange;
        var btnSplit = mySectionManager.Cashier.Payment.LinkSecondPayment;

        if (diff != 0) {
            if (diff < 0) {
                mySectionManager.Cashier.Payment.TxtChange.addClass("red");
                mySectionManager.Cashier.Payment.LinkSecondPayment.show();
            }
            else {
                mySectionManager.Cashier.Payment.TxtChange.removeClass("red");
                mySectionManager.Cashier.Payment.LinkSecondPayment.hide();
                mySectionManager.Cashier.Payment.DivSecondPayment.hide();
            }
            mySectionManager.Cashier.Payment.TxtChange.val(Formatter.Number(diff));
            mySectionManager.Cashier.Payment.DivChange.show();
        }
        else {
            mySectionManager.Cashier.Payment.DivChange.hide();
            mySectionManager.Cashier.Payment.LinkSecondPayment.hide();
            mySectionManager.Cashier.Payment.DivSecondPayment.hide();
        }
        this.OnDeliveryRequiredPaymentCheck();
    },
    OnDeliveryRequiredPaymentCheck: function () {
        var paidAmount = mySectionManager.Cashier.Payment.TxtAmount.autoNumeric('get');
        var totalAmount = amountUI.Total;
        var diff = paidAmount - totalAmount;
        var creditSales = mySectionManager.Cashier.Payment.RadButtonPaymentTypeChecked.find("input:checked").val() == 1;

        mySectionManager.Cashier.Payment.RadButtonDeliveryChecked.find("input").removeAttr('disabled');
        if (myStorageManager.POSStorage.AppConfig.Delivery.SalesOrderPaymentBeforeDelivery && (creditSales || diff < 0)) {
            mySectionManager.Cashier.Payment.RadButtonDeliveryChecked.find("input").attr("disabled", "disabled");
            mySectionManager.Cashier.Payment.RadButtonDeliveryChecked.find("[value=false]").prop("checked", true)

        }


    },
    Complete: function (id, soID, outID, creator, orderTimeString, message) {
        if (id != Constants.GuidEmpty) {
            myEmailInvoice.invID = id;
            mySectionManager.Complete.LinkInvoiceNumber.text("#" + myOrderManager.GetCurrentNumber());
            if (POSSettings.isOnline()) {
                var printUrlFormat = "/Authenticated/Print/{0}.aspx?ID={1}&Template={2}";
                var printInvoiceNOutFormat = "/Authenticated/Print/InvoiceNOutD.aspx?InvoiceID={0}&OutID={1}&Template={2}";
                var PrintInvoiceFormat = '/Authenticated/Transaction/Customer/InvoiceInfo.aspx?ID={0}';
                var QRCodeLinkFormat = '/Authenticated/Print/QR.aspx?ID={0}';
                var CommissionLinkFormat = '/Authenticated/Transaction/Commission/assign.aspx?ID={0}';
                var printSalesOrderFormat = "/Authenticated/Print/CustomerPO.aspx?ID={0}&Template={1}"
                mySectionManager.Complete.LinkInvoiceNumber.attr('href', $.validator.format(PrintInvoiceFormat, id));
                mySectionManager.Complete.LinkInvoiceNumber.attr('target', '_blank');
                mySectionManager.Complete.LinkTax.attr('href', '/Authenticated/Print/TaxInvoice.aspx?ID=' + id);
                mySectionManager.Complete.LinkSalesOrder.attr('href', $.validator.format(printSalesOrderFormat, soID, myReceiptGenerator.template.ID));
                mySectionManager.Complete.LinkQRCode.attr('href', $.validator.format(QRCodeLinkFormat, id));
                if (Constants.IsNotEmpty(POSData.Order.SalesID)) {
                    mySectionManager.Complete.LiCommission.hide();
                }
                else {
                    mySectionManager.Complete.LiCommission.show();
                    mySectionManager.Complete.LinkCommission.attr('href', $.validator.format(CommissionLinkFormat, soID));

                }


                if (myReceiptGenerator.template.PrintMode == 1) {
                    mySectionManager.Complete.LinkInvoice.attr('href', $.validator.format(printUrlFormat, "Invoice", id, myReceiptGenerator.template.ID));
                }
                else {
                    mySectionManager.Complete.LinkInvoice.attr('href', $.validator.format(printUrlFormat, "InvoiceMini", id, myReceiptGenerator.template.ID));
                }


                if (outID != Constants.GuidEmpty) {
                    mySectionManager.Complete.LinkDelivery.attr('href', $.validator.format(printUrlFormat, "OutDelivery", outID, myReceiptGenerator.template.ID));
                    mySectionManager.Complete.LinkInvDlv.attr('href', $.validator.format(printInvoiceNOutFormat, id, outID, myReceiptGenerator.template.ID));
                }
                else {
                    mySectionManager.Complete.LinkDelivery.attr('href', '#');
                    mySectionManager.Complete.LinkInvDlv.attr('href', '#');
                }
            }


        } else {
            mySectionManager.Complete.LinkInvoiceNumber.text(myOrderManager.GetCurrentNumber());
            mySectionManager.Complete.LinkInvoiceNumber.attr('href', '#');
            mySectionManager.Complete.LinkInvoiceNumber.attr('target', '');


            mySectionManager.Complete.LinkTax.attr('href', '#');
            mySectionManager.Complete.LinkSalesOrder.attr('href', '#');
            mySectionManager.Complete.LinkQRCode.attr('href', '#');
            mySectionManager.Complete.LinkCommission.attr('href', '#');
            mySectionManager.Complete.LinkInvoice.attr('href', '#');
        }


        if (AppRole.IsOrderEditor()) {
            mySectionManager.Complete.LinkEdit.parent().show();
            if (!myStorageManager.POSStorage.AppConfig.Core.Settings.EditAfterDelivery && POSData.Action.DeliveryEntityID != Guid.Empty) {
                mySectionManager.Complete.LinkEdit.parent().hide();
            }
        }


        mySectionManager.Complete.LinkEdit.unbind('click');
        mySectionManager.Complete.LinkEdit.click(function () {
            AjaxForm.Edit(soID);
        });

        this.UnBlock();

        mySectionManager.Switch();
        mySectionManager.General.LblNote.hide();

        if (POSData.Action.Retry) {
            mySectionManager.Complete.DivAction.hide();
            mySectionManager.Complete.DivNotification.show();
            mySectionManager.Complete.DivNotification.children("span").html(message);

        } else {
            mySectionManager.Complete.DivAction.show();
            mySectionManager.Complete.DivNotification.hide();

            if (POSData.Action.Type != SubmissionType.Payment) {
                if (POSData.Action.Type == SubmissionType.Park) {
                    myReceiptGenerator.generateReceiptPark(creator, orderTimeString);
                } else {
                    myReceiptGenerator.generateReceiptMini(creator, orderTimeString);
                }
                this.Renew();
                if (myStorageManager.POSStorage.AppConfig.Park.Print.Behaviour.PrintAfterPark) {
                    window.setTimeout(function () {
                        window.print();
                    }, 500);
                }
            } else {
                if (myStorageManager.POSStorage.AppConfig.POS.PrintOnPayment) {
                    window.setTimeout(function () {
                        window.print();
                    }, 500);
                }
            }
        }
    },
    Renew: function () {
        if (POSSettings.pushRealtime()) {
            myIndexeddb.Orders.Sync();
        }

        if (myOrderManager.SubmitCounter == 0 && myOrderManager.IsEditMode()) {
            mySectionManager.Cashier.SalesOrder.DPInvDate.val(myStorageManager.POSStorage.ServerDateString);
        }
        if (!myStorageManager.IsInRole(AppRole.DateEditor) && !myStorageManager.IsInRole(AppRole.GlobalEditor)) {
            mySectionManager.Cashier.SalesOrder.DPInvDate.val(myStorageManager.POSStorage.ServerDateString);
        }
        myOrderManager.SubmitCounter++;
        this.Clear();
        mySectionManager.Switch();
        mySectionManager.General.PageTitle.text("New Sales Order");
        myRegister.generateNewNumber();
        myRegister.renewSelected();
        quickKeyManager.clearSubQuickKey();

    },
    //edit from link clicked, such retrieve, edit and unpaid
    Edit: function (soID, park) {
        park = park | false;
        mySectionManager.Cashier.SalesOrder.HfSalesOrderID.val(soID);
        if (soID == Constants.GuidEmpty) {
            myOrderManager.SubmitOffline = true;
            mySectionManager.General.PageTitle.text("Updating Sales Order #" + mySectionManager.Cashier.SalesOrder.TxtNumber.val());
        } else {
            if (POSSettings.pushRealtime()) {
                AjaxForm.Block();
                $.ajax({
                    url: "/Authenticated/Services/Transaction.asmx/GetSalesOrderJSONParkByID",
                    data: "{ 'id': '" + soID + "'}",
                    dataType: "json",
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    async: false,
                    success: function (data) {
                        AjaxForm.Fill(data.d, park);
                        AjaxForm.UnBlock();
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(posAlertMessage.failGetSalesOrder);
                        return false;
                    }
                });
            } else {
                //offline park only
                if (park) {
                    //if offline park is from synce / data duplicate from server to support offline retrieve
                    if (myLocalStorage.parks.GetByID(soID).length > 0) {
                        var so = myLocalStorage.parks.GetByID(soID)[0];
                        AjaxForm.Fill(so, park);
                        myOrderManager.OfflineParkID = soID;
                        myOrderManager.OfflinePark = true;
                    }
                        //if ofline park is get from offline transaction / park order during offline, and will send to server after online
                    else {
                        myIndexeddb.Orders.GetByKey(soID, function (tempSO) {
                            var so = '';
                            var Customer = {
                                Name: '',
                            }
                            if (myLocalStorage.customers.getByID(tempSO.Order.CustomerID).length > 0) {
                                var Customer = myLocalStorage.customers.getByID(tempSO.Order.CustomerID)[0];
                            }
                            var items = new Array();
                            $.each(tempSO.Items, function (i, item) {
                                var variants = myIndexeddb.Products.GetVariantByID(item.VariantID, myRegister.getEntityID());
                                var variant = new Object();
                                if (variants != null) {
                                    variant = variants;
                                }
                                item.Variant = variant;
                                item.Price = item.UnitPrice;
                                item.Cost = item.UnitCost;
                                items.push(item);
                            });
                            var so = {
                                Order: tempSO.Order,
                                Customer: Customer,
                                Items: JSON.stringify(items),
                                DateDisplay: tempSO.Park.DateDisplay
                            }
                            mySectionManager.Cashier.SalesOrder.HfSalesOrderID.val(so.Order.ID);

                            AjaxForm.Fill(so, park);
                            myOrderManager.OfflineParkID = soID;
                            myOrderManager.OfflinePark = true;

                        })
                    }

                } else {
                    alert(posAlertMessage.wrongOfflineAction);
                    return false;
                }

            }
        }



        if (myStorageManager.POSStorage.AppConfig.Park.Mode == 1) {
            mySectionManager.General.BtnPark.attr("dialogid", "dialogRePark");
            mySectionManager.General.BtnPark.attr("validate", "OnValidatePark");

        }
        mySectionManager.Switch();
        quickKeyManager.clearSubQuickKey();
    },

    //Fill data to cart
    Fill: function (so, park) {
        mySectionManager.Cashier.SalesOrder.TxtNumber.val(so.Order.Number);
        mySectionManager.Cashier.SalesOrder.TxtNoteOverall.val(so.Order.Note);
        mySectionManager.Cashier.SalesOrder.TxtParkLabel.val(so.Order.ParkLabel);

        mySectionManager.Cashier.SalesOrder.DdlDepositPaymentMethod.val(so.Order.DepositPaymentMethodID);
        mySectionManager.Cashier.SalesOrder.DdlDepositPaymentMethod.trigger("chosen:updated");

        mySectionManager.Cashier.SalesOrder.TxtDeposit.autoNumeric('set', so.Order.Deposit);
        if (park && myStorageManager.POSStorage.AppConfig.Park.Deposit.Enabled) {
            mySectionManager.Cashier.Payment.TxtAmount.attr('deposit', so.Order.Deposit)
            mySectionManager.Cashier.Payment.TxtAmount.attr('depositDate', so.DateDisplay)
            mySectionManager.Cashier.Payment.TxtAmount.attr('depositPaymentMethodID', so.Order.DepositPaymentMethodID)
        }

        var parkNoteHTML = jQuery.validator.format("<i>IN: {0}</i>", Formatter.DateTime.ToSimple(so.DateDisplay));
        if (Constants.IsNotEmpty(so.Order.ParkLabel)) {
            parkNoteHTML += jQuery.validator.format("<span>{0}</span>", so.Order.ParkLabel);
        }

        mySectionManager.General.LblNote.html(parkNoteHTML);
        mySectionManager.Cashier.SalesOrder.DdlSales.val(so.Order.SalesID);
        mySectionManager.Cashier.SalesOrder.DdlSales.trigger("chosen:updated");
        if (so.Order.SalesID != Constants.GuidEmpty) {
            mySectionManager.Cashier.SalesOrder.DdlSales.attr("currentSales", so.Order.SalesID);
        }
        //potype
        mySectionManager.Cashier.SalesOrder.DdlPOType.val(so.Order.TypeID);
        mySectionManager.Cashier.SalesOrder.DdlPOType.trigger("chosen:updated");
        //currency & rate
        mySectionManager.Cashier.SalesOrder.DdlCurrency.val(so.Order.CurrencyID);
        mySectionManager.Cashier.SalesOrder.DdlCurrency.trigger("chosen:updated");
        if (Constants.IsNotEmpty(so.Order.CurrencyRate)) {
            mySectionManager.Cashier.SalesOrder.TxtCurrencyRate.val(so.Order.CurrencyRate);
            mySectionManager.Cashier.SalesOrder.CurrencyRate.css('display', 'inline-block');
        }
        // assign discount and tax
        mySectionManager.Cashier.SalesOrder.TxtDisc1.val(so.Order.Discount);
        mySectionManager.Cashier.SalesOrder.TxtDisc2.val(so.Order.Discount2);
        mySectionManager.Cashier.SalesOrder.TxtDiscAmount.val(so.Order.DiscountAmount);
        mySectionManager.Cashier.SalesOrder.DdlTax.val(so.Order.TaxTypeID);
        mySectionManager.Cashier.SalesOrder.DdlTax.trigger("chosen:updated");
        if (!park) {
            var sodate = Formatter.DateTime.ParseFormatted(so.DateString);
            if (sodate != Constants.DateMinValue) {
                mySectionManager.Cashier.SalesOrder.DPInvDate.val(Formatter.DateTime.ToDateOnlyString(sodate));
            }
        }

        mySectionManager.General.PageTitle.text("Updating Sales Order #" + so.Order.Number);
        if (Constants.IsNotEmpty(so.Order.CustomerID)) {

            mySectionManager.Cashier.SalesOrder.HfCustomer.val(so.Order.CustomerID);
            mySectionManager.Cashier.SalesOrder.TxtContact.val(so.Customer.Name);
        }
        mySectionManager.Cashier.SalesOrder.HfItemJson.val(so.Items);
        myCashier.clear();
        AjaxForm.PopulateCart();
    },
    //block and unblock can be used in ajax block before request and unblock after response
    Block: function () {
        $.blockUI({
            message: mySectionManager.General.Loading,
            overlayCSS: { backgroundColor: '#ffffff', 'z-index': '10000', },
            css: {
                width: '350px',
                border: '1px solid #aaa',
                padding: '50px',
                backgroundColor: '#ffffff',
                'box-shadow': '0 0 4px #888888',
                opacity: .8,
                color: '#000000',
                'z-index': '10000'
            }
        });
    },
    UnBlock: function () {
        $.unblockUI();
    },
    //block process is blocking a function, will unblock after the function is done
    BlockProcess: function (job, unblock) {
        $.blockUI({
            message: mySectionManager.General.Loading,
            overlayCSS: { backgroundColor: '#ffffff', 'z-index': '10000' },
            css: {
                width: '350px',
                border: '1px solid #aaa',
                padding: '50px',
                backgroundColor: '#ffffff',
                'box-shadow': '0 0 4px #888888',
                opacity: .8,
                color: '#000000',
                'z-index': '10000'
            },
            onBlock: function () {
                try {
                    job();
                    if (unblock) {
                        $.unblockUI();
                    }

                } catch (ex) {
                    $.unblockUI();
                    AjaxForm.Alert(posAlertMessage.failToSyncProduct);
                }

            }
        });

    },
    Alert: function (message) {
        var $m = $('<div class="growlUI"><div class="logo notice"><i></i></div></div>');
        if (message) $m.append('<span>' + message + '</span>');
        $.blockUI({
            message: $m,
            fadeIn: 100,
            fadeOut: 1000,
            timeout: 6000,
            showOverlay: false,
            css: {
                width: '350px',
                top: '',
                right: '10px',
                left: '',
                bottom: '10px',
                border: 'none',
                opacity: 0.9,
                cursor: 'default',
                color: '#fff',
                backgroundColor: '#517fa4',
                '-webkit-border-radius': '5px',
                '-moz-border-radius': '5px',
                'border-radius': '5px',
                'z-index': '10000'
            },
        });
        $m.click(function () {
            $.unblockUI();
        });
    },
    Clear: function () {
        myCashier.clear();
        mySectionManager.Clear();
        amountUI.update();
        myEmailInvoice.Clear();
    },
    Void: function () {
        this.Clear();
        mySectionManager.General.PageTitle.text("New Sales Order");
        myRegister.generateNewNumber();
    },

}
var POSData = {
    Order: {
        ID: '',
        EntityID: '',
        RegisterID: '',
        TypeID: '',
        Date: '',
        Number: '',
        CustomerID: '',
        SalesID: '',
        Discount: '',
        Discount2: '',
        DiscountAmount: '',
        Note: '',
        TaxTypeID: '',
        CurrencyID: '',
        CurrencyRate: '',
        PointUsed: '',
        InvoicedStateID: '',
        PurchaseOrderNumber: '',
        Deposit: '',
        ParkLabel: '',
        DepositPaymentMethodID: '',
        assign: function () {
            this.ID = mySectionManager.Cashier.SalesOrder.HfSalesOrderID.val();
            this.EntityID = mySectionManager.Cashier.SalesOrder.myRegisterPicker.attr("entityID");
            this.RegisterID = mySectionManager.Cashier.SalesOrder.myRegisterPicker.attr("registerID");
            this.TypeID = mySectionManager.Cashier.SalesOrder.DdlPOType.val() != '' && mySectionManager.Cashier.SalesOrder.DdlPOType.val() != null ? mySectionManager.Cashier.SalesOrder.DdlPOType.val() : '0';
            var dateVal = new Date(Date.parse(mySectionManager.Cashier.SalesOrder.DPInvDate.val()));
            this.Date = Formatter.DateTime.ToSerializedString(dateVal);
            this.Number = mySectionManager.Cashier.SalesOrder.TxtNumber.val();
            this.CustomerID = mySectionManager.Cashier.SalesOrder.HfCustomer.val() != '' ? mySectionManager.Cashier.SalesOrder.HfCustomer.val() : Constants.GuidEmpty;
            this.SalesID = mySectionManager.Cashier.SalesOrder.DdlSales.val() != '' && mySectionManager.Cashier.SalesOrder.DdlSales.val() != null ? mySectionManager.Cashier.SalesOrder.DdlSales.val() : Constants.GuidEmpty;
            this.Discount = mySectionManager.Cashier.SalesOrder.TxtDisc1.autoNumeric('get');
            this.Discount2 = mySectionManager.Cashier.SalesOrder.TxtDisc2.autoNumeric('get');
            this.DiscountAmount = mySectionManager.Cashier.SalesOrder.TxtDiscAmount.autoNumeric('get');
            this.Note = Formatter.ClearInvalidCharacter(mySectionManager.Cashier.SalesOrder.TxtNote.val());
            this.PurchaseOrderNumber = mySectionManager.Cashier.SalesOrder.TxtPONumber.val();
            this.TaxTypeID = mySectionManager.Cashier.SalesOrder.DdlTax.val() != '' && mySectionManager.Cashier.SalesOrder.DdlTax.val() != null ? mySectionManager.Cashier.SalesOrder.DdlTax.val() : Constants.GuidEmpty;
            this.CurrencyID = mySectionManager.Cashier.SalesOrder.DdlCurrency.val();
            this.CurrencyRate = mySectionManager.Cashier.SalesOrder.TxtCurrencyRate.autoNumeric('get');
            this.PointUsed = mySectionManager.Cashier.SalesOrder.TxtMemberPoint.val() != '' ? mySectionManager.Cashier.SalesOrder.TxtMemberPoint.autoNumeric('get') : '0';
            this.Deposit = mySectionManager.Cashier.SalesOrder.TxtDeposit.autoNumeric('get');
            this.ParkLabel = Formatter.ClearInvalidCharacter(mySectionManager.Cashier.SalesOrder.TxtParkLabel.val());
            this.DepositPaymentMethodID = Constants.IsNotEmpty(mySectionManager.Cashier.SalesOrder.DdlDepositPaymentMethod.val()) ? mySectionManager.Cashier.SalesOrder.DdlDepositPaymentMethod.val() : 0;
            this.InvoicedStateID = 3;
            if (POSData.Action.Type == SubmissionType.Park) {
                POSData.Order.InvoicedStateID = 1;
            }
        },
    },
    Items: [],
    Payments: [],
    Invoice: {
        Due: '',
        CustomDateField: '',
        assign: function () {
            this.Due = undefined;
            var creditSales = mySectionManager.Cashier.Payment.RadButtonPaymentTypeChecked.find("input:checked").val() == 1;
            if (POSData.Action.Type == SubmissionType.Bill || creditSales) {
                var due = (mySectionManager.Cashier.Payment.DPDue.val() != '' && mySectionManager.Cashier.Payment.DPDue.val() != undefined) ? new Date(Date.parse(mySectionManager.Cashier.Payment.DPDue.val())) : undefined;
                this.Due = Formatter.DateTime.ToSerializedString(due);
            }
            var customField = (mySectionManager.Cashier.Payment.DPCustomField.val() != '' && mySectionManager.Cashier.Payment.DPCustomField.val() != undefined) ? new Date(Date.parse(mySectionManager.Cashier.Payment.DPCustomField.val())) : undefined;
            this.CustomDateField = Formatter.DateTime.ToSerializedString(customField);

        },
    },
    Action: {
        Retry: false,
        Type: '',
        DeliveryEntityID: '',
        assign: function () {
            var pickup = mySectionManager.Cashier.Payment.RadButtonDeliveryChecked.find("input:checked").val() == "true" && POSData.Action.Type != SubmissionType.Park;
            if (pickup) {
                this.DeliveryEntityID = mySectionManager.Cashier.Payment.DdlEntity.val() != '' ? mySectionManager.Cashier.Payment.DdlEntity.val() : Constants.GuidEmpty;
            } else {
                this.DeliveryEntityID = Constants.GuidEmpty;
            }
        }
    },

    assign: function () {
        //assign sales order
        this.Order.assign();

        //assign customer po items
        POSData.Items.length = 0;
        var itemIndex = 1;
        myCashier.tableCart.children().each(function () {
            var item = $(this).data("item");
            var newItem = {
                ID: Constants.IsEmpty(item.ID) ? Constants.GuidEmpty : item.ID,
                VariantID: item.Variant.ID,
                Quantity: item.Quantity,
                UnitQuantity: 1,
                UnitCost: item.Cost,
                UnitPrice: item.Price,
                Discount: item.Discount,
                Note: Formatter.ClearInvalidCharacter(item.Note),
                Taxable: item.Variant.Taxable,
                LoyaltyPoint: item.Variant.LoyaltyPoint,
                Index: itemIndex

            };
            itemIndex++;
            POSData.Items.push(newItem);

        });

        //assign invoice and payment
        POSData.Payments.length = 0;



        //assign invoice when action type is not park
        this.Invoice.assign();
        this.Action.assign();

        //assign payment when is pay cash
        var creditSales = mySectionManager.Cashier.Payment.RadButtonPaymentTypeChecked.find("input:checked").val() == 1;
        if (this.Action.Type == SubmissionType.Payment && !creditSales) {
            //payment 1
            var paymentdate = POSData.Order.Date;
            //payment amount =  deposit, then record payment 1 as deposit
            if (Constants.IsNotEmpty(mySectionManager.Cashier.Payment.TxtAmount.attr('deposit'))) {
                if (mySectionManager.Cashier.Payment.TxtAmount.attr('deposit') == mySectionManager.Cashier.Payment.TxtAmount.autoNumeric('get')) {
                    var depositdate = new Date(Date.parse(mySectionManager.Cashier.Payment.TxtAmount.attr('depositDate')));
                    paymentdate = Formatter.DateTime.ToSerializedString(depositdate)
                }
            }
            var paymentamount1 = mySectionManager.Cashier.Payment.TxtAmount.autoNumeric('get');
            var change = mySectionManager.Cashier.Payment.TxtChange.autoNumeric('get');
            if (paymentamount1 != 0) {
                var payment1 = {
                    MethodID: mySectionManager.Cashier.Payment.FirstPaymentMethodID(),
                    Date: paymentdate,
                    Code: mySectionManager.Cashier.Payment.TxtCode.val(),
                    Note: Formatter.ClearInvalidCharacter(mySectionManager.Cashier.Payment.TxtNote.val()),
                    Amount: paymentamount1,
                    Index: 1,

                };
                if (change > 0) {
                    payment1.Amount = paymentamount1 - change;
                    payment1.PaidAmount = paymentamount1;
                }
                POSData.Payments.push(payment1);
            }
            if (change < 0 && myStorageManager.POSStorage.AppConfig.POS.PaymentSplit && mySectionManager.Cashier.Payment.DdlPaymentMethod2.val() != '') {
                var payment2 = {
                    MethodID: mySectionManager.Cashier.Payment.DdlPaymentMethod2.val(),
                    Date: POSData.Order.Date,
                    Amount: change * -1,
                    Index: 2
                };
                POSData.Payments.push(payment2);
            }

        }


    }
}



var quickKeyManager = {
    Groups: '',
    Items: '',
    ulQuickKeyGroup: '',
    liQuickKeyGroupTemplate: '',
    divUlQuickKeyItemTemplate: '',
    liQuickKeyItemTemplate: '',
    defaultImage: '',
    type: '',
    subFormat: '<div class=\"subQuickkey\" itemid="{0}"><ul Class="quickKeyTabs subQuickkeyTab"><li><a class="subQuickkeyBack"><span>&nbsp;</span><i></i></a></li><li class="ui-tabs-active"><a><span>{1}</span></a></li></ul><ul Class="items">{2}</ul></div>',
    subItemFormat: '<li><a class="clearfix" {0}="{1}" title="{2}"><span>{3}</span></li>',
    init: function (QuickKeyPack) {
        this.type = QuickKeyPack.TypeID;
        this.Groups = QuickKeyPack.Groups;
        this.Items = QuickKeyPack.Items;
        this.ulQuickKeyGroup = "<ul class='quickKeyTabs quickkeyParentTab'></ul>";
        this.liQuickKeyGroupTemplate = "<li><a href='#tabs-{0}'><span>{1}</span></li>";
        this.divUlQuickKeyItemTemplate = "<div id='tabs-{0}' class='quickkeyParentContent'><ul class='quickKeyItems clearfix'></ul></div>";
        this.liQuickKeyItemTemplate = "<li><a class='clearfix' {0}='{1}' title='{2}'><img id='QKimage' src='{3}'/><span>{4}</span></li>";
        this.defaultImage = "/Images/Cashier/default-pic.jpg";
    },
    clean: function () {
        if (mySectionManager.QuickKey.Tabs.data("ui-tabs")) {
            mySectionManager.QuickKey.Tabs.tabs("destroy");
        }
        mySectionManager.QuickKey.Tabs.empty();
        mySectionManager.QuickKey.Section.removeClass('bgQuickkeyIllustration');

    },
    GenerateTitle: function (ItemCode, ItemName) {
        if (ItemCode == null) {
            return ItemName;
        }
        else {
            return ItemName + " - " + ItemCode;
        }
    },
    clearSubQuickKey: function () {
        mySectionManager.QuickKey.Section.find("div[itemid]").hide();
    },
    render: function () {
        this.clearSubQuickKey();
        mySectionManager.QuickKey.Tabs.append(this.ulQuickKeyGroup);

        if (this.Groups.length > 4) {
            mySectionManager.QuickKey.Tabs.find("ul.quickkeyParentTab").addClass("quickKeyBigTab");
        }
        for (var x = 0; x < this.Groups.length; x++) {
            var liGroup = jQuery.validator.format(this.liQuickKeyGroupTemplate, x + 1, this.Groups[x].Name);
            mySectionManager.QuickKey.Tabs.find('ul.quickkeyParentTab').append(liGroup);

            var divUlItem = jQuery.validator.format(this.divUlQuickKeyItemTemplate, x + 1);
            mySectionManager.QuickKey.Tabs.append(divUlItem);
            var liItem = '';
            var itemcount = 0;
            for (var z = 0; z < this.Items.length; z++)//loop to get the desired item
            {
                if (this.Groups[x].ID == this.Items[z].GroupID) {
                    var itemName = this.Items[z].ItemName;
                    var itemID = this.Items[z].ItemID;
                    var itemTitle = this.GenerateTitle(this.Items[z].ItemCode, this.Items[z].ItemName);
                    var itemImage = this.Items[z].ImageURLClient;
                    var children = this.Items[z].Children;

                    if (quickKeyManager.type == 0) {
                        liItem += $.validator.format(this.liQuickKeyItemTemplate, "variantid", itemID, itemTitle, itemImage, itemName);
                    } else {
                        if (children.length == 0) {
                            liItem += $.validator.format(this.liQuickKeyItemTemplate, "id", itemID, itemTitle, itemImage, itemName);

                        } else if (children.length == 1) {
                            liItem += $.validator.format(this.liQuickKeyItemTemplate, "variantid", children[0].ID, itemTitle, itemImage, itemName);

                        } else if (children.length > 1) {
                            if (mySectionManager.QuickKey.Section.find("div[itemid=" + itemID + "]").length < 1) {
                                var subQuickkeyItem = quickKeyManager.generateSubQuickkey(children);
                                var subQuickkey = $.validator.format(this.subFormat, itemID, itemName, subQuickkeyItem);
                                mySectionManager.QuickKey.Section.append(subQuickkey);
                            }
                            liItem += $.validator.format(this.liQuickKeyItemTemplate, "itemid", itemID, itemTitle, itemImage, itemName);
                        }
                    }
                    itemcount++;
                }
            }
            for (var i = 0; i < (16 - itemcount) ; i++) {
                liItem += jQuery.validator.format(this.liQuickKeyItemTemplate, "id", "", "", this.defaultImage, "");
            }
            mySectionManager.QuickKey.Tabs.find('div.quickkeyParentContent:last-child').find("ul.quickKeyItems").html(liItem);
        }
        if (this.Items.length > 0) {
            mySectionManager.QuickKey.LinkConfigureQuickkey.hide();
        }
        mySectionManager.QuickKey.Tabs.tabs();
        mySectionManager.QuickKey.Section.find("a[variantid]").unbind("click");
        mySectionManager.QuickKey.Section.find("a[variantid]").click(function () {
            var id = $(this).attr('variantid');

            AjaxForm.OnVariantSelectID(id, true, !myStorageManager.POSStorage.AppConfig.POS.QuickKeyToNewRow, false);
            $(this).closest('div[itemid]').hide();


        });
        mySectionManager.QuickKey.Section.find("a[itemid]").click(function () {
            var id = $(this).attr('itemid');
            mySectionManager.QuickKey.Section.find("div[itemid=" + id + "]").show();

        });

        mySectionManager.QuickKey.Section.find("a.subQuickkeyBack").click(function () {
            $(this).closest('div[itemid]').hide();
        });
    },
    generateSubQuickkey: function (children) {
        var options = '';
        $.each(children, function (index, item) {
            var option = $.validator.format(quickKeyManager.subItemFormat, "variantid", item.ID, quickKeyManager.GenerateTitle(item.Code, item.Model), item.Model);
            options += option;
        });

        return options;
    },
    GenerateLinkConfigure: function (QuickkeyID) {
        var formatString = "<Strong>QUICK KEYS UNCONFIGURED</Strong><i></i><span>{0}</span>";
        var linkAdd = "/Authenticated/Settings/Application/QuickKey/Form.aspx";
        var linkEdit = "/Authenticated/Settings/Application/QuickKey/Form.aspx?ID={0}";

        if (myStorageManager.IsInRole(AppRole.Setup)) {
            if (QuickkeyID != Constants.GuidEmpty) {
                mySectionManager.QuickKey.LinkConfigureQuickkey.attr('href', $.validator.format(linkEdit, QuickkeyID));
                mySectionManager.QuickKey.LinkConfigureQuickkey.html($.validator.format(formatString, "Click here to setup your Quick keys"));

            }
            else {
                mySectionManager.QuickKey.LinkConfigureQuickkey.attr('href', linkAdd);
                mySectionManager.QuickKey.LinkConfigureQuickkey.html($.validator.format(formatString, "Click here to setup your Quick keys"));
            }
        } else {
            mySectionManager.QuickKey.LinkConfigureQuickkey.attr('href', '#');
            mySectionManager.QuickKey.LinkConfigureQuickkey.html($.validator.format(formatString, "Contact Administrator to setup Quick Key"));

        }



    },
}

var myCashier = {
    tableCart: '',
    items: [],
    rowHTML: "<tr title=\"Click to Edit\"><td>{0}</td><td><span></span><p></p></td><td></td><td></td><td></td><td></td><td></td></tr>",
    rowDeleteHTML: "<img src='/Images/Icon/Op/Delete.png' title='Click to Remove'",
    usePrice: true,
    priceAsCost: false,
    init: function (usePrice, priceAsCost) {
        this.usePrice = usePrice;
        if (typeof (priceAsCost) != "undefined") {
            this.priceAsCost = prClearMemberPointiceAsCost;
        }

        this.tableCart = $("table.cart tbody");
        if (this.usePrice) {
            this.rowHTML = "<tr title=\"Click to Edit\"><td>{0}</td><td><span></span><p></p></td><td></td><td></td><td></td><td></td><td></td></tr>"
        }
        else {
            this.rowHTML = "<tr title=\"Click to Edit\"><td>{0}</td><td><span></span><p></p></td><td></td><td></td></tr>";
        }

        $.contextMenu.types.jsTree = function (item, opt, root) {
            $('<a><i></i><span>&nbsp;</span>' + item.name + '</a>').appendTo(this);

        };
        $.contextMenu.types.jsTreeSeparator = function (item, opt, root) {
            $('<a>&nbsp;</a>').appendTo(this);

        };


        $.contextMenu({
            selector: 'table.cart tbody tr',
            items: {
                "Return": {
                    type: "jsTree",
                    name: "Return",
                    icon: "return",
                    disabled: function () {
                        return !myStorageManager.IsInRole(AppRole.Return);
                    },
                    callback: function () {
                        myCashier.changeStatus($(this), true);
                    }
                },
                "Sales": {
                    type: "jsTree",
                    name: "Sales",
                    icon: "sales",
                    callback: function () { myCashier.changeStatus($(this), false) }
                },
                separator1: "-----",
                "Merge": {
                    type: "jsTree",
                    name: "Merge Price",
                    icon: "Combine",
                    callback: function () { myCashier.MergePrice($(this)) }
                },
            }
        });

    },
    additem: function (item) {
        var result = jQuery.validator.format(this.rowHTML, this.rowDeleteHTML);
        var row = $(result);
        row.find("img").click(function () {
            $(this).closest("tr").remove();
            amountUI.update();
        });

        row.click(function () {
            var row = $(this);
            dialogCart.fillRowData(row);
        });

        this.tableCart.append(row);
        dialogCart.clear();

        row.data("item", item);
        this.reflectRowData(row);
        amountUI.update();
    },
    reflectRowData: function (row) {
        var item = row.data("item");

        row.children().eq(1).find("span").text(item.Variant.Name);

        if (item.Note != null) {
            row.children().eq(1).find("p").html(Constants.NewLineToBR(item.Note));
        }

        if (item.Variant.Code != null) {
            row.children().eq(2).text(item.Variant.Code);
        }

        var qtyLabel = Formatter.Number(item.Quantity);
        if (item.UnitQuantity > 1) {
            qtyLabel += " @" + Formatter.Number(item.UnitQuantity);
        }

        row.children().eq(3).text(qtyLabel);

        if (this.usePrice) {
            row.children().eq(4).text(Formatter.Number(item.Price));

            var discount = "";
            if (item.Discount > 0) {
                discount = "-" + Formatter.Number(item.Discount);
            }
            row.children().eq(5).text(discount);

            var total = item.Quantity * item.Price * (100 - item.Discount) / 100;
            row.children().eq(6).text(Formatter.Number(total));
        }
    },
    updateAllPrice: function () {
        var updatePrice = parseInt($("#txtUpdatePrice").autoNumeric('get'));
        this.tableCart.children().each(function () {
            var row = $(this);
            var item = row.data("item");
            item.Price = updatePrice;
            myCashier.reflectRowData(row);
        });
    },
    clear: function () {
        this.tableCart.children().remove();
        dialogCart.clear();
        amountUI.update();
    },
    changeStatus: function (row, returnStatus) {
        var item = row.data("item");
        if (returnStatus) {
            if (item.Quantity > 0) {
                item.Quantity = item.Quantity * -1;
            }
        } else {
            if (item.Quantity < 0) {
                item.Quantity = item.Quantity * -1;
            }
        }

        myCashier.reflectRowData(row);
        amountUI.update();
    },
    MergePrice: function (row) {

        var item = row.data("item");
        var totalAmount = 0;
        this.tableCart.children().each(function () {
            var row = $(this);
            var item = row.data("item");
            totalAmount += item.Quantity * item.Price * (100 - item.Discount) / 100;
            item.Price = 0;
            myCashier.reflectRowData(row);
        });
        item.Price = totalAmount / item.Quantity;


        myCashier.reflectRowData(row);
        amountUI.update();
    }
}

var dialogCart = {
    Row: null, //temporary storage
    AutoFillQuantity: false,
    Name: '',
    Quantity: '',
    UnitQuantity: '',
    UnitQuantityPrice: '',
    DivUnitQuantity: '',
    UOM: '',
    Cost: '',
    CostRow: '',
    Price: '',
    Discount: '',
    Note: '',
    LblItemPrice: '',
    listSerial: '',
    trItemSerial: '',
    trItemNote: '',
    linkSwithSerial: '',
    lblAvailable: '',
    divAvailableItem: '',
    DivPriceCalculator: '',
    DivQtyCalculator: '',
    TxtPriceCalc1: '',
    TxtPriceCalc2: '',
    TxtQtyCalc1: '',
    TxtQtyCalc2: '',
    init: function () {
        var autoFillAttr = mySectionManager.General.DialogItem.attr('autoFillQuantity');
        this.AutoFillQuantity = autoFillAttr == "1";
        this.Name = $("input.txtBarcodeDialog");
        this.Quantity = $("#txtItemQty");
        this.UnitQuantity = $("#txtUnitQty");
        this.UnitQuantityPrice = $("#txtUnitQtyPrice");
        this.DivUnitQuantity = $("div.unitQty");
        this.UOM = $("#lblItemUOM");
        this.Cost = $("#txtItemCost");
        this.CostRow = $(".costRow")
        this.Price = $("#txtItemPrice");
        this.Discount = $("#txtItemDiscount");
        this.Note = $("#txtItemNote");
        this.LblItemPrice = $("#lblItemPrice");
        this.listSerial = $("#listSerial");
        this.trItemSerial = $("#trItemSerial");
        this.trItemNote = $("#trItemNote");
        this.linkSwithSerial = $('#linkSwithSerial');
        this.lblAvailable = $('#lblAvailable');
        this.divAvailableItem = $('#divAvailableItem');
        this.DivPriceCalculator = $('#divPriceCalculator');
        this.TxtPriceCalc1 = $('#txtPriceCalc1');
        this.TxtPriceCalc2 = $('#txtPriceCalc2');
        this.DivQtyCalculator = $('#divQtyCalculator');
        this.TxtQtyCalc1 = $('#txtQtyCalc1');
        this.TxtQtyCalc2 = $('#txtQtyCalc2');
        this.trItemSerial.hide();

        this.listSerial.change(function () {
            var serial = "";
            var length = 0;
            if ($(this).val() != null) {
                serial = $(this).val().toString();
                length = $(this).val().length;
            }
            dialogCart.Note.val($.validator.format("[{0}]", serial));
            dialogCart.Quantity.val(length);

        })
        this.linkSwithSerial.click(function () {
            dialogCart.trItemNote.show();
            dialogCart.trItemSerial.hide();
        });


        // not allowed give discount
        if (!myStorageManager.IsInRole(AppRole.Discount)) {
            this.Discount.attr("disabled", "disabled");
            mySectionManager.Cashier.SalesOrder.BtnDiscount.attr("disabled", "disabled");
        }

        if (!myStorageManager.IsInRole(AppRole.Return)) {
            this.Quantity.attr("class", "txtAbsolute");
        }

        if (!myStorageManager.POSStorage.AppConfig.POS.Cost.Visible || !myStorageManager.IsInRole(AppRole.Cost)) {
            this.CostRow.hide();
        }
        if (!myStorageManager.POSStorage.AppConfig.POS.Cost.Enabled) {
            this.Cost.attr("disabled", "disabled");
        }
        this.UnitQuantityPrice.keyup(function () {
            var unitQtyPrice = dialogCart.UnitQuantityPrice.autoNumeric('get');
            var unitQty = dialogCart.UnitQuantity.autoNumeric('get');
            dialogCart.Price.autoNumeric('set', unitQtyPrice * unitQty);
        });
        this.Quantity.keyup(function () {
            if (!Constants.IsNotEmpty(mySectionManager.Cashier.SalesOrder.TxtContact.data("pricebook"))) {
                myPriceBook.assignByQuantity();
            }
        });
        if (myStorageManager.POSStorage.AppConfig.POS.NumberPad.Enabled) {
            dialogCart.Quantity.numpad(
                {
                    ID: "dialogCartNumpadQuantity",
                    onChange: function (event, value) {
                        dialogCart.Quantity.autoNumeric('set', value);
                        if (!Constants.IsNotEmpty(mySectionManager.Cashier.SalesOrder.TxtContact.data("pricebook"))) {
                            myPriceBook.assignByQuantity();
                        }
                    }
                });
            dialogCart.Price.numpad(
                {
                    ID: "dialogCartNumpadPrice",
                    onChange: function (event, value) {
                        dialogCart.Price.autoNumeric('set', value);

                    }
                });
            dialogCart.Cost.numpad(
                {
                    ID: "dialogCartNumpadCost",
                    onChange: function (event, value) {
                        dialogCart.Cost.autoNumeric('set', value);

                    }
                });
            dialogCart.Discount.numpad(
              {
                  ID: "dialogCartNumpadDiscount",
                  onChange: function (event, value) {
                      dialogCart.Discount.autoNumeric('set', value);

                  }
              });
        }
        //dialog barcode
        this.Name.keypress(function (e) {
            if (e.keyCode == 13) {
                var inputBarcode = $(this);
                AjaxForm.SelectVariantByCode(inputBarcode.val(), false, true);

            }
        });

        if (!myStorageManager.POSStorage.AppConfig.AdvanceConfig.Sell.DialogItemCalculatorEnabled) {
            this.DivPriceCalculator.hide();
            this.DivQtyCalculator.hide();
        } else {
            this.TxtPriceCalc1.keyup(function (e) {
                dialogCart.CalculatePrice();
            });
            this.TxtPriceCalc2.keyup(function (e) {
                dialogCart.CalculatePrice();
            });
            this.TxtQtyCalc1.keyup(function (e) {
                dialogCart.CalculateQty();
            });
            this.TxtQtyCalc2.keyup(function (e) {
                dialogCart.CalculateQty();
            });


        }

    },
    clear: function () {
        this.Name.val('');
        this.Name.removeAttr("disabled");
        this.Quantity.val('');
        this.UnitQuantity.val('');
        this.UnitQuantityPrice.val('');
        this.DivUnitQuantity.hide();
        this.Cost.val('');
        this.Price.val('');
        this.Discount.val('');
        this.Note.val('');
        this.UOM.text('');
        this.trItemNote.show();
        this.trItemSerial.hide();
        this.Note.attr("placeholder", "");
        this.Row = null;
        this.Name.removeData("variant");
        myPriceBook.clear();
        this.LblItemPrice.removeClass("tooltip-data-title");
        this.lblAvailable.text('');
        this.divAvailableItem.hide();
        $("[id*='dialogCartNumpad']").hide();
        this.TxtPriceCalc1.val('');
        this.TxtPriceCalc2.val('');
        this.TxtQtyCalc1.val('');
        this.TxtQtyCalc2.val('');
    },
    fillRowData: function (row) {
        this.Row = row;
        var item = row.data("item");

        // not allowed edit item price
        if (!myStorageManager.IsInRole(AppRole.Price) && item.Variant.TypeID != VariantInventoryType.NonInventory) {
            this.Price.attr("disabled", "disabled");
        } else {
            this.Price.removeAttr("disabled");
        }
        //is serial item
        if (item.Variant.TypeID == VariantInventoryType.Serialized) {
            this.trItemNote.hide();
            this.trItemSerial.show();
            this.GenerateSerial(item.Variant.ID, item.Note);
            this.Note.attr("placeholder", "Insert Serial with pattern [serial1,serial2,serial3]");
            if (item.ID != '') {
                this.listSerial.attr("disabled", "disabled");
            }
            else {
                this.listSerial.removeAttr("disabled");
            }

        } else {
            this.trItemNote.show();
            this.trItemSerial.hide();
        }

        this.Name.val(item.Variant.Name);
        this.Name.data("variant", item.Variant);

        if (item.ID != '') {
            this.Name.attr("disabled", "disabled");
        }
        else {
            this.Name.removeAttr("disabled");
        }

        //unit in stock & uom


        if (item.Variant.UnitsInStock != Constants.DecimalMinValue && POSSettings.queryRealtime() && myStorageManager.IsInRole(AppRole.Inventory)) {
            this.lblAvailable.text(Formatter.Number(item.Variant.UnitsInStock));
            this.divAvailableItem.show();
        }


        if (item.Variant.UOM != null) {
            this.UOM.text(item.Variant.UOM);
        }


        if (myStorageManager.POSStorage.AppConfig.POS.LoadPriceBook) {
            myPriceBook.generate(item.Variant);
        }

        this.Quantity.autoNumeric('set', item.Quantity);
        this.UnitQuantity.autoNumeric('set', item.Variant.UnitQuantity);
        this.processVariantUI(item.Variant);

        if (item.Variant.UnitQuantity > 1) {
            this.UnitQuantityPrice.autoNumeric('set', item.Price / item.Variant.UnitQuantity);
        }

        this.Cost.autoNumeric('set', item.Cost);
        this.Price.autoNumeric('set', item.Price);
        this.Discount.autoNumeric('set', item.Discount);
        this.Note.val(item.Note);
        this.SetToolTip(item.Variant);

        this.open(true);
    },
    processVariantUI: function (variant) {
        if (variant.UnitQuantity > 1) {
            this.DivUnitQuantity.css("display", "inline-block");
        }
        else {
            this.DivUnitQuantity.hide();
        }
    },
    get: function () {
        var v = this.Name.data("variant");
        var currentID = this.Row == null ? '' : this.Row.data("item").ID;

        var item = {
            Variant: v,
            ID: currentID,
            Quantity: this.Quantity.autoNumeric('get'),
            UnitQuantity: parseInt(this.UnitQuantity.autoNumeric('get')),
            Cost: this.Cost.autoNumeric('get'),
            Price: this.Price.autoNumeric('get'),
            Discount: this.Discount.autoNumeric('get'),
            Note: this.Note.val()
        };

        return item;
    },
    open: function (edit) {
        mySectionManager.General.DialogItem.dialog('option', 'title', 'Add new items to order');
        if (edit) {
            mySectionManager.General.DialogItem.dialog('option', 'title', 'Update current item');
        }
        this.Name.focus();
        mySectionManager.General.DialogItem.dialog('open');
    },
    SetToolTip: function (variant) {
        this.LblItemPrice.addClass("tooltip-data-title");

        if (!myCashier.priceAsCost) {
            this.LblItemPrice.attr("data-title", Formatter.Number(variant.UnitPrice));
        }
        else {
            this.LblItemPrice.attr("data-title", Formatter.Number(variant.UnitCost));
        }


    },
    GenerateSerial: function (variantID, variantNote) {
        if (POSSettings.isOnline()) {
            var entityID = myRegister.getEntityID();
            if (entityID == "") {
                entityID = Constants.GuidEmpty;
            }
            var soID = mySectionManager.Cashier.SalesOrder.HfSalesOrderID.val();
            var selected = new Array();
            if (variantNote != null) {
                selected = variantNote.replace("[", "").replace("]", "").split(",");
            }

            $.ajax({
                url: "/Authenticated/Services/Catalog.asmx/GetVariantSerial",
                data: "{ 'entityID' : '" + entityID + "','variantID' : '" + variantID + "','soID' : '" + soID + "'}",
                dataType: "json",
                type: "POST",

                contentType: "application/json; charset=utf-8",
                dataFilter: function (data) { return data; },
                success: function (data) {
                    if (data.d.length > 0) {
                        var options = "";
                        $.each(data.d, function (index, item) {
                            var opSelected = (selected.indexOf(item.Serial) > -1) ? "Selected" : "";
                            var option = $.validator.format("<option value=\"{0}\" {1}>{0}</option>", item.Serial, opSelected);
                            options += option;
                        })
                    }
                    dialogCart.listSerial.html(options);
                    dialogCart.listSerial.trigger("chosen:updated");
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(posAlertMessage.failGetSerial);
                }
            });

        }
    },
    CalculatePrice: function () {
        var price = this.TxtPriceCalc1.autoNumeric('get') * this.TxtPriceCalc2.autoNumeric('get');
        this.Price.autoNumeric('set', price);
    },
    CalculateQty: function () {
        var qty = this.TxtQtyCalc1.autoNumeric('get') * this.TxtQtyCalc2.autoNumeric('get');
        this.Quantity.autoNumeric('set', qty);
    }
}

var disc = {
    discCalc1: '',
    discCalc2: '',
    discCalc3: '',
    init: function () {
        this.discCalc1 = $(".discCalc1");
        this.discCalc2 = $(".discCalc2");
        this.discCalc3 = $(".discCalc3");
        disc.discCalc1.keyup(function () {
            disc.calc()
        })
        disc.discCalc2.keyup(function () {
            disc.calc()
        })
        disc.discCalc3.keyup(function () {
            disc.calc()
        })
        mySectionManager.Cashier.SalesOrder.TxtDisc1.keyup(function () {
            disc.Clear();
        })

    },
    Clear: function () {
        this.discCalc1.val(''),
        this.discCalc2.val(''),
        this.discCalc3.val('')
    },
    get: function () {
        var item = {
            Disc1: this.discCalc1.val(),
            Disc2: this.discCalc2.val(),
            Disc3: this.discCalc3.val(),
        };
        return item;
    },
    calc: function () {
        var item = disc.get();
        var disc1 = (1 - (item.Disc1 / 100));
        var disc2 = (1 - (item.Disc2 / 100));
        var disc3 = (1 - (item.Disc3 / 100));
        var total = 100 - (100 * disc1 * disc2 * disc3);
        mySectionManager.Cashier.SalesOrder.TxtDisc1.val(Formatter.Number(total));
        amountUI.update();
    }
}

var amountUI = {
    RowFormat: "<tr><th>{0}</th><td>{1}</td></tr>",
    Table: '',
    AmountInput: '',
    Quantity: '',
    Total: '',
    init: function () {
        this.Table = $("table.calc");
        this.AmountInput = $("#" + this.Table.attr("inputID"));
        this.Quantity = $("div.head h2 span");
        mySectionManager.Cashier.SalesOrder.TxtDisc1.keyup(function () { amountUI.update(); });
        mySectionManager.Cashier.SalesOrder.TxtDisc2.keyup(function () { amountUI.update(); });
        mySectionManager.Cashier.SalesOrder.TxtDiscAmount.keyup(function () { amountUI.update(); });
        mySectionManager.Cashier.SalesOrder.DdlTax.change(function () { amountUI.update(); });
        mySectionManager.Cashier.SalesOrder.DdlCurrency.change(function () { amountUI.update(); });
        mySectionManager.Cashier.SalesOrder.DdlPromotion.change(function () {
            amountUI.updatePromotion();
        });
    },
    update: function () {
        var total = 0;
        var totalQty = 0;
        var totalQtyFormatted = 0;
        var totalTaxable = 0;
        var clipped = false;

        myCashier.tableCart.children().each(function () {
            var item = $(this).data("item");
            var rowTotal = item.Quantity * item.Price * (100 - item.Discount) / 100;
            total += rowTotal;
            totalQty += item.Quantity;
            if (totalQty.toString().length > 5) {
                totalQtyFormatted = Formatter.Number(totalQty).toString().substring(0, 6);
                clipped = true;
            }
            else {
                totalQtyFormatted = Formatter.Number(totalQty);
            }

            if (item.Variant.Taxable) {
                totalTaxable += rowTotal;
            }
        });

        //Total Quantity Label
        var totalQtyLabel = Formatter.Number(totalQty).toString();
        if (totalQtyLabel.length > 5) {
            totalQtyLabel = totalQtyLabel.substring(0, 5) + '~';
        }
        this.Quantity.text(totalQtyLabel);

        var originalTotal = total;
        this.Table.find("tr").not(':first').remove();

        var td = this.Table.find("tr:first-child td");
        var totalString = Formatter.Number(total);
        td.text(totalString);

        if (totalTaxable > 0) {
            totalTaxable -= this.processDiscount(mySectionManager.Cashier.SalesOrder.TxtDisc1, totalTaxable, false);
            totalTaxable -= this.processDiscount(mySectionManager.Cashier.SalesOrder.TxtDisc2, totalTaxable, false);
        }

        if (myCashier.usePrice) {
            total -= this.processDiscount(mySectionManager.Cashier.SalesOrder.TxtDisc1, total, true);
            total -= this.processDiscount(mySectionManager.Cashier.SalesOrder.TxtDisc2, total, true);

            if (mySectionManager.Cashier.SalesOrder.TxtDiscAmount.length > 0) {
                var discAmount = parseFloat(mySectionManager.Cashier.SalesOrder.TxtDiscAmount.autoNumeric('get'));
                if (discAmount != 0) {
                    var rowHTML = jQuery.validator.format(this.RowFormat, "Discount " + mySectionManager.Cashier.SalesOrder.DdlCurrency.find('option:selected').text(), Formatter.Number(discAmount));
                    this.Table.append($(rowHTML));

                    total -= discAmount;
                    totalTaxable -= discAmount;
                }
            }

            if (mySectionManager.Cashier.SalesOrder.DdlTax.length > 0) {
                var option = mySectionManager.Cashier.SalesOrder.DdlTax.find(":selected");
                var taxID = option.val();
                var rate = parseFloat(option.attr("rate"));
                var type = option.attr("type");

                var tax = myStorageManager.GetTaxByID(taxID);

                if (rate > 0) {
                    var taxAmount = 0;
                    var taxLabel = "";

                    //TaxCalculation.Add
                    if (type == "0") {
                        taxAmount = rate / 100 * totalTaxable;
                        total += taxAmount;
                    }
                    else {
                        //TaxCalculation.Include
                        taxAmount = (rate / (100.0 + rate)) * totalTaxable;
                    }
                    taxLabel = jQuery.validator.format("Tax {0} %", rate);
                    var rowHTML = jQuery.validator.format(this.RowFormat, taxLabel, Formatter.Number(taxAmount));

                    //for multiple tax 
                    if (type == "0" && tax.TypeID == "2" && tax.Components != null) {
                        if (tax.Components.length > 1) {
                            rowHTML = '';
                            var totalAmountCount = totalTaxable;
                            $.each(tax.Components, function (i, components) {
                                var taxComponentAmount = components.Rate / 100 * totalAmountCount;
                                totalAmountCount += taxComponentAmount;
                                taxLabel = jQuery.validator.format("{0} {1} %", components.Label, components.Rate);
                                rowHTML += jQuery.validator.format(amountUI.RowFormat, taxLabel, Formatter.Number(taxComponentAmount));
                            });
                        }
                    }

                    this.Table.append($(rowHTML));
                }

            }
            if (myStorageManager.POSStorage.AppConfig.AdvanceConfig.Payment.RoundingEnabled) {
                total = Math.round(total);
            }
            mySectionManager.General.BtnPay.children("span").text(Formatter.Number(total));
            this.AmountInput.autoNumeric('set', total);
            this.Total = total;
            mySectionManager.Cashier.Payment.TxtChange.val("0");

            //currency path

            var currenciesSuggestion = jQuery.grep(myStorageManager.POSStorage.Currencies, function (n, i) {
                return (n.ConversionSuggestion && n.ID != myStorageManager.POSStorage.AppConfig.Core.Defaults.CurrencyID);
            });

            if (currenciesSuggestion.length > 0) {
                var sugestion = "";
                $.each(currenciesSuggestion, function (index, item) {
                    var exchangeAmount = total / item.ExchangeRate;
                    var row = $.validator.format("<span>{0} {1}</span>", item.Symbol, Formatter.Number(exchangeAmount));
                    sugestion += row;
                })
                mySectionManager.General.BtnPay.addClass("toolTipEnabled");
                mySectionManager.General.BtnPay.children("div.toolTip").html(sugestion);
            } else {
                mySectionManager.General.BtnPay.removeClass("toolTipEnabled");
            }

            //When total is empty, payment types will always be cash
            if (typeof (myPaymentDialog) != "undefined") {
                if (myPaymentDialog.inputs.length > 1) {
                    if (total == 0) {
                        var inputCash = myPaymentDialog.inputs.eq(0);
                        inputCash.prop('checked', true);
                        myPaymentDialog.refreshUI();
                        myPaymentDialog.hideOption();
                    }
                    else {
                        myPaymentDialog.showOption();
                        mySectionManager.Cashier.Payment.PaymentTypeSetDefault();
                    }
                }
            }

        }

    },
    processDiscount: function (input, amount, show) {
        if (input.length > 0) {
            var disc = parseFloat(input.autoNumeric('get'));
            if (disc != 0) {
                var discAmounted = (disc / 100) * amount;

                if (show) {
                    var discLabel = jQuery.validator.format("Discount {0} %", disc);
                    var rowHTML = jQuery.validator.format(this.RowFormat, discLabel, Formatter.Number(discAmounted));
                    this.Table.append($(rowHTML));
                }

                return discAmounted;
            }
        }

        return 0;
    },
    updatePromotion: function () {
        mySectionManager.Cashier.SalesOrder.TxtDisc1.autoNumeric('set', mySectionManager.Cashier.SalesOrder.DdlPromotion.val());
        mySectionManager.Cashier.SalesOrder.TxtNoteOverall.val(mySectionManager.Cashier.SalesOrder.DdlPromotion.find('option:selected').text());

        amountUI.update();
    }
}


var myEmailInvoice = {
    invID: '',
    Clear: function () {
        this.invID = '';
        mySectionManager.General.txtEmailInvoice.val("");
    },
    GetEmail: function () {
        if (Constants.IsNotEmpty(this.invID)) {
            if (POSSettings.isOnline()) {
                if (Constants.IsNotEmpty(POSData.Order.CustomerID)) {
                    $.ajax({
                        url: "/Authenticated/Services/Customer.asmx/GetEmailByID",
                        data: "{ 'id' : '" + POSData.Order.CustomerID + "'}",
                        dataType: "json",
                        type: "POST",
                        contentType: "application/json; charset=utf-8",
                        dataFilter: function (data) { return data; },
                        async: false,
                        success: function (data) {
                            mySectionManager.General.txtEmailInvoice.val(data.d);
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert(posAlertMessage.failGetCustomer);
                            return false;
                        }
                    });
                }
                return true;
            }
            else {
                alert(posAlertMessage.wrongOfflineAction);
                return false;
            }
        } else {
            alert(posAlertMessage.wrongOfflineAction);
            return false;


        }
    },
    Send: function () {
        if (POSSettings.isOnline()) {
            var email = mySectionManager.General.txtEmailInvoice.val();
            AjaxForm.Block();
            $.ajax({
                url: "/Authenticated/Services/Transaction.asmx/SendEmail",
                data: "{ 'invoiceID' : '" + this.invID + "','email' : '" + email + "'}",
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                dataFilter: function (data) { return data; },
                success: function (data) {
                    AjaxForm.UnBlock();
                    if (data.d.Success) {
                        AjaxForm.Alert($.validator.format(posAlertMessage.successSendEmail, email));
                    } else {
                        AjaxForm.Alert(data.d.Message);
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(posAlertMessage.failGetCustomer);
                    AjaxForm.UnBlock();
                }
            });
        }
        else {
            alert(posAlertMessage.wrongOfflineAction);
        }
    }
}
var myCustomer = {
    TxtName: '',
    HfID: '',
    DpBirthDate: '',
    TxtNRIC: '',
    TxtAddr: '',
    TxtPhone: '',
    TxtEmail: '',
    TxtCode: '',
    DdlGender: '',
    DdlCity: '',
    DdlNationality: '',
    DdlRace: '',
    CbkGroup: '',
    DivCity: '',
    DivNationality: '',
    DivRace: '',
    DivGroup: '',
    TxtType: '',
    CreateEnable: '',
    Dialog: '',
    Action: '',
    init: function () {
        this.TxtName = $("#txtInput");
        this.HfID = $('#hfID');
        this.DpBirthDate = $(".dpBirthDate");
        this.TxtNRIC = $("#txtContactNRIC");
        this.TxtAddr = $("#txtContactAddress");
        this.TxtPhone = $("#txtContactPhone");
        this.TxtEmail = $("#txtContactEmail");
        this.TxtCode = $("#txtContactCode");
        this.DdlGender = $("#ddlGender");
        this.DdlCity = $("#ddlCity");
        this.DdlNationality = $("#ddlNationality");
        this.DdlRace = $("#ddlRace");
        this.CbkGroup = $("#ulCustomerGroups");
        this.DivCity = $('#divCustomerCity');
        this.DivNationality = $('#divCustomerNationality');
        this.DivRace = $('#divCustomerRace');
        this.DivGroup = $("#divCustomerGroup");
        this.TxtType = $("#txtContactType");
        this.CreateEnable = $("a.btn-add").is(":visible");
        this.Dialog = $("#dialogCustomer");
        this.GenerateCity();
        this.GenerateNationality();
        this.GenerateRace();
        this.GenerateGroup();
        mySectionManager.Cashier.SalesOrder.TxtContact.change(function () {
            amountUI.update();

        });
        mySectionManager.Cashier.SalesOrder.TxtContact.keypress(function (e) {
            mySectionManager.General.DivCustomerGroup.html('');
            if (e.keyCode == 13) {
                myCustomer.SelectByCode($(this).val());
            }
        });

        this.TxtNRIC.attr("placeholder", myStorageManager.POSStorage.AppConfig.Labels.NationalIdentificationNumber);
    },
    OnSelect: function (custID) {
        myCustomer.ClearMemberPoint();
        if (POSSettings.isOnline()) {
            $.ajax({
                url: "/Authenticated/Services/Customer.asmx/GetPrivilegeByID",
                data: "{ 'id' : '" + custID + "'}",
                dataType: "json",
                type: "POST",

                contentType: "application/json; charset=utf-8",
                dataFilter: function (data) { return data; },
                success: function (data) {
                    mySectionManager.Cashier.SalesOrder.TxtMemberPoint.val('');
                    mySectionManager.Cashier.SalesOrder.TxtMemberPoint.autoNumeric('update', { vMax: data.d.Point });
                    mySectionManager.Cashier.SalesOrder.TxtMemberPoint.next().html('/ ' + data.d.Point);
                    mySectionManager.Cashier.SalesOrder.TxtContact.data("pricebook", data.d.PricebookID);
                    mySectionManager.Cashier.SalesOrder.TxtContact.data("duedays", data.d.DueDays);
                    if (Constants.IsNotEmpty(data.d.SalesID)) {
                        mySectionManager.Cashier.SalesOrder.DdlSales.val(data.d.SalesID);
                        mySectionManager.Cashier.SalesOrder.DdlSales.trigger("chosen:updated");
                    }
                    //group display
                    if (data.d.Groups.length > 0) {
                        var groupDisplay = "";
                        $.each(data.d.Groups, function (i, item) {
                            groupDisplay += $.validator.format("<li>{0}</li>", item.Name);
                        })
                        groupDisplay = $.validator.format("<ul>{0}</ul>", groupDisplay);
                        mySectionManager.General.DivCustomerGroup.html(groupDisplay);
                    }

                    if (data.d.DiscountRate > 0) {
                        mySectionManager.Cashier.SalesOrder.TxtDisc1.val(data.d.DiscountRate);
                        amountUI.update();
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(posAlertMessage.failGetCustomer);
                }
            });

        }
    },
    SelectByCode: function (code) {
        if (POSSettings.isOnline()) {
            var validCode = Formatter.ClearInvalidCharacter(code);
            $.ajax({
                url: "/Authenticated/Services/Customer.asmx/GetByCode",
                data: "{ 'code': '" + validCode + "'}",
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                dataFilter: function (data) { return data; },
                success: function (data) {
                    var variant = data.d;
                    if (data.d != null) {
                        mySectionManager.Cashier.SalesOrder.TxtContact.val(data.d.Display);
                        mySectionManager.Cashier.SalesOrder.HfCustomer.val(data.d.ID);
                        myCustomer.OnSelect(data.d.ID);
                    }
                    else {
                        var msg = jQuery.validator.format(posAlertMessage.emptyCustomerFormat, code);
                        alert(msg);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(posAlertMessage.failGetCustomer);
                }

            });
        }
        else {

            var customer = myLocalStorage.customers.GetByCode(code);
            if (customer.length > 0) {
                customer = customer[0];
                mySectionManager.Cashier.SalesOrder.TxtContact.val(customer.Display);
                mySectionManager.Cashier.SalesOrder.HfCustomer.val(customer.ID);
                myCustomer.OnSelect(customer.ID);
            } else {
                var msg = jQuery.validator.format(posAlertMessage.emptyCustomerFormat, code);
                alert(msg);
            }


        }
    },
    Create: function () {
        if (this.CreateEnable) {
            if (POSSettings.isOnline()) {
                if (this.TxtName.val() == "") {
                    return false;
                }
                if (this.HfID.val() != "") {
                    mySectionManager.Cashier.SalesOrder.TxtContact.val(this.TxtName.val());
                    mySectionManager.Cashier.SalesOrder.HfCustomer.val(this.HfID.val()).trigger('change');
                    this.OnSelect(this.HfID.val());
                    this.Clear();
                    return true;
                }
                var bd = undefined;
                if (!Constants.IsEmpty(this.DpBirthDate.val())) {
                    bd = new Date(Date.parse(this.DpBirthDate.val()));
                }

                var raceVal = Constants.GuidEmpty;
                if (!Constants.IsEmpty(this.DdlRace.val())) {
                    raceVal = this.DdlRace.val();
                }

                var groupVal = [];
                this.CbkGroup.find("input[type=checkbox]:checked").each(function () {
                    groupVal.push($(this).val());
                });

                var nationalityVal = Constants.GuidEmpty;
                if (!Constants.IsEmpty(this.DdlNationality.val())) {
                    nationalityVal = this.DdlNationality.val();
                }

                var contact = {
                    Name: this.TxtName.val(),
                    Birthdate: Formatter.DateTime.ToSerializedString(bd),
                    MemberIdentification: this.TxtNRIC.val(),
                    Phone: this.TxtPhone.val(),
                    Email: this.TxtEmail.val(),
                    Code: this.TxtCode.val(),
                    Address: Formatter.ClearInvalidCharacter(this.TxtAddr.val()),
                    Gender: this.DdlGender.val(),
                    City: this.DdlCity.val(),
                    RaceID: raceVal,
                    NationalityID: nationalityVal,
                    EntityID: myRegister.getEntityID()
                }

                var type = this.TxtType.val();

                var contactJSONString = JSON.stringify(contact);
                var groupJSONString = JSON.stringify(groupVal);
                $.ajax({
                    url: "/Authenticated/Services/Customer.asmx/CreateWithGroup",
                    type: "post",
                    data: "{ 'contact' : '" + contactJSONString + "', 'type' : '" + type + "', 'groups' : '" + groupJSONString + "'}",
                    dataType: "json",
                    async: false,
                    contentType: "application/json;charset=utf-8",
                    success: function (data) {
                        var result = data.d;
                        if (result.Success) {
                            mySectionManager.Cashier.SalesOrder.TxtContact.val(myCustomer.TxtName.val());
                            mySectionManager.Cashier.SalesOrder.HfCustomer.val(result.ObjectID);
                            POSData.Order.CustomerID = result.ObjectID;
                            if (myCustomer.Action == "pay") {
                                mySectionManager.General.BtnPay.click();
                            }
                            myCustomer.Clear();
                        }
                        else {
                            alert(result.Message);
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(posAlertMessage.failCreateCustomer);
                    }
                });
            }
            else {
                alert(posAlertMessage.wrongOfflineAction);
            }
        } else {
            alert(posAlertMessage.noRoleContact);

        }
    },
    Clear: function () {
        this.TxtName.val('');
        this.HfID.val('');
        this.DpBirthDate.val('');
        this.TxtNRIC.val('');
        this.TxtAddr.val('');
        this.TxtPhone.val('');
        this.TxtEmail.val('');
        this.TxtCode.val('');
        this.DdlGender.prop('selectedIndex', 0);
        this.DdlGender.trigger("chosen:updated");
        this.DdlCity.prop('selectedIndex', 0);
        this.DdlCity.trigger("chosen:updated");
        this.DdlNationality.prop('selectedIndex', 0);
        this.DdlNationality.trigger("chosen:updated");
        this.DdlRace.prop('selectedIndex', 0);
        this.DdlRace.trigger("chosen:updated");
        this.CbkGroup.find("input[type=checkbox]:checked").each(function () {
            $(this).prop("checked", false);
        });
        this.TxtType.val('');
        this.Action = '';
    },
    ClearMemberPoint: function () {
        var memberPointObj = mySectionManager.Cashier.SalesOrder.TxtMemberPoint;
        memberPointObj.val('');
        mySectionManager.Cashier.SalesOrder.TxtDiscAmount.val('');
        memberPointObj.autoNumeric('update', { vMax: 0 });
        memberPointObj.next().text("/ " + 0);
    },
    GenerateCity: function () {
        var options = "";
        options += "<option value=\"" + Constants.GuidEmpty + "\"></option>"
        if (myStorageManager.POSStorage.Cities.length > 0) {
            $.each(myStorageManager.POSStorage.Cities, function (index, item) {
                var option = "<option value=\"" + item.ID + "\">" + item.Name + "</option>";
                options += option;
            })
        } else {
            this.DivCity.hide();
        }
        myCustomer.DdlCity.html(options);
        myCustomer.DdlCity.trigger("chosen:updated");
    },
    GenerateNationality: function () {
        var options = "";
        options += "<option value=\"" + Constants.GuidEmpty + "\"></option>"
        if (myStorageManager.POSStorage.Nationalities.length > 0) {
            $.each(myStorageManager.POSStorage.Nationalities, function (index, item) {
                var option = "<option value=\"" + item.ID + "\">" + item.Name + "</option>";
                options += option;
            })
        } else {
            this.DivNationality.hide();
        }
        myCustomer.DdlNationality.html(options);
        myCustomer.DdlNationality.trigger("chosen:updated");
    },
    GenerateRace: function () {
        var options = "";
        options += "<option value=\"" + Constants.GuidEmpty + "\"></option>"
        if (myStorageManager.POSStorage.Races.length > 0) {
            $.each(myStorageManager.POSStorage.Races, function (index, item) {
                var option = "<option value=\"" + item.ID + "\">" + item.Name + "</option>";
                options += option;
            })
        } else {
            this.DivRace.hide();
        }
        myCustomer.DdlRace.html(options);
        myCustomer.DdlRace.trigger("chosen:updated");
    },
    GenerateGroup: function () {
        var options = "";
        if (myStorageManager.POSStorage.Groups.length > 0) {
            $.each(myStorageManager.POSStorage.Groups, function (index, item) {
                var option = "<li><input type=\"checkbox\" value=\"" + item.ID + "\">" + item.Name + "<li>";

                options += option;
            })
        } else {
            this.DivGroup.hide();
        }
        myCustomer.CbkGroup.html(options);
    },

    GenerateNewCode: function () {
        if (myStorageManager.POSStorage.AppConfig.Code.CustomerCodeEnabled) {
            if (myCustomer.TxtCode.val() == "") {
                if (POSSettings.isOnline()) {
                    $.ajax({
                        url: "/Authenticated/Services/Customer.asmx/GetCode",
                        dataType: "json",
                        type: "POST",
                        async: false,
                        contentType: "application/json; charset=utf-8",
                        dataFilter: function (data) { return data; },
                        success: function (data) {
                            myCustomer.TxtCode.val(data.d);
                            return true;
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            return false;
                        }
                    });
                }
                else {
                    return false;
                }
            }
        }

        return true;
    }
}

var myReceiptGenerator = {
    invoiceNumber: null,
    template: '',
    XMLFileMini: "/Xml/PrintTemplate.xml?v=B",
    receiptMiniHtml: '',
    urlTemplate: "/Authenticated/Print/Invoice.aspx?ID={0}&Template={1}",
    urlParkTemplate: "/Authenticated/Print/SalesOrderMini.aspx?ID={0}&Template={1}",
    templateExtraPartSales: '<span>Sales : {0}</span>',
    templateExtraPartNote: '<p>{0}</p>',
    formatRowAmount: '<tr><th>{0}</th><td class="sep">:</td><td class="currency">{1}</td><td style="width:50px;">{2}</td></tr>',
    formatRowPayment: 'Payment<div>{0}</div>',
    formatRowLoyaltyPoint: 'Point<div>{0}</div>',
    printContainersTemplate: '<div class="print_container">{0}</div>',
    tax: '',
    taxRate: 0,
    taxText: '',
    taxType: 0,
    currencySymbol: '',
    paymentMethod1: '',
    paymentMethod2: '',
    amount: 0,
    amountTaxable: 0,
    discounted: false,
    taxReserveSequence: false,
    ZeroDecimalSuffix: false,
    init: function () {
        this.ZeroDecimalSuffix = myStorageManager.POSStorage.AppConfig.Decimal.ZeroDecimalSuffix;
        this.generateXML();
    },
    generateXML: function () {
        this.generateXmlMini();

    },
    generateXmlMini: function () {
        var receiptMini;
        $.ajax({
            url: this.XMLFileMini,
            type: 'get',
            dataType: 'html',
            async: false,
            success: function (data) {
                receiptMini = data;
            }
        });
        this.receiptMiniHtml = receiptMini;
    },
    generateReceipt: function (invoiceID, creator, orderTimeString) {
        if (this.template != null) {
            if (this.template.PrintMode == 1) {
                if (POSSettings.pushRealtime()) {

                    this.generateReceiptFull(invoiceID);
                } else {
                    this.generateReceiptMini(creator, orderTimeString);
                }
            }
            else {
                this.generateReceiptMini(creator, orderTimeString);
            }
        }
    },
    generateReceiptMini: function (creator, orderTimeString) {
        var dateVal = new Date();
        this.currencySymbol = mySectionManager.Cashier.SalesOrder.DdlCurrency.find('option:selected').text();
        var selectedTax = mySectionManager.Cashier.SalesOrder.DdlTax.find('option:selected');
        this.tax = myStorageManager.GetTaxByID(selectedTax.val());;
        this.taxRate = selectedTax.attr('rate');
        this.taxText = selectedTax.text();
        this.taxType = selectedTax.attr("type");

        var paymentMethod = jQuery.grep(myStorageManager.POSStorage.Payments, function (n, i) {
            return (n.ID == mySectionManager.Cashier.Payment.FirstPaymentMethodID());
        });
        this.paymentMethod1 = paymentMethod[0].Name;

        this.paymentMethod2 = $('option:selected', '#ddlPaymentMethod2').text();
        if (POSData.Order.Discount > 0 || POSData.Order.Discount2 > 0 || POSData.Order.DiscountAmount > 0) {
            this.discounted = true;
        }
        else {
            this.discounted = false;
        }
        mySectionManager.General.Print.html(this.receiptMiniHtml);
        $('div.print_container .logo').html(this.getLogo());
        $('div.print_container .invoiceHeader').html(this.template.Name);
        $('div.print_container .tagline').html(this.template.Field);
        var address = this.template.Address;
        if (this.template.ContactInfo != null) { address += "<br>" + this.template.ContactInfo }
        $('div.print_container .address').html(address);


        $('div.print_container .note').html(this.template.FooterLeft);
        $('div.print_container .lblInvoiceNumber').html(this.getInvNumber());

        $('div.print_container .customer').html(this.getCustomerInfo());

        var divExtra = $('div.print_container .extra');
        divExtra.html('');
        divExtra.append(this.generateExtraSales());
        divExtra.append(this.generateExtraNote());
        if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.DocumentVisibility.CustomerEntryTimeVisible) {
            var orderTime = Constants.IsNotEmpty(orderTimeString) ? orderTimeString : Formatter.DateTime.ToReceiptString(dateVal);
            $('div.print_container p.orderDateTime').html(orderTime);
            $('div.print_container .timestamp').hide();
        } else {
            var invDate = new Date(Date.parse(POSData.Order.Date));
            $('div.print_container p.invDate').html(Formatter.DateTime.ToDateOnlyString(invDate));
            $('div.print_container .timestamp').show();
            $('div.print_container .timestamp').html(Formatter.DateTime.ToReceiptString(dateVal));
        }
        $('div.print_container section.cart-mini-items').html(this.getItems());


        var divRightAuto = $('div.print_container table.rightAuto tbody');
        divRightAuto.html('');
        divRightAuto.append(this.getAmountRow());
        divRightAuto.append(this.getDiscountRow());
        divRightAuto.append(this.getNetNTaxRow());
        divRightAuto.append(this.getChangeRow());
        $('div.print_container div.section div.section_content_left').html(this.getPointInfo());
        $('div.print_container div.section div.section_content_right').html(this.getPayment());
        if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.Footer.CreatorVisible) {
            $('div.print_container .creator').html(creator);
        }

        this.Clear();
    },
    generateReceiptPark: function (creator, orderTimeString) {
        var dateVal = new Date();
        this.currencySymbol = mySectionManager.Cashier.SalesOrder.DdlCurrency.find('option:selected').text();
        mySectionManager.General.Print.html(this.receiptMiniHtml);
        $('div.print_container .logo').html(this.getLogo());
        $('div.print_container .invoiceHeader').html(this.template.Name);

        if (myStorageManager.POSStorage.AppConfig.Park.Print.Output.OutletInformationVisible) {
            $('div.print_container .tagline').html(this.template.Field);
            var address = this.template.Address;
            if (this.template.ContactInfo != null) { address += "<br>" + this.template.ContactInfo }
            $('div.print_container .address').html(address);
        }

        $('div.print_container .note').html(this.template.FooterRight);
        $('div.print_container .lblInvoiceNumber').html(this.getInvNumber());
        $('div.print_container .customer').html(this.getCustomerInfo());
        var divExtra = $('div.print_container .extra');
        divExtra.html('');
        divExtra.append(this.generateExtraSales());
        divExtra.append(this.generateExtraParkLabel());
        divExtra.append(this.generateExtraNote());

        var orderTime = Constants.IsNotEmpty(orderTimeString) ? orderTimeString : Formatter.DateTime.ToReceiptString(dateVal);
        $('div.print_container p.orderDateTime').html(Formatter.DateTime.ToReceiptString(orderTime));
        $('section.cart-mini-items').html(this.getItemsForPark());


        if (myStorageManager.POSStorage.AppConfig.Park.Print.Output.AmountVisible) {
            var divRightAuto = $('div.print_container table.rightAuto tbody');
            divRightAuto.html('');
            divRightAuto.append(this.getAmountRow());
            divRightAuto.append(this.getDiscountRow());
            divRightAuto.append(this.getNetNTaxRow());
        } else {
            $('div.print_container .cartAmountdot').hide();
        }

        if (POSData.Order.Deposit > 0) {
            var prefix = (Constants.IsEmpty(myStorageManager.POSStorage.AppConfig.Park.Print.Output.DepositPrefix)) ? "" : myStorageManager.POSStorage.AppConfig.Park.Print.Output.DepositPrefix;
            var depositContent = $.validator.format(this.formatRowPayment, $.validator.format("{0} {1}{2}", prefix, this.currencySymbol, Formatter.Number(POSData.Order.Deposit, this.ZeroDecimalSuffix)));
            $('div.print_container div.section div.section_content_right').html(depositContent);
        }

        this.Clear();
    },
    generateReceiptFull: function (id) {
        var invoiceUrl = $.validator.format(this.urlTemplate, id, this.template.ID);
        var receiptFull;
        $.ajax({
            url: invoiceUrl,
            type: 'get',
            dataType: 'html',
            async: false,
            success: function (data) {
                var $html = $(data);
                receiptFull = $html.find("div.invoice_container").html();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            }

        });
        mySectionManager.General.Print.html($.validator.format(this.printContainersTemplate, receiptFull));
    },
    getLogo: function () {
        if (this.template.Logo != '' && this.template.Logo != null) {
            var logo = this.template.Logo.replace("~/", "/");
            return '<img src="' + logo + '">';
        }
        return '';
    },
    getInvNumber: function () {
        if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.DocumentVisibility.NumberVisible) {
            var title = (POSData.Action.Type == SubmissionType.Park) ? myStorageManager.POSStorage.AppConfig.Park.Print.Output.ParkNumberPrefix : myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.HeaderTitle;
            return title + " #" + myOrderManager.GetCurrentNumber();
        }
        return "";
    },
    getCustomerInfo: function () {
        $('div.print_container .customer').hide();
        var printElement = "";
        var printElementFormat = "<h3>{0}</h3><h3>{1}</h3><p>{2}</p><span>{3}</span><span>{4}</span>";
        var customer = null;
        if (POSData.Order.CustomerID != Constants.GuidEmpty) {
            if (myOrderManager.ServerResult != null) {
                customer = myOrderManager.ServerResult.Contact;
            } else {
                var customers = myLocalStorage.customers.getByID(POSData.Order.CustomerID);
                if (customers.length > 0) {
                    customer = customers[0];
                }
            }
            var contactName = '';
            var contactNRIC = '';
            var contactPhone = '';
            var contactEmail = '';
            var contactAddress = '';
            if (customer != null) {
                if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.DocumentVisibility.CustomerVisible) {
                    $('div.print_container .customer').show();
                    contactName = customer.Name;
                    contactNRIC = customer.MemberIdentification != null ? customer.MemberIdentification : '';
                    if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.DocumentVisibility.CustomerContactVisible) {
                        contactEmail = customer.Email != null ? customer.Email : '';
                        contactPhone = customer.Phone != null ? customer.Phone : '';
                    }
                    if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.DocumentVisibility.CustomerAddressVisible) {
                        contactAddress = customer.Address != null ? customer.Address : '';
                    }

                }


                printElement = $.validator.format(printElementFormat, contactName, contactNRIC, contactAddress, contactPhone, contactEmail);

            }




        }

        return printElement;
    },
    getPointInfo: function () {
        if (Constants.IsNotEmpty(myOrderManager.ServerResult)) {
            if (Constants.IsNotEmpty(myOrderManager.ServerResult.LoyaltyPoint)) {
                return $.validator.format(this.formatRowLoyaltyPoint, myOrderManager.ServerResult.LoyaltyPoint);
            }
        }
        return "";
    },
    getItems: function () {
        $('div.print_container section.cart-mini-items').removeClass("single-row");
        var formatRow = "<div><p>{0}</p><mark>{1}</mark><div><small>{2}</small><i>{3}</i>{4}</div></div>";
        var itemsInHtml = '';
        myCashier.tableCart.children().each(function () {
            var item = $(this).data("item");

            var itemNameCode = item.Variant.Name;
            if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.ItemsTable.CodeVisible && Constants.IsNotEmpty(item.Variant.Code)) {
                itemNameCode += " - " + item.Variant.Code;
            }
            var itemNote = "";
            if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.Footer.NoteVisible && Constants.IsNotEmpty(item.Note)) {
                itemNote = Constants.NewLineToBR(item.Note);
            }
            var itemQuantitySingePrice = "";
            if (item.Quantity > 1 || item.Discount > 0) {
                itemQuantitySingePrice = Formatter.Number(item.Quantity);
                itemQuantitySingePrice += " x @" + Formatter.Number(item.Price);

            }

            var itemDiscount = '';
            var totalPrice = Formatter.Number(item.Price * item.Quantity);
            if (item.Discount > 0) {
                itemDiscount = Formatter.Number(item.Discount) + '%';
                totalPrice = Formatter.Number(item.Price * (1 - (item.Discount / 100)) * item.Quantity);
            }

            var itemPrice = $.validator.format("<span>{0}</span>", totalPrice);
            itemsInHtml += $.validator.format(formatRow, itemNameCode, itemNote, itemQuantitySingePrice, itemDiscount, itemPrice);

            var calc = item.Price * (1 - (item.Discount / 100)) * item.Quantity;
            myReceiptGenerator.amount += calc;
            if (item.Variant.Taxable) {
                myReceiptGenerator.amountTaxable += calc;
            }
        });
        return itemsInHtml;
    },

    getItemsForPark: function () {
        $('div.print_container section.cart-mini-items').addClass("single-row");

        var itemsInHtml = '';
        var items = [];
        var itemCategories = [];
        myCashier.tableCart.children().each(function () {
            var item = $(this).data("item");
            if (myStorageManager.POSStorage.AppConfig.Park.Print.Behaviour.PrintAdditionalItemsOnlyOnRePark) {

                var sameItem = jQuery.grep(myParkNBill.temporaryPoItems, function (n, i) {
                    return (n.ID == item.ID);
                });

                if (sameItem.length > 0) {
                    item.Quantity -= sameItem[0].Quantity;
                }
            }
            if (item.Quantity != 0) {
                items.push(item);
            }
            if (itemCategories.indexOf(item.Variant.CategoryName) == -1) {
                itemCategories.push(item.Variant.CategoryName);
            }
        });
        if (myStorageManager.POSStorage.AppConfig.Park.Print.Output.GroupByCategory) {
            $.each(itemCategories, function (i, category) {
                var filteredItems = $.grep(items, function (n, i) {
                    return (n.Variant.CategoryName == category);
                });
                if (filteredItems.length > 0) {
                    itemsInHtml += $.validator.format("<section class=\"category\">{0}</section><section class=\"item\">{1}</section>", category, myReceiptGenerator.generateParkItems(filteredItems));

                }
            })
        } else {
            itemsInHtml += myReceiptGenerator.generateParkItems(items);
        }

        return itemsInHtml;
    },
    generateParkItems: function (items) {
        var itemsInHtml = '';
        var formatRow = "<div><div><small>{0}</small><strong>{1}</strong><i>{2}</i>{3}</div><mark>{4}</mark></div>";
        $.each(items, function (i, item) {

            var itemNameCode = item.Variant.Name;
            if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.ItemsTable.CodeVisible && Constants.IsNotEmpty(item.Variant.Code)) {
                itemNameCode += " - " + item.Variant.Code;
            }
            var itemNote = "";
            if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.Footer.NoteVisible && Constants.IsNotEmpty(item.Note)) {
                itemNote = Constants.NewLineToBR(item.Note);
            }


            var itemQuantitySingePrice = Formatter.Number(item.Quantity) + " x";


            var itemPrice = "";
            var itemDiscount = "";
            if (myStorageManager.POSStorage.AppConfig.Park.Print.Output.AmountVisible) {
                var totalPrice = Formatter.Number(item.Price * item.Quantity)
                if (item.Discount > 0) {
                    itemDiscount = Formatter.Number(item.Discount) + '%';
                    totalPrice = Formatter.Number(item.Price * (1 - (item.Discount / 100)) * item.Quantity);
                }
                itemPrice = $.validator.format("<span>{0}</span>", totalPrice);
                var calc = item.Price * (1 - (item.Discount / 100)) * item.Quantity;
                myReceiptGenerator.amount += calc;
                if (item.Variant.Taxable) {
                    myReceiptGenerator.amountTaxable += calc;
                }
            }

            itemsInHtml += $.validator.format(formatRow, itemQuantitySingePrice, itemNameCode, itemDiscount, itemPrice, itemNote);


        });
        return itemsInHtml;
    },
    getAmountRow: function () {
        if (this.tax.PrintVisible && this.taxType == "1" && myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.ItemsFooter.TaxIncludeBeforeTotalAmount) {
            this.taxReserveSequence = true;
        } else {
            this.taxReserveSequence = false;
        }
        var NoDiscountNoTax = (!this.discounted && !this.tax.PrintVisible);
        var TaxIncludeNotBeforeTotal = (this.taxType == "1" && !myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.ItemsFooter.TaxIncludeBeforeTotalAmount);
        //if there is no discount and tax, then this is the last amount
        if (myStorageManager.POSStorage.AppConfig.AdvanceConfig.Payment.RoundingEnabled && (NoDiscountNoTax || TaxIncludeNotBeforeTotal)) {
            this.amount = Math.round(this.amount);
        }

        var label = this.addTotalQuantiy("Amount");

        rowHtml = jQuery.validator.format(this.formatRowAmount, label, this.currencySymbol, Formatter.Number(this.amount, this.ZeroDecimalSuffix));

        if (!this.discounted && this.taxReserveSequence) {
            rowHtml = '';
        }
        return rowHtml;

    },
    addTotalQuantiy: function (label) {
        if (myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.ItemsFooter.TotalQuantityVisible && myCashier.tableCart.children().length > 1) {
            var totalQuantity = 0;
            myCashier.tableCart.children().each(function () {
                var item = $(this).data("item");
                totalQuantity += item.Quantity;
            });
            var formatQuantity = "Qty: {0}; {1}";
            label = jQuery.validator.format(formatQuantity, totalQuantity, label);
        }
        return label;
    },
    getDiscountRow: function () {
        var rowHtml = "";
        if (POSData.Order.Discount > 0) {
            var headerTextFormat = "Discount ({0}%)";
            var headerText = jQuery.validator.format(headerTextFormat, POSData.Order.Discount);
            var discountAmount = (this.amount * POSData.Order.Discount) / 100;
            this.amount -= discountAmount;
            this.amountTaxable -= (this.amountTaxable * POSData.Order.Discount) / 100;
            rowHtml += jQuery.validator.format(this.formatRowAmount, headerText, this.currencySymbol, Formatter.Number(discountAmount * -1, this.ZeroDecimalSuffix));

        }
        if (POSData.Order.Discount2 > 0) {
            var headerTextFormat = "Sp. Discount ({0}%)";
            var headerText = jQuery.validator.format(headerTextFormat, POSData.Order.Discount2);
            var discountAmount = (this.amount * POSData.Order.Discount2) / 100;
            this.amount -= discountAmount;
            this.amountTaxable -= (this.amountTaxable * POSData.Order.Discount2) / 100;
            rowHtml += jQuery.validator.format(this.formatRowAmount, headerText, this.currencySymbol, Formatter.Number(discountAmount * -1, this.ZeroDecimalSuffix));

        }
        if (POSData.Order.DiscountAmount > 0) {
            var headerTextFormat = "Discount ({0})";
            var headerText = jQuery.validator.format(headerTextFormat, this.currencySymbol);
            this.amount -= POSData.Order.DiscountAmount;
            this.amountTaxable -= POSData.Order.DiscountAmount;
            rowHtml += jQuery.validator.format(this.formatRowAmount, headerText, this.currencySymbol, Formatter.Number(POSData.Order.DiscountAmount * -1, this.ZeroDecimalSuffix));
        }
        var GotDiscountNoTax = (this.discounted && !this.tax.PrintVisible);

        var TaxIncludeNotBeforeTotal = (this.taxType == "1" && !myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.ItemsFooter.TaxIncludeBeforeTotalAmount);
        //if there is got discount but no tax, then this is the last amount
        if (myStorageManager.POSStorage.AppConfig.AdvanceConfig.Payment.RoundingEnabled && (GotDiscountNoTax || TaxIncludeNotBeforeTotal)) {
            this.amount = Math.round(this.amount);
        }

        var totalAmountRow = jQuery.validator.format(this.formatRowAmount, "", this.currencySymbol, Formatter.Number(this.amount, this.ZeroDecimalSuffix));

        if (!this.discounted || this.taxReserveSequence) {
            totalAmountRow = "";
        }
        rowHtml += totalAmountRow;
        return rowHtml;
    },
    getNetNTaxRow: function () {
        var rowHtml = "";
        var displayText = "Total Amount";
        var displayAmount = this.amount;

        var calcTax;
        var DisplayComponent = false;
        var calcTaxComponent = new Array();
        if (this.taxType == "0") {
            //for multiple tax 
            if (this.tax.TypeID == "2" && this.tax.Components != null) {
                if (this.tax.Components.length > 1) {
                    DisplayComponent = true;
                }
            }

            if (DisplayComponent) {
                var totalAmountCounter = this.amountTaxable;
                $.each(this.tax.Components, function (i, components) {
                    taxLabel = jQuery.validator.format("{0} {1} %", components.Label, components.Rate);
                    var taxComponentAmount = components.Rate / 100 * totalAmountCounter;
                    calcTaxComponent.push({ Label: taxLabel, Amount: taxComponentAmount });

                    totalAmountCounter += taxComponentAmount;
                    myReceiptGenerator.amount += taxComponentAmount;
                });

            } else {
                calcTax = this.taxRate / 100 * this.amountTaxable;
                calcTaxComponent.push({ Label: this.taxText, Amount: calcTax });
                this.amount += calcTax;
            }

            //if got tax and tax not included this is last amount to pay
            if (myStorageManager.POSStorage.AppConfig.AdvanceConfig.Payment.RoundingEnabled) {
                this.amount = Math.round(this.amount);
            }

            displayAmount = this.amount;
            displayText = "Total Amount";
        }
        else {
            //TaxCalculation.Include
            calcTax = (Number(this.taxRate) / (100.0 + Number(this.taxRate))) * this.amountTaxable;
            calcTaxComponent.push({ Label: this.taxText, Amount: calcTax });
            displayText = "Before Tax";
            displayAmount = this.amount - calcTax;


        }

        if (this.tax.PrintVisible) {
            if (!this.taxReserveSequence) {
                $.each(calcTaxComponent, function (i, components) {
                    rowHtml += jQuery.validator.format(myReceiptGenerator.formatRowAmount, components.Label, myReceiptGenerator.currencySymbol, Formatter.Number(components.Amount, myReceiptGenerator.ZeroDecimalSuffix));
                });

                rowHtml += jQuery.validator.format(this.formatRowAmount, displayText, this.currencySymbol, Formatter.Number(displayAmount, this.ZeroDecimalSuffix));
            }
            else {
                //if got tax and tax is included this is last amount to pay
                if (myStorageManager.POSStorage.AppConfig.AdvanceConfig.Payment.RoundingEnabled) {
                    this.amount = Math.round(this.amount);
                }
                rowHtml += jQuery.validator.format(this.formatRowAmount, displayText, this.currencySymbol, Formatter.Number(displayAmount, this.ZeroDecimalSuffix));
                $.each(calcTaxComponent, function (i, components) {
                    rowHtml += jQuery.validator.format(myReceiptGenerator.formatRowAmount, components.Label, myReceiptGenerator.currencySymbol, Formatter.Number(components.Amount, myReceiptGenerator.ZeroDecimalSuffix));
                });
                rowHtml += jQuery.validator.format(this.formatRowAmount, "Total Amount", this.currencySymbol, Formatter.Number(this.amount, this.ZeroDecimalSuffix));
            }
        }





        return rowHtml;
    },
    getChangeRow: function () {
        var rowHtml = "";
        if (POSData.Payments.length > 0) {
            if (POSData.Payments[0].PaidAmount > parseFloat(this.amount).toFixed(2)) {
                rowHtml += jQuery.validator.format(this.formatRowAmount, "Payment", this.currencySymbol, Formatter.Number(POSData.Payments[0].PaidAmount, this.ZeroDecimalSuffix));
                rowHtml += jQuery.validator.format(this.formatRowAmount, "Change", this.currencySymbol, Formatter.Number((POSData.Payments[0].PaidAmount - POSData.Payments[0].Amount), this.ZeroDecimalSuffix));
            }
        }

        return rowHtml;
    },
    getPayment: function () {
        var rowHtml = "";

        if (POSData.Payments.length > 0) {
            var payment = '';
            var Code = '';
            if (POSData.Payments[0].Code != '') {
                Code = " - " + POSData.Payments[0].Code;
            }
            if (POSData.Payments[0].Amount < parseFloat(this.amount).toFixed(2)) {
                if (POSData.Payments[0].Amount != 0) {
                    payment = this.paymentMethod1 + Code + "-" + Formatter.Number(POSData.Payments[0].Amount);
                }

                if (POSData.Payments.length > 1) {
                    payment += "<br/>" + this.paymentMethod2 + "-" + Formatter.Number(POSData.Payments[1].Amount);
                }
            }
            else {
                if (POSData.Payments[0].Amount != 0) {
                    payment = this.paymentMethod1 + Code;
                }

            }

            if (Constants.IsNotEmpty(payment)) {
                rowHtml = jQuery.validator.format(this.formatRowPayment, payment);
            }

        }


        return rowHtml;
    },
    generateExtraSales: function () {
        if (mySectionManager.Cashier.SalesOrder.DdlSales.find('option:selected').text() != '') {
            return $.validator.format(this.templateExtraPartSales, mySectionManager.Cashier.SalesOrder.DdlSales.find('option:selected').text());
        }
        return '';
    },
    generateExtraNote: function () {
        if (mySectionManager.Cashier.SalesOrder.TxtNote.val() != '' && myStorageManager.POSStorage.AppConfig.PrintConfig.Invoice.Footer.NoteVisible) {

            return $.validator.format(this.templateExtraPartNote, mySectionManager.Cashier.SalesOrder.TxtNote.val().replace(/(?:\r\n|\r|\n)/g, "<br/>"));
        }
        return '';
    },
    generateExtraParkLabel: function () {

        if (mySectionManager.Cashier.SalesOrder.TxtParkLabel.val() != '') {
            var prefix = myStorageManager.POSStorage.AppConfig.Park.Print.Output.ParkLabelPrefix;
            var parkLabel = mySectionManager.Cashier.SalesOrder.TxtParkLabel.val();
            if (myStorageManager.POSStorage.AppConfig.Park.SelectMode.ReplaceSelectionWithAlias) {
                parkLabel = myParkSelect.getParkAliasByName(parkLabel);
            }
            var parkLabelWithPrefix = (Constants.IsEmpty(prefix)) ? parkLabel : $.validator.format("{0} # {1}", prefix, parkLabel);


            return $.validator.format(this.templateExtraPartNote, parkLabelWithPrefix.replace(/(?:\r\n|\r|\n)/g, "<br/>"));
        }

        return '';
    },
    assignTemplate: function () {
        this.template = myRegister.outletInfo.PrintTemplate;

        //Reassign css based on template print mode
        HtmlEditor.RemoveStyle("Print/Master.css");
        HtmlEditor.RemoveStyle("Print/Invoice.css");
        HtmlEditor.RemoveStyle("Print/Signature.css");
        HtmlEditor.RemoveStyle("Print/InvoiceMini.css?v=B");
        HtmlEditor.RemoveStyle("Master/table.css");
        HtmlEditor.RemoveStyle("Master/app_custom.css");
        HtmlEditor.RemoveStyle("Print/InvoiceMiniLX300.css?v=B");
        HtmlEditor.RemoveStyle("Print/LX300.css");
        if (this.template.PrintMode == 1) {
            HtmlEditor.AddStyle("Print/Master.css");
            HtmlEditor.AddStyle("Print/Invoice.css");
            HtmlEditor.AddStyle("Print/Signature.css");
            if (this.template.PrintLX300) {
                HtmlEditor.AddStyle("Print/LX300.css");
            }
        }
        else {
            HtmlEditor.AddStyle("Print/InvoiceMini.css?v=B");
            if (this.template.PrintLX300) {
                HtmlEditor.AddStyle("Print/InvoiceMiniLX300.css?v=B");
            }
        }

        HtmlEditor.AddStyle("Master/table.css");
        HtmlEditor.AddStyle("Master/app_custom.css");

    },
    Clear: function () {
        this.amount = 0;
        this.amountTaxable = 0;
    }
}

var myReceiptNumberGenerator = {
    NumberElement: null,
    generate: function () {
        var number = '';
        if (this.NumberElement != null) {
            number = Formatter.PadLeft(this.NumberElement.Seed, this.NumberElement.Digit);
            number = $.validator.format(this.NumberElement.Prefix, number);
        }
        return number;
    },
    save: function () {
        if (myLocalStorage.outlets.GetByEntityID(myRegister.getEntityID()).length > 0) {

            var outlets = myLocalStorage.outlets.GetByEntityID(myRegister.getEntityID())[0];
            outlets.NumberElement = this.NumberElement;
            myLocalStorage.outlets.save();
            myLocalStorage.outlets.load();
        }
    }
}

var myOrderManager = {
    SubmitCounter: 0,
    SubmitOffline: false,
    ServerResult: '',
    OfflinePark: false,
    OfflineParkID: '',
    IsEditMode: function () {
        return mySectionManager.Cashier.SalesOrder.HfSalesOrderID.val() != Constants.GuidEmpty;
    },
    Submit: function (submissionType, retry) {
        mySectionManager.General.AllDialog.dialog('close');
        this.ServerResult = null;
        if (!retry) {
            POSData.Action.Type = submissionType;
            POSData.assign();

            this.OfflineEditCheck();
            if (myReceiptNumberGenerator.NumberElement != null) {
                myReceiptNumberGenerator.NumberElement.Seed++;
            }
        }
        if (POSSettings.pushRealtime()) {
            var pickup = mySectionManager.Cashier.Payment.RadButtonDeliveryChecked.find("input:checked").val() == "true" && POSData.Action.Type != SubmissionType.Park;
            if (pickup && POSData.Action.DeliveryEntityID == Constants.GuidEmpty) {
                alert(posAlertMessage.emptyDeliveryOutlet);
                return;
            } else {
                AjaxForm.Block();
                this.SubmitToServer();
            }
        } else {
            alert(posAlertMessage.submitLocally);
            this.SubmitToLocal();
        }
        //save to local storage
        if (myReceiptNumberGenerator.NumberElement != null) {
            myReceiptNumberGenerator.save();
        }
    },
    OfflineEditCheck: function () {
        if (myOrderManager.SubmitOffline) {

            myIndexeddb.Orders.DeleteLastRecord();
            myOrderManager.SubmitOffline = false;
            myReceiptNumberGenerator.NumberElement.Seed--;
        }

        if (myOrderManager.OfflinePark) {
            if (myLocalStorage.parks.GetByID(myOrderManager.OfflineParkID).length > 0) {
                myLocalStorage.parks.RemoveByID(myOrderManager.OfflineParkID);
            } else {
                myIndexeddb.Orders.DeleteByKey(myOrderManager.OfflineParkID);
            }
            myOrderManager.OfflinePark = false;
            myOrderManager.OfflineParkID = "";
        }
    },
    SubmitToServer: function () {
        myIndexeddb.Orders.Sync();
        var req = $.ajax({
            url: myIndexeddb.Orders.CheckOutUrl,
            data: "{ 'json': '" + JSON.stringify(POSData) + "'}",
            dataType: "json",
            timeout: 10000,
            type: "POST",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                var result = data.d;
                if (result.Success) {
                    //object id empty means park
                    myOrderManager.ServerResult = result;
                    if (result.ObjectID != Constants.GuidEmpty) {
                        myReceiptGenerator.generateReceipt(result.ObjectID, result.Creator, result.OrderTimeString);
                    }
                    POSData.Action.Retry = false;
                    AjaxForm.Complete(result.ObjectID, result.SalesOrderID, result.OutDeliveryID, result.Creator, result.OrderTimeString);
                   
                }
                else {
                    AjaxForm.UnBlock();
                    alert(result.Message);

                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                req.abort();
               
                POSData.Action.Retry = true;
                //some time transaction has been send but it late to response in given time out
                
                AjaxForm.Complete(Constants.GuidEmpty, Constants.GuidEmpty, Constants.GuidEmpty, '', '', posAlertMessage.failOrderConnectionTimeOut);

            }
        });
    },
    SubmitToLocal: function () {
        if (POSData.Action.Type == SubmissionType.Park) {
            POSData.Park = new Object();
            var now = new Date()
            var dateFormat = "{0} {1}:{2}";
            var date = $.validator.format(dateFormat, ($.datepicker.formatDate('dd-M-yy', now)), ("00" + now.getHours()).slice(-2), ("00" + now.getMinutes()).slice(-2))
            POSData.Park.DateDisplay = date;
        }
        var POSDataJSON = JSON.stringify(POSData);
        var POSDataClone = jQuery.parseJSON(POSDataJSON);
        myIndexeddb.Orders.Save(POSDataClone);

        POSData.Action.Retry = false;
        myReceiptGenerator.generateReceipt(Constants.GuidEmpty, "", "");
        AjaxForm.Complete(Constants.GuidEmpty, Constants.GuidEmpty, Constants.GuidEmpty, "", "");
    },
    GetCurrentNumber: function () {
        var number = (this.ServerResult != null) ? this.ServerResult.InvoiceNumber : mySectionManager.Cashier.SalesOrder.TxtNumber.val();
        return number;
    },
    RemovePark: function (soID) {
        $.ajax({
            url: "/Authenticated/Services/Transaction.asmx/RemovePark",
            data: "{ 'soID': '" + soID + "'}",
            dataType: "json",
            type: "POST",
            async: false,
            contentType: "application/json; charset=utf-8",
            success: function (data) {

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(posAlertMessage.failDeletePark);
            }
        });
    },
    GetByID: function (soID) {
        var so;
        if (POSSettings.isOnline()) {
            $.ajax({
                url: "/Authenticated/Services/Transaction.asmx/GetSalesOrderJSONByID",
                data: "{ 'id' : '" + soID + "'}",
                dataType: "json",
                type: "POST",
                async: false,
                contentType: "application/json; charset=utf-8",
                dataFilter: function (data) { return data; },
                success: function (data) {
                    so = data.d;
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(posAlertMessage.failGetSalesOrder);
                }
            });
        } else {
            alert(posAlertMessage.wrongOfflineAction);
        }
        return so;
    }
}

var myRegister = {
    outletInfo: '',
    userID: '',
    object: '',
    label: '',
    txtFilter: '',
    itemFormat: '<li><a class="{0}" title="{1}" registerID="{2}" entityID="{3}" cashierID="{4}"><strong><i></i><span>{5}</span></strong><div><span class="idle">VACANT</span></div></a></li>',
    itemFormatOpen: '<li><a class="{0}" title="{1}" registerID="{2}" entityID="{3}" cashierID="{4}" time="{7}"><strong><i></i><span>{5}</span></strong><div><span class="cashier"><i></i><font>{6}</font></span><span class="open"><i></i><font>{7}</font></span></div></a></li>',
    init: function () {
        this.object = mySectionManager.Cashier.SalesOrder.myRegisterPicker;
        this.label = $('a#outlets>span');
        this.txtFilter = $('#txtRegisterFilter');
        this.txtFilter.keyup(function () { myPicker.generateByFilter(myRegister.object, myRegister.txtFilter); });
        this.userID = myStorageManager.POSStorage.UserID;
        this.generateRegister();
        mySectionManager.General.DialogEntity.bind('dialogclose', function () {
            myRegister.clear();
        });

    },
    clear: function () {
        myRegister.object.find("a").removeClass("active");
        var registerID = this.object.attr("registerID");
        if (Constants.IsNotEmpty(registerID)) {

            selected = this.object.find("[registerID='" + registerID + "']");
            selected.addClass("active");
            var selectedCashierID = selected.attr("cashierID");
            if (Constants.IsEmpty(selectedCashierID) || selectedCashierID == myRegister.userID) {
                this.reAssignSelected(selected);
            }
            this.object.attr("registerID", selected.attr("registerID"));
            this.object.attr("entityID", selected.attr("entityID"));
        }

    },
    generateRegister: function () {
        if (Constants.IsNotEmpty(myStorageManager.POSStorage.Registers)) {
            if (myStorageManager.POSStorage.Registers.length <= 12) {
                myRegister.txtFilter.hide();
            }

            myRegister.object.html('');
            $.each(myStorageManager.POSStorage.Registers, function (i, register) {
                var registerEntityID = register.EntityID;
                var registerCashierID = register.CashierID;
                var registerName = register.Name;
                var registerUser = register.LoginID;
                var registerDisplayName = registerName.length > 18 ? registerName.substring(0, 18) : register.Name;

                if (register.State == "Close") {
                    myRegister.object.append($.validator.format(myRegister.itemFormat, "", registerName, register.ID, registerEntityID, registerCashierID, registerDisplayName));
                }
                else {
                    var registerOpenTime = register.StartDisplay.split(" ")[3] + " - Now";
                    myRegister.object.append($.validator.format(myRegister.itemFormatOpen, "", registerName, register.ID, registerEntityID, registerCashierID, registerDisplayName, registerUser, registerOpenTime));

                }
            });

            myRegister.object.find("a").click(function () {
                if (!myOrderManager.IsEditMode()) {
                    var linkRegister = $(this);
                    //if vacant or currently occupied by self
                    if (linkRegister.attr("cashierID") == Constants.GuidEmpty || linkRegister.attr("cashierID") == myRegister.userID) {
                        var registerNow = myRegister.object.find("a.active");
                        registerNow.removeClass("active");
                        linkRegister.addClass("active");

                    }
                    else {
                        var msg = jQuery.validator.format(posAlertMessage.confirmationCloseRegister, linkRegister.find("span.cashier").text());
                        if (confirm(msg)) {

                            window.location = "/Authenticated/Sell/Register/Closure.aspx";
                        }

                    }
                }
            });
        }

    },

    getEntityIDByRegisterID: function (registerID) {
        var register = $.grep(myStorageManager.POSStorage.Registers, function (n, i) {
            return (n.ID == registerID)
        })
        if (register.length > 0) {
            return register[0].EntityID;
        } else {
            return Constants.GuidEmpty;
        }

    },
    //reason: the hidden elemet will affect the display of nth-child;

    validateRegister: function () {
        myRegister.object.find("a").removeClass("active");
        var registerID = this.object.attr("registerID");
        var entityID = this.object.attr("entityID");
        if (myRegister.object.find("li").length == 0) {
            alert(posAlertMessage.emptyAccessRegister);
        }
        else if (myRegister.object.find("li").length == 1) {
            this.object.find("a").addClass("active");
            if (Constants.IsNotEmpty(registerID) || Constants.IsNotEmpty(registerID)) {
                this.onChooseOK(true);
            }
            else {
                this.onChooseOK();
                this.autoOpen();
            }

        }
        else {
            //change cashier name to me if cashier id
            var selected = this.object.find("[cashierID='" + myRegister.userID + "']");
            if (selected.length > 0) {
                this.reAssignSelected(selected);
            }

            //if edit
            if (Constants.IsNotEmpty(registerID)) {

                selected = this.object.find("[registerID='" + registerID + "']");
                // When cannot find any register by register id, then find it based on entity id
                if (selected.length < 1) {
                    selected = this.object.find("[entityID='" + entityID + "']");
                }
                selected.addClass("active");
                this.onChooseOK(true);

            } else if (Constants.IsNotEmpty(entityID)) {
                //if edit
                selected = this.object.find("[entityID='" + entityID + "']");
                selected.addClass("active");
                this.onChooseOK(true);

            } else {
                //if add
                if (selected.length > 0) {
                    selected.addClass("active");
                    this.reAssignSelected(selected);
                    this.onChooseOK();
                }
            }

            this.autoOpen();

        }

    },
    renewSelected: function () {
        var selected = this.object.find("[cashierID='" + myRegister.userID + "']");
        if (selected.length > 0) {
            if (selected.attr("registerID") != this.object.attr("registerID")) {
                myRegister.object.find("a").removeClass("active");
                selected.addClass("active");
                this.reAssignSelected(selected);
                this.onChooseOK();
            }

        }
    },
    getEntityID: function () {
        var entityID = myRegister.object.attr("entityID");
        var registerID = myRegister.object.attr("registerID");
        //When a selected option is found

        if (Constants.IsEmpty(entityID)) {
            return registerID;
        }
        else {
            return entityID;
        }


        return "";
    },
    generateNewNumber: function () {
        if (!myOrderManager.IsEditMode()) {
            var entityID = myRegister.getEntityID();
            if (entityID != '') {
                if (POSSettings.pushRealtime()) {
                    var wsUrl = "/Authenticated/Services/TransactionNumber.asmx/";
                    var wsMethod = myRegister.object.attr('wsMethod');
                    var typeID = myRegister.object.attr('transactionType');

                    $.ajax({
                        url: wsUrl + wsMethod,
                        data: "{'entityID' : '" + entityID + "', 'typeID' : '" + typeID + "'}",
                        dataType: "json",
                        type: "POST",
                        async: false,
                        contentType: "application/json; charset=utf-8",
                        dataFilter: function (data) { return data; },
                        success: function (data) {
                            myReceiptNumberGenerator.NumberElement = data.d;
                            var number = myReceiptNumberGenerator.generate();
                            mySectionManager.Cashier.SalesOrder.TxtNumber.val(number);
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert(posAlertMessage.failGenerateNewNumber);
                        }
                    });

                    return mySectionManager.Cashier.SalesOrder.TxtNumber.val();
                }
                else {
                    var number = myReceiptNumberGenerator.generate();
                    mySectionManager.Cashier.SalesOrder.TxtNumber.val(number);
                }

            }
            else {
                mySectionManager.Cashier.SalesOrder.TxtNumber.val("")
            }
        }
    },
    refreshLabel: function () {
        var entityName = this.object.find(".active").attr("title");
        if (entityName == "") {
            entityName = "Choose an Outlet";
        }

        this.label.text(entityName);
    },
    refreshDeliveryOutlet: function () {
        if (this.object.attr("pairAction") != "none") {
            if (Constants.IsNotEmpty(this.object.attr("registerID"))) {
                var entityID = myRegister.getEntityID();
                var ddlPair = $("#" + this.object.attr("pairentityid"));
                ddlPair.val(entityID);
                ddlPair.trigger("chosen:updated");
            }
        }
    },
    refreshSales: function () {
        var ListSales = myRegister.outletInfo.ListSales;
        if (ListSales != null) {

            var options = "";

            if (ListSales.length > 0) {
                options += "<option value=\"\"></option>"
                $.each(ListSales, function (index, item) {
                    var option = "<option value=\"" + item.ID + "\">" + item.Name + "</option>";
                    options += option;
                })
            } else {
                //hide sales person when empty

                //mySectionManager.General.SectionSales.hide();
            }

            mySectionManager.Cashier.SalesOrder.DdlSales.html(options);
            mySectionManager.Cashier.SalesOrder.DdlSales.trigger("chosen:updated");

            //Assign ke default jika option-nya ada
            var defaultSales = mySectionManager.Cashier.SalesOrder.DdlSales.attr("default");
            var currentSales = mySectionManager.Cashier.SalesOrder.DdlSales.attr("currentSales");
            if (currentSales != undefined) {
                mySectionManager.Cashier.SalesOrder.DdlSales.val(currentSales);
                mySectionManager.Cashier.SalesOrder.HfSalesID.val(currentSales);
            }
            else {
                if (defaultSales != undefined) {
                    var arr = jQuery.grep(ListSales, function (item) {
                        return item.ID == defaultSales;
                    });

                    if (arr.length == 1) {
                        mySectionManager.Cashier.SalesOrder.DdlSales.val(defaultSales);
                        mySectionManager.Cashier.SalesOrder.HfSalesID.val(defaultSales);
                    }
                }
            }
            mySectionManager.Cashier.SalesOrder.DdlSales.trigger("chosen:updated");
        }
    },
    refreshType: function () {
        var DefaultCustomerPOType = myRegister.outletInfo.DefaultCustomerPOType;
        if (DefaultCustomerPOType != null) {
            mySectionManager.Cashier.SalesOrder.DdlPOType.val(DefaultCustomerPOType);
            mySectionManager.Cashier.SalesOrder.DdlPOType.trigger("chosen:updated");
        }

    },
    refreshTax: function () {
        var DefaultTaxType = myRegister.outletInfo.DefaultTaxType;
        if (Constants.IsNotEmpty(DefaultTaxType)) {
            mySectionManager.Cashier.SalesOrder.DdlTax.val(DefaultTaxType);
            mySectionManager.Cashier.SalesOrder.DdlTax.trigger("chosen:updated");
        }

    },
    refreshParkLayout: function () {
        if (myStorageManager.POSStorage.AppConfig.Park.Mode == 1) {
            try {
                myParkSelect.layout = myRegister.outletInfo.ParkLayoutPack.Layout;
                myParkSelect.parkAlias = myRegister.outletInfo.ParkLayoutPack.Alias;
                myParkSelect.generate();
            } catch (err) {
                var msg = jQuery.validator.format(posAlertMessage.failTryGetParkSelect, err.message);
                alert(msg);
            }
        }
    },
    refreshQuickKey: function () {
        var QuickKeyPack = myRegister.outletInfo.QuickKeyPack;
        if (Constants.IsNotEmpty(QuickKeyPack)) {
            quickKeyManager.clean();
            quickKeyManager.GenerateLinkConfigure(QuickKeyPack.ID);
            mySectionManager.QuickKey.LinkConfigureQuickkey.show();
            mySectionManager.QuickKey.Section.addClass('bgQuickkeyIllustration');

            if (QuickKeyPack.ID != Constants.GuidEmpty) {
                if (QuickKeyPack.Groups.length > 0) {
                    mySectionManager.QuickKey.Section.removeClass('bgQuickkeyIllustration');
                    quickKeyManager.init(QuickKeyPack);
                    quickKeyManager.render();
                }
            }
        }

    },
    refreshAccessLoyaltyPoint: function () {
        if (myRegister.outletInfo.MemberPoint) {
            $("button.loyalty").prop('disabled', false);
        }
        else {
            $("button.loyalty").prop('disabled', true);
        }
    },
    autoOpen: function () {
        var entityID = this.getEntityID();
        var selectedRegister = this.object.find(".active");

        if (Constants.IsEmpty(entityID)) {
            mySectionManager.General.DialogEntity.attr("autoopen", "1");
        } else {
            if (selectedRegister.attr("cashierid") != Constants.GuidEmpty) {
                if (this.userID != selectedRegister.attr("cashierid")) {
                    if (!myOrderManager.IsEditMode()) {
                        mySectionManager.General.DialogEntity.attr("autoopen", "1");
                    }
                }
            }
        }
    },
    reAssignSelected: function (selected) {
        var vacant = "<span class=\"idle\">VACANT</span>";
        this.object.find("[cashierID='" + Constants.GuidEmpty + "']").find("small").html(vacant);
        var registerBoxFormat = '<span class="cashier"><i></i><font>Me</font></span><span class="open"><i></i><font>{0}</font></span>';
        var d = new Date();
        var time = d.getHours() + ":" + d.getMinutes() + " - Now";
        if (selected.attr("cashierID") != Constants.GuidEmpty && Constants.IsNotEmpty(selected.attr("time"))) {
            time = selected.attr("time");
        }

        selected.find("small").html($.validator.format(registerBoxFormat, time));
    },
    onChooseOK: function (editMode) {
        var registerID = this.object.find(".active").attr("registerID");
        //if edit mode register is assigned from backend code so still need to get outlet info although is same, other case if same register no need to reopen
        if (Constants.IsNotEmpty(registerID) && (registerID != this.object.attr("registerID") || editMode)) {
            if (POSSettings.isOnline()) {
                $.ajax({
                    url: "/Authenticated/Services/Register.asmx/OpenNGetOutletInfo",
                    type: "post",
                    data: "{'registerID': '" + registerID + "'}",
                    dataType: "json",
                    async: false,
                    contentType: "application/json;charset=utf-8",
                    success: function (data) {
                        var resultObj = data.d;
                        if (resultObj.Success) {
                            var registerID = myRegister.object.find(".active").attr("registerID");
                            var entityID = myRegister.object.find(".active").attr("entityID");

                            myRegister.object.attr("registerID", registerID);
                            myRegister.object.attr("entityID", entityID);
                            if (resultObj.Open) {
                                myRegister.object.find("[cashierID='" + myRegister.userID + "']").attr("cashierID", Constants.GuidEmpty);
                                myRegister.object.find(".active").attr("cashierID", myRegister.userID);
                                myRegister.object.find(".active").attr("registerID");
                                myOpCash.Open();
                            }

                            var selectedCashierID = myRegister.object.find(".active").attr("cashierID");
                            if (Constants.IsEmpty(selectedCashierID) || selectedCashierID == myRegister.userID) {
                                myRegister.reAssignSelected(myRegister.object.find(".active"));
                                if (Constants.IsEmpty(selectedCashierID) && !editMode) {
                                    myOpCash.Open();
                                }
                            }
                            myRegister.outletInfo = data.d.OutletInfo;
                            myRegister.assignOutletInfo();
                        }
                        else {
                            alert(resultObj.Message);
                            mySectionManager.General.DialogEntity.attr("autoopen", "1");


                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(posAlertMessage.failOpenRegister);
                    }
                });

            }
            else {
                var registerID = myRegister.object.find(".active").attr("registerID");
                var entityID = myRegister.object.find(".active").attr("entityID");

                myRegister.object.attr("registerID", registerID);
                myRegister.object.attr("entityID", entityID);
                myRegister.reAssignSelected(myRegister.object.find(".active"));

                myRegister.outletInfo = new Object();

                if (myLocalStorage.outlets.GetByEntityID(myRegister.getEntityID()).length > 0) {

                    var outletInfo = myLocalStorage.outlets.GetByEntityID(myRegister.getEntityID())[0];

                    //default portype
                    myRegister.outletInfo = outletInfo;
                } else {
                    alert(posAlertMessage.failGetLocalOutletInfo);
                    return false;
                }
                myRegister.assignOutletInfo();
            }
        }

    },

    assignOutletInfo: function () {
        //generate number
        if (!myOrderManager.IsEditMode()) {
            myReceiptNumberGenerator.NumberElement = myRegister.outletInfo.NumberElement;
            mySectionManager.Cashier.SalesOrder.TxtNumber.val(myReceiptNumberGenerator.generate());
        }
        this.refreshLabel();
        this.refreshDeliveryOutlet();
        this.refreshSales();
        this.refreshType();
        this.refreshTax();
        this.refreshQuickKey();
        this.refreshParkLayout();
        this.refreshAccessLoyaltyPoint();
        myReceiptGenerator.assignTemplate();
    }
}

function AutoOpenDialog(dialog) {
    try {
        dialog.dialog('open');
    } catch (ex) {
        dialog.attr("autoopen", "1");
    }


}

var myOpCash = {
    dialog: '',
    txtAmount: '',
    init: function () {
        this.dialog = $("#dialogOpCash");
        this.txtAmount = $("#txtOpeningCash");
    },
    Open: function () {
        if (myStorageManager.POSStorage.AppConfig.POS.RegisterUseSession && myStorageManager.POSStorage.AppConfig.POS.OpeningCashRequired) {
            this.txtAmount.val("");
            AutoOpenDialog(this.dialog);
        }
    },
    Record: function () {
        var registerID = myRegister.object.find(".active").attr("registerID");
        var opAmount = this.txtAmount.autoNumeric('get');
        //if edit mode register is assigned from backend code so still need to get outlet info although is same, other case if same register no need to reopen
        if (Constants.IsNotEmpty(registerID)) {
            if (POSSettings.isOnline()) {
                $.ajax({
                    url: "/Authenticated/Services/Register.asmx/RecordOpeningCash",
                    type: "post",
                    data: "{'registerID': '" + registerID + "','opAmount': '" + opAmount + "'}",
                    dataType: "json",
                    async: false,
                    contentType: "application/json;charset=utf-8",
                    success: function (data) {
                        var resultObj = data.d;
                        if (resultObj.Success) {
                            if (resultObj.Open) {
                                myRegister.object.find("[cashierID='" + myRegister.userID + "']").attr("cashierID", Constants.GuidEmpty);
                                myRegister.object.find(".active").attr("cashierID", myRegister.userID);
                                myRegister.object.find(".active").attr("registerID");
                            }
                        }
                        else {
                            alert(resultObj.Message);

                        }

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(posAlertMessage.failOpenRegister);
                    }
                });

            }
        }
    }
}


var myPriceBook = {
    ddlPriceBook: '',
    divPricebook: '',
    init: function () {
        this.ddlPriceBook = $("#ddlPriceBook");
        this.divPricebook = $("div.pricebook");
        this.ddlPriceBook.change(this.updateVariantPrice);
    },
    clear: function () {
        this.divPricebook.hide();
        myPriceBook.ddlPriceBook.html("");
        myPriceBook.ddlPriceBook.trigger("chosen:updated");
    },
    generate: function (variant) {
        this.clear();
        if (POSSettings.queryRealtime()) {
            $.ajax({
                url: "/Authenticated/Services/Catalog.asmx/GetPriceBookByVariantID",
                data: "{ 'id': '" + variant.ID + "' }",
                dataType: "json",
                type: "POST",
                async: false,
                contentType: "application/json; charset=utf-8",
                dataFilter: function (data) { return data; },
                success: function (data) {
                    var options = "";
                    if (data.d.length > 0) {
                        var optionFormat = '<option MinimumQuantity="{0}" Price="{1}" Discount="{2}" value="{3}" >{4}</option>';
                        myPriceBook.divPricebook.show();
                        options += $.validator.format(optionFormat, 0, variant.UnitPrice, variant.PriceDiscount, Constants.GuidEmpty, "")
                        $.each(data.d, function (index, item) {
                            var option = $.validator.format(optionFormat, item.MinimumQuantity, item.UnitPrice, item.PriceDiscount, item.ID, item.Name);

                            options += option;
                        })

                        myPriceBook.ddlPriceBook.html(options);
                        myPriceBook.ddlPriceBook.trigger("chosen:updated");

                        if (Constants.IsNotEmpty(mySectionManager.Cashier.SalesOrder.TxtContact.data("pricebook"))) {
                            myPriceBook.ddlPriceBook.val(mySectionManager.Cashier.SalesOrder.TxtContact.data("pricebook"));
                            myPriceBook.ddlPriceBook.trigger("chosen:updated");
                            myPriceBook.updateVariantPrice();
                        } else {
                            myPriceBook.assignByQuantity();
                        }

                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(posAlertMessage.failGetPricebook);
                }
            });
        }
    },

    updateVariantPrice: function () {
        dialogCart.Price.autoNumeric('set', myPriceBook.ddlPriceBook.find('option:selected').attr("price"));
        dialogCart.Discount.autoNumeric('set', myPriceBook.ddlPriceBook.find('option:selected').attr("discount"));
    },
    assignByQuantity: function () {
        //if dropdownlist pricebook bahe option and visible
        if (myPriceBook.ddlPriceBook.children().length > 1) {
            //temporary minimum quantity, assigned to check whether got other minimal quantity nearer with current quantity
            var temporaryMQ = 0;
            var assignIndex = 0;
            var dialogCartQuantity = parseFloat(dialogCart.Quantity.autoNumeric('get'));

            myPriceBook.ddlPriceBook.find("option").each(function () {
                var option = $(this);
                var optionMQ = parseFloat(option.attr("MinimumQuantity"));
                //if this option minimum quantity greater then last option minimum quantity and still smaller then quantity in dialog cart
                if ((temporaryMQ <= optionMQ) && (optionMQ <= dialogCartQuantity)) {
                    if (optionMQ > 0) {
                        temporaryMQ = optionMQ;
                        assignIndex = option.index()
                    }
                }
            });
            myPriceBook.ddlPriceBook.prop('selectedIndex', assignIndex);
            myPriceBook.ddlPriceBook.trigger("chosen:updated");
            myPriceBook.updateVariantPrice();
        }
    }

}

function OnOpCashOK() {
    myOpCash.Record();
}

function OnChooseRegisterOK() {
    myRegister.onChooseOK();
}

function OnVariantSelect(ui) {
    AjaxForm.OnVariantSelectID(ui.item.id, false, false, true);
}

function OnBarcodeSelect(ui) {
    AjaxForm.OnVariantSelectID(ui.item.id, true, true, true);
}

function OnUpdateDiscountAmountOK() {
    amountUI.update();
}

function OnPayOKAjax() {
    try {
        var creditSales = mySectionManager.Cashier.Payment.RadButtonPaymentTypeChecked.find("input:checked").val() == 1;
        var customerEmpty = Constants.IsEmpty(mySectionManager.Cashier.SalesOrder.HfCustomer.val());

        if (creditSales && customerEmpty) {
            alert(posAlertMessage.emptyCustomerCredit);
        } else {
            myOrderManager.Submit(SubmissionType.Payment);
        }
    }
    catch (err) {
        var msg = jQuery.validator.format(posAlertMessage.failTrySubmit, err.message);
        alert(msg);
    }

    return false;
}

function OnVoidOK() {
    AjaxForm.Void();
}

function OnNewContactOK() {
    try {
        myCustomer.Create();
    } catch (err) {
        var msg = jQuery.validator.format(posAlertMessage.failTryCreateCustomer, err.message);
        alert(msg);

    }
}

function OnMemberPointOK() {
    var inputPoint = mySectionManager.Cashier.SalesOrder.TxtMemberPoint;
    var memberPoint = inputPoint.autoNumeric('get');
    var cashDiscount = parseFloat(inputPoint.attr("cashDiscount"));
    var memberPointAmount = memberPoint * cashDiscount;

    mySectionManager.Cashier.SalesOrder.TxtDiscAmount.autoNumeric('set', memberPointAmount);
    amountUI.update();
}

function OnUsePoint() {
    var inputContact = mySectionManager.Cashier.SalesOrder.TxtContact;
    var CustomerID = mySectionManager.Cashier.SalesOrder.HfCustomer.val();
    if (inputContact.val() == "") {
        inputContact.focus();
        alert(posAlertMessage.emptyCustomer);
        return false;
    }
    return true;
}

function CreateNewVariant() {
    var name = dialogCart.Name.val();
    var price = dialogCart.Price.autoNumeric('get');
    if (POSSettings.isOnline()) {
        $.ajax({
            url: "/Authenticated/Services/Catalog.asmx/CreateVariant",
            data: "{ 'name': '" + name + "', 'price' : " + price + "}",
            dataType: "json",
            type: "POST",
            contentType: "application/json; charset=utf-8",
            dataFilter: function (data) { return data; },
            success: function (data) {
                var variant = data.d;
                if (variant != null) {
                    var hf = $("#" + dialogCart.Name.attr("hfID"));
                    hf.val(variant.ID);
                    DoVariantSelect(variant, false, true);
                } else {
                    alert(posAlertMessage.requiredDefaultCategory);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(posAlertMessage.failCreateNewVariant);
            }
        });
    } else {
        alert(posAlertMessage.wrongOfflineAction);
    }
}

function DoVariantSelect(variant, appendToCart, queryPricebook) {
    dialogCart.Name.val(variant.Name);
    if (variant.UOM != null) {
        dialogCart.UOM.text(variant.UOM);
    }
    // not allowed edit item price
    if (!myStorageManager.IsInRole(AppRole.Price) && variant.TypeID != VariantInventoryType.NonInventory) {
        dialogCart.Price.attr("disabled", "disabled");
    } else {
        dialogCart.Price.removeAttr("disabled");
    }
    if (variant.TypeID == VariantInventoryType.Serialized) {
        dialogCart.trItemNote.hide();
        dialogCart.trItemSerial.show();
        dialogCart.GenerateSerial(variant.ID);
    } else {
        dialogCart.trItemNote.show();
        dialogCart.trItemSerial.hide();
    }
    if (Constants.IsNotEmpty(variant.Description)) {
        dialogCart.Note.val(variant.Description);
    }
    //unit in stock & uom

    if (variant.UnitsInStock != Constants.DecimalMinValue && POSSettings.queryRealtime() && myStorageManager.IsInRole(AppRole.Inventory)) {
        dialogCart.lblAvailable.text(Formatter.Number(variant.UnitsInStock));
        dialogCart.divAvailableItem.show();
    }

    if (variant.UOM != null) {
        dialogCart.UOM.text(variant.UOM);
    }

    dialogCart.UnitQuantity.autoNumeric('set', variant.UnitQuantity);
    if (variant.UnitQuantity > 1) {
        var price = variant.UnitPrice / variant.UnitQuantity;
        dialogCart.UnitQuantityPrice.autoNumeric('set', price);
    }

    dialogCart.Cost.autoNumeric('set', variant.UnitCost);



    if (!myCashier.priceAsCost) {
        dialogCart.Price.autoNumeric('set', variant.UnitPrice);
    }
    else {
        dialogCart.Price.autoNumeric('set', variant.UnitCost);
    }
    dialogCart.SetToolTip(variant);
    dialogCart.Discount.autoNumeric('set', variant.PriceDiscount);


    if (dialogCart.AutoFillQuantity || appendToCart) {
        var currentQty = dialogCart.Quantity.autoNumeric('get');
        if (currentQty == 0) {
            dialogCart.Quantity.autoNumeric('set', 1);
        }
    }
    if (queryPricebook && myStorageManager.POSStorage.AppConfig.POS.LoadPriceBook) {
        myPriceBook.generate(variant);
    }

    dialogCart.Quantity.focus();
    dialogCart.processVariantUI(variant);
    dialogCart.Name.data("variant", variant);

}



function OnCartOK(appendQty) {
    var item = dialogCart.get();
    if (item.Variant == undefined) {


        if (dialogCart.Name.val().trim() != "") {
            if (mySectionManager.General.divCreateVariant.attr("isenabled") == "true") {
                mySectionManager.General.divCreateVariant.dialog('open');
            }
            else {
                alert(posAlertMessage.emptyVariant);
            }
        }

        return false;
    }
    //add code to add quantity instead add row

    var row;
    if (dialogCart.Row == null) {
        if (appendQty) {
            myCashier.tableCart.children().each(function () {
                var cartItem = $(this).data("item");
                if (item.Variant.ID == cartItem.Variant.ID) {
                    item.Quantity += cartItem.Quantity;
                    item.ID = cartItem.ID;
                    row = $(this);
                    return false;
                }
            });
        }
    }
    else {
        var row = dialogCart.Row;
    }

    if (!POSSettings.queryRealtime()) {
        item.Variant.UnitsInStock = Constants.DecimalMinValue;
    }

    if (row == undefined) {
        myCashier.additem(item);
    }
    else {
        row.data("item", item);
        myCashier.reflectRowData(row);
        dialogCart.clear();
        amountUI.update();
    }

    $("div.table").scrollTop($("div.table")[0].scrollHeight);
};

function OnValidatePay() {
    if (ValidateCheckOut()) {
        if (myStorageManager.POSStorage.AppConfig.POS.NumberPad.Enabled) {
            mySectionManager.Cashier.Payment.TxtAmount.click();
        }
        return true;
    }
}
function OnValidateBill() {
    if (ValidateCheckOut()) {
        return true;
    }
}


function OnValidatePark() {
    if (ValidateCheckOut()) {
        if (!myOrderManager.IsEditMode() && myStorageManager.POSStorage.AppConfig.Park.Advanced.DefaultParkNoteValue != "" && Constants.IsEmpty(mySectionManager.Cashier.SalesOrder.TxtNote.val())) {
            mySectionManager.Cashier.SalesOrder.TxtNoteOverall.val(myStorageManager.POSStorage.AppConfig.Park.Advanced.DefaultParkNoteValue);
        }
        return true;
    }
}
function OnGetVacantTable() {
    var entityID = myRegister.getEntityID();
    if (Constants.IsNotEmpty(entityID)) {
        myParkSelect.getVacant();
        return true;
    } else {
        alert(posAlertMessage.emptyEntity);
    }
}
function ValidateCheckOut() {
    //When textbox is not empty and hidden field is empty
    var entityID = myRegister.getEntityID();
    if (entityID != "") {
        if (!myStorageManager.POSStorage.AppConfig.POS.SalesPersonRequired || Constants.IsNotEmpty(mySectionManager.Cashier.SalesOrder.DdlSales.find(":selected").val())) {
            if (!myStorageManager.POSStorage.AppConfig.POS.CustomerRequired || Constants.IsNotEmpty(mySectionManager.Cashier.SalesOrder.TxtContact.val())) {
                var newCustomer = mySectionManager.Cashier.SalesOrder.TxtContact.val() != "" && mySectionManager.Cashier.SalesOrder.HfCustomer.val() == "";
                if (!newCustomer) {
                    var rows = myCashier.tableCart.children();
                    if (rows.length != 0) {
                        //Jquery Validate
                        var isValid = true;
                        $("section.cashier hgroup").find(':input').each(function (i, item) {
                            var im = $(item);
                            var inputValid = im.valid();
                            if (!inputValid) {
                                isValid = false;
                            }
                        });

                        if (!isValid) {
                            return false;
                        }

                        //Stringify for server processing.
                        var itemsJSON = [];
                        myCashier.tableCart.children().each(function () {
                            var item = $(this).data("item");
                            var newItem = {
                                ID: item.ID,
                                VariantID: item.Variant.ID,
                                Quantity: item.Quantity,
                                Cost: item.Cost,
                                Price: item.Price,
                                Discount: item.Discount,
                                Note: item.Note,
                                Taxable: item.Variant.Taxable,
                                LoyaltyPoint: item.Variant.LoyaltyPoint
                            };

                            itemsJSON.push(newItem);
                        });

                        var itemsJSONString = JSON.stringify(itemsJSON);
                        mySectionManager.Cashier.SalesOrder.HfItemJson.val(itemsJSONString);

                        //Set default due
                        if (!myOrderManager.IsEditMode() || Constants.IsEmpty(mySectionManager.Cashier.Payment.DPDue.val())) {
                            var datePicker = mySectionManager.Cashier.SalesOrder.DPInvDate;
                            var option = mySectionManager.Cashier.SalesOrder.DdlPOType.find(":selected");
                            var days = parseInt(option.attr("due"));
                            if (Constants.IsNotEmpty(mySectionManager.Cashier.SalesOrder.TxtContact.data("duedays"))) {
                                days = parseInt(mySectionManager.Cashier.SalesOrder.TxtContact.data("duedays"));
                            }
                            var invDate = datePicker.datepicker("getDate");
                            invDate.setDate(invDate.getDate() + days);
                            mySectionManager.Cashier.Payment.DPDue.datepicker("setDate", invDate);
                            mySectionManager.Cashier.Payment.TxtDaysDue.autoNumeric('set', days);
                        }

                        if (Constants.IsNotEmpty(mySectionManager.Cashier.Payment.TxtAmount.attr('deposit'))) {
                            if (mySectionManager.Cashier.Payment.TxtAmount.attr('deposit') > 0) {
                                mySectionManager.Cashier.Payment.DdlPaymentMethod.val(mySectionManager.Cashier.Payment.TxtAmount.attr('depositPaymentMethodID'))
                                mySectionManager.Cashier.Payment.DdlPaymentMethod.trigger("chosen:updated");

                                mySectionManager.Cashier.Payment.PaymentButtonSelect(mySectionManager.Cashier.Payment.TxtAmount.attr('depositPaymentMethodID'));

                                mySectionManager.Cashier.Payment.TxtAmount.autoNumeric('set', mySectionManager.Cashier.Payment.TxtAmount.attr('deposit'));
                                mySectionManager.Cashier.Payment.TxtNote.val("Deposit");
                                AjaxForm.OnPaymentAmountChange(mySectionManager.Cashier.Payment.TxtAmount);
                            }
                        }


                        return true;
                    }
                    else {
                        alert(posAlertMessage.emptyPOItem);
                    }

                    return false;
                } else {
                    //On Payment when new customer is created not via Dialog
                    if (myStorageManager.POSStorage.AppConfig.POS.CustomerQuickCreate) {
                        myCustomer.Action = "pay";
                        myCustomer.TxtName.val(mySectionManager.Cashier.SalesOrder.TxtContact.val());
                        myCustomer.GenerateNewCode();

                        myCustomer.Dialog.dialog('open');
                    }
                    else {
                        mySectionManager.Cashier.SalesOrder.TxtContact.val("");
                        alert(posAlertMessage.noRoleContact);
                    }
                    return false;
                }
            } else {
                alert(posAlertMessage.emptyCustomer);
                mySectionManager.Cashier.SalesOrder.TxtContact.focus();
                return false;
            }
        } else {
            alert(posAlertMessage.emptySalesPerson);
            mySectionManager.Cashier.SalesOrder.DdlSalesChosen.addClass("chosen-with-drop");
            return false;
        }

    } else {
        alert(posAlertMessage.emptyEntity);
        mySectionManager.General.DialogEntity.dialog('open');
        return false;
    }
}

var myParkNBill = {
    itemFormat: '<li><a ID="park" title="{0}" soID="{1}" {6}><strong><i></i><span>{2}</span></strong><div>{3}</div></a><span class="print"><a href="{4}" target="_blank"></a></span>{5}</li>',
    spanClose: '<span class="close"></span>',
    itemInfoFormat: '<span class="{0}"><i></i><font>{1}</font></span>',
    object: '',
    txtFilter: '',
    objectBilling: '',
    txtFilterBilling: '',
    temporaryPoItems: '',
    init: function () {
        this.object = $("#myRetrievePicker");
        this.txtFilter = $("#txtRetrievePicker");
        this.txtFilter.keyup(function () { myPicker.generateByFilter(myParkNBill.object, myParkNBill.txtFilter); });

        this.objectBilling = $("#myBillingPicker");
        this.txtFilterBilling = $("#txtBillingPicker");
        this.txtFilterBilling.keyup(function () { myPicker.generateByFilter(myParkNBill.objectBilling, myParkNBill.txtFilterBilling); });
    },
    generatePark: function () {
        var entityID = myRegister.getEntityID();
        if (POSSettings.pushRealtime()) {
            if (entityID != "") {

                AjaxForm.Block();
                myIndexeddb.Orders.Sync();
                $.ajax({
                    url: "/Authenticated/Services/Transaction.asmx/GetParkByEntityID",
                    data: "{ 'entityID' : '" + entityID + "'}",
                    dataType: "json",
                    type: "POST",
                    async: false,
                    contentType: "application/json; charset=utf-8",
                    dataFilter: function (data) { return data; },
                    success: function (data) {
                        myParkNBill.generatePicker(myParkNBill.object, myParkNBill.txtFilter, data.d, SubmissionType.Park);
                        AjaxForm.UnBlock();
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(posAlertMessage.failGetPark);
                    }
                });
            } else {
                alert(posAlertMessage.emptyEntity);
                mySectionManager.General.DialogEntity.dialog('open');

            }
        } else {



            myIndexeddb.Orders.GetParked(function (listLocalPark) {
                //get from local storage
                var listServerPark = myLocalStorage.parks.GetByEntityID(entityID);
                var listpark = new Array();
                $.each(listServerPark, function (i, serverPark) {
                    var Park = {
                        ID: serverPark.Order.ID,
                        Number: serverPark.Order.Number,
                        CustomerDisplay: serverPark.CustomerDisplay,
                        MemberIdentification: serverPark.Customer.MemberIdentification,
                        ParkLabelDisplay: serverPark.ParkLabelDisplay,
                        DateDisplay: serverPark.DateDisplay,
                    }
                    listpark.push(Park);
                });


                listLocalPark = $.grep(listLocalPark, function (n, i) {
                    return (myRegister.getEntityIDByRegisterID(n.Order.RegisterID) == entityID);
                });

                $.each(listLocalPark, function (i, localPark) {
                    var customer = myLocalStorage.customers.getByID(localPark.Order.CustomerID);
                    var CustomerDisplay = "";
                    var CustomerMemberIdentification = "";
                    if (customer.length > 0) {
                        CustomerDisplay = customer[0].CustomerDisplay;
                        CustomerMemberIdentification = customer[0].MemberIdentification;
                    }

                    var Park = {
                        ID: localPark.Order.ID,
                        Number: localPark.Order.Number,
                        CustomerDisplay: CustomerDisplay,
                        MemberIdentification: CustomerMemberIdentification,
                        ParkLabelDisplay: localPark.Order.ParkLabel,
                        DateDisplay: localPark.Park.DateDisplay,
                        LocalParkID: localPark.Park.ID,
                    }
                    listpark.push(Park);
                });

                myParkNBill.generatePicker(myParkNBill.object, myParkNBill.txtFilter, listpark, SubmissionType.Park);
            });


        }



    },
    generateOutStanding: function () {
        if (POSSettings.isOnline()) {
            var entityID = myRegister.getEntityID();
            if (entityID != "") {
                AjaxForm.Block();
                $.ajax({
                    url: "/Authenticated/Services/Transaction.asmx/GetOutStandingByEntityID",
                    data: "{ 'entityID' : '" + entityID + "'}",
                    dataType: "json",
                    type: "POST",
                    async: false,
                    contentType: "application/json; charset=utf-8",
                    dataFilter: function (data) { return data; },
                    success: function (data) {
                        myParkNBill.generatePicker(myParkNBill.objectBilling, myParkNBill.txtFilterBilling, data.d, SubmissionType.Bill);
                        AjaxForm.UnBlock();
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(posAlertMessage.failGetOutStanding);
                    }
                });
            } else {
                alert(posAlertMessage.emptyEntity);
                mySectionManager.General.DialogEntity.dialog('open');

            }
        } else {
            alert(posAlertMessage.wrongOfflineAction);
        }
    },
    generatePicker: function (obj, filter, list, state) {
        if (list.length > 12 || state == SubmissionType.Park && myStorageManager.POSStorage.AppConfig.Park.Advanced.RetreiveFilterBoxAlwaysVisible) {
            filter.show();
            filter.val("");
        } else {
            filter.hide();
        }

        obj.html('');
        if (list.length > 0) {
            $.each(list, function (i, salesOrder) {
                var displayDateTime = Formatter.DateTime.ToSimple(salesOrder.DateDisplay);
                if (state == SubmissionType.Park) {
                    var note = salesOrder.ParkLabelDisplay.length > 15 ? salesOrder.ParkLabelDisplay.substring(0, 15) : salesOrder.ParkLabelDisplay;
                    var parkalias = myParkSelect.getParkAliasByName(salesOrder.ParkLabel);
                    if (myStorageManager.POSStorage.AppConfig.Park.SelectMode.ReplaceSelectionWithAlias) {
                        note = parkalias.length > 15 ? parkalias.substring(0, 15) : parkalias;
                    }
                    var url = $.validator.format("/Authenticated/Print/SalesOrderMini.aspx?ID={0}&Template={1}", salesOrder.ID, myReceiptGenerator.template.ID);
                    var close = myParkNBill.spanClose;
                    var localPark = "";
                    if (!POSSettings.pushRealtime()) {
                        close = "";
                        if (!Constants.IsEmpty(salesOrder.LocalParkID)) {
                            localPark = $.validator.format("localParkID='{0}'", salesOrder.LocalParkID);
                        }
                    }
                    var title = parkalias + " - " + salesOrder.ParkLabelDisplay + " - " + salesOrder.Number;
                    if (myStorageManager.POSStorage.AppConfig.Park.Advanced.AuthorizeParkOrderDeletion && !AppRole.IsOrderEditor()) {
                        close = "";
                    }

                    title = (Constants.IsNotEmpty(salesOrder.MemberIdentification)) ? title + " - " + salesOrder.MemberIdentification : title;

                    var rowInfo = $.validator.format(myParkNBill.itemInfoFormat, "date", displayDateTime);
                    rowInfo += $.validator.format(myParkNBill.itemInfoFormat, "invoice", salesOrder.Number);
                    rowInfo += $.validator.format(myParkNBill.itemInfoFormat, "customer", Constants.NewLineToBR(salesOrder.CustomerDisplay));
                    if (!myStorageManager.POSStorage.AppConfig.Park.SelectMode.ReplaceSelectionWithAlias) {
                        rowInfo += parkalias == "" ? "" : $.validator.format("<span class=\"alias\">{0}</span>", parkalias);

                    }

                    var row = $.validator.format(myParkNBill.itemFormat, title, salesOrder.ID, note, rowInfo, url, close, localPark);
                } else {
                    var note = salesOrder.ParkLabelDisplay.length > 15 ? salesOrder.ParkLabelDisplay.substring(0, 15) : salesOrder.ParkLabelDisplay;
                    var noteComplete = salesOrder.ParkLabelDisplay;
                    if (Constants.IsEmpty(noteComplete)) {
                        note = salesOrder.NoteDisplay.length > 15 ? salesOrder.NoteDisplay.substring(0, 15) : salesOrder.NoteDisplay;
                        noteComplete = salesOrder.NoteDisplay;
                    }
                    var url = $.validator.format("/Authenticated/Print/InvoiceMini.aspx?ID={0}&Template={1}", salesOrder.InvID, myReceiptGenerator.template.ID);
                    var close = myParkNBill.spanClose;
                    if (!AppRole.IsOrderEditor()) {
                        close = "";
                    }
                    var rowInfo = $.validator.format(myParkNBill.itemInfoFormat, "date", displayDateTime);
                    rowInfo += $.validator.format(myParkNBill.itemInfoFormat, "invoice", salesOrder.Number);

                    var row = $.validator.format(myParkNBill.itemFormat, noteComplete, salesOrder.ID, note, rowInfo, url, close, "");
                }

                obj.append(row);
            });

            obj.find("a#park").unbind('click');
            obj.find("a#park").each(function () {
                var linkPark = $(this);
                var soID = linkPark.attr("soID");
                if (Constants.IsNotEmpty(linkPark.attr("localParkID"))) {
                    soID = linkPark.attr("localParkID");
                }

                linkPark.click(function () {
                    mySectionManager.Switch();
                    var isPark = state == SubmissionType.Park;
                    mySectionManager.General.LblNote.show();
                    AjaxForm.Edit(soID, isPark);
                    myParkNBill.temporaryPoItems = '';
                    if (state == SubmissionType.Park) {
                        var sessionItemsString = mySectionManager.Cashier.SalesOrder.HfItemJson.val();
                        if (sessionItemsString != "" && sessionItemsString != undefined) {
                            myParkNBill.temporaryPoItems = jQuery.parseJSON(sessionItemsString);
                        }
                    }
                    if (isPark) {
                        $("#dialogRetrieve").dialog('close');
                    } else {
                        $("#dialogOutstanding").dialog('close');
                    }

                });
            });
            obj.find("span.close").unbind('click');
            obj.find("span.close").each(function () {
                var linkParkClose = $(this);
                var soID = linkParkClose.parent().find("a#park").attr("soID");
                linkParkClose.click(function () {
                    if (confirm(posAlertMessage.confirmationDeleteOrder)) {
                        myOrderManager.RemovePark(soID);
                        if (state == SubmissionType.Park) {
                            myParkNBill.generatePark();
                        } else {
                            myParkNBill.generateOutStanding();
                        }
                    }


                });
            });
        }

    },

}

var myParkSelect = {
    layout: '',
    itemFormat: '<li><a Class="parkSelect" title="{0}" name="{1}"><strong><i></i><span>{2}</span></strong><div><span class="idle">VACANT</span>{3}</div></a></li>',
    object: '',
    txtFilter: '',
    DialogParkSelect: '',
    parkAlias: '',
    init: function () {
        this.object = $("#divParkSelect #tabs");
        this.txtFilter = $("#txtParkSelectFilter");
        this.DialogParkSelect = $("#dialogParkSelect");
        this.txtFilter.keyup(function () {
            myPicker.generateByFilter(myParkSelect.object.find("ul.ulParkSelectTabs"), myParkSelect.txtFilter);

        });
        this.DialogParkSelect.attr("title", myStorageManager.POSStorage.AppConfig.Park.UI.ParkDialogTitle);

    },
    getParkAliasByName: function (name) {
        var alias = "";
        if (Constants.IsNotEmpty(this.parkAlias)) {
            var listAlias = jQuery.grep(this.parkAlias, function (n, i) {
                return (n.Name == name);
            });
            if (listAlias.length > 0) {
                alias = listAlias[0].Alias;
            }
        }

        return alias;
    },
    generate: function () {
        var categories = this.layout != null ? this.layout : new Array();
        if (myParkSelect.object.data("ui-tabs")) {
            myParkSelect.object.tabs("destroy");
        }
        myParkSelect.object.empty();
        var totalOption = 0;
        $.each(categories, function (i, category) {
            totalOption = totalOption + parseFloat(category.Size);
        });

        myParkSelect.object.append("<ul class=\"tabs tabsCategory\"</ul>")
        $.each(categories, function (i, category) {
            var categoryName = (category.Name.length > 5 && categories.length > 4) ? category.Name.substring(0, 5) : category.Name
            myParkSelect.object.find(".tabs").append($.validator.format("<li><a href=\"#tabs-{0}\">{1}</a></li>", i + 1, categoryName));

            myParkSelect.object.append($.validator.format("<div id='tabs-{0}' class=\"divParkSelectTabs\"><ul class=\"ulParkSelectTabs dialogPickerBig dialogPicker\"></ul></div>", i + 1));
            for (var i = 1; i <= category.Size; i++) {
                var optionName = category.Name + i;
                var optionNameDisplay = optionName;
                var parkalias = myParkSelect.getParkAliasByName(optionName);
                var title = optionName + " - " + parkalias;
                var aliasHtml = '';
                if (myStorageManager.POSStorage.AppConfig.Park.SelectMode.ReplaceSelectionWithAlias) {
                    optionNameDisplay = parkalias.length > 15 ? parkalias.substring(0, 15) : parkalias;
                } else {
                    aliasHtml = parkalias == "" ? "" : $.validator.format("<span class=\"alias\">{0}</span>", parkalias);
                }

                var row = $.validator.format(myParkSelect.itemFormat, title, optionName, optionNameDisplay, aliasHtml);
                myParkSelect.object.find('div.divParkSelectTabs:last-child').find("ul.ulParkSelectTabs").append(row);
            }
        })

        if (categories.length > 1) {
            myParkSelect.object.tabs();
        } else {
            myParkSelect.object.find(".tabs").remove();
        }


        if (totalOption <= 12) {
            this.txtFilter.hide();
        } else {
            this.txtFilter.show();
            this.txtFilter.val("");
        }
    },
    getVacant: function () {
        if (POSSettings.isOnline()) {
            var entityID = myRegister.getEntityID();
            if (entityID != "") {

                AjaxForm.Block();
                myIndexeddb.Orders.Sync();
                $.ajax({
                    url: "/Authenticated/Services/Transaction.asmx/GetParkByEntityID",
                    data: "{ 'entityID' : '" + entityID + "'}",
                    dataType: "json",
                    type: "POST",
                    async: false,
                    contentType: "application/json; charset=utf-8",
                    dataFilter: function (data) { return data; },
                    success: function (data) {
                        myParkSelect.object.find("a.parkSelect").unbind('click');

                        myParkSelect.object.find("a.parkSelect").each(function () {
                            var linkTable = $(this);
                            linkTable.click(function () {
                                if (ValidateCheckOut()) {
                                    var tableName = linkTable.attr("name");
                                    mySectionManager.Cashier.SalesOrder.TxtParkLabel.val(tableName);
                                    if (myStorageManager.POSStorage.AppConfig.Park.Deposit.Enabled) {
                                        mySectionManager.Cashier.Payment.DialogPark.dialog('open');
                                    } else {
                                        myOrderManager.Submit(SubmissionType.Park);
                                    }

                                }
                            });
                        });

                        myParkSelect.object.find("span.idle").html("VACANT");
                        myParkSelect.object.find("a").removeClass("occupied");
                        myParkSelect.object.find("a").addClass("vacant");
                        $.each(data.d, function (i, salesOrder) {
                            var occTable = myParkSelect.object.find("[name='" + salesOrder.ParkLabel + "']");
                            occTable.find("span.idle").html("OCCUPIED");
                            occTable.removeClass("vacant");
                            occTable.addClass("occupied");
                            occTable.unbind('click');
                        });


                        AjaxForm.UnBlock();
                        return true;
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(posAlertMessage.failGetParkSelect);
                    }
                });
            } else {
                alert(posAlertMessage.emptyEntity);
                mySectionManager.General.DialogEntity.dialog('open');

            }
        } else {
            alert(posAlertMessage.wrongOfflineAction);
        }
    },

}
var myFlag = {
    itemFormat: '<li><a ID="flag">{0}</a></li>',
    object: '',
    txtFilter: '',
    init: function () {
        this.object = $("#flagPicker");

    },
    generate: function () {
        myFlag.object.html('');
        for (var i = 1; i <= myStorageManager.POSStorage.AppConfig.AdvanceConfig.Sell.Flag.MaxOptions; i++) {
            var row = $.validator.format(myFlag.itemFormat, myStorageManager.POSStorage.AppConfig.AdvanceConfig.Sell.Prefix + i);
            myFlag.object.append(row);
        }
        myFlag.object.find("a#flag").unbind('click');
        myFlag.object.find("a#flag").each(function () {
            var linkTable = $(this);
            linkTable.click(function () {
                myFlag.object.find("a#flag").removeClass("active");
                linkTable.addClass("active");
                var flagName = linkTable.text();
                mySectionManager.Cashier.SalesOrder.TxtNoteOverall.val(flagName);

            });
        });
    },

}
//general function often used in picker
var myPicker = {
    generateByFilter: function (obj, filter) {
        obj.children().hide();
        obj.children().removeClass("top3");
        obj.children().removeClass("right");
        obj.children().removeClass("clear");

        var re = RegExp(filter.val(), "i");
        obj.find("a").filter(function () {
            return re.test(this.title);
        }).each(function () {
            $(this).closest("li").show();;

        });
    }
}
//checking order  ui to fill when on page load
var myOrderUIManager = {
    init: function () {
        var SOID = $.url().param('ID');
        if (Constants.IsNotEmpty(SOID)) {
            if (POSSettings.isOnline()) {
                mySectionManager.Cashier.SalesOrder.HfSalesOrderID.val(SOID);

                if (myStorageManager.POSStorage.AppConfig.Park.Mode == 1) {
                    mySectionManager.General.BtnPark.attr("dialogid", "dialogRePark");
                    mySectionManager.General.BtnPark.attr("validate", "OnValidatePark");

                }
                var so = myOrderManager.GetByID(SOID);
                this.Fill(so);
            }
            else {
                alert(posAlertMessage.wrongOfflineAction);
            }
        }
        else {
            mySectionManager.Cashier.SalesOrder.HfSalesOrderID.val(Constants.GuidEmpty);
            mySectionManager.Cashier.SalesOrder.DPInvDate.val(myStorageManager.POSStorage.ServerDateString);
            //alert(myStorageManager.POSStorage.ServerTime);
            mySectionManager.Cashier.Payment.DPDue.val(myStorageManager.POSStorage.ServerDateString);
            myRegister.validateRegister();
        }
    },
    Fill: function (so) {
        if (Constants.IsNotEmpty(so.Order)) {
            //this case will only run when got querystring ID when page load
            if (so.Order.RegisterID != Constants.GuidEmpty) {
                myRegister.object.attr("registerID", so.Order.RegisterID)
            }
            if (so.Order.EntityID != Constants.GuidEmpty) {
                myRegister.object.attr("entityID", so.Order.EntityID)
            }
            myRegister.validateRegister();

            mySectionManager.Cashier.SalesOrder.DdlPOType.val(so.Order.TypeID);
            mySectionManager.Cashier.SalesOrder.DdlPOType.trigger("chosen:updated");

            var sodate = Formatter.DateTime.ParseFormatted(so.DateString);
            if (sodate != Constants.DateMinValue) {
                var invDateInput = mySectionManager.Cashier.SalesOrder.DPInvDate;
                invDateInput.val(Formatter.DateTime.ToDateOnlyString(sodate));
            }
            mySectionManager.Cashier.SalesOrder.TxtNumber.val(so.Order.Number);
            mySectionManager.Cashier.SalesOrder.TxtDeposit.val(so.Order.Deposit);
            mySectionManager.Cashier.SalesOrder.DdlDepositPaymentMethod.val(so.Order.DepositPaymentMethodID);
            mySectionManager.Cashier.SalesOrder.DdlDepositPaymentMethod.trigger("chosen:updated");

            if (Constants.IsNotEmpty(so.Order.CustomerID)) {

                mySectionManager.Cashier.SalesOrder.HfCustomer.val(so.Order.CustomerID);
                mySectionManager.Cashier.SalesOrder.TxtContact.val(so.Customer.Name);
                mySectionManager.Cashier.SalesOrder.TxtMemberPoint.val(so.Order.PointUsed);
                //to do: customer point
            }

            //assign sales person  
            mySectionManager.Cashier.SalesOrder.DdlSales.val(so.Order.SalesID);
            mySectionManager.Cashier.SalesOrder.DdlSales.trigger("chosen:updated");
            if (so.Order.SalesID != Constants.GuidEmpty) {
                mySectionManager.Cashier.SalesOrder.DdlSales.attr("currentSales", so.Order.SalesID);
            }
            if (Constants.IsNotEmpty(so.Order.PurchaseOrderNumber)) {
                mySectionManager.Cashier.SalesOrder.TxtPONumber.val(so.Order.PurchaseOrderNumber);
            }
            if (Constants.IsNotEmpty(so.Order.Note)) {
                mySectionManager.Cashier.SalesOrder.TxtNoteOverall.val(so.Order.Note);
            }
            if (Constants.IsNotEmpty(so.Order.ParkLabel)) {
                mySectionManager.Cashier.SalesOrder.TxtParkLabel.val(so.Order.ParkLabel);
            }
            //assign currency & rate
            mySectionManager.Cashier.SalesOrder.DdlCurrency.val(so.Order.CurrencyID);
            mySectionManager.Cashier.SalesOrder.DdlCurrency.trigger("chosen:updated");
            if (Constants.IsNotEmpty(so.Order.CurrencyRate)) {
                mySectionManager.Cashier.SalesOrder.TxtCurrencyRate.val(so.Order.CurrencyRate);
                mySectionManager.Cashier.SalesOrder.CurrencyRate.css('display', 'inline-block');
            }

            // assign discount and tax
            mySectionManager.Cashier.SalesOrder.TxtDisc1.val(so.Order.Discount);
            mySectionManager.Cashier.SalesOrder.TxtDisc2.val(so.Order.Discount2);
            mySectionManager.Cashier.SalesOrder.TxtDiscAmount.val(so.Order.DiscountAmount);
            mySectionManager.Cashier.SalesOrder.DdlTax.val(so.Order.TaxTypeID);
            mySectionManager.Cashier.SalesOrder.DdlTax.trigger("chosen:updated");
            //Edit mode header title
            mySectionManager.General.PageTitle.text($.validator.format("Updating Sales Order #{0}", so.Order.Number));
            //assign item

            mySectionManager.Cashier.SalesOrder.HfItemJson.val(so.Items);
            AjaxForm.PopulateCart();
            //asign payment


            //if got invoice then generate payment
            if (Constants.IsNotEmpty(so.Invoice)) {
                var customDateField = Formatter.DateTime.ParseJSONString(so.Invoice.CustomDateField);
                customDateField = Formatter.DateTime.ToDateOnlyString(customDateField);
                if (customDateField != Constants.DateMinValue) {
                    mySectionManager.Cashier.Payment.DPCustomField.val(customDateField);
                }

                var dueDate = Formatter.DateTime.ParseJSONString(so.Invoice.Due);
                dueDate = Formatter.DateTime.ToDateOnlyString(dueDate);
                if (dueDate != Constants.DateMinValue) {
                    mySectionManager.Cashier.Payment.DPDue.val(dueDate);
                }

                //assign delivery

                if (Constants.IsNotEmpty(so.Delivery)) {
                    mySectionManager.Cashier.Payment.DdlEntity.val(so.Delivery.EntityID);
                    mySectionManager.Cashier.Payment.DdlEntity.trigger("chosen:updated");
                    mySectionManager.Cashier.Payment.RadButtonDeliveryChecked.find('[value="true"]').attr('checked', 'checked');
                } else {
                    mySectionManager.Cashier.Payment.RadButtonDeliveryChecked.find('[value="false"]').attr('checked', 'checked');
                }


                //assign payment


                //if got invoice then generate payment
                if (Constants.IsNotEmpty(so.Payments)) {
                    mySectionManager.Cashier.Payment.RadButtonPaymentTypeChecked.find('[value="0"]').attr('checked', 'checked');
                    var firstPayment = so.Payments[0];

                    var DateOn = Formatter.DateTime.ParseJSONString(firstPayment.Date);
                    DateOn = Formatter.DateTime.ToDateOnlyString(DateOn);
                    if (DateOn != Constants.DateMinValue) {
                        mySectionManager.Cashier.Payment.DPDateOn.val(DateOn);
                    }

                    mySectionManager.Cashier.Payment.DdlPaymentMethod.val(firstPayment.MethodID);
                    mySectionManager.Cashier.Payment.DdlPaymentMethod.trigger("chosen:updated");
                    mySectionManager.Cashier.Payment.PaymentButtonSelect(firstPayment.MethodID);

                    mySectionManager.Cashier.Payment.TxtCode.val(firstPayment.Code);
                    mySectionManager.Cashier.Payment.TxtNote.val(firstPayment.Note);


                } else {
                    mySectionManager.Cashier.Payment.RadButtonPaymentTypeChecked.find('[value="1"]').attr('checked', 'checked');

                }

            }
        }
    },

}

function OnCustomerSelect(ui) {
    myCustomer.OnSelect(ui.item.id);
};

function OnAddCustomer() {
    myCustomer.GenerateNewCode();
    return true;


}


function OnParkOK() {
    try {
        myOrderManager.Submit(SubmissionType.Park);
    } catch (err) {
        var msg = jQuery.validator.format(posAlertMessage.failTryPark, err.message);
        alert(msg);
    }
    return false;
}
function OnBillOk() {
    try {
        myOrderManager.Submit(SubmissionType.Bill);
    } catch (err) {
        alert("An error occurred during billing \n" + err.message)
    }
}
function OnGetPark() {
    try {
        myParkNBill.generatePark();
    } catch (err) {
        var msg = jQuery.validator.format(posAlertMessage.failTryGetPark, err.message);
        alert(msg);
    }
    return true;
}
function OnGetBill() {
    try {
        myParkNBill.generateOutStanding();
    } catch (err) {
        var msg = jQuery.validator.format(posAlertMessage.failTryGetOutStanding, err.message);
        alert(msg);
    }
    return true;
}

function onAddItem() {
    dialogCart.open();
    return true;
}

function OnGetCustomerEmail() {
    return myEmailInvoice.GetEmail();
}
function onEmailInvoiceOK() {
    myEmailInvoice.Send();
}
function OnQueryModeOK() {
    AjaxForm.SaveQueryMode();
}
var myCacheButton = {
    init: function () {
        this.clear();
        mySectionManager.General.BtnSendTransaction.find("a.main").click(function () {
            myCacheButton.sendTransaction();
            return false;
        });
        mySectionManager.General.BtnSyncProduct.find("a.main").click(function () {
            myCacheButton.syncProduct();
            return false;
        });
    },
    clear: function () {
        mySectionManager.General.BtnSendTransaction.find("a.main").unbind('click');
        mySectionManager.General.BtnSyncProduct.find("a.main").unbind('click');
    },
    sendTransaction: function () {
        if (POSSettings.isOnline()) {
            AjaxForm.BlockProcess(
               function () {
                   myIndexeddb.Orders.Sync();
                   SetLocalStorageCounter();
               }, true);
        } else {
            alert(posAlertMessage.wrongOfflineAction);
        }

    },
    syncProduct: function () {
        if (POSSettings.isOnline()) {
            AjaxForm.BlockProcess(
                function () {
                    myLocalStorage.dataSync();
                    myLocalStorage.dataLoad();
                    myIndexeddb.onComplete = function () {
                        SetLocalStorageCounter();
                        AjaxForm.UnBlock()
                    }

                }, false);

        } else {
            alert(posAlertMessage.wrongOfflineAction);
        }
    },

}

var myNumpad = {
    init: function () {
        $.fn.numpad.defaults.gridTpl = '<table class="tableNumpad"></table>';
        $.fn.numpad.defaults.decimalSeparator = '.';
        $.fn.numpad.defaults.hidePlusMinusButton = true;
        $.fn.numpad.defaults.ButtonSize = myStorageManager.POSStorage.AppConfig.POS.NumberPad.ButtonSize;

    }
}
$(document).ready(function () {
    //first section more to setting environment & local storage

    try {
        //get all element from local storage to array
        myIndexeddb.init();

        myLocalStorage.init();
        //assign all form element to javascript class
        mySectionManager.init();
        //get drop down list option which only get one time in document ready
        myStorageManager.init();
        //try to sync order to server when online
        if (POSSettings.isOnline()) {
            if (POSSettings.pushRealtime()) {
                myIndexeddb.Orders.Sync();
            }

            if (myLocalStorage.config.data.AppConfig == undefined) {
                myLocalStorage.dataSync(true);
                myLocalStorage.dataLoad();
            }
            myLocalStorage.config.data = myStorageManager.POSStorage;
            myLocalStorage.config.save();


        }
    } catch (err) {

    }

    //second section more to binding control and other setting
    try {
        myNumpad.init();

        myMenuManager.init();

        myParkSelect.init();
        //have role like cs code, assign all function form and generate option to dropdownlist  
        AjaxForm.init();
        //assign register element and generate register option to register picker
        myOpCash.init();
        myRegister.init();
        //assign pricebook element
        myPriceBook.init();
        //assign function of dialog cart 
        dialogCart.init();
        //assign function table of cashier 
        myCashier.init(true);
        //assign function to total amount table 
        amountUI.init();
        disc.init();
        //assign customer dialog element and generate city to drop down list
        myCustomer.init();
        //assign park function
        myParkNBill.init();
        //cache button
        myCacheButton.init();
        //get mini template
        myReceiptGenerator.init();
        //check whather is add mode or edit mode to assign form element with value
        myOrderUIManager.init();

        //conection status 
        window.addEventListener('online', refreshConnectionStatus);
        window.addEventListener('offline', refreshConnectionStatus);
        refreshConnectionStatus({ type: 'ready' });


    } catch (err) {
        alert(err.message)
    }

});

function refreshConnectionStatus(event) {
    $("#connection").attr("class", navigator.onLine ? 'online' : 'offline');
    $("#connection > span").html(navigator.onLine ? 'Online' : 'Offline');
    $("#connection > div.toolTip > strong").html("You are currently working " + (navigator.onLine ? 'Online' : 'Offline') + ".");

    var onlineNote = "All sales will be uploaded to server automatically.";
    var offlineNote = "Any sales made on this register will be saved in the browser's local storage.";
    $("#connection > div.toolTip > p").html((navigator.onLine ? onlineNote : offlineNote));

}
function SetLocalStorageCounter() {
    var msgTFormat = "( {0} Offline Orders )";
    myIndexeddb.Orders.Count(function (e) {
        mySectionManager.General.BtnSendTransaction.find("a.link").html($.validator.format(msgTFormat, e));
    });
    var msgPFormat = "( {0} Products Cached )";
    mySectionManager.General.BtnSyncProduct.find("a.link").html($.validator.format(msgPFormat, myIndexeddb.Products.data.length));

    if ($("#connection").hasClass("offline")) {
        myCacheButton.clear();
        mySectionManager.General.DialogCache.dialog('option', 'title', 'You are offline');
        mySectionManager.General.DialogCache.parent().addClass("offline");
    } else {
        myCacheButton.init();
        mySectionManager.General.DialogCache.dialog('option', 'title', 'You are online');
        mySectionManager.General.DialogCache.parent().removeClass("offline");

    }
    return true;
}

var posAlertMessage = {
    failGetMenu: 'Fail to get pos menu',
    failGetLocalPosStorage: 'Fail to get setting and option from local storage, Please re-cache your data while online!',
    failGetVariant: 'Fail to get variant',
    failGetLocalVariant: 'Fail to get variant from local storage, Please re-cache your data while online!',
    emptyBarcodeFormat: 'No product with barcode \"{0}\"',
    emptyCustomerFormat: 'No customer with code \"{0}\"',
    failGetSalesOrder: 'Fail to get sales order',
    failBin: 'Fail to bin transaction',
    failGetCustomer: 'Fail to get customer\'s data',
    failCreateCustomer: 'Fail to create customer',
    noRoleContact: 'You have no right to create new customer',
    submitLocally: 'Connection unavailable ~ offline! Order stored locally',
    failOrderConnectionTimeOut: 'Connection timeout! Please try uploading your order again!',
    failDeletePark: 'Fail to delete park',
    emptyAccessRegister: 'You do not have access to any Register',
    failGenerateNewNumber: 'Fail to generate new number',
    failOpenRegister: 'Fail to open register',
    failGetLocalOutletInfo: 'Fail to get outlet information from local storage, Please re-cache your data while online!',
    failGetPricebook: 'Fail to get pricebook',
    failTrySubmit: '[Error submitting order] \n{0}',
    failTryCreateCustomer: '"[Error creating customer] \n"{0}',
    createCustomerOffline: 'Create customer is not supported when the connection offline',
    emptyCustomer: 'Please select customer!',
    emptySalesPerson: 'Please select sales person!',
    failCreateNewVariant: 'Fail to create new variant',
    requiredDefaultCategory: '[WARNING] - POS / Quick Create Product requires Default Category',
    emptyVariant: 'Item is undefined, please re-type',
    emptyPOItem: 'You must have at least one item',
    emptyEntity: 'Please select entity before proceeding..',
    failGetRetrieve: 'Fail to get retrieve',
    failTryPark: '[Error submitting park] \n{0}',
    failTryGetPark: '[Error during get park] \n{0}',
    failTryGetOutStanding: '[Error during get outstanding] \n{0}',
    failTryGetParkSelect: '[Error during get available park select] \n{0}',
    failGetSerial: 'Fail to get variant serial',
    successSendOrder: 'Orders synchronized to server. Upload Transaction Complete!',
    successSyncProduct: 'Products synchronized to Local Storage',
    failGetPark: 'Fail to get park',
    failGetOutStanding: 'Fail to get outstanding',
    failGetParkSelect: 'Fail to get available park select',
    confirmationDeleteOrder: 'Are you sure want to delete this order?',
    confirmationCloseRegister: 'The Register is still occupied under \'{0}\'. Do you want to end his / her session?',
    successSendEmail: 'Email is sent successfully to \'{0}\'',
    wrongOfflineAction: 'This action is not supported when the connection offline',
    emptyCustomerCredit: 'Give credit require contact specified!;',
    failToSyncProduct: 'Fail sync product to local storage!',
    emptyDeliveryOutlet: 'There is no outlet in delivery module. To turn on delivery module, please go to it\'s outlet form -> tab "Extras" -> row "Module" -> column "Delivery", and turn on it\'s delivery module',
}

var SubmissionType = {
    Park: 1,
    Bill: 2,
    Payment: 3,
}

var VariantInventoryType = {
    NonInventory: 2,
    Serialized: 4
}
var PaymentInputType = {
    DropDownList: 0,
    Button: 1

}