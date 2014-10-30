define(["App", "jquery", "backbone"],
 
        function(App, $, Backbone) {

        var CertificationModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/certifications/" + App.user.id },
            
            defaults : {
                name : "",
                description : "",
                authority : "",
                link : "",
                date_from : "",
                date_to : "",
                does_not_expire : 0,
                lisenceno : "",
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.name == "" )
                    return 'nameException';
                else if (attrs.date_to!="" && attrs.date_from > attrs.date_to)
                    return 'DurationException';
                else if (attrs.does_not_expire < 0 || attrs.does_not_expire > 1 )
                    return 'DoesNotExpireException';
                else if (attrs.does_not_expire == 0 && attrs.date_from != "" && attrs.date_to == "")
                    return 'DateToException';

            }
        });

        return CertificationModel;

    }

);