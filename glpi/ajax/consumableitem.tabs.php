<?php
/*
 * @version $Id: consumableitem.tabs.php 12760 2010-10-15 11:32:01Z yllen $
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2010 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------

define('GLPI_ROOT', '..');
include (GLPI_ROOT . "/inc/includes.php");

header("Content-Type: text/html; charset=UTF-8");
header_nocache();

if (!isset($_POST["id"])) {
   exit();
}
if (!isset($_REQUEST['glpi_tab'])) {
   exit();
}

checkRight("consumable", "r");

$consumable = new ConsumableItem();

if ($_POST["id"]>0 && $consumable->can($_POST["id"],'r')) {

   switch($_REQUEST['glpi_tab']) {
      case -1 :
         Consumable::showAddForm($consumable);
         Consumable::showForItem($consumable);
         Consumable::showForItem($consumable, 1);
         Infocom::showForItem($consumable);
         Document::showAssociated($consumable);
         Link::showForItem('ConsumableItem', $_POST["id"]);
         Plugin::displayAction($consumable, $_REQUEST['glpi_tab']);
         break;

      case 4 :
         Infocom::showForItem($consumable);
         break;

      case 5 :
         Document::showAssociated($consumable);
         break;

      case 7 :
         Link::showForItem('ConsumableItem', $_POST["id"]);
         break;

      case 10 :
         showNotesForm($_POST['target'], 'ConsumableItem', $_POST["id"]);
         break;

      default :
         if (!Plugin::displayAction($consumable, $_REQUEST['glpi_tab'])) {
            Consumable::showAddForm($consumable);
            Consumable::showForItem($consumable);
            Consumable::showForItem($consumable, 1);
         }
   }
}
ajaxFooter();

?>
