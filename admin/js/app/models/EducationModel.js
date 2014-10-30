define(["App", "jquery", "backbone"],
        
    
        function(App, $, Backbone) {

        var EducationModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/education/" + App.user.id },
            
            defaults : {
                attended_from : "",
                attended_to : "",
                current_education : 0,
                fieldOfStudy : "",
                grade : "",
                description : "",
                degree_id : -1,
                school_id : -1,
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.attended_from == "" )
                    return 'AttendedFromException';
                else if (attrs.attended_to!="" && attrs.attended_from > attrs.attended_to)
                    return 'AttendedDurationException';
                else if (attrs.current_education < 0 || attrs.current_education > 1 )
                    return 'CurrentEducationException';
                else if (attrs.current_education == 0 && attrs.attended_from!= "" && attrs.attended_to== "")
                    return 'AttendedToException';
                else if (attrs.fieldOfStudy == "" )
                    return 'FieldOfStudyException';
                else if ( attrs.grade && attrs.grade != "" && isNaN(attrs.grade) )//!isFloat(attrs.grade) || !isInt(attrs.grade) )
                    return 'GradeException';
                else if (attrs.degree_id == -1 )
                    return 'degreeIdException';
                else if (attrs.school_id == -1 )
                    return 'schoolIdException';
                
            }
        });

        return EducationModel;

    }

);