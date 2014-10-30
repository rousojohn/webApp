define(["App", "backbone", "marionette", "jquery", "views/ListItemView", "views/EmptyListItemView", "collections/PhoneCollection",
        "hbs!templates/phoneListItem", "i18next"],
    function (App, Backbone, Marionette, $, ListItemView, EmptyListItemView, PhoneCollection, template) {
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
            
            collection: new PhoneCollection(),
            
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
                switch (item.get("type")){
                    case  0:
                        item.set("phoneType", "home");
                        break;
                    case 1:
                        item.set("phoneType", "briefcase");
                        break;
                    case 2:
                        item.set("phoneType", "phone");
                        break;
                };
                
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