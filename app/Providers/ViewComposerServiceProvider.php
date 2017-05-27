<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.main_menu', function( $view )
        {
            $view->with( 'menu_list', \App\Menu::adminMenu() );
        });
        
        view()->composer('admin.blocks.navigation', function( $view )
        {
            $view->with( 'back', \App\Helpers\Helpers::back() );
        });
        
        view()->composer('site.blocks.login_langs', function( $view )
        {
            $view->with( 'langs', \App\Menu::langsMenu() );
        });
        
        view()->composer('site.footer.footer', function( $view )
        {
            $footer = \App::make( '\App\Http\Controllers\SettingsController' );
            $view->with( 'social_pages', $footer->socialMenu() );
        });
        
        view()->composer('site.blocks.notifications', function( $view )
        {
            $notifications = \App::make( '\App\Http\Controllers\NotificationsController' );
            $view->with( 'notifications_count', $notifications->getUnreadNotifications() )
                 ->with( 'notifications_list', $notifications->getUserNotifications() );
        });
        
        view()->composer('site.blocks.messages', function( $view )
        {
            $messages = \App::make( '\App\Http\Controllers\MessagesController' );
            $view->with( 'messages_count', $messages->getUnreadMessages() )
                 ->with( 'messages_list', $messages->getUserMessages() );
        });
        
        view()->composer('site.blocks.index.reviews', function( $view )
        {
            $view->with( 'reviews', \App\Http\Controllers\ReviewsController::getPublicReviews() );
        });
        
        view()->composer('site.menu.footer_menu', function( $view )
        {
            $contents = \App::make( '\App\Http\Controllers\ContentsController' );
            $view->with( 'footer_menu', $contents->footerMenu() );
        });
        
        view()->composer('site.blocks.index.travel', function( $view )
        {
            $view->with( 'index_travel', \App\Http\Controllers\BenefitsController::showTravelBenefits() )
                 ->with( 'passanger_requests', \App\Http\Controllers\RequestsController::showLastRequests() );
        });
        
        view()->composer('site.blocks.travel', function( $view )
        {
            $view->with( 'index_travel', \App\Http\Controllers\BenefitsController::showTravelBenefits() );
        });
        
        view()->composer('site.blocks.modals', function( $view )
        {
            $view->with( 'years', \App\Helpers\Helpers::getYearsList() );
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
