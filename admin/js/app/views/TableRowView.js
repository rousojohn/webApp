define(["App", "backbone", "marionette", "jquery", "hbs!templates/emptyListItem"],
    function (App, Backbone, Marionette, $, template) {
        return Backbone.Marionette.ItemView.extend({
            
            tagName: "tr",
            
            ui : {
                editBtn : "a.edit",
                deleteBtn : "a.delete"
            },
            
            events : {
                "click a.delete" : "deleteEntry",
                "click a.edit" : "editEntry"
            },
            
            template: template,

			initialize: function(){
                _.bindAll(this);
			},
            
            editEntry : function (evt) {
                evt.stopPropagation();
                evt.preventDefault();
                
                if ( $(evt.currentTarget).hasClass("editAddr") )
                    App.vent.trigger("editAddress",  $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("editPhone") )
                   App.vent.trigger("editPhone", $(evt.currentTarget).attr("data-id"));
            },
            
            deleteEntry : function (evt) {
                evt.stopPropagation();
                evt.preventDefault();
                
                if ( $(evt.currentTarget).hasClass("deleteAddr") )
                    App.vent.trigger("deleteAddress", $(evt.currentTarget).attr("data-id"));
                else if ( $(evt.currentTarget).hasClass("deletePhone") )
                    App.vent.trigger("deletePhone", $(evt.currentTarget).attr("data-id"));
            },
            
            onRender : function () {
                var view = this;
                
                this.ui.deleteBtn.tooltip({
                    animation: true,
                    placement: "right",
                    trigger: "hover"
                });
                
                
                this.ui.editBtn.tooltip({
                    animation: true,
                    placement: "left",
                    trigger: "hover"
                });
                
                
                if (this.model !== undefined){
                    if (this.model.get("primary_address") == 1)
                        this.$el.addClass("info");
                    
                    if (this.model.get("type") !== undefined && this.model.get("type") !== null ) {
                        switch(this.model.get("type")){
                                case 0:
                                    this.$el.find("#telTd").before('<td><span class="glyphicon glyphicon-home"></span></td>');
                                    break;
                                case 1:
                                    this.$el.find("#telTd").before('<td><span class="glyphicon glyphicon-briefcase"></span></td>');
                                    break;
                                case 2:
                                    this.$el.find("#telTd").before('<td><span class="glyphicon glyphicon-phone"></span></td>');
                                    break;
                        };
                    }
                }
		}
    });
});