define(["backbone", "marionette"], function(Backbone, Marionette) {
    "use strict";
    
    return Backbone.Marionette.AppRouter.extend({
        initialize: function () {
            this.routeHist = 0;
            Backbone.history.on('route', function () { this.routeHist ++;}, this);
        },
        
        back : function () {
            if (this.routeHist > 1 ){
                window.history.back();
            }
            else {
                this.navigate('/', {trigger:true, replace:true});
            }
        },
       appRoutes: {
       		"" : "login",
       		"#" : "login",
           "main" : "showMain",
           "news/:userId/:newsId" : "showNew",
           "profile/:userId" : "showProfile",
           "personal/:userId" : "showPersonal",
           "educationHistory/:userId" : "showEducationHistory",
           "activities/:userId" : "showActivities",
           "employment/:userId" : "showEmployment",
           "about/:userId" : "showAboutPage"
		}
   });
});