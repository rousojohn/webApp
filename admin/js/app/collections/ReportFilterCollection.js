define(["App", "jquery", "backbone", "models/ReportFilterModel"],
  function(App, $, Backbone, ReportFilterModel) {
       
    var ReportFilterCollection = Backbone.Collection.extend({
      
      model: ReportFilterModel
      
    });

    return ReportFilterCollection;
    
  });