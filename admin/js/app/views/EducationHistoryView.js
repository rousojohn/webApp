define(["App", "backbone", "marionette", "jquery", "hbs!templates/educationHistory", "models/SchoolModel", "collections/LevelCollection",
        "models/LanguageModel", "models/CertificationModel", 'collections/DegreeCollection', 'collections/SchoolsCollection', 'models/EducationModel'],
    function (App, Backbone, Marionette, $, template, SchoolModel, LevelCollection, LanguageModel, CertificationModel, DegreeCollection,
               SchoolsCollection, EducationModel) {
        return Backbone.Marionette.Layout.extend({
            
            template: template,
            
            ui : {
                
                // UI Elements for Schools
                addSchoolBtn : "button#addSchool",
                schoolModal : "#schoolModal",
                schoolName : "#schoolName",
                schoolAddress : "#schoolAddress",
                schoolPhone : "#schoolTel",
                schoolLink : "#schoolLink",
                schoolCollapsible : "#collapseOne",
                
                
                // UI Elements for Languages
                addLangBtn : "button#addLanguage",
                langModal : "#langModal",
                langCollapsible : "#collapseTwo",
                langLevelSel : "#langLevelSel",
                langName : "#langName",
                
                // UI Elements for Certifications
                addCertBtn : "button#addCert",
                certModal : "#certModal",
                certName : "#certName",
                certDesc : "#certDesc",
                certAuthority : "#certAuthority",
                certLink : "#certLink",
                certFrom : "#certFrom",
                certTo : "#certTo",
                certNotExpires : "#certNotExpires",
                certLicense : "#certLicenseNo",
                certCollapsible : "#collapseThree",
                
                // UI Elements for Education
                addEdu : "button#addEdu",
                eduModal : "#eduModal",
                eduSchoolSel : "#eduSchoolSel",
                eduDegreeSel : "#eduDegreeSel",
                isCurrent : "#isCurrent",
                eduFrom : "#eduFrom",
                eduTo   :   "#eduTo",
                studyField  :   "#eduFieldStudy",
                eduGrade    :   "#eduGrade",
                eduDesc     :   "#eduDesc",
                eduCollapsible : "#collapseFour"
            },
            
            regions : {
                shoolsRegion : "div#shoolsRegion",
                langsRegion : "div#langsRegion",
                certsRegion : "div#certsRegion",
                educationRegion : "div#educationRegion"
            },
            
            events : {
                // events for handling Schools
                "click button#addSchool" : "showSchoolForm",
                "click a#schoolSave" : "saveSchool",
                "hide.bs.modal #schoolModal" : "clear",
                
                //events for handling Languages
                "click button#addLanguage" : "showLangForm",
                "show.bs.modal #langModal" : "beforeLangFormOpen",
                "click a#langSave" : "saveLang",
                "hide.bs.modal #langModal" : "clear",
                
                // events for handling Certifications
                "click button#addCert" : "showCertForm",
                "show.bs.modal #certModal" : "beforeCertFormOpen",
                "click a#certSave" : "saveCert",
                "hide.bs.modal #certModal" : "clear",
                
                // events for handling Certifications
                "click button#addEdu" : "showEduForm",
                "show.bs.modal #eduModal" : "beforeEduFormOpen",
                "hide.bs.modal #eduModal" : "clear",
                "click a#eduSave" : "saveEdu"
            },
            
            beforeLangFormOpen : function () {
                var view = this;
                var error = "";
                
                var levels = new LevelCollection();
                
                // fetch levels for the dropdown option and select the proper one if it's about editing a model
                levels.fetch({success : function (data) {
                    
                    var html = "";
                    html = "<option value='-1'></option>";
                    data.each(function(_model){
                        html += "<option value='" + _model.id + "'";
                        if (view.model !== undefined && view.model.get("level_id") == _model.id)
                            html += " selected='selected'" ;
                        html += ">"+_model.get("name")+"</option>";
                    });
                    view.ui.langLevelSel.html(html);
                }});
            },
            
            beforeEduFormOpen : function () {
                var view = this;
                var error = "" ;
                
                var schools = new SchoolsCollection();
                var degrees = new DegreeCollection();
                
                
                if (this.model !== undefined && this.model !== null)
                    this.ui.isCurrent.attr("checked", (this.model.get("current_education") == 1));
                
                degrees.fetch({success : function (degressData) {
                    var degreesHtml = "<option value='-1'></option>";
                    degressData.each(function (_model) {
                        degreesHtml += "<option value='" + _model.id +"' ";
                        if (view.model !== undefined && view.model.get("degree_id") == _model.id)
                            degreesHtml += "selected='selected'";
                        degreesHtml += ">" + _model.get("name") +"</option>";
                    });
                    
                    schools.fetch({success : function (schoolsData) { 
                        var schoolsHtml = "<option value='-1'></option>";
                        
                        schoolsData.each( function (_model) {
                            schoolsHtml += "<option value='" + _model.id + "' ";
                            if (view.model !== undefined && view.model.get("school_id") == _model.id)
                                schoolsHtml += "selected='selected'";
                            schoolsHtml += ">" + _model.get("name") + "</option>";
                        });
                        
                        view.ui.eduSchoolSel.html(schoolsHtml);
                        view.ui.eduDegreeSel.html(degreesHtml);
                    }});
                }});
            },
            
            beforeCertFormOpen : function () {
                var view = this;
                if (this.model !== undefined && this.model !== null)
                    this.ui.certNotExpires.attr("checked", (this.model.get("does_not_expire") == 1));
            },
            
            clear : function (){
                this.model = undefined;
                this.ui.langLevelSel.html('');
                this.render();
            },
            
            initialize : function () {
                _.bindAll(this);
                var view = this;
                
                
                // Bind the view on Edit Events from its children
                App.vent.on("editSchool", function (schoolId) {
                    view.model = view.options.shoolsRegion.collection.find( function (_model) { return _model.id == schoolId; });
                    view.render();
                    view.showSchoolForm();
                });
                
                App.vent.on("editLang", function (langId) {
                    view.model = view.options.langsRegion.collection.find( function (_model) { return _model.id == langId; });
                    view.render();
                    view.showLangForm();
                });
                
                App.vent.on("editCert", function (certId) {
                    view.model = view.options.certsRegion.collection.find( function (_model) { return _model.id == certId; });
                    view.render();
                    view.showCertForm();
                });
                
                App.vent.on("editEducation", function (eduId) {
                    view.model = view.options.educationRegion.collection.find( function (_model) { return _model.id == eduId; });
                    view.render();
                    view.showEduForm();
                });
                
                
                
                
                // Bind the view on Delete Events from its children
                App.vent.on("deleteSchool", function (schoolId) {
                    var deleteModel = view.options.shoolsRegion.collection.find( function (_model) { return _model.id == schoolId; });
                    deleteModel.destroy();
                    view.options.shoolsRegion.trigger("refresh");
                });
                
                App.vent.on("deleteLang", function (langId) {
                    var deleteModel = view.options.langsRegion.collection.find( function (_model) { return _model.id == langId; });
                    deleteModel.destroy();
                    view.options.langsRegion.collection.fetch({success: function(data){
                        view.options.langsRegion.trigger("refresh");
                    }});
                });
                
                App.vent.on("deleteCert", function (certId) {
                    var deleteModel = view.options.certsRegion.collection.find( function (_model) { return _model.id == certId; });
                    deleteModel.destroy();
                    view.options.certsRegion.collection.fetch({success: function(data){
                        view.options.certsRegion.trigger("refresh");
                    }});
                });
                
                App.vent.on("deleteEdu", function (eduId) {
                    var deleteModel = view.options.educationRegion.collection.find( function (_model) { return _model.id == eduId; });
                    deleteModel.destroy();
                    view.options.educationRegion.collection.fetch({success: function(data){
                        view.options.educationRegion.trigger("refresh");
                    }});
                });
                
                
                
                
                this.render();
            },
            
            showSchoolForm : function (evt) {
                if (evt){
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.schoolModal.modal('show');
            },
            
            showLangForm : function (evt) {
                if (evt){
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.langModal.modal('show');
            },
            
            showCertForm : function (evt){
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.certModal.modal('show');
            },
            
            
            showEduForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.eduModal.modal('show');
            },
            
            
            saveSchool : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                if (this.model instanceof SchoolModel == false )
                    this.model = new SchoolModel({
                        user_id: App.user.id
                    });
                
                this.model.on("invalid", function (model, error){
                    App.handleError(error);
                    
                    model.off("invalid");
                });
                this.model.set("name", this.ui.schoolName.val());
                this.model.set("address", this.ui.schoolAddress.val());
                this.model.set("phone", this.ui.schoolPhone.val());
                this.model.set("link", this.ui.schoolLink.val());
                
                
                this.model.save({},{success: function (data) {
                    view.model = null;
                    view.ui.schoolModal.modal('hide');
                    view.ui.schoolCollapsible.collapse('show');
                    view.options.shoolsRegion.trigger("refresh");
                    view.render();
                }});
            },
            
            
            saveLang : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                if (this.model instanceof LanguageModel == false )
                    this.model = new LanguageModel({
                        user_id : App.user.id
                    });
                
                this.model.on("invalid", function (model, error) {
                    App.handleError(error);
                    
                    model.off("invalid");
                });
                this.model.set("name", this.ui.langName.val());
                this.model.set("level_id", this.ui.langLevelSel.val());
                
                this.model.save({}, {success : function (data) {
                    view.model = null;
                    view.ui.langModal.modal('hide');
                    view.ui.langCollapsible.collapse('show');
                    view.options.langsRegion.trigger("refresh");
                }});
            },
            
            
            saveCert : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                
                if (this.model instanceof CertificationModel == false )
                    this.model = new CertificationModel({
                        user_id : App.user.id
                    });
                
                this.model.on("invalid", function (_model, error){
                    App.handleError(error);
                    _model.off("invalid");
                });
                
                this.model.set("name", this.ui.certName.val());
                this.model.set("description", this.ui.certDesc.val());
                this.model.set("authority", this.ui.certAuthority.val());
                this.model.set("link", this.ui.certLink.val());
                this.model.set("date_from", this.ui.certFrom.val());
                this.model.set("date_to", this.ui.certTo.val());
                this.model.set("does_not_expire", $(this.ui.certNotExpires).is(":checked") ? 1 : 0);
                this.model.set("licenseno", this.ui.certLicense.val());
                
                this.model.save({}, {success: function (data) {
                    view.model = null;
                    view.ui.certModal.modal('hide');
                    view.ui.certCollapsible.collapse('show');
                    view.options.certsRegion.trigger("refresh");
                }});
            },
            
            
            saveEdu : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                
                if ( this.model instanceof EducationModel == false)
                    this.model = new EducationModel({
                        user_id : App.user.id
                    });
                
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                
                this.model.set("attended_from", this.ui.eduFrom.val());
                this.model.set("attended_to", this.ui.eduTo.val());
                this.model.set("current_education", this.ui.isCurrent.is(":checked") ? 1 : 0);
                this.model.set("fieldOfStudy", this.ui.studyField.val());
                this.model.set("grade", this.ui.eduGrade.val());
                this.model.set("description", this.ui.eduDesc.val());
                this.model.set("degree_id", this.ui.eduDegreeSel.val());
                this.model.set("school_id", this.ui.eduSchoolSel.val());
                
                this.model.save({}, {success : function (data) {
                    view.model = undefined;
                    view.ui.eduModal.modal('hide');
                    view.ui.eduCollapsible.collapse('show');
                    view.options.educationRegion.trigger("refresh");
                }});
            },
            
            onRender: function (){
                var view = this;
                
                // Initialize Tooltips for the 'Add' Buttons
                this.ui.addSchoolBtn.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addLangBtn.tooltip({
                    animation: true, 
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addCertBtn.tooltip({
                    animation : true,
                    placement : "right",
                    trigger : "hover"
                });
                
                this.ui.addEdu.tooltip({
                    animation : true,
                    placement : "right",
                    trigger : "hover"
                });
                
                
                
                // Initialize modals
                this.ui.schoolModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });
                
                this.ui.langModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });
                
                this.ui.certModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });
                
                this.ui.eduModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });
                
                
                
                // Show the regions
                if (this.options.shoolsRegion !== undefined)
                    this.shoolsRegion.show(this.options.shoolsRegion);
                
                if (this.options.langsRegion !== undefined)
                    this.langsRegion.show(this.options.langsRegion);
                
                if (this.options.certsRegion !== undefined)
                    this.certsRegion.show(this.options.certsRegion);
                
                if (this.options.educationRegion !== undefined )
                    this.educationRegion.show(this.options.educationRegion);
                
            }
        });
    });