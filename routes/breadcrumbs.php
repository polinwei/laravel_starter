<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use App\Models\SomeModel;
use App\Models\User;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

Breadcrumbs::for('errors.403', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Permission denied');
});

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
    $trail->push('Dashboard', route('dashboard'));
});

// Users
/**
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('users.index');
    $trail->push('Show', route('users.show', $user));
});
 */

// For Route::resource($name, class)
Breadcrumbs::macro('resource', function (string $name, string $title) {
    // Home > User
    Breadcrumbs::for("{$name}.index", function (BreadcrumbTrail $trail) use ($name, $title) {
        $trail->parent('home');
        $trail->push($title, route("{$name}.index"));
    });

    // Home > User > New
    Breadcrumbs::for("{$name}.create", function (BreadcrumbTrail $trail) use ($name) {
        $trail->parent("{$name}.index");
        $trail->push('New', route("{$name}.create"));
    });

    // Home > User > User 123
    Breadcrumbs::for("{$name}.show", function (BreadcrumbTrail $trail, $model) use ($name) {
        $trail->parent("{$name}.index");
        $trail->push('Show', route("{$name}.show", $model));
    });

    // Home > User > User 123 > Edit
    Breadcrumbs::for("{$name}.edit", function (BreadcrumbTrail $trail, $model) use ($name) {
        $trail->parent("{$name}.show", $model);
        $trail->push('Edit', route("{$name}.edit", $model));
    });
});

Breadcrumbs::resource('users', 'User');
Breadcrumbs::resource('roles', 'Role');

// Roles
//Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
//    $trail->parent('home');
//    $trail->push('Roles', route('roles.index'));
//});

