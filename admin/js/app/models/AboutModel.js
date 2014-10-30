define(["App", "jquery", "backbone"], function(App, $, Backbone) {
    var AboutModel = Backbone.Model.extend({
        urlRoot : function () { return App.server + "/about/" + App.user.id },
        defaults : {
            about : "",
            photo : "",
            user_id: -1
        },
        idAttribute : "id",
        validate: function (attrs) {
            if (attrs.user_id == -1)
                return 'userIdException';
        }
    });
    return AboutModel;
});