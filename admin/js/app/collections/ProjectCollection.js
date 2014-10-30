define(["App", "jquery", "backbone", "models/ProjectModel"],
  function(App, $, Backbone, ProjectModel) {
       
    var ProjectCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/projects/" + App.user.id ; },
      
      model: ProjectModel
      
    });

    return ProjectCollection;
    
  });