define(["App", "jquery", "backbone", "models/AddressModel"],
  function(App, $, Backbone, AddressModel) {
       
    var AddressCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/addresses/" + App.user.id ; },
      
      model: AddressModel
      
    });

    return AddressCollection;
    
  });