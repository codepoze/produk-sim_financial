<?php

use App\Models\Product;
use App\Models\Type;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// begin:: pages
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(__('menu.home'), route('home'));
});

Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
    $trail->parent('home');

    $trail->push(__('menu.about'), route('about'));
});
// end:: pages

// begin:: admin
Breadcrumbs::for('admin.dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard.index'));
});

Breadcrumbs::for('admin.profil.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');

    $trail->push('Profil', route('admin.profil.index'));
});

Breadcrumbs::for('admin.category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');

    $trail->push('Category', route('admin.category.index'));
});

Breadcrumbs::for('admin.money.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');

    $trail->push('Money', route('admin.money.index'));
});
// end:: admin
