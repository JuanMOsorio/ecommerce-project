<?php
  // Se agrega los controladores al contexto de la app (container).
  $container['UserController'] = function($container) {
    return new app\Controllers\UserController($container);
  }
?>