<?php
$view = new stdClass();
$view->pageTitle = 'Dashboard';
require_once("Views/Templates/heading.phtml");

require_once ("Views/dashboard.phtml");//requires the view for the logged in page
