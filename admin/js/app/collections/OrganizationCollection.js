define(["App", "jquery", "backbone", "models/OrganizationModel"],
  function(App, $, Backbone, OrganizationModel) {
       
    var OrganizationCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/organizations/" + App.user.id ; },
      
      model: OrganizationModel
      
    });

    return OrganizationCollection;
    
  });