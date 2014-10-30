define(["backbone", "marionette", "jquery", "hbs!templates/emptyListItem"],
    function (Backbone, Marionette, $, template) {
        return Backbone.Marionette.ItemView.extend({
            
            tagName: "li",
            
            attributes: function (){
                return {
                    "class" : "list-group-item"
                };
            },
            
            template: template,
            
            initialize: function(){
                _.bindAll(this);
            }
            
        });
    });