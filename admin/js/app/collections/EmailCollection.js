define(["App", "jquery", "backbone", "models/EmailModel"],
  function(App, $, Backbone, EmailModel) {
       
    var EmailCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/emails/" + App.user.id ; },
      
      model: EmailModel
      
    });

    return EmailCollection;
    
  });