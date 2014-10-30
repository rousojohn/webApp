define(["App", "backbone", "marionette", "jquery", "hbs!templates/personal", "models/OfficeHoursModel", "models/AddressModel",
        "models/PhoneModel", "models/EmailModel"],
    function (App, Backbone, Marionette, $, template, OfficeHoursModel, AddressModel, PhoneModel, EmailModel) {
        return Backbone.Marionette.Layout.extend({
            
            template: template,
            
            ui : {
                // UI OfficeHours Elements
                officeModal : "div#officeModal",
                addOffice : "button#addOffice",
                officeOffice : "#officeOffice",
                officeDay : "#officeDay",
                officeFrom : "#officeFrom",
                officeTo : "#officeTo",
                officeCollapse : "#collapseOne",
                
                // UI Addresses Elements
                addrModal : "div#addrModal",
                addressCollapse : "#collapseTwo",
                addAddress : "button#addAddress",
                addrPrimary : "#addrPrimary",
                addrStreet : "#addrStreet",
                addrNum : "#addrNum",
                addrCity : "#addrCity",
                addrPostal : "#addrPostal",
                
                // UI Phones Elements
                phoneModal : "div#phoneModal",
                addPhone : "button#addPhone",
                phoneCollapse : "#collapseThree",
                telTel : "#telTel",
                telType : "#telType",
                
                // UI Emails Elements
                emailModal : "div#emailModal",
                addEmail : "button#addEmail",
                emailCollapse : "#collapseFour",
                emailEmail : "#emailEmail",
                emailPrimary : "#emailPrimary"                
            },
            
            regions : {
                officeRegion : "div#officeRegion",
                addressRegion : "div#addressRegion",
                phonesRegion : "div#phonesRegion",
                emailsRegion : "div#emailsRegion",
                presonalData : "div#presonalData"
            },
            
            events : {
                // OfficeHours Events
                "click button#addOffice" : "showOfficeHoursForm",
                "click a#officeSave" : "saveOfficeHours",
                "show.bs.modal #officeModal" : "beforeOfficeFormOpen",
                "hide.bs.modal #officeModal" : "clear",
                
                // Addresses Events
                "show.bs.modal #addrModal" : "beforeAddrFormOpen",
                "hide.bs.modal #addrModal" : "clear",
                "click button#addAddress" : "showAddressForm",
                "click a#addrSave" : "saveAddress",
                
                // Phones Events
                "show.bs.modal #phoneModal" : "beforePhoneFormOpen",
                "hide.bs.modal #phoneModal" : "clear",
                "click button#addPhone" : "showPhoneForm",
                "click a#telSave" : "savePhone",
                "keydown input#telTel" : "telChanged",
                
                // Emails Events
                "show.bs.modal #emailModal" : "beforeEmailFormOpen",
                "hide.bs.modal #emailModal" : "clear",
                "click button#addEmail" : "showEmailForm",
                "click a#emailSave" : "saveEmail",
                
                // Form events
                "click button#save" : "saveDataForm"
            },
            
            clear : function (){
                this.model = undefined;
                this.render();
            },
            
            telChanged : function (evt) {
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode != 190 && charCode > 31 && 
                    (charCode < 48 || charCode > 57) && 
                    (charCode < 96 || charCode > 105) && 
                    (charCode < 37 || charCode > 40) && 
                    charCode != 110 && charCode != 8 && charCode != 46 )
                    return false;
                return true;
            },
            
            initialize : function () {
                _.bindAll(this);
                var view = this;
                
                // Bind the view on Edit Events from its children
                App.vent.on("editOffice", function (officeID) {
                    view.model = view.options.officeRegion.collection.find( function (_model) { return _model.id == officeID; });
                    view.render();
                    view.showOfficeHoursForm();
                });
                App.vent.on("editAddr", function (addrID) {
                    view.model = view.options.addressRegion.collection.find( function (_model) { return _model.id == addrID; });
                    view.render();
                    view.showAddressForm();
                });
                App.vent.on("editTel", function (telID) {
                    view.model = view.options.phonesRegion.collection.find( function (_model) { return _model.id == telID; });
                    view.render();
                    view.showPhoneForm();
                });
                App.vent.on("editEmail", function (emailID) {
                    view.model = view.options.emailsRegion.collection.find( function (_model) { return _model.id == emailID; });
                    view.render();
                    view.showEmailForm();
                });
                
                
                
                 // Bind the view on Delete Events from its children
                App.vent.on("deleteOffice", function (officeID) {
                    var deleteModel = view.options.officeRegion.collection.find( function (_model) { return _model.id == officeID; });
                    deleteModel.destroy({
                        success: function (data){
                            view.options.officeRegion.trigger("refresh");
                        }
                    });
                });
                
                App.vent.on("deleteAddr", function (addrID) {
                    var deleteModel = view.options.addressRegion.collection.find( function (_model) { return _model.id == addrID; });
                    deleteModel.destroy({
                        success: function (data){
                            view.options.addressRegion.trigger("refresh");
                        }
                    });
                });
                App.vent.on("deleteTel", function (telID) {
                    var deleteModel = view.options.phonesRegion.collection.find( function (_model) { return _model.id == telID; });
                    deleteModel.destroy({
                        success: function (data){
                            view.options.phonesRegion.trigger("refresh");
                        }
                    });
                });
                App.vent.on("deleteEmail", function (emailID) {
                    var deleteModel = view.options.emailsRegion.collection.find( function (_model) { return _model.id == emailID; });
                    deleteModel.destroy({
                        success: function (data){
                            view.options.emailsRegion.trigger("refresh");
                        }
                    });
                });
            },
            
            saveDataForm : function (evt) {
                this.options.presonalData.trigger('saveForm');
            },
            
            saveOfficeHours : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                if ( this.model instanceof OfficeHoursModel == false)
                    this.model = new OfficeHoursModel({
                        user_id : App.user.id
                    });
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                this.model.set({
                    office : this.ui.officeOffice.val(),
                    day : this.ui.officeDay.val(),
                    hour_from : this.ui.officeFrom.val(),
                    hour_to : this.ui.officeTo.val()
                });
                
                this.model.save({}, {success : function (_data) {
                    view.model = undefined;
                    view.ui.officeModal.modal('hide');
                    view.ui.officeCollapse.collapse('show');
                    view.options.officeRegion.trigger('refresh');
                }});
            },
            
            saveAddress : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                if (this.model instanceof AddressModel == false)
                    this.model = new AddressModel({
                        user_id : App.user.id
                    });
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                this.model.set({
                    city: this.ui.addrCity.val(),
                    street : this.ui.addrStreet.val(),
                    no : this.ui.addrNum.val(),
                    postal_code : this.ui.addrPostal.val(),
                    primary_address : this.ui.addrPrimary.val()
                });
                this.model.save({}, { success : function (_data) {
                    view.model = undefined;
                    view.ui.addrModal.modal('hide');
                    view.ui.addressCollapse.collapse('show');
                    view.options.addressRegion.trigger('refresh');
                }});
            },
            
            savePhone : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                if (this.model instanceof PhoneModel == false) 
                    this.model = new PhoneModel({
                        user_id : App.user.id
                    });
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                this.model.set({
                    phone : this.ui.telTel.val(),
                    type : this.ui.telType.val()
                });
                this.model.save({}, { success : function (_data) {
                    view.model = undefined;
                    view.ui.phoneModal.modal('hide');
                    view.ui.phoneCollapse.collapse('show');
                    view.options.phonesRegion.trigger('refresh');
                }});
            },
            
            saveEmail : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                if (this.model instanceof EmailModel == false)
                    this.model = new EmailModel({
                        user_id : App.user.id
                    });
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                this.model.set({
                    email : this.ui.emailEmail.val(),
                    primary_mail : parseInt(this.ui.emailPrimary.val())
                });
                this.model.save({}, { success : function (_data) {
                    view.model = undefined;
                    view.ui.emailModal.modal('hide');
                    view.ui.emailCollapse.collapse('show');
                    view.options.emailsRegion.trigger('refresh');
                }});
            },
            
            showOfficeHoursForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.officeModal.modal('show');
            },
            
            showAddressForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.addrModal.modal('show');
            },
            
            showPhoneForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.phoneModal.modal('show');
            },
            
            showEmailForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.emailModal.modal('show');
            },
            
            beforeAddrFormOpen : function (evt) {
                if (this.model instanceof AddressModel)
                    this.ui.addrPrimary.val(this.model.get("primary_address"));
            },
            
            beforeOfficeFormOpen : function (evt) {
                if (this.model instanceof OfficeHoursModel)
                    this.ui.officeDay.val(this.model.get("day"));
            },
            
            beforeEmailFormOpen : function (evt) {
                if (this.model instanceof EmailModel)
                    this.ui.emailPrimary.val(this.model.get("primary_mail"));
            },
            
            beforePhoneFormOpen : function (evt) {
                if (this.model instanceof PhoneModel)
                    this.ui.telType.val(this.model.get("type"));
            },
            
            onRender: function (){
                var view = this;
                
                
                 // Initialize Tooltips for the 'Add' Buttons
                this.ui.addOffice.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addAddress.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addPhone.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addEmail.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                // Initialize modals
                this.ui.officeModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });
                
                this.ui.addrModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });
                
                this.ui.phoneModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });
                
                this.ui.emailModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });
                
                
                // Show the regions
                if (this.options.officeRegion !== undefined)
                    this.officeRegion.show(this.options.officeRegion);
                
                if (this.options.addressRegion !== undefined)
                    this.addressRegion.show(this.options.addressRegion);
                
                if (this.options.phonesRegion !== undefined)
                    this.phonesRegion.show(this.options.phonesRegion);
                
                if (this.options.emailsRegion !== undefined)
                    this.emailsRegion.show(this.options.emailsRegion);
                
                if (this.options.presonalData !== undefined)
                    this.presonalData.show(this.options.presonalData);
            }
        });
    });