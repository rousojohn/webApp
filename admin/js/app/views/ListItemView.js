define(["App","backbone", "marionette", "jquery", "hbs!templates/listItem"],
    function (App, Backbone, Marionette, $, template) {
        "use strict";
        
        return Backbone.Marionette.ItemView.extend({
            
            tagName: "li",
            
            attributes: function (){
                return {
                    "class" : "list-group-item"
                };
            },
                
            
            template: template,
            
            ui: {
                // common UI Elements
                link : "#link",
                delete: "a.delete",
                edit: "a.edit",
                
                popOverList : ".aPopover",
                
                // Individual UI Elements
                dateTospan : "span.dateTo",
                presentSpan : "span.present"
            },
            
            events: {
                "click a.delete" : "deleteItem",
                "click a.edit" : "editItem"
            },
                        
            initialize: function(){
                _.bindAll(this);
                
                
            },
            
            deleteItem: function (evt) {
                evt.stopPropagation();
                evt.preventDefault();
                if ( $(evt.currentTarget).hasClass("schools") )
                    App.vent.trigger("deleteSchool", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("langs") )
                    App.vent.trigger("deleteLang", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("certs") )
                    App.vent.trigger("deleteCert", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("edu") )
                    App.vent.trigger("deleteEdu", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("publication") )
                    App.vent.trigger("deletePublication", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("honor") )
                    App.vent.trigger("deleteHonor", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("interest") )
                    App.vent.trigger("deleteInterest", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("orgs") )
                    App.vent.trigger("deleteOrganization", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("courses") )
                    App.vent.trigger("deleteCourse", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("project") )
                    App.vent.trigger("deletePrj", $(evt.currentTarget).attr("data-id"));       
                else if ( $(evt.currentTarget).hasClass("work") )
                    App.vent.trigger("deleteWork", $(evt.currentTarget).attr("data-id"));       
                else if ( $(evt.currentTarget).hasClass("office") )
                    App.vent.trigger("deleteOffice", $(evt.currentTarget).attr("data-id"));        
                else if ( $(evt.currentTarget).hasClass("addr") )
                    App.vent.trigger("deleteAddr", $(evt.currentTarget).attr("data-id"));           
                else if ( $(evt.currentTarget).hasClass("tel") )
                    App.vent.trigger("deleteTel", $(evt.currentTarget).attr("data-id"));            
                else if ( $(evt.currentTarget).hasClass("email") )
                    App.vent.trigger("deleteEmail", $(evt.currentTarget).attr("data-id"));               
                else
                    this.model.destroy();
                
            },
            
            editItem : function (evt) {
                evt.stopPropagation();
                evt.preventDefault();
                
                if ( $(evt.currentTarget).hasClass("schools") )
                    App.vent.trigger("editSchool", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("langs") )
                    App.vent.trigger("editLang", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("certs") )
                    App.vent.trigger("editCert", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("edu") )
                    App.vent.trigger("editEducation", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("publication") )
                    App.vent.trigger("editPublication", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("honor") )
                    App.vent.trigger("editHonor", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("interest") )
                    App.vent.trigger("editInterest", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("orgs") )
                    App.vent.trigger("editOrganization", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("courses") )
                    App.vent.trigger("editCourse", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("project") )
                    App.vent.trigger("editPrj", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("work") )
                    App.vent.trigger("editWork", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("office") )
                    App.vent.trigger("editOffice", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("addr") )
                    App.vent.trigger("editAddr", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("tel") )
                    App.vent.trigger("editTel", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("email") )
                    App.vent.trigger("editEmail", $(evt.currentTarget).attr("data-id"));
            },
            
            onRender: function(){
                this.ui.delete.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                this.ui.edit.tooltip({
                    animation: true,
                    placement: "left",
                    trigger: "hover"
                });
                
                this.ui.popOverList.popover({
                    animation: true,
                    container: "body",
                    placement: "top",
                    template : '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content" style="word-wrap: break-word;">{{description}}</div></div>',
                    trigger: "hover"
                });
                
                if(this.model.id){
                    var hrefLink = "#" + this.options.editPage + "/" + this.model.id ;
                    this.ui.link.attr("href",  hrefLink);
                    
                    if (this.model.get("does_not_expire") == 0 && this.model.get("date_to")) {
                        this.ui.dateTospan.removeClass("hidden");
                        this.ui.presentSpan.addClass("hidden");
                    }
                    
                    if (this.model.get("current_education") == 0 && this.model.get("date_to")) {
                        this.ui.dateTospan.removeClass("hidden");
                        this.ui.presentSpan.addClass("hidden");
                    }
                    
                    if (this.model.get("current_position") == 0 && this.model.get("date_to")) {
                        this.ui.dateTospan.removeClass("hidden");
                        this.ui.presentSpan.addClass("hidden");
                    }
                    
                    if (this.model.get("current_project") == 0 && this.model.get("date_to")) {
                        this.ui.dateTospan.removeClass("hidden");
                        this.ui.presentSpan.addClass("hidden");
                    }
                    
                    if (this.model.get("current_job") == 0 && this.model.get("timeperiod_to")) {
                        this.ui.dateTospan.removeClass("hidden");
                        this.ui.presentSpan.addClass("hidden");
                    }
                }
                else
                    this.$el.hide();
            }
        });
    });