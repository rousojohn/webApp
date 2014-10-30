define(["App", "jquery", "backbone"],
    function(App, $, Backbone) {

        var LanguageModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/languages/" + App.user.id },
            
            defaults : {
                name : "",
                level_id: -1,
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.name == "" )
                    return 'nameException';
                else if (attrs.level_id == -1)
                    return 'levelIdException';

            }
        });

        return LanguageModel;

    }

);