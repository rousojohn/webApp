define(["App", "jquery", "backbone", "models/EducationModel"],
  function(App, $, Backbone, EducationModel) {
       
    var EducationCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/education/" + App.user.id ; },
      
      model: EducationModel
      
    });

    return EducationCollection;
    
  });