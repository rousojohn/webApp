define(["App","jquery", "backbone"],
    function(App, $, Backbone) {

        var UserModel = Backbone.Model.extend({
            urlRoot : function () { return App.server + "/user/"},
            
            defaults : {
                name: "",
                surname : "",
                id: -1,
                birthdate: "",
                IM: "",
                title: "",
                email: ""
            },
            
            idAttribute : "id",
            
             validate: function (attrs) {
                if (attrs.name == "" )
                    return 'nameException';
                else if (attrs.surname == "" )
                    return 'surnameException';
                //check if email address is valid
                else if ( !email.match(/(\w+)@(.+)\.(\w+)$/) )  
		              return 'email_valid_Exception';  
                /*
                else if (attrs.birthdate > currentDate)
                    return 'BirthdateException';
                */
            }
            
        });

        return UserModel;

    }

);