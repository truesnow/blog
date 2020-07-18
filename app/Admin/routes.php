<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    Route::name('admin.')->group(function(Router $router) {
        $router->get('/', 'HomeController@index');
        $router->resource('users', UsersController::class);
        $router->resource('articles', ArticlesController::class);
        $router->resource('subjects', SubjectsController::class);
        $router->resource('replies', RepliesController::class);
        $router->resource('messages', MessagesController::class);
        $router->resource('mottos', MottosController::class);
        $router->resource('bookmarkcategories', BookmarkCategoriesController::class);
        $router->resource('bookmarks', BookmarksController::class);
        $router->resource('works', WorksController::class);
        $router->resource('pages', PagesController::class);
        $router->resource('visitlogs', VisitLogsController::class);
        $router->resource('abbrs', AbbrsController::class);
        $router->resource('milestones', MilestonesController::class);
        $router->resource('wiki-subjects', WikiSubjectsController::class);
        $router->resource('wiki-cates', WikiCatesController::class);
        $router->resource('wiki-items', WikiItemsController::class);
        $router->resource('text-contents', TextContentsController::class);
    });
});
