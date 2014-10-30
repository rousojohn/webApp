define(["App", "jquery", "backbone"],
 
       
        function(App, $, Backbone) {

        var ProjectModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/projects/" + App.user.id },
            
            defaults : {
                name : "",
                description : "",
                date_from : "",
                date_to : "",
                current_project : 0,
                team_members : "",
                link : "",
                company_id : -1,
                education_id : -1,
                user_id : -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.name == "" )
                    return 'nameException';
                else if (attrs.current_project < 0 || attrs.current_project > 1 )
                    return 'CurrentProjectException';
                else if (attrs.current_project == 0 && attrs.date_from!= "" && attrs.date_to== "")
                    return 'DateToException';
                else if (attrs.date_to!="" && attrs.date_from > attrs.date_to)
                    return 'ProjectDurationException';
                
            }
        });

        return ProjectModel;

    }

);