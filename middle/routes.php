<?php
use FastRoute\RouteCollector;
use FastRoute\Dispatcher;

return FastRoute\simpleDispatcher(function (RouteCollector $r) {
    // Ruta para el curso principal
    $r->addRoute('GET', '/Curso.html', 'CursoController@index');

    // Ruta para cursos individuales
    $r->addRoute('GET', '/Curso.html/{nombre}', 'CursoController@show');
});
