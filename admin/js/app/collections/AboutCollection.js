define(["App", "jquery", "backbone", "models/AboutModel"],
  function(App, $, Backbone, AboutModel) {
       
    var AboutCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/about/" + App.user.id ; },
      
      model: AboutModel
      
    });

    return AboutCollection;
    
  });