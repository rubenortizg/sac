<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/admin.controlador.php";
require_once "controladores/transportadoras.controlador.php";
require_once "controladores/tipos.controlador.php";
require_once "controladores/establecimientos.controlador.php";
require_once "controladores/empresas.controlador.php";
require_once "controladores/remitentes.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/radicados.controlador.php";
require_once "controladores/perfiles.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/admin.modelo.php";
require_once "modelos/transportadoras.modelo.php";
require_once "modelos/tipos.modelo.php";
require_once "modelos/establecimientos.modelo.php";
require_once "modelos/empresas.modelo.php";
require_once "modelos/remitentes.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/radicados.modelo.php";
require_once "modelos/perfiles.modelo.php";




$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
