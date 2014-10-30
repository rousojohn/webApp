define(["App", "jquery", "backbone", "models/HonorsModel"],
  function(App, $, Backbone, HonorsModel) {
       
    var HonorCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/honors/" + App.user.id ; },
      
      model: HonorsModel
      
    });

    return HonorCollection;
    
  });