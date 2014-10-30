define(["App", "jquery", "backbone"],
    function(App, $, Backbone) {

        var SchoolModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/schools/" + App.user.id },
            
            defaults : {
                name : "",
                address : "",
                phone : "",
                link : "",
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.name == "" )
                    return 'nameException';
                else if (attrs.phone != "" && isNaN(attrs.phone) )
                    return 'phoneException';
            }
        });

        return SchoolModel;

    }

);