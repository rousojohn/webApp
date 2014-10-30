define(["App", "jquery", "backbone"],
 
       
        function(App, $, Backbone) {

        var OrganizationModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/organizations/" + App.user.id },
            
            defaults : {
                name : "",
                position : "",
                date_from : "",
                date_to : "",
                current_position : 0,
                description : "",
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.name == "" )
                    return 'nameException';
                else if (attrs.current_position < 0 || attrs.current_position > 1)
                    return 'CurrentPositionException';
                else if (attrs.current_position == 0 && attrs.date_from!= "" && attrs.date_to== "")
                    return 'DateToException';
                else if (attrs.date_to!="" && attrs.date_from > attrs.date_to)
                    return 'DurationException';

            }
        });

        return OrganizationModel;

    }

);