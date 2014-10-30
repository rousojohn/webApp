// Include Desktop Specific JavaScript files here (or inside of your Desktop Controller, or differentiate based off App.mobile === false)
require(["App", "routers/AppRouter", "controllers/Controller", "jquery", "backbone", "marionette", "bootstrap", "backbone.validateAll"],
    function (App, AppRouter, AppController) {
        App.appRouter = new AppRouter({
            controller:new AppController()
        });

        App.start();
    });