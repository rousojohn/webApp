define(["App", "jquery", "backbone"],
    function(App, $, Backbone) {

        var InterestsModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/interests/" + App.user.id },
            
            defaults : {
                description : "",
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.description == "" )
                    return 'descriptionException';
            }
        });

        return InterestsModel;

    }

);