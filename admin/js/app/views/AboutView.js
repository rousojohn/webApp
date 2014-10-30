define(["App", "backbone", "marionette", "jquery", "hbs!templates/about", "models/AboutModel", "collections/AboutCollection", "i18next"],
       function (App,Backbone, Marionette, $, template, AboutModel, AboutCollection) {
    "use strict";
    return Backbone.Marionette.ItemView.extend({
        template: template,
        
        ui:{
            summary : "#summary",
            imgLink : "#imgLink"
        },
        
        events : {
            "click button#cancelBtn" : "goBack",
            "change input#imgLink" : "prepareUpload",
            "click button#saveBtn" : "saveAbout"
        },
        
        validateFileType : function () {
            var ext = this.ui.imgLink.val().split('.').pop().toLowerCase();
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                alert(i18n.t('invalidExt'));
                return false;
            }
            return true;
        },
            
        prepareUpload: function (e) {
            if (this.validateFileType())
                this.files = e.target.files;
            else 
                return false;
        },
        
        goBack: function (e){
            e.stopPropagation();
            e.preventDefault();
            App.appRouter.back();
        },
        
        saveAbout : function (evt) {
            var view = this;
            if (evt) {
                evt.stopPropagation();
                evt.preventDefault();
            }
            
            this.model.set("about", this.ui.summary.val());
            
            if (this.files !== undefined)
                this.uploadFile(view);
            else 
                this.model.save();            
        },
        
        uploadFile: function (view) {
            var data = new FormData();
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
                success : function (_data,textStatus, jqXHR) {
                    if (_data.error) {
                        App.handleError(_data.error[0]);
                        return false;
                    }
                    else {
                        view.model.set("photo", _data.files[0]);
                        view.model.save();
                    }
                },
                error : function (jqXHR, textStatus, errorThrown){
                    App.handleError(textStatus);
                }
            });
        },
        
        initialize: function() {
            _.bindAll(this);
            var view = this;
            this.files = undefined;
            this.collection = new AboutCollection();
            this.collection.fetch({success: function (_data) {
                if (_data.length > 0 )
                    view.model = _data.models[0];
                else
                    view.model = new AboutModel({
                        user_id : App.user.id
                    });
                view.render();
            }});
        }});
});