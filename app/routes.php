<?php
declare(strict_types=1);

// includes
use Farol360\IsepeEventos\Controller\Admin\EventsController as EventsAdmin;
use Farol360\IsepeEventos\Controller\Admin\EventsTypeController as EventsTypeAdmin;
use Farol360\IsepeEventos\Controller\Admin\IndexController as IndexAdmin;
use Farol360\IsepeEventos\Controller\Admin\PermissionController as PermissionAdmin;
use Farol360\IsepeEventos\Controller\Admin\RoleController as RoleAdmin;
use Farol360\IsepeEventos\Controller\Admin\TrashController as TrashAdmin;
use Farol360\IsepeEventos\Controller\Admin\UserController as UserAdmin;
use Farol360\IsepeEventos\Controller\Admin\SubscriptionController as SubscriptionAdmin;

use Farol360\IsepeEventos\Controller\PageController as Page;
use Farol360\IsepeEventos\Controller\UserController as User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('[/]', Page::class . ':index');

$app->group('/admin', function () {
    $this->get('[/]', IndexAdmin::class . ':index');

    $this->group('/certificates', function() {
        $this->get('[/]', EventsAdmin::class . ':certificates' );
    });

    $this->group('/events', function() {
        $this->get('[/]', EventsAdmin::class . ':index' );

        $this->map(['GET', 'POST'], '/add', EventsAdmin::class . ':add' );
        $this->get('/disable/{id:[0-9]+}', EventsAdmin::class . ':disable');
        $this->get('/enable/{id:[0-9]+}', EventsAdmin::class . ':enable');
        $this->get('/edit/{id:[0-9]+}', EventsAdmin::class . ':edit' );
        $this->map(['GET', 'POST'], '/update', EventsAdmin::class . ':update' );
        $this->get('/trash/remove/{id:[0-9]+}', EventsAdmin::class . ':trashRemove');
        $this->get('/trash/send/{id:[0-9]+}', EventsAdmin::class . ':trashSend');

    });

    $this->group('/eventstype', function () {
        $this->get('[/]', EventsTypeAdmin::class . ':index' );
        $this->map(['GET', 'POST'], '/add', EventsTypeAdmin::class . ':add' );
        $this->get('/disable/{id:[0-9]+}', EventsTypeAdmin::class . ':disable');
        $this->get('/enable/{id:[0-9]+}', EventsTypeAdmin::class . ':enable');
        $this->get('/edit/{id:[0-9]+}', EventsTypeAdmin::class . ':edit' );
        $this->get('/getTerms/{id:[0-9]+}', EventsTypeAdmin::class . ':getTerms' );
        $this->map(['GET', 'POST'], '/update', EventsTypeAdmin::class . ':update' );

        $this->get('/remove/{id:[0-9]+}', EventsTypeAdmin::class . ':remove' );
        // events type dnt implements trash feature
        //$this->get('/trash/remove/{id:[0-9]+}', EventsTypeAdmin::class . ':trashRemove');
        //$this->get('/trash/send/{id:[0-9]+}', EventsTypeAdmin::class . ':trashSend');

        $this->map(['GET', 'POST'], '/verifytoremove/{id:[0-9]+}', EventsTypeAdmin::class . ':verifytoremove' );
        $this->map(['GET', 'POST'], '/verifytounpublish/{id:[0-9]+}', EventsTypeAdmin::class . ':verifytounpublish' );
    });

    $this->group('/permission', function () {
        $this->get('[/]', PermissionAdmin::class . ':index');
        $this->map(['GET', 'POST'], '/add', PermissionAdmin::class . ':add');
        $this->get('/delete/{id:[0-9]+}', PermissionAdmin::class . ':delete');
        $this->get('/edit/{id:[0-9]+}', PermissionAdmin::class . ':edit');
        $this->post('/update', PermissionAdmin::class . ':update');
    });

    $this->group('/role', function () {
        $this->get('[/]', RoleAdmin::class . ':index');
        $this->map(['GET', 'POST'], '/add', RoleAdmin::class . ':add');
        $this->get('/delete/{id:[0-9]+}', RoleAdmin::class . ':delete');
        $this->get('/edit/{id:[0-9]+}', RoleAdmin::class . ':edit');
        $this->post('/update', RoleAdmin::class . ':update');
    });

    $this->group('/subscriptions', function() {
        $this->get('[/]', SubscriptionAdmin::class . ':index');
        $this->get('/{id:[0-9]+}', SubscriptionAdmin::class . ':index');
        $this->get('/activate/{id:[0-9]+}', SubscriptionAdmin::class . ':activate');
        $this->get('/deactivate/{id:[0-9]+}', SubscriptionAdmin::class . ':deactivate');
        $this->get('/open/{id:[0-9]+}', SubscriptionAdmin::class . ':open');
    });

    $this->group('/attendances', function() {
        $this->get('[/]', SubscriptionAdmin::class . ':attendances');
        $this->get('/{id:[0-9]+}', SubscriptionAdmin::class . ':attendances');
        $this->get('/activate/{id:[0-9]+}', SubscriptionAdmin::class . ':activate');
        $this->get('/deactivate/{id:[0-9]+}', SubscriptionAdmin::class . ':deactivate');
        $this->get('/open/{id:[0-9]+}', SubscriptionAdmin::class . ':open');
    });


    /**
        Trash index route
    */
    $this->get('/trash', TrashAdmin::class . ':index');

    $this->group('/user', function () {
        $this->get('[/]', UserAdmin::class . ':index');
        $this->get('/all', UserAdmin::class . ':index');
        $this->get('/export', UserAdmin::class . ':export');
        $this->get('/{id:[0-9]+}', UserAdmin::class . ':view');
        $this->map(['GET', 'POST'], '/add', UserAdmin::class . ':add');
        $this->get('/delete/{id:[0-9]+}', UserAdmin::class . ':delete');
        $this->get('/edit/{id:[0-9]+}', UserAdmin::class . ':edit');
        $this->post('/update', UserAdmin::class . ':update');
    });
});

$app->map(['GET', 'POST'], '/contato', Page::class . ':contato');

$app->group('/eventos', function () {
    $this->get('[/]', Page::class . ':events');
    $this->get('/{id:[0-9]+}', Page::class . ':eventId');

    $this->group('/categorias', function() {
        $this->get('[/]', Page::class . ':eventsType');
        $this->get('/{id:[0-9]+}', Page::class . ':eventsTypeId');
    });
});

$app->group('/inscricao', function () {
    $this->map(['GET', 'POST'], '[/]', Page::class . ':inscricao'); //not found any use for this yet
    $this->get('/{id:[0-9]+}', Page::class . ':inscricao');
    $this->post('/add', Page::class . ':inscricaoAdd');

});

$app->get('/obrigado', Page::class . ':contatoObrigado');

$app->group('/users', function () {
    $this->get('/dashboard', User::class . ':dashboard');
    $this->map(['GET', 'POST'], '/profile', User::class . ':profile');
    $this->map(['GET', 'POST'], '/recover', User::class . ':recover');
    $this->map(['GET', 'POST'], '/recover/token/{token}', User::class . ':recoverPassword');
    $this->map(['GET', 'POST'], '/signin', User::class . ':signIn');
    $this->get('/signout', User::class . ':signOut');
    $this->map(['GET', 'POST'], '/signup', User::class . ':signUp');
    $this->get('/verify/{token}', User::class . ':verify');
    $this->get('/inscricoes', Page::class . ':userInscricoes');
});
