define(["App", "jquery", "backbone", "models/WorkingExperienceModel"],
  function(App, $, Backbone, WorkingExperienceModel) {
       
    var WorkingExperienceCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/workingexperience/" + App.user.id ; },
      
      model: WorkingExperienceModel
      
    });

    return WorkingExperienceCollection;
    
  });