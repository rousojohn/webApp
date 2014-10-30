define(["App", "jquery", "backbone"],
    function(App, $, Backbone) {

        var AddressModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/addresses/" + App.user.id },
            
            defaults : {
                street: "",
                primary_address: 0,
                no: 0,
                city: "",
                postal_code: "",
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.street == "" )
                    return 'streetException';
                else if (attrs.primary_address < 0 || attrs.primary_address > 1 )
                    return 'PrimaryAddressException';
                else if (attrs.city == "" )
                    return 'cityException';
                else if (attrs.postal_code != "" && isNaN(attrs.postal_code) )
                    return 'PostalCodeException';
                
            } 
        });

        return AddressModel;

    }

);