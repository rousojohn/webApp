define(["App", "jquery", "backbone", "models/OfficeHoursModel"],
  function(App, $, Backbone, OfficeHoursModel) {
       
    var OfficeHoursCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/office_hours/" + App.user.id ; },
      
      model: OfficeHoursModel
      
    });

    return OfficeHoursCollection;
    
  });