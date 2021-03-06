define(["App", "backbone", "marionette", "jquery", "views/ListItemView", "views/EmptyListItemView", "collections/OfficeHoursCollection",
        "hbs!templates/officeHoursListItem",],
    function (App, Backbone, Marionette, $, ListItemView, EmptyListItemView, OfficeHoursCollection, template) {
        return Backbone.Marionette.CollectionView.extend({
            tagName: "ul",
            
            attributes: function (){
                return {
                    "class" : "list-group"
                };
            },
            
            events : {
            },
            
            ui : {
            },
            
            itemView: ListItemView,
            
            emptyView: EmptyListItemView,
            
            collection: new OfficeHoursCollection(),
            
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
                item.set("dayStr", App.dayOfWeek(item.get("day")));
                // build the final list of options for the item view type
                var options = _.extend({model: item}, itemViewOptions);
                
                if(this.collection.length>0){
                    options.template = template;
                }
                
                // create the item view instance
                var view = new ItemViewType(options);
                
              // return it
                return view;
            }
        });
    });