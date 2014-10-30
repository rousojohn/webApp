define(["App", "jquery", "backbone"],
    function(App, $, Backbone) {

        var PhoneModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/phones/" + App.user.id },
            
            defaults : {
                phone : "",
                primary_phone : 0,
                type : -1,
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.type == -1 )
                    return 'phoneTypeException';
                else if (attrs.primary_phone < 0 || attrs.primary_phone > 1)
                    return 'phonePrimaryException';
                else if (attrs.phone == "" || isNaN(attrs.phone) )
                    return 'phoneNaNException';
            }
        });

        return PhoneModel;

    }

);