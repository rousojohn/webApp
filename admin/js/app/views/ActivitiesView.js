define(["App", "backbone", "marionette", "jquery", "hbs!templates/activities", 'models/PublicationModel', 'models/HonorsModel', 'models/InterestsModel', 'models/OrganizationModel'],
    function (App, Backbone, Marionette, $, template, PublicationModel, HonorsModel, InterestsModel, OrganizationModel) {
        return Backbone.Marionette.Layout.extend({
            
            template: template,
            
            ui : {
                
                // UI Elements for Publications
                publicationModal : "#publicationModal",
                addPublication : "button#addPublication",
                publTitle : "#publicationTitle",
                publAuthors : "#publicationAuthors",
                publPublisher : "#publicationPublisher",
                publDate : "#publicationDate",
                publLink : "#publicationLink",
                publDesc : "#publicationDesc",
                publicationCollapse : "#collapseOne",
                
                // UI Elements for Honors
                addHonor : "button#addHonor",
                honorsModal : "div#honorsModal",
                honorTitle : "#honorTitle",
                honorIssuer : "#honorIssuer",
                honorDate : "#honorDate",
                honorDesc : "#honorDesc",
                honorsCollapse : "#collapseThree",
                
                // UI Elements for Interests
                addInterest : "button#addInterest",
                interestCollapse : "#collapseFour",
                interestModal : "#interestModal",
                interestDesc : "#interestDesc",
                
                // UI Elements for Organizations
                addOrganization : "button#addOrganization",
                orgsModal : "#orgsModal",
                orgsCollapse : "#collapseTwo",
                orgName     : "#orgName",
                orgPosition : "#orgPosition",
                orgFrom : "#orgFrom",
                orgTo : "#orgTo",
                orgCurrent : "#orgCurrent",
                orgDesc : "#orgDesc"
            },
            
            regions : {
                publicationsRegion : "div#publicationsRegion",
                honorsRegion : "div#honorsRegion",
                interestRegion : "div#interestRegion",
                organizationsRegion : "div#organizationsRegion"
            },
            
            events : {
                // events for handling Publications
                "click button#addPublication" : "showPublicationForm",
                "click a#publicationSave" : "savePublication",
                "hide.bs.modal #publicationModal" : "clear",
                
                // events for handling Honors
                "click button#addHonor" : "showHonorsForm",
                "hide.bs.modal #honorsModal" : "clear",
                "click a#honorSave" : "saveHonor",
                
                // events for handling Interests
                "click button#addInterest" : "showInterestsForm",
                "hide.bs.modal #interestModal" : "clear",
                "click a#interestSave" : "saveInterest",
                
                // events for handling Organizations
                "click button#addOrganization" : "showOrgsForm",
                "hide.bs.modal #orgsModal" : "clear",
                "show.bs.modal #orgsModal" : "beforeOrgFormOpen",
                "click a#orgSave" : "saveOrg",
                
            },
            
            clear : function (){
                this.model = undefined;
                this.render();
            },
            
            beforeOrgFormOpen : function () {
                var view = this;
                if (this.model !== undefined && this.model !== null)
                    this.ui.orgCurrent.attr("checked", (this.model.get("current_position") == 1));
            },
            
            showPublicationForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.publicationModal.modal('show');
            },
            
            showHonorsForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.honorsModal.modal('show');
            },
            
            showInterestsForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.interestModal.modal('show');
            },
            
            showOrgsForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.orgsModal.modal('show');
            },
            
            savePublication : function (evt) {
                var view = this;
                if ( evt ) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                if ( this.model instanceof PublicationModel == false )
                    this.model = new PublicationModel({
                        user_id : App.user.id
                    });
                
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                
                this.model.set("title", this.ui.publTitle.val());
                this.model.set("authors", this.ui.publAuthors.val());
                this.model.set("publisher", this.ui.publPublisher.val());
                this.model.set("date", this.ui.publDate.val());
                this.model.set("link", this.ui.publLink.val());
                this.model.set("description", this.ui.publDesc.val());
                
                this.model.save({},{success: function (_data) {
                    view.model = undefined;
                    view.ui.publicationModal.modal('hide');
                    view.ui.publicationCollapse.collapse('show');
                    view.options.publicationsRegion.trigger("refresh");
                }});
            },
            
            saveHonor : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                
                if ( this.model instanceof HonorsModel == false )
                    this.model = new HonorsModel({
                        user_id : App.user.id
                    });
                
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                
                this.model.set("title", this.ui.honorTitle.val());
                this.model.set("description", this.ui.honorDesc.val());
                this.model.set("date", this.ui.honorDate.val());
                this.model.set("issuer", this.ui.honorIssuer.val());
                
                this.model.save({}, {success : function (_data) {
                    view.model = undefined;
                    view.ui.honorsModal.modal('hide');
                    view.ui.honorsCollapse.collapse('show');
                    view.options.honorsRegion.trigger('refresh');
                }});
            },
            
            
            saveInterest : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                if ( this.model instanceof InterestsModel == false) 
                    this.model = new InterestsModel({
                        user_id : App.user.id
                    });
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                
                this.model.set("description", this.ui.interestDesc.val());
                this.model.save({}, {success : function (_data) {
                    view.model = undefined;
                    view.ui.interestModal.modal('hide');
                    view.ui.interestCollapse.collapse('show');
                    view.options.interestRegion.trigger('refresh');
                }});
            },
            
            
            saveOrg : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                if (this.model instanceof OrganizationModel == false)
                    this.model = new OrganizationModel({
                        user_id : App.user.id
                    });
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                this.model.set("name", this.ui.orgName.val());
                this.model.set("position", this.ui.orgPosition.val());
                this.model.set("date_from", this.ui.orgFrom.val());
                this.model.set("date_to", this.ui.orgTo.val());
                this.model.set("current_position", this.ui.orgCurrent.is(":checked") ? 1 : 0);
                this.model.set("description", this.ui.orgDesc.val());
                this.model.save({}, {success : function (_data) {
                    view.model = undefined;
                    view.ui.orgsModal.modal('hide');
                    view.ui.orgsCollapse.collapse('show');
                    view.options.organizationsRegion.trigger('refresh');
                }});
            },
            
            initialize : function () {
                _.bindAll(this);
                var view = this;
                
                // Bind the view on Edit Events from its children
                App.vent.on("editPublication", function (publID) {
                    view.model = view.options.publicationsRegion.collection.find( function (_model) { return _model.id == publID; });
                    view.render();
                    view.showPublicationForm();
                });
                
                App.vent.on("editHonor", function (honorId) {
                    view.model = view.options.honorsRegion.collection.find( function (_model) { return _model.id == honorId; });
                    view.render();
                    view.showHonorsForm();
                });
                
                App.vent.on("editInterest", function (interestId) {
                    view.model = view.options.interestRegion.collection.find( function (_model) { return _model.id == interestId; });
                    view.render();
                    view.showInterestsForm();
                });
                
                App.vent.on("editOrganization", function (ogrId) {
                    view.model = view.options.organizationsRegion.collection.find( function (_model) { return _model.id == ogrId; });
                    view.render();
                    view.showOrgsForm();
                });
                
                
                
                 // Bind the view on Delete Events from its children
                
                
                
                App.vent.on("deletePublication", function (publID) {
                    var deleteModel = view.options.publicationsRegion.collection.find( function (_model) { return _model.id == publID; });
                    deleteModel.destroy({
                        success: function (data){
                            view.options.publicationsRegion.trigger("refresh");
                        }
                    });
                });
                
                App.vent.on("deleteHonor", function (honorId) {
                    var deleteModel = view.options.honorsRegion.collection.find( function (_model) { return _model.id == honorId; });
                     deleteModel.destroy({
                        success: function (data){
                            view.options.honorsRegion.trigger('refresh');
                        }
                    });
                });
                
                App.vent.on("deleteInterest", function (interestId) {
                    var deleteModel = view.options.interestRegion.collection.find( function (_model) { return _model.id == interestId; });
                    deleteModel.destroy({
                        success: function (data){
                            view.options.interestRegion.trigger('refresh');
                        }
                    });
                });
                
                App.vent.on("deleteOrganization", function (orgId) {
                    var deleteModel = view.options.organizationsRegion.collection.find( function (_model) {return _model.id == orgId; });
                    deleteModel.destroy({
                        success: function (data) {
                            view.options.organizationsRegion.trigger('refresh');
                        }
                    });
                });
                
                //this.render();
            },
            
            onRender: function (){
                var view = this;
                 // Initialize Tooltips for the 'Add' Buttons
                this.ui.addPublication.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addHonor.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addInterest.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addOrganization.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                
                
                
                
                // Initialize modals
                this.ui.publicationModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });                
                
                this.ui.honorsModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });              
                
                this.ui.interestModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });              
                
                this.ui.orgsModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });
                
                
                
                
                
                
                
                // Show the regions
                if (this.options.publicationsRegion !== undefined)
                    this.publicationsRegion.show(this.options.publicationsRegion);
                
                if (this.options.honorsRegion !== undefined)
                    this.honorsRegion.show(this.options.honorsRegion);
                
                if (this.options.interestRegion !== undefined)
                    this.interestRegion.show(this.options.interestRegion);
                
                if (this.options.organizationsRegion !== undefined )
                    this.organizationsRegion.show(this.options.organizationsRegion);
                
            }
        });
    });