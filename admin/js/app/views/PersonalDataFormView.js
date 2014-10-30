define(["App", "backbone", "marionette", "jquery", "hbs!templates/personalDataForm", "models/PersonModel", "collections/PersonCollection"],
    function (App,Backbone, Marionette, $, template, PersonModel, PersonCollection) {
        "use strict";
        
        return Backbone.Marionette.ItemView.extend({
           
            template: template,
            
            ui:{
                im : "#im",
                birthdate : "#birthdate",
                title : "#title",
                surname : "#surname",
                name : "#name"
            },
            
            saveIt : function (){
                this.model.set({
                    name : this.ui.name.val(),
                    surname : this.ui.surname.val(),
                    title : this.ui.title.val(),
                    birthdate : this.ui.birthdate.val(),
                    IM : this.ui.im.val()
                });
                this.model.save();
            },
            
            initialize: function() {
                _.bindAll(this);
                var view = this;
                
               this.on("saveForm", this.saveIt);
                
                this.collection = new PersonCollection();
                this.collection.fetch({success: function (_data){
                    console.log(_data);
                    if (_data.length > 0)
                        view.model = _data.models[0];
                    else
                        view.model = new PersonModel({
                            user_id : App.user.id
                        });
                    
                    view.model.on("invalid", function (_model, error) {
                        App.handleError(error);
                        _model.off("invalid");
                    });
                    view.render();
                }});
            }
            
        });
    });