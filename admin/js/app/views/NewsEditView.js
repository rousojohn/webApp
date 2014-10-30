define(["App", "backbone", "marionette", "jquery", "hbs!templates/news", "models/NewsModel"],
    function (App,Backbone, Marionette, $, template, NewsModel) {
        "use strict";
        
        return Backbone.Marionette.ItemView.extend({
           
            template: template,
            
            ui:{
                cancelBtn : "#cancelBtn"
            },
            
            events: {
                "click button#cancelBtn" : "goBack",
                "click button#saveBtn" : "saveNews",
                "change .modelCols" : "modelChanged",
                "change input#imgLink" : "prepareUpload"
            },
            
            prepareUpload: function (e) {
                this.files = e.target.files;
            },
            
            
            
            goBack: function (e){
                if (e) {
                    e.stopPropagation();
                    e.preventDefault();
                }
                App.appRouter.back();
            },
            
            saveNews: function (e) {
                var view = this;
                e.stopPropagation();
                e.preventDefault();
                
                var data = new FormData();
                if (this.files && this.files.length > 0) {
                    $.each(this.files, function (key, value){
                        data.append(key, value);
                    });
                
                   $.ajax({
                       url: App.server + "/uploadFile/" + App.user.id,
                       type: "POST",
                       data: data,
                       cache: false,
                       dataType: 'json',
                       processData: false,
                       contentType: false,
                       success: function (_data,textStatus, jqXHR){
                           if (_data.error) {
                               App.handleError(_data.error[0]);
                               return false;
                           }
                           else {
                               view.model.set("file", _data.files[0]);
                               view.model.save({}, {success: function(obj) {
                                   App.vent.trigger("navigate", "#main");
                               }});
                           }
                       },
                       error: function (jqXHR, textStatus, errorThrown) {
                           App.handleError(textStatus);
                       }
                   });
                }
                else{
                    this.model.save({}, {success : function (data) {
                        App.vent.trigger("navigate", "#main");
                    }});
                }
//                this.model.save();
            },
            
            modelChanged: function (e) {
                var changed = e.currentTarget;
                var obj = {};
                obj[changed.id] = $(changed).val();
                this.model.set(obj);
                
//                console.log(this.model);
            },
            
            onRender : function () {
                      
                
            },
            
            initialize: function() {
                _.bindAll(this);
                var view = this;
                
                this.model = new NewsModel({
                    user_id: this.options.userId,
                    date: new Date()
                });
                
                if (this.options.newsId != -1) { // Create a new one
                    this.model.set("id" ,this.options.newsId);
                    
                    this.model.fetch({success: function (data) {
                        view.model = data;
                        view.render();
                    }});
                }
                
                
                
                this.render();
            }
            
        });
    });