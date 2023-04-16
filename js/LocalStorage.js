var myIndexeddb = {
    db: '',
    dbName: 'MyLocalDB',
    data: '',
    onComplete: function () { },
    Products: {
        key: 'Products',
        data: '',
        loaded: false,
        Save: function (listProduct) {
            var transaction = myIndexeddb.db.transaction([myIndexeddb.Products.key], 'readwrite');
            var store = transaction.objectStore(myIndexeddb.Products.key);
            var objectStoreRequest = store.clear();

            objectStoreRequest.onsuccess = function (event) {
                if (listProduct.length > 0) {
                    $.each(listProduct, function (i, item) {
                        store.put(item
                        );
                    });
                }
            };

            transaction.oncomplete = function () {
                myIndexeddb.Products.Serialize();
            };
        },
        Serialize: function () {
            var transaction = myIndexeddb.db.transaction([myIndexeddb.Products.key], 'readonly');
            var store = transaction.objectStore(myIndexeddb.Products.key);
            // Get everything in the store
            var keyRange = IDBKeyRange.lowerBound(0);
            var cursorRequest = store.openCursor(keyRange);

            this.data = new Array();
            cursorRequest.onsuccess = function (e) {
                var result = e.target.result;
                if (result) {
                    myIndexeddb.Products.data.push(result.value);
                    result.continue();
                } else {
                    myIndexeddb.Products.loaded = true;
                    if (myIndexeddb.OutletPrices.loaded) {
                        myIndexeddb.onComplete();
                    }

                }
            };

        },
        GetVariantByCode: function (Code, entityID) {
            var variant = null;
            var variants = jQuery.grep(this.data, function (n, i) {
                return (n.Code == Code);
            });
            if (variants.length > 0) {
                variant = this.GenerateEntityProperties(variants[0], entityID);
            }

            return variant;
        },
        GetVariantByID: function (ID, entityID) {
            var variant = null;
            var listvariant = this.data;
            var variants = jQuery.grep(listvariant, function (n, i) {
                return (n.ID == ID);
            });
            if (variants.length > 0) {
                variant = this.GenerateEntityProperties(variants[0], entityID);
            }

            return variant;
        },
        GenerateEntityProperties: function (variant, entityID) {
            var result = variant;
            if (Constants.IsNotEmpty(entityID)) {
                var oPrice = myIndexeddb.OutletPrices.GetByID(variant.ID, entityID);
                if (oPrice != null) {
                    result = new Object();
                    result.Code = variant.Code;
                    result.Description = variant.Description;
                    result.ID = variant.ID;
                    result.LoyaltyPoint = variant.LoyaltyPoint;
                    result.Name = variant.Name;
                    result.OrderPrice = variant.OrderPrice;
                    result.OrderPriceDiscount = variant.OrderPriceDiscount;
                    result.Taxable = variant.Taxable;
                    result.TypeID = variant.TypeID;
                    result.UOM = variant.UOM;
                    result.UnitQuantity = variant.UnitQuantity;
                    result.UnitsInStock = variant.UnitsInStock;

                    result.UnitCost = oPrice.UnitCost;
                    result.UnitPrice = oPrice.UnitPrice;
                    result.PriceDiscount = oPrice.PriceDiscount;

                }
            }
            return result
        }
    },
    OutletPrices: {
        key: 'OutletPrices',
        data: '',
        loaded: false,
        Save: function (listOutletPrices) {
            var transaction = myIndexeddb.db.transaction([myIndexeddb.OutletPrices.key], 'readwrite');
            var store = transaction.objectStore(myIndexeddb.OutletPrices.key);
            var objectStoreRequest = store.clear();

            objectStoreRequest.onsuccess = function (event) {
                if (listOutletPrices.length > 0) {
                    $.each(listOutletPrices, function (i, item) {
                        store.put(item);
                    });
                }
            };

            transaction.oncomplete = function () {
                myIndexeddb.OutletPrices.Serialize();
            };
        },
        Serialize: function () {
            var transaction = myIndexeddb.db.transaction([myIndexeddb.OutletPrices.key], 'readonly');
            var store = transaction.objectStore(myIndexeddb.OutletPrices.key);
            // Get everything in the store
            var keyRange = IDBKeyRange.lowerBound(0);
            var cursorRequest = store.openCursor(keyRange);

            this.data = new Array();
            cursorRequest.onsuccess = function (e) {
                var result = e.target.result;
                if (result) {
                    myIndexeddb.OutletPrices.data.push(result.value);
                    result.continue();
                } else {
                    myIndexeddb.OutletPrices.loaded = true;
                    if (myIndexeddb.Products.loaded) {
                        myIndexeddb.onComplete();
                    }

                }
            };

        },
        GetByID: function (ID, entityID) {

            var oPrice = null;
            var oPrices = jQuery.grep(this.data, function (n, i) {
                return (n.VariantID == ID && n.EntityID == entityID);
            });
            if (oPrices.length > 0) {
                oPrice = oPrices[0];
            }
            return oPrice;
        }

    },
    Orders: {
        key: 'Orders',
        park: '',
        loaded: false,
        count: 0,
        CheckOutUrl: '/Authenticated/Services/Transaction.asmx/SubmitOrder',
        Save: function (cashierData) {
            myIndexeddb.OpenDB(function () {
                var transaction = myIndexeddb.db.transaction([myIndexeddb.Orders.key], 'readwrite');
                var store = transaction.objectStore(myIndexeddb.Orders.key);
                store.put(cashierData);
            });

        },
        Sync: function () {
            myIndexeddb.OpenDB(function () {

                var transaction = myIndexeddb.db.transaction([myIndexeddb.Orders.key], 'readwrite');
                var store = transaction.objectStore(myIndexeddb.Orders.key);
                // Get everything in the store
                var keyRange = IDBKeyRange.lowerBound(0);
                var cursorRequest = store.openCursor(keyRange);


                cursorRequest.onsuccess = function (e) {
                    myLocalStorage.FailedOrders.load();

                    var cursor = e.target.result;
                    if (cursor) {
                        var order = cursor.value;
                        var result = myIndexeddb.Orders.CheckOut(order);
                        if (result.Success) {

                        } else {
                            var failTrans = order;
                            failTrans.Message = result.Message;
                            myLocalStorage.FailedOrders.data.push(failTrans);
                        }
                        cursor.delete();
                        myLocalStorage.FailedOrders.save();

                        cursor.continue();
                    } else {
                        myIndexeddb.Products.loaded = true;
                        if (myIndexeddb.OutletPrices.loaded) {
                            myIndexeddb.onComplete();
                        }

                    }
                };
            });

        },
        CheckOut: function (cashierData) {
            var checkoutResult = {
                Success: false,
            };
            $.ajax({
                async: false,
                url: this.CheckOutUrl,
                data: "{ 'json': '" + JSON.stringify(cashierData) + "'}",
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    var result = data.d;
                    checkoutResult = result;

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    checkoutResult.Success = false;
                    checkoutResult.Message = "Fail During Send Transaction";
                }
            });
            return checkoutResult;
        },
        DeleteLastRecord: function () {
            myIndexeddb.OpenDB(function () {
                var transaction = myIndexeddb.db.transaction([myIndexeddb.Orders.key], 'readwrite');
                var store = transaction.objectStore(myIndexeddb.Orders.key);

                var cursorRequest = store.openCursor(null, 'prev');
                cursorRequest.onsuccess = function (e) {
                    var cursor = e.target.result;
                    if (cursor) {
                        return cursor.delete();
                    }

                };

            });
        },
        Count: function (callback) {
            myIndexeddb.OpenDB(function () {
                var transaction = myIndexeddb.db.transaction([myIndexeddb.Orders.key], 'readwrite');
                var store = transaction.objectStore(myIndexeddb.Orders.key);

                var cursorRequest = store.count();
                cursorRequest.onsuccess = function (e) {
                    callback(cursorRequest.result);

                };

            });
        },
        GetParked: function (callback) {
            var transaction = myIndexeddb.db.transaction([myIndexeddb.Orders.key], 'readonly');
            var store = transaction.objectStore(myIndexeddb.Orders.key);
            // Get everything in the store
            var keyRange = IDBKeyRange.lowerBound(0);
            var cursorRequest = store.openCursor(keyRange);

            var park = [];
            cursorRequest.onsuccess = function (e) {
                var cursor = e.target.result;
                if (cursor) {
                    if (cursor.value.Action.Type == 1) {
                        cursor.value.Park.ID = cursor.key;
                        park.push(cursor.value);
                    }
                    cursor.continue();
                } else {
                    callback(park);
                }
            };
        },
        GetByKey: function (key, callback) {
            var transaction = myIndexeddb.db.transaction([myIndexeddb.Orders.key], 'readonly');
            var store = transaction.objectStore(myIndexeddb.Orders.key);
            // Get everything in the store
            var keyRange = IDBKeyRange.only(parseInt(key));
            var cursorRequest = store.openCursor(keyRange);
            cursorRequest.onsuccess = function (e) {
                var cursor = e.target.result;
                if (cursor) {
                    callback(cursor.value);
                }

            };
        },
        DeleteByKey: function (key) {
            var transaction = myIndexeddb.db.transaction([myIndexeddb.Orders.key], 'readwrite');
            var store = transaction.objectStore(myIndexeddb.Orders.key);
            // Get everything in the store
            var keyRange = IDBKeyRange.only(parseInt(key));
            var cursorRequest = store.openCursor(keyRange);
            cursorRequest.onsuccess = function (e) {
                var cursor = e.target.result;
                if (cursor) {
                    cursor.delete();
                }

            };
        },
        GetAll: function (callback) {
            var transaction = myIndexeddb.db.transaction([myIndexeddb.Orders.key], 'readonly');
            var store = transaction.objectStore(myIndexeddb.Orders.key);
            // Get everything in the store
            var keyRange = IDBKeyRange.lowerBound(0);
            var cursorRequest = store.openCursor(keyRange);

            var list = [];
            cursorRequest.onsuccess = function (e) {
                var cursor = e.target.result;
                if (cursor) {
                    list.push(cursor.value);
                    cursor.continue();
                } else {
                    callback(list);
                }
            };
        },
    },
    init: function () {
        try {
            //prefixes of implementation that we want to test
            window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB;

            //prefixes of window.IDB objects
            window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || window.msIDBTransaction;
            window.IDBKeyRange = window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange;
        } catch (ex) {

        }

    },
    Serialize: function (data) {
        try {
            this.OpenDB(function () {
                myIndexeddb.Products.loaded = false;
                myIndexeddb.OutletPrices.loaded = false;
                myIndexeddb.Orders.loaded = false;
                if (data != undefined) {
                    myIndexeddb.Save(data);
                } else {
                    myIndexeddb.Products.Serialize();
                    myIndexeddb.OutletPrices.Serialize();
                }

            });

        } catch (err) {

        }
    },
    OpenDB: function (callback) {
        try {
            var request = indexedDB.open(myIndexeddb.dbName, 2);

            //recreate database structure when update version
            request.onupgradeneeded = function () {
                myIndexeddb.db = request.result;
                request.transaction.onerror = myIndexeddb.databaseError;

                //check if table product is exist then delete and recreate
                if (myIndexeddb.db.objectStoreNames.contains(myIndexeddb.Products.key)) {
                    myIndexeddb.db.deleteObjectStore(myIndexeddb.Products.key);
                }
                myIndexeddb.db.createObjectStore(myIndexeddb.Products.key, { keyPath: "ID" });

                //check if table outlet price is exist then delete and recreate
                if (myIndexeddb.db.objectStoreNames.contains(myIndexeddb.OutletPrices.key)) {
                    myIndexeddb.db.deleteObjectStore(myIndexeddb.OutletPrices.key);
                }
                myIndexeddb.db.createObjectStore(myIndexeddb.OutletPrices.key, { autoIncrement: true });

                //check if table orders is exist then delete and recreate
                if (myIndexeddb.db.objectStoreNames.contains(myIndexeddb.Orders.key)) {
                    myIndexeddb.db.deleteObjectStore(myIndexeddb.Orders.key);
                }
                myIndexeddb.db.createObjectStore(myIndexeddb.Orders.key, { autoIncrement: true });
            };
            request.onsuccess = function (e) {
                myIndexeddb.db = e.target.result;
                callback();
            };
            request.onerror = this.databaseError;
        } catch (ex) {

        }
    },
    Save: function (data) {
        myIndexeddb.Products.Save(data.Products);
        myIndexeddb.OutletPrices.Save(data.OutletPrices)
    },
    databaseError: function (e) {
        alert("Your browser does not support offline mode. Please use latest version of Google Chrome or Apple Safari for offline use.");
    }
}
var myLocalStorage = {
    menu: {
        key: 'Menu',
        data: '',
        Url: '/Authenticated/Services/UI.asmx/GetMenu',
        sync: function () {
            localStorage.removeItem(this.key);
            $.ajax({
                async: false,
                url: this.Url,
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                dataFilter: function (data) { return data; },
                success: function (data) {
                    localStorage.setItem(myLocalStorage.menu.key, JSON.stringify(data.d));
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        },
        load: function () {

            if (localStorage) {
                this.data = JSON.parse(localStorage.getItem(this.key));
            }
            if (this.data == null) {
                this.data = new Array();
            }
        },
        save: function () {
            localStorage.setItem(this.key, JSON.stringify(this.data));
        },
    },
    customers: {
        key: 'Customers',
        data: '',
        sync: function () {
            localStorage.removeItem(this.key);
            $.ajax({
                async: false,
                url: "/Authenticated/Services/Customer.asmx/GetAll",
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                dataFilter: function (data) { return data; },
                success: function (data) {
                    localStorage.setItem(myLocalStorage.customers.key, JSON.stringify(data.d));
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        },
        load: function () {
            if (localStorage) {
                this.data = JSON.parse(localStorage.getItem(this.key));
            }
            if (this.data == null) {
                this.data = new Array();
            }
        },
        getByID: function (ID) {
            return jQuery.grep(this.data, function (n, i) {
                return (n.ID == ID);
            });
        },
        GetByCode: function (Code) {
            return jQuery.grep(this.data, function (n, i) {
                return (n.Code == Code);
            });
        },
    },
    parks: {
        key: 'Parks',
        data: '',
        load: function () {

            if (localStorage) {
                this.data = JSON.parse(localStorage.getItem(this.key));
            }
            if (this.data == null) {
                this.data = new Array();
            }
        },
        GetByEntityID: function (entityID) {
            return jQuery.grep(this.data, function (n, i) {
                return (n.Order.EntityID == entityID);
            });
        },
        save: function () {
            localStorage.setItem(this.key, JSON.stringify(this.data));
        },
        GetByID: function (id) {
            return jQuery.grep(this.data, function (n, i) {
                return (n.Order.ID == id);
            });
        },
        RemoveByID: function (id) {
            this.data = jQuery.grep(this.data, function (n, i) {
                return (n.Order.ID != id);
            });
            this.save();
        },
    },
    FailedOrders: {
        key: 'FailedOrders',
        data: '',
        resend: function (index) {
            var cashierData = this.data[index];
            $.ajax({
                async: false,
                url: myIndexeddb.Orders.CheckOutUrl,
                data: "{ 'json': '" + JSON.stringify(cashierData) + "'}",
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    var result = data.d;
                    if (result.Success) {
                        myLocalStorage.FailedOrders.data.splice(index, 1);
                        myLocalStorage.FailedOrders.save();
                    } else {
                        alert(result.Message);
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Fail During Send Transaction");
                }
            });
        },
        load: function () {
            if (localStorage) {
                this.data = JSON.parse(localStorage.getItem(this.key));
            }
            if (this.data == null) {
                this.data = new Array();
            }
        },
        save: function () {
            localStorage.setItem(this.key, JSON.stringify(this.data));
        },
    },
    outlets: {
        key: 'Outlets',
        data: '',
        sync: function () {
            localStorage.removeItem(this.key);
            $.ajax({
                async: false,
                url: "/Authenticated/Services/Register.asmx/GetListOutletInfo",
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                dataFilter: function (data) { return data; },
                success: function (data) {
                    localStorage.setItem(myLocalStorage.outlets.key, JSON.stringify(data.d));
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        },
        save: function () {
            localStorage.setItem(this.key, JSON.stringify(this.data));
        },
        load: function () {
            if (localStorage) {
                this.data = JSON.parse(localStorage.getItem(this.key));
            }
            if (this.data == null) {
                this.data = new Array();
            }
        },
        GetByEntityID: function (ID) {
            return jQuery.grep(this.data, function (n, i) {
                return (n.EntityID == ID);
            });
        }
    },
    config: {
        key: 'Config',
        data: '',
        sync: function () {
            localStorage.removeItem(this.key);
            $.ajax({
                async: false,
                url: "/Authenticated/Services/POS.asmx/GetPOSStorage",
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                dataFilter: function (data) { return data; },
                success: function (data) {
                    localStorage.setItem(myLocalStorage.config.key, JSON.stringify(data.d));
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        },
        load: function () {
            if (localStorage) {
                this.data = JSON.parse(localStorage.getItem(this.key));
            }
            if (this.data == null) {
                this.data = new Array();
            }
        },
        save: function () {
            localStorage.setItem(this.key, JSON.stringify(this.data));
        },
    },
    queryMode: {
        key: 'QueryConfig',
        data: '',
        load: function () {
            if (localStorage) {
                this.data = JSON.parse(localStorage.getItem(this.key));
            }
            if (this.data == null) {
                this.data = new Array();
            }
        },
        save: function () {
            localStorage.setItem(this.key, JSON.stringify(this.data));
        },
        //1=Realtime, 2=Local
        GetProduct: function () {
            if (Constants.IsEmpty(this.data)) {
                return "1";
            }
            if (Constants.IsEmpty(this.data.Product)) {
                return "1"
            }
            return this.data.Product;
        },
        //1=Realtime, 2=Local
        GetOrder: function () {
            if (Constants.IsEmpty(this.data)) {
                return "1"
            }
            if (Constants.IsEmpty(this.data.Order)) {
                return "1"
            }
            return this.data.Order;
        }

    },
    init: function () {
        this.dataLoad();
        myIndexeddb.Serialize();
    },
    //load all data except order    
    dataLoad: function () {
        this.customers.load();
        this.outlets.load();
        this.config.load();
        this.queryMode.load();
        this.parks.load();
    },

    dataSync: function (auto) {
        if (auto == undefined) {
            auto = false;
        }
        $.ajax({
            async: false,
            url: "/Authenticated/Services/POS.asmx/GetLocalStorageData",
            data: "{ 'auto': '" + auto + "'}",
            dataType: "json",
            type: "POST",
            contentType: "application/json; charset=utf-8",
            dataFilter: function (data) { return data; },
            success: function (data) {
                myIndexeddb.Serialize(data.d);
                localStorage.setItem(myLocalStorage.customers.key, JSON.stringify(data.d.Customers));
                localStorage.setItem(myLocalStorage.outlets.key, JSON.stringify(data.d.Outlets));
                localStorage.setItem(myLocalStorage.config.key, JSON.stringify(data.d.Config));
                localStorage.setItem(myLocalStorage.parks.key, JSON.stringify(data.d.Parks));
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }
}

// Code obtained from www.html5rocks.com/en/tutorials/appcache/beginner/
window.addEventListener('load', function (e) {
    window.applicationCache.addEventListener('updateready', function (e) {
        if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
            window.applicationCache.swapCache();
            //reload automatically on new version detection
            window.location.reload();
        }
    }, false);

}, false);
