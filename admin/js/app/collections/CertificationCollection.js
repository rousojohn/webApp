define(["App", "jquery", "backbone", "models/CertificationModel"],
  function(App, $, Backbone, CertificationModel) {
       
    var CertificationCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/certifications/" + App.user.id ; },
      
      model: CertificationModel
      
    });

    return CertificationCollection;
    
  });