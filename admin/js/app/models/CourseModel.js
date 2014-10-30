define(["App", "jquery", "backbone"],
       
             
        function(App, $, Backbone) {

        var CourseModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/courses/" + App.user.id },
            
            defaults : {
                code : "",
                title : "",
                review : "",
                link : "",
                courses_from : "",
                courses_to : "",
                courses_current : "",
                co_teachers : "",
                user_id: -1,
                school_id: -1
            },
            
            idAttribute : "id",
                      
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.title == "" )
                    return 'titleException';
                else if (attrs.review == "" )
                    return 'reviewException';
                else if (attrs.courses_from == "" )
                    return 'CoursesFromException';
                else if (attrs.courses_to!="" && attrs.courses_from > attrs.courses_to)
                    return 'CoursesDurationException';
                else if (attrs.courses_current < 0 || attrs.courses_current > 1 )
                    return 'CoursesCurrentException';
                else if (attrs.courses_current == 0 && attrs.courses_from!= "" && attrs.courses_to== "")
                    return 'DateToException';
                else if (attrs.school_id == -1)
                    return 'schoolIdException';
            }
        });

        return CourseModel;

    }

);