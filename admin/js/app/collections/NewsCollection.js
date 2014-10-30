define(["App", "jquery", "backbone", "models/NewsModel"],
  function(App, $, Backbone, NewsModel) {
       
    var NewsCollection = Backbone.Collection.extend({
      
      url: function() { return App.server + "/news/" + App.user.id ; },
      
      model: NewsModel
      
    });

    return NewsCollection;
    
  });