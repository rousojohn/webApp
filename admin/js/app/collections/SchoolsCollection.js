define(["App", "jquery", "backbone", "models/SchoolModel"],
  function(App, $, Backbone, SchoolModel) {
       
    var SchoolsCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/schools/" + App.user.id ; },
      
      model: SchoolModel
      
    });

    return SchoolsCollection;
    
  });