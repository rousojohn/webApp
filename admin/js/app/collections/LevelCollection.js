define(["App", "jquery", "backbone", "models/LevelModel"],
  function(App, $, Backbone, LevelModel) {
       
    var LevelCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/levels"; },
      
      model: LevelModel
      
    });

    return LevelCollection;
    
  });