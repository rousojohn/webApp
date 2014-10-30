define(["App", "backbone", "marionette", "jquery", "hbs!templates/header", /*"views/ReportListView",*/ 'i18next'],
    function (App, Backbone, Marionette, $, template) {
       "use strict";
       
       return Backbone.Marionette.Layout.extend({
           
            template: template,
            
            regions: {
                statistics: "#statistics"
            },
           
            ui: {
                en: "#en",
                el: "#el",
                client: "#clientName",
                statisticsLink: "#statisticsLink",
                hidden : ".hidden",
                profileLnk : "a#profile"
            },
            
            events: {
                "click li.lang": "changeLang",
                "click a#logout": "logout"
            },
            
            initialize: function() {
                _.bindAll(this);
                
                this.model = App.user;
            },
            
            changeLang: function(e){
                var lang = $(e.currentTarget).data("value");
                localStorage.setItem("lng", lang);
                location.reload();
                e.preventDefault();
            },
           
           logout: function (e){
               localStorage.removeItem("user");
               this.model = undefined;
               App.user.id = -1;
               App.user.set("surname", "");
               App.user.set("name", "");
               this.initialize();
              // location.reload();
           },
           
           onRender: function(){
//                $(this.ui.client).text(sessionStorage.getItem("user") || "");
               
               
                var lang = localStorage.getItem("lng") || "en";
                switch(lang){
                    case "en":
                        $(this.ui.el).removeClass("glyphicon-ok");
                        $(this.ui.en).addClass("glyphicon-ok");
                        break;
                    case "el":
                        $(this.ui.en).removeClass("glyphicon-ok");
                        $(this.ui.el).addClass("glyphicon-ok");
                        break;
                }
               
               console.log(App.user);
                
                
                // show statistics link when the user logs in
                if(App.user && App.user.id != -1){
                    $(this.ui.hidden).removeClass("hidden");
                    $(this.ui.client).text(App.user.get("surname") + " " + App.user.get("name"));
                    this.ui.profileLnk.attr("href", "#profile/" + App.user.id);
                }
               else{
                   $(this.ui.hidden).addClass("hidden");
                    $(this.ui.client).text('');
                    this.ui.profileLnk.attr("href", "");
               }
            }
        });
    });