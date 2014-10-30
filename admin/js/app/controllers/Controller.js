define(['App', 'backbone', 'marionette', 'views/LoginView', 'views/HeaderView', "views/MainView", "views/NewsListView",
        'views/NewsEditView', "views/ProfileView", 'views/PersonalView', 'views/AddressListView', 'views/PhonesListView',
        'views/EducationHistoryView', 'views/SchoolsListView', 'views/LanguagesListView', 'views/CertificationListView',
        'views/EducationListView', 'views/PublicationsListView', 'views/ActivitiesView', 'views/HonorsListView', 'views/InterestListView',
        'views/OrganizationListView', 'views/EmploymentView', 'views/CompaniesListView', 'views/CoursesListView', 'views/ProjectsListView',
        'views/WorksListView', 'views/OfficeHoursListView', 'views/EmailsListView', 'views/PersonalDataFormView', 'views/AboutView',
        'i18next'],
    function (App, Backbone, Marionette, LoginView, HeaderView, MainView, NewsListView, NewsEditView, ProfileView, PersonalView,
               AddressListView, PhonesListView, EducationHistoryView, SchoolsListView, LanguagesListView, CertificationListView, 
              EducationListView, PublicationsListView, ActivitiesView, HonorsListView, InterestListView, OrganizationListView, EmploymentView,
              CompaniesListView, CoursesListView, ProjectsListView, WorksListView, OfficeHoursListView, EmailsListView, PersonalDataFormView,
              AboutView) {
    return Backbone.Marionette.Controller.extend({
        initialize: function(){
            setTimeout(function(){
                App.headerRegion.show(new HeaderView());
            }, 100);    
        },
        
        login: function () {
            
            App.headerRegion.show(new HeaderView());
            App.mainRegion.show(new LoginView());
        },
        
        showMain: function () {
            App.headerRegion.show(new HeaderView());
            App.mainRegion.show( new MainView({
                newslist: new NewsListView({
                    editPage: "news/"+App.user.id
                }),
                editPage: "#news/"+App.user.id+"/-1"
            }));
        },
        
        showNew: function (userId, newsId){
         App.mainRegion.show(new NewsEditView({
             newsId: newsId,
             userId: userId
         }));
        },
        
        showProfile: function (userID) {
            App.mainRegion.show( new ProfileView({
                userId: App.user.id
            }));
        },
        
        showPersonal : function (userId) {
            App.mainRegion.show( new PersonalView({
                userId : App.user.id,
                officeRegion : new OfficeHoursListView(),
                addressRegion : new AddressListView(),
                phonesRegion : new PhonesListView(),
                emailsRegion : new EmailsListView(),
                presonalData : new PersonalDataFormView()
            }));
        },
        
        showEducationHistory : function (userId) {
            App.mainRegion.show( new EducationHistoryView({
                userId : App.user.id,
                shoolsRegion: new SchoolsListView(),
                langsRegion : new LanguagesListView(),
                certsRegion : new CertificationListView(),
                educationRegion : new EducationListView()
            }));
        },
        
        showActivities : function (userId) {
            App.mainRegion.show( new ActivitiesView({
                userId : App.user.id,
                publicationsRegion : new PublicationsListView(),
                honorsRegion : new HonorsListView(),
                interestRegion : new InterestListView(),
                organizationsRegion : new OrganizationListView()
            }));
        },
        
        showEmployment : function (userId) {
            App.mainRegion.show(new EmploymentView({
                userId : userId,
                companiesRegion : new CompaniesListView(),
                projectsRegion : new ProjectsListView(),
                coursesRegion : new CoursesListView(),
                worksRegion : new WorksListView()
            }));
        },
        
        showAboutPage : function (userId) {
            console.log("Controller");
            App.mainRegion.show(new AboutView({
                userId : userId
            }));
        }
    });
});