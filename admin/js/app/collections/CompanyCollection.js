define(["App", "jquery", "backbone", "models/CompanyModel"],
  function(App, $, Backbone, CompanyModel) {
       
    var CompanyCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/companies/" + App.user.id ; },
      
      model: CompanyModel
      
    });

    return CompanyCollection;
    
  });