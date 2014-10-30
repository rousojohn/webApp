define(["App", "backbone", "marionette", "jquery", "views/ListItemView", "views/EmptyListItemView", "collections/NewsCollection", "models/NewsModel", "hbs!templates/newsListItem",],
    function (App, Backbone, Marionette, $, ListItemView, EmptyListItemView, NewsCollection, NewsModel, template) {
        return Backbone.Marionette.CollectionView.extend({
            tagName: "ul",
            
            attributes: function (){
                return {
                    "class" : "event-list"
                };
            },
            
            itemView: ListItemView,
            
            emptyView: EmptyListItemView,
            
            collection: new NewsCollection(),
            
            initialize: function() {
                _.bindAll(this);
                var view = this;
                this.collection.fetch({success: function (data) {
                    view.render();
                }});
                
                 this.on("refresh", function (){
                    view.collection.fetch({success: function (data) {
                        view.render();
                    }});
                });
            },
            
            buildItemView: function(item, ItemViewType, itemViewOptions){
                // build the final list of options for the item view type
                var options = _.extend({model: item}, itemViewOptions);
                
                if(this.collection.length>0){
                    options.template = template;
                }
                
                // set the editPage of the listview item from options
              options.editPage = this.options.editPage || "asdasd";
                
                 
                // create the item view instance
                var view = new ItemViewType(options);
                
              // return it
                return view;
            }
        });
    });