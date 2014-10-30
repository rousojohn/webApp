define(["App", "jquery", "backbone"],
    function(App, $, Backbone) {

        var LevelModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/levels/" },
            
            defaults : {
                name : ""
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.name == "" )
                    return 'nameException';
            }
        });

        return LevelModel;

    }

);