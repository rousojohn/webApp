define(["App", "jquery", "backbone"],
           
       function(App, $, Backbone) {

        var PublicationModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/publications/" + App.user.id },
            
            defaults : {
                title : "",
                date : "",
                link : "",
                publisher : "",
                authors : "",
                description : "",
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.title == "" )
                    return 'titleException';
                else if (attrs.date == "" )
                    return 'dateException';
                
            }
        });

        return PublicationModel;

    }

);