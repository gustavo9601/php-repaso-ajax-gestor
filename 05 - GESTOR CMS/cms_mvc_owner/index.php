<?php
//imprtamos la visata de template
require_once 'controllers/template.php';
require_once 'controllers/gestorArticulos.php';
require_once 'controllers/gestorSlide.php';
require_once 'controllers/gestorGaleria.php';
require_once 'controllers/gestorVideos.php';
require_once 'controllers/gestorContacto.php';

require_once 'models/gestorSlide.php';
require_once 'models/gestorArticulos.php';
require_once 'models/gestorGaleria.php';
require_once 'models/gestorVideos.php';
require_once 'models/gestorContacto.php';

//creamos el objeto de clase, y ejecutamos la funcion, que inclulle el template
$llamandoTemplate = new TemplateController();
$llamandoTemplate->template();

?>