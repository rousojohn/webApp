define(["backbone", "marionette", "jquery", "hbs!templates/alert"],
    function (Backbone, Marionette, $, template) {
        return Backbone.Marionette.ItemView.extend({
            
            template: template
            
        });
    });