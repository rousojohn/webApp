define(["App", "jquery", "backbone"],
    
       
        function(App, $, Backbone) {

        var HonorsModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/honors/" + App.user.id },
            
            defaults : {
                date : "",
                description : "",
                issuer : "",
                link : "",
                title : "",
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.title == "" )
                    return 'titleException';
              
            }
        });

        return HonorsModel;

    }

);