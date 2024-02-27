<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Inicio
Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
  $trail->push('Inicio', route('index'));
});
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
  $trail->push('Inicio', route('home'));
});

// Inicio > Artículo
Breadcrumbs::for('terms', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push('Términos y condiciones', route('terms'));
});
Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push('Acerca de nosotros', route('about'));
});
Breadcrumbs::for('faq', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push('Preguntas frecuentes', route('faq'));
});
Breadcrumbs::for('contact', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push('Contacto', route('contact'));
});
Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push('Control de usuarios', route('users'));
});
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push('Perfil de usuario', route('profile'));
});
Breadcrumbs::for('dishes', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push('Menú de alimentos y bebidas', route('dishes'));
});
Breadcrumbs::for('reservations', function (BreadcrumbTrail $trail) {
  $trail->parent('home');
  $trail->push('Administrar reservaciones', route('reservations'));
});

Breadcrumbs::for('categories', function (BreadcrumbTrail $trail) {
  $trail->parent('dishes');
  $trail->push('Administrar categorías', route('categories'));
});
Breadcrumbs::for('promotions', function (BreadcrumbTrail $trail) {
  $trail->parent('dishes');
  $trail->push('Administrar promociones', route('promotions'));
});
Breadcrumbs::for('tables', function (BreadcrumbTrail $trail) {
  $trail->parent('reservations');
  $trail->push('Administrar mesas', route('tables'));
});

// Inicio > Artículo > [Sub artículo]
/* Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
  $trail->parent('blog');
  $trail->push($category->title, route('category', $category));
}); */
