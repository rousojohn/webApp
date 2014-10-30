define(["App", "jquery", "backbone"],
    function(App, $, Backbone) {

        var NewsModel = Backbone.Model.extend({
             urlRoot : function () { return App.server + "/news/" + App.user.id },
            
            defaults : {
                date: new Date(),
                day: new Date().getDay() + 1,
                month: new Date().getMonth() + 1,
                year: new Date().getFullYear(),
                file: "",
                title: "",
                description: "",
                user_id: -1
            },
            
            idAttribute : "id",
            
            validate: function (attrs) {
                if (attrs.user_id == -1)
                    return 'userIdException';
                else if (attrs.title == "" )
                    return 'titleException';
                else if (attrs.date == "" )
                    return 'dateException';

            }
            
        });

        return NewsModel;

    }

);