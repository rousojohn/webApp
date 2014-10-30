define(["App", "backbone", "marionette", "jquery", "hbs!templates/login", "models/AlertModel", "views/AlertView", "models/UserModel", 'i18next'],
    function (App, Backbone, Marionette, $, template, AlertModel, AlertView, UserModel) {
        "use strict";
        return Backbone.Marionette.ItemView.extend({
           
            template: template,

            ui: {
                username: "#username",
                password: "#password",
                loading: "#loading"       
            },
            
            events: {
                "submit" : "login"
            },
            
            initialize: function () {
                _.bindAll(this);
                
               localStorage.removeItem("user");
            },
            
            login: function () {
                var view = this;
                
                // show loading
                this.ui.loading.removeClass("hidden");
                this.ui.loading.addClass("icon-refresh-animate");
                
                var error = "";
                
                var jqxhr = $.post(App.server + "/login", {
                    un: this.ui.username.val(),
                    pw: this.ui.password.val(),
                    rl: "c"
                })
                .done(function(data){
                    var response = jQuery.parseJSON(data);
                    if ( response.success == false)
                        error = i18n.t(response.error);
                    else {
                        if (App.user === undefined) App.user = new UserModel();
                        App.user.set("name",response.name);
                        App.user.set("surname",response.surname);
                        App.user.set("id",response.id);
                        App.user.set("birthdate",response.birthdate);
                        App.user.set("IM",response.IM);
                        App.user.set("title",response.title);
                        App.user.set("email",response.email);
//                        App.user.set("time", new Date());
                        
                        localStorage.setItem("user", JSON.stringify(App.user));
                        App.vent.trigger("navigate", "main");
                    }
                })
                .fail(function(error){
                    error = error.status + " " + error.statusText;
                })
                .always(function(){
                    // check if there is any message to show
                    if(error != ""){
                        // hide loading
                        view.ui.loading.addClass("hidden");
                        view.ui.loading.removeClass("icon-refresh-animate");
                        App.handleError(error);
                    }
                });
                
                return false; 
            }
            
        });
    });