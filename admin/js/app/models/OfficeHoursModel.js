define(["App", "jquery", "backbone"],
    function(App, $, Backbone) {

        var OfficeHoursModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/office_hours/" + App.user.id },
            
            defaults : {
                office : "",
                day : "",
                hour_from : "",
                hour_to : "",
                user_id: -1
            },
            
            idAttribute : "id",
            
            regex: /^(2[0-3])|[01][0-9]:[0-5][0-9]$/,
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.office == "" )
                    return 'officeException';
                else if (attrs.day == -1 || attrs.day > 5)
                    return 'dayException';
                else if (attrs.day == "" || isNaN(attrs.day) )
                    return 'dayNaNException';
                else if (attrs.hour_from == "")
                    return 'HourFromException';
                else if (!this.regex.test(attrs.hour_from))
                    return 'HourFromTypeException';
                else if (attrs.hour_to == "")
                    return 'HourToException';
                else if (!this.regex.test(attrs.hour_to))
                    return 'HourToTypeException';
            }
        });

        return OfficeHoursModel;

    }
       
);