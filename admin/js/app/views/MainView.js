define(["App", "backbone", "marionette", "jquery", "hbs!templates/main", "models/AlertModel", "views/AlertView", 'i18next'],
       function (App, Backbone, Marionette, $, template, AlertModel, AlertView) {
           "use strict";
           return Backbone.Marionette.Layout.extend({
               template: template,
               
               ui: {
                   addNewsBtn: "#addNewsBtn"
               },
               
               regions: {
                   newslist: "#newsList"
               },
               
               onRender: function (){
                   if( this.options.newslist !== undefined ) {
                       this.newslist.show(this.options.newslist);
                       this.options.newslist.trigger('refresh');
                   }
                   
                   this.ui.addNewsBtn.attr("href", this.options.editPage);
               }
           });
       });