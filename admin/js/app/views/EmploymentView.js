define(["App", "backbone", "marionette", "jquery", "hbs!templates/employment", 'models/CompanyModel', 'models/CourseModel',
        'collections/SchoolsCollection', 'collections/CompanyCollection', 'collections/EducationCollection', 'models/ProjectModel',
       'models/WorkingExperienceModel'],
    function (App, Backbone, Marionette, $, template, CompanyModel, CourseModel, SchoolsCollection, CompanyCollection, EducationCollection,
              ProjectModel, WorkingExperienceModel) {
        return Backbone.Marionette.Layout.extend({
            
            template: template,
            
            ui : {
                
                // UI Elements for Companies
                addCompany : "button#addCompany",
                companyModal : "div#companyModal",
                companyCollapse : "div#collapseOne",
                compName : "#compName",
                compAddress : "#compAddress",
                compPhone : "#compPhone",
                compLink : "#compLink",
                
                // UI Elements for Courses
                coursesModal : "div#coursesModal",
                addCourse : "button#addCourse",
                courseCollapse : "div#collapseTwo",
                courseTitle : "#courseTitle",
                courseReview : "#courseReview",
                courseCode : "#courseCode",
                coursesTeachers : "#courseTeachers",
                courseCurrent : "#courseCurrent",
                courseFrom : "#courseFrom",
                courseTo : "#courseTo",
                courseSchoollSel : "#courseSchoollSel",
                
                // UI Elements for Projects
                addPrj : "button#addPrj",
                projectModal : "div#projectModal",
                prjName : "#prjName",
                prDesc : "#prDesc",
                prjFrom : "#prjFrom",
                prjTo : "#prjTo",
                prjCurrent : "#prjCurrent",
                prjMembers : "#prjMembers",
                prjLink : "#prjLink",
                prjCompSel : "#prjCompSel",
                prjEduSel : "#prjEduSel",
                prjCollapse : "div#collapseThree",
                
                // UI Elements for Working_experience
                workModal : "div#workModal",
                addWork : "button#addWork",
                workCompSel : "#workCompSel",
                workTitle : "#workTitle",
                workFrom  : "#workFrom",
                workTo  : "#workTo",
                workCurrent : "#workCurrent",
                wordDesc : "#workDesc",
                workCompSel : "#workCompSel",
                workCollapse : "#collapseFour"
            },
            
            regions : {
                companiesRegion : "div#companiesRegion",
                coursesRegion : "div#coursesRegion",
                projectsRegion : "div#projectsRegion",
                worksRegion : "div#worksRegion"
            },
            
            events : {
                // events for handling companies
                "click button#addCompany" : "showCompanyForm",
                "click a#compSave" : "saveCompany",
                "hide.bs.modal #companyModal" : "clear",
                
                // events for handling courses
                "click button#addCourse" : "showCourseForm",
                "click a#courseSave" : "saveCourse",
                "hide.bs.modal #coursesModal" : "clear",
                "show.bs.modal #coursesModal" : "beforeCourseFormOpen",
                
                // events for handling Projects
                "click button#addPrj" : "showProjectForm",
                "hide.bs.modal #projectModal" : "clear",
                "show.bs.modal #projectModal" : "beforeProjectFormOpen",
                "click a#prjSave" : "saveProject",
                
                // events for handling Working_experience
                "click button#addWork" : "showWorkForm",
                "hide.bs.modal #workModal" : "clear",
                "show.bs.modal #workModal" : "beforeWorkFormOpen",
                "click a#workSave" : "saveWork",
                
                
            },
            
            clear : function (){
                this.model = undefined;
                this.render();
            },
            
            beforeCourseFormOpen : function () {
                var view = this;
                
                var schools = new SchoolsCollection();
                
                // fetch levels for the dropdown option and select the proper one if it's about editing a model
                schools.fetch({success : function (data) {
                    var html = "<option value='-1'></option>";
                    data.each(function(_model){
                        html += "<option value='" + _model.id + "'";
                        if (view.model !== undefined && view.model.get("school_id") == _model.id)
                            html += " selected='selected'" ;
                        html += ">"+_model.get("name")+"</option>";
                    });
                    view.ui.courseSchoollSel.html(html);
                }});
            },
            
            
            beforeProjectFormOpen : function () {
                var view = this;
                var companies = new CompanyCollection();
                var education = new EducationCollection();
                
                // fetch companies for the dropdown option and select the proper one if it's about editing a model
                companies.fetch({success: function (data) {
                   var html = "<option value='-1'></option>";
                    data.each(function (_model) {
                        html += "<option value='" + _model.id + "'";
                        if ( view.model !== undefined && view.model.get("company_id") == _model.id )
                            html += " selected='selected'" ;
                        html += ">" + _model.get("name") + "</option>";
                    });
                    view.ui.prjCompSel.html(html);
                }});
                
                education.fetch({success : function (data) {
                    var html = "<option value='-1'></option>";
                    data.each(function (_model) {
                        html += "<option value='" + _model.id + "'";
                        if ( view.model !== undefined && view.model.get("education_id") == _model.id )
                            html += " selected='selected'";
                        html += ">" + _model.get("schoolName") + "</option>";
                    });
                    view.ui.prjEduSel.html(html);
                }});                
            },
            
            beforeWorkFormOpen : function () {
                var view = this;
                var companies = new CompanyCollection();
                
                companies.fetch({success : function (data) {
                    var html = "<option value='-1'></option>";
                    data.each(function (_model) {
                        html += "<option value='" + _model.id + "'";
                        if (view.model !== undefined && view.model.get("company_id") == _model.id)
                            html += " selected='selected'";
                        html += ">" + _model.get("name") + "</option>";
                    });
                    view.ui.workCompSel.html(html);
                }});
            },
            
            
            showCompanyForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.companyModal.modal('show');
            },
            
            showCourseForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.coursesModal.modal('show');
            },
            
            showProjectForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.projectModal.modal('show');
            },
            
            showWorkForm : function (evt) {
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                this.ui.workModal.modal('show');
            },
            
            saveCompany : function (evt) {
                var view = this;
                if ( evt ) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                if ( this.model instanceof CompanyModel == false )
                    this.model = new CompanyModel({
                        user_id : App.user.id
                    });
                
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                
                this.model.set("name", this.ui.compName.val());
                this.model.set("address", this.ui.compAddress.val());
                this.model.set("phone", this.ui.compPhone.val());
                this.model.set("link", this.ui.compLink.val());
                
                this.model.save({},{success: function (_data) {
                    view.model = undefined;
                    view.ui.companyModal.modal('hide');
                    view.ui.companyCollapse.collapse('show');
                    view.options.companiesRegion.trigger("refresh");
                }});
            },
            
            saveCourse : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                
                if ( this.model instanceof CourseModel == false )
                    this.model = new CourseModel({
                        user_id : App.user.id
                    });
                
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    console.log(error);
                    _model.off("invalid");
                });
                
                this.model.set("title", this.ui.courseTitle.val());
                this.model.set("review", this.ui.courseReview.val());
                this.model.set("code", this.ui.courseCode.val());
                this.model.set("co_teachers", this.ui.coursesTeachers.val());
                this.model.set("courses_current", this.ui.courseCurrent.is(":checked") ? 1 : 0 );
                this.model.set("courses_from", this.ui.courseFrom.val());
                this.model.set("courses_to", this.ui.courseTo.val());
                this.model.set("school_id", this.ui.courseSchoollSel.val());
                
                this.model.save({}, {success : function (_data) {
                    view.model = undefined;
                    view.ui.coursesModal.modal('hide');
                    view.ui.courseCollapse.collapse('show');
                    view.options.coursesRegion.trigger('refresh');
                }});
            },
            
            
            saveProject : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                
                if ( this.model instanceof ProjectModel == false )
                    this.model = new ProjectModel({
                        user_id : App.user.id
                    });
                
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    console.log(error);
                    _model.off("invalid");
                });
                
                this.model.set("name", this.ui.prjName.val());
                this.model.set("description", this.ui.prDesc.val());
                this.model.set("date_from", this.ui.prjFrom.val());
                this.model.set("date_to", this.ui.prjTo.val());
                this.model.set("current_project", this.ui.prjCurrent.is(":checked") ? 1 : 0);
                this.model.set("team_members", this.ui.prjMembers.val());
                this.model.set("link", this.ui.prjLink.val());
                this.model.set("company_id", this.ui.prjCompSel.val());
                this.model.set("education_id", this.ui.prjEduSel.val());
                
                this.model.save({}, {success : function (_data) {
                    view.model = undefined;
                    view.ui.projectModal.modal('hide');
                    view.ui.prjCollapse.collapse('show');
                    view.options.projectsRegion.trigger('refresh');
                }});
            },
            
            saveWork : function (evt) {
                var view = this;
                if (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                }
                
                if (this.model instanceof WorkingExperienceModel == false )
                    this.model = new WorkingExperienceModel({
                        user_id : App.user.id
                    });
                this.model.on("invalid", function (_model, error) {
                    App.handleError(error);
                    _model.off("invalid");
                });
                
                this.model.set("title", this.ui.workTitle.val());
                this.model.set("timeperiod_from", this.ui.workFrom.val());
                this.model.set("timeperiod_to", this.ui.workTo.val());
                this.model.set("current_job", this.ui.workCurrent.is(":checked") ? 1 : 0);
                this.model.set("description", this.ui.wordDesc.val());
                this.model.set("company_id", this.ui.workCompSel.val());
                this.model.save({}, {success: function (_data) {
                    view.model = undefined;
                    view.ui.workModal.modal('hide');
                    view.ui.workCollapse.collapse('show');
                    view.options.worksRegion.trigger('refresh');
                }});
            },
            
            
            initialize : function () {
                _.bindAll(this);
                var view = this;
                
                // Bind the view on Edit Events from its children
                App.vent.on("editSchool", function (cmpId) {
                    view.model = view.options.companiesRegion.collection.find( function (_model) { return _model.id == cmpId; });
                    view.render();
                    view.showCompanyForm();
                });
                
                App.vent.on("editCourse", function (courseId) {
                    view.model = view.options.coursesRegion.collection.find( function (_model) { return _model.id == courseId; });
                    view.render();
                    view.showCourseForm();
                });
                
                App.vent.on("editPrj", function (prjId) {
                    view.model = view.options.projectsRegion.collection.find( function (_model) { return _model.id == prjId; });
                    view.render();
                    view.showProjectForm();
                });
                
                App.vent.on("editWork", function (workId) {
                    view.model = view.options.worksRegion.collection.find( function (_model) { return _model.id == workId; });
                    view.render();
                    view.showWorkForm();
                });
                
                
                // Bind the view on Delete Events from its children
                
                App.vent.on("deleteSchool", function (cmpId) {
                    var deleteModel = view.options.companiesRegion.collection.find( function (_model) { return _model.id == cmpId; });
                    deleteModel.destroy({
                        success: function (data){
                            view.options.companiesRegion.trigger("refresh");
                        }
                    });
                });
                
                App.vent.on("deleteCourse", function (courseId) {
                    var deleteModel = view.options.coursesRegion.collection.find( function (_model) { return _model.id == courseId; });
                     deleteModel.destroy({
                        success: function (data){
                            view.options.coursesRegion.trigger('refresh');
                        }
                    });
                });
                
                App.vent.on("deletePrj", function (prjId) {
                    var deleteModel = view.options.projectsRegion.collection.find( function (_model) { return _model.id == prjId; });
                    deleteModel.destroy({
                        success: function (data){
                            view.options.projectsRegion.trigger('refresh');
                        }
                    });
                });
                
                App.vent.on("deleteWork", function (workId) {
                    var deleteModel = view.options.worksRegion.collection.find( function (_model) {return _model.id == workId; });
                    deleteModel.destroy({
                        success: function (data) {
                            view.options.worksRegion.trigger('refresh');
                        }
                    });
                });
                
                //this.render();
            },
            
            onRender: function (){
                var view = this;
                 // Initialize Tooltips for the 'Add' Buttons
                this.ui.addCompany.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addCourse.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addPrj.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.addWork.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                
                
                
                
                // Initialize modals
                this.ui.companyModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });                
                
                this.ui.coursesModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });              
                
                this.ui.projectModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });              
                
                this.ui.workModal.modal({
                    backdrop : true,
                    keyboard : true,
                    show : false
                });
                
                
                
                
                
                
                
                // Show the regions
                if (this.options.companiesRegion !== undefined)
                    this.companiesRegion.show(this.options.companiesRegion);
//                
                if (this.options.coursesRegion !== undefined)
                    this.coursesRegion.show(this.options.coursesRegion);
//                
                if (this.options.projectsRegion !== undefined)
                    this.projectsRegion.show(this.options.projectsRegion);
                
                if (this.options.worksRegion !== undefined )
                    this.worksRegion.show(this.options.worksRegion);
                
            }
        });
    });