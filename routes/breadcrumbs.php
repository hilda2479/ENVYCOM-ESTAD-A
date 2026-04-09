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

// ruta de clientes a editar
Breadcrumbs::for('clientes.edit', function ($trail, $cliente) {
    $trail->parent('clientes.index');
    $titulo = $cliente->nombre_cliente ?? 'Editar Cliente';
    $trail->push('Editar', route('clientes.edit', $cliente));
    $trail->push($titulo); 
});

// ruta de clientes a mostrar expediente
Breadcrumbs::for('clientes.show', function (BreadcrumbTrail $trail, $cliente) {
    $trail->parent('clientes.index');
    $trail->push($cliente->nombre_cliente, route('clientes.show', $cliente));
});


// ruta de equipos registrados
Breadcrumbs::for('equipos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Equipos Registrados', route('equipos.index'));
});

// ruta de equipos a crear
Breadcrumbs::for('equipos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('equipos.index');
    $trail->push('Nuevo Equipo', route('equipos.create'));
});

// ruta de equipos a agregar historial
Breadcrumbs::for('mantenimientos.create', function ($trail, $equipo) {
    $trail->parent('equipos.index');
    $trail->push($equipo->nombre_equipo, route('equipos.show', $equipo));
    $trail->push('Agregar Historial');
});