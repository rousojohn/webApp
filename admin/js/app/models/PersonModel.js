define(["App", "jquery", "backbone"],
          
       
        function(App, $, Backbone) {

        var PersonModel = Backbone.Model.extend({
            urlRoot : function(){ return App.server + "/personalData/" + this.get("user_id")},
            
            defaults : {
                name: "",
                surname : "",
                birthdate: "",
                IM: "",
                title: "",
                email: "",
                user_id: -1
            },
            
            idAttribute : "id",
            
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.name == "" )
                    return 'nameException';
                else if (attrs.surname == "" )
                    return 'surnameException';
            }
        });

        return PersonModel;

    }

);