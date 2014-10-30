define(["App", "jquery", "backbone", "models/InterestsModel"],
  function(App, $, Backbone, InterestsModel) {
       
    var InterestCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/interests/" + App.user.id ; },
      
      model: InterestsModel
      
    });

    return InterestCollection;
    
  });