define(["App", "jquery", "backbone"],
    function(App, $, Backbone) {

        var DegreeModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/degree/"},
            
            defaults : {
                name : ""
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                
                if (attrs.name == "" )
                    return 'nameException';
            }
        });

        return DegreeModel;

    }

);