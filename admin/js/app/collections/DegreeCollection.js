define(["App", "jquery", "backbone", "models/DegreeModel"],
  function(App, $, Backbone, DegreeModel) {
       
    var DegreeCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/degree"; },
      
      model: DegreeModel
      
    });

    return DegreeCollection;
    
  });