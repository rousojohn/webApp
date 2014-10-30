define(["App", "jquery", "backbone", "models/LanguageModel"],
  function(App, $, Backbone, LanguageModel) {
       
    var LanguageCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/languages/" + App.user.id ; },
      
      model: LanguageModel
      
    });

    return LanguageCollection;
    
  });