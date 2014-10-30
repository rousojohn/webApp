define(["App", "jquery", "backbone", "models/PublicationModel"],
  function(App, $, Backbone, PublicationModel) {
       
    var PublicationCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/publications/" + App.user.id ; },
      
      model: PublicationModel
      
    });

    return PublicationCollection;
    
  });