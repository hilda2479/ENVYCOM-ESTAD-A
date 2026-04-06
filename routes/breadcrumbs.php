<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// rtua de dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// ruta de vista de clientes
Breadcrumbs::for('clientes.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Clientes', route('clientes.index'));
});

// ruta de clientes a crear
Breadcrumbs::for('clientes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('clientes.index');
    $trail->push('Nuevo Cliente', route('clientes.create'));
});

// ruta de clientes a mostrar expediente
Breadcrumbs::for('clientes.show', function (BreadcrumbTrail $trail, $cliente) {
    $trail->parent('clientes.index');
    $trail->push($cliente->nombre, route('clientes.show', $cliente));
});

// ruta de equipos registrados
Breadcrumbs::for('equipos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Equipos Registrados', route('equipos.index'));
});