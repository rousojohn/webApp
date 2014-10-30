define(["App", "jquery", "backbone"],
    function(App, $, Backbone) {

        var EmailModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/emails/" + App.user.id },
            
            defaults : {
                email : "",
                primary_mail : 0,
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.email == "" )
                    return 'emailException';
                else if (attrs.primary_mail < 0 || attrs.primary_mail > 1 )
                    return 'PrimaryMailException';
                //check if email address is valid
                else if ( !attrs.email.match(/(\w+)@(.+)\.(\w+)$/) )  
		              return 'email_valid_Exception';  
            }
        });

        return EmailModel;

    }

);