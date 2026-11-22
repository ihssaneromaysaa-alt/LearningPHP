<?php
use Controllers\TareasController;
use Core\Router;

Router::add('get',  '/', [TareasController::class, 'index']);
Router::add('get',  '/form', [TareasController::class, 'index']);
Router::add('get',  '/tareas', [TareasController::class, 'tareas']);
Router::add('post',  '/hacerTarea', [TareasController::class, 'hacerTarea']);
Router::add('post',  '/guardar', [TareasController::class, 'guardar']);
Router::add('post',  '/eliminarNotas', [TareasController::class, 'vaciar']);




/*
• GET /tareas — Devuelve el array completo de tareas (id, texto, hecha).
• POST /tareas — Recibe JSON {"texto": "..."}, crea una tarea nueva con id único y hecha=false, la guarda y devuelve la
tarea creada.
• PATCH /tareas/{id} o POST /tareas/toggle — Marca/desmarca la tarea como hecha. Devuelve la tarea actualizada.
• Ante cualquier error (JSON mal formado, tarea no encontrada, método no permitido) responde con el código HTTP
adecuado (400, 404, 405…) y un JSON de error.
*/