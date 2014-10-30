define(["jquery", "backbone"],
    function($, Backbone) {

        var AlertModel = Backbone.Model.extend({

            defaults: {
                type: "", 
                message: ""
            }

        });

        return AlertModel;

    }

);