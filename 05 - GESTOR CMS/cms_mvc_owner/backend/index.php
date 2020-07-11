<?php
ini_set("memory_limit", "50M");
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');

require_once 'models/enlaces.php';
require_once 'models/conexion.php';
require_once 'models/ingreso.php';
require_once 'models/gestorSlide.php';
require_once 'models/gestorArticulos.php';
require_once 'models/gestorGaleria.php';
require_once 'models/gestorVideos.php';
require_once 'models/gestorContacto.php';
require_once 'models/gestorMensajes.php';

require_once 'controllers/template.php';
require_once 'controllers/enlaces.php';
require_once 'controllers/ingreso.php';
require_once 'controllers/gestorSlide.php';
require_once 'controllers/gestorArticulos.php';
require_once 'controllers/gestorGaleria.php';
require_once 'controllers/gestorVideos.php';
require_once 'controllers/gestorContacto.php';
require_once 'controllers/gestorMensajes.php';
//creo un objeto y ejecuto la funcion que importa el template
$template = NEW TemplateController();
$template->template();
?>