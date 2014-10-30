define(["App", "jquery", "backbone", "models/PhoneModel"],
  function(App, $, Backbone, PhoneModel) {
       
    var PhoneCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/phones/" + App.user.id ; },
      
      model: PhoneModel
      
    });

    return PhoneCollection;
    
  });