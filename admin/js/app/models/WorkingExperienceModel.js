define(["App", "jquery", "backbone"],
 
       
        function(App, $, Backbone) {

        var WorkingExperienceModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/workingexperience/" + App.user.id },
            
            defaults : {
                title : "",
                timeperiod_from : "",
                timeperiod_to : "",
                current_job : 0,
                description : "",
                company_id : -1,
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.company_id == -1)
                    return 'companyIdException';
                else if (attrs.title == "" )
                    return 'titleException';
                else if (attrs.current_job < 0 || attrs.current_job > 1 )
                    return 'CurrentJobException';
                else if (attrs.current_job == 0 && attrs.timeperiod_from!= "" && attrs.timeperiod_to== "")
                    return 'DateToException';
                else if (attrs.timeperiod_from == "")
                    return 'TimePeriodFromException';
                else if (attrs.timeperiod_to!="" && attrs.timeperiod_from > attrs.timeperiod_to)
                    return 'WorkDurationException';
                                
            }
        });

        return WorkingExperienceModel;

    }

);