define(["jquery", "backbone", "marionette", "underscore", "handlebars", "models/UserModel", "models/AlertModel", "views/AlertView", "i18next"],
    function ($, Backbone, Marionette, _, Handlebars, UserModel, AlertModel, AlertView) {
        
        "use strict";
        
       
        
        var App = new Backbone.Marionette.Application();
                        
        App.addRegions({
            headerRegion: "#header",
            mainRegion : "#main",
            alertRegion : "#alert"
        });
        
        App.addInitializer(function () {
            App.month = new Array(12);
            App.month[0] = "Jan";
            App.month[1] = "Feb";
            App.month[2] = "Mar";
            App.month[3] = "Apr";
            App.month[4] = "May";
            App.month[5] = "Jun";
            App.month[6] = "Jul";
            App.month[7] = "Aug";
            App.month[8] = "Sep";
            App.month[9] = "Oct";
            App.month[10] = "Nov";
            App.month[11] = "Dec";
            
             App.week = new Array(7);
            
            i18n.init({ fallbackLng: false , useLocalStorage: false, resGetPath: 'i18n/__lng__/__ns__.json' });
            
            var lang = localStorage.getItem("lng") || "en";
            i18n.setLng(lang, function(){
                Backbone.history.start();
                 App.week[0] = i18n.t("sunday");
                App.week[1] = i18n.t("monday");
                App.week[2] = i18n.t("tuesday");
                App.week[3] = i18n.t("wednesday");
                App.week[4] = i18n.t("thursday");
                App.week[5] = i18n.t("friday");
                App.week[6] = i18n.t("saturday");
            });
            
            
           
           
           // }, 100);
            
            var userObj = JSON.parse(localStorage.getItem("user"));
            
            if (userObj)
                setTimeout(function (){
                     localStorage.removeItem("user");
                    App.user = undefined;
                    App.vent.trigger("navigate","#");
                }, 1000*60*60*1); /* 1000 milisecs * 60 sec * 60 min * 1 hour*/
        
            App.user = (userObj)? new UserModel({
                name: userObj.name || "",
                surname : userObj.surname || "",
                id: userObj.id || -1,
                birthdate: userObj.birthdate || "",
                IM: userObj.birthdate || "",
                title: userObj.title || "",
                email: userObj.email || ""

            }) : new UserModel({id:-1});
        });
        
        function navigate(url) {
            // set main view as the startup view
            if(url == "main"){
                App.appRouter.navigate(url, { replace: true });
            }
            else{
                App.appRouter.navigate(url, { trigger: true });
            }
        }
        
        App.vent.on("navigate", function(e) {
            navigate(e);
            
            // cause the page to refresh for main view
            if(e == "main"){
                location.reload();
            }
        });
    
        App.handleError = function (error) {
            var alertModel = new AlertModel({
                type: "danger",
                message: error
            });
            this.alertRegion.show(new AlertView({
                model: alertModel
            }));
        };
    
        App.dayOfWeek = function (_day) {
            return App.week[--_day];
        };
        
        return App;
    });