define(["App", "jquery", "backbone", "models/ReportModel"],
function(App, $, Backbone, ReportModel) {
  "use strict";
  
  var ReportCollection = Backbone.Collection.extend({
    
    url: App.server + "/reports/" + sessionStorage.getItem("svPoll_cid"),
    
    model: ReportModel,
    
    initialize: function(){
        this.fetch();
    }
    
  });

  return ReportCollection;
  
});