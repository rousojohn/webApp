define(["App", "jquery", "backbone", "models/CourseModel"],
  function(App, $, Backbone, CourseModel) {
       
    var CourseCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/courses/" + App.user.id ; },
      
      model: CourseModel
      
    });

    return CourseCollection;
    
  });