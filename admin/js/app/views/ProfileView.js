define(["App", "backbone", "marionette", "jquery", "hbs!templates/profile", "Models/UserModel"],
    function (App, Backbone, Marionette, $, template, UserModel) {
        return Backbone.Marionette.ItemView.extend({
            
            template: template,
            
            ui : {
                password1 : "#password1",
                password2 : "#password2",
                _8char : "#8char",
                ucase : "#ucase",
                lcase : "#lcase",
                num : "#num",
                pwmatch : "#pwmatch",
                usernamesame : "#usernamesame",
                username : "#username"
            },
            
            events : {
                "keyup input[type=password]" : "inputChanged"
            },
            
            inputChanged : function (e){
                var ucase = new RegExp("[A-Z]+");
                var lcase = new RegExp("[a-z]+");
                var num = new RegExp("[0-9]+");
                
                
                // Password must be at least 8 chars length
                if (this.ui.password1.val().length >= 8){
                    this.ui._8char.removeClass("glyphicon-remove");
                    this.ui._8char.addClass("glyphicon-ok");
                    this.ui._8char.css("color","#00A41E");
                }
                else {
                    this.ui._8char.removeClass("glyphicon-ok");
                    this.ui._8char.addClass("glyphicon-remove");
                    this.ui._8char.css("color", "#FF0004");
                }
                
                
                
                // Password must have at least 1 Uppercase char
                if ( ucase.test(this.ui.password1.val()) ){
                    this.ui.ucase.removeClass("glyphicon-remove");
                    this.ui.ucase.addClass("glyphicon-ok");
                    this.ui.ucase.css("color","#00A41E");
                }
                else {
                    this.ui.ucase.removeClass("glyphicon-ok");
                    this.ui.ucase.addClass("glyphicon-remove");
                    this.ui.ucase.css("color", "#FF0004");
                }
                
                
                // Password must have at least 1 Lowercase char                
                if ( lcase.test(this.ui.password1.val()) ){
                    this.ui.lcase.removeClass("glyphicon-remove");
                    this.ui.lcase.addClass("glyphicon-ok");
                    this.ui.lcase.css("color","#00A41E");
                }
                else {
                    this.ui.lcase.removeClass("glyphicon-ok");
                    this.ui.lcase.addClass("glyphicon-remove");
                    this.ui.lcase.css("color", "#FF0004");
                }
                
                
                // Password must have at least 1 number 
                if ( num.test(this.ui.password1.val()) ){
                    this.ui.num.removeClass("glyphicon-remove");
                    this.ui.num.addClass("glyphicon-ok");
                    this.ui.num.css("color","#00A41E");
                }
                else {
                    this.ui.num.removeClass("glyphicon-ok");
                    this.ui.num.addClass("glyphicon-remove");
                    this.ui.num.css("color", "#FF0004");
                }
                
                
                // Password must not be the same as the username                
                if ( this.ui.password1.val() != this.ui.username.val() ) {
                    this.ui.usernamesame.removeClass("glyphicon-remove");
                    this.ui.usernamesame.addClass("glyphicon-ok");
                    this.ui.usernamesame.css("color","#00A41E");
                }else{
                    this.ui.usernamesame.removeClass("glyphicon-ok");
                    this.ui.usernamesame.addClass("glyphicon-remove");
                    this.ui.usernamesame.css("color","#FF0004");
                }
                
                
                // Repeat Password must be the same as Password
                if( this.ui.password1.val() == this.ui.password2.val() ){
                    this.ui.pwmatch.removeClass("glyphicon-remove");
                    this.ui.pwmatch.addClass("glyphicon-ok");
                    this.ui.pwmatch.css("color","#00A41E");
                }else{
                    this.ui.pwmatch.removeClass("glyphicon-ok");
                    this.ui.pwmatch.addClass("glyphicon-remove");
                    this.ui.pwmatch.css("color","#FF0004");
                }
            },
            
            initialize : function () {
                var view =this;
                
                _.bindAll(this);
                this.model = new UserModel({
                    id : App.user.id
                });
                
                this.model.fetch({success : function (data) {
                    view.render();
                }});
                    
            }
        });
    });