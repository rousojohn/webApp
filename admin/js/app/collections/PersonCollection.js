define(["App", "jquery", "backbone", "models/PersonModel"],
  function(App, $, Backbone, PersonModel) {
       
    var PersonCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/personalData/" + App.user.id ; },
      
      model: PersonModel
      
    });

    return PersonCollection;
    
  });