<?php
/**
 * (c) 2004-2006 Linbox / Free&ALter Soft, http://linbox.com
 *
 * $Id$
 *
 * This file is part of LMC.
 *
 * LMC is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * LMC is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with LMC; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
?>
<style type="text/css">
<!--

<?php
printSidebarCss($_GET["submod"],$_GET["action"]);

?>

-->
</style>

<?

$sidebar = array("class" => "blacklist",
                 "content" => array(array("id" => "status","text" => _T("Proxy status"),
                                    "link" => "main.php?module=proxy&submod=blacklist&action=statut"),
				    array("id" => "index","text" => _T("Blacklist management"),
                                    "link" => "main.php?module=proxy&submod=blacklist&action=index"),
				    array("id" => "add","text" => _T("Add an entry in blacklist"),
                                    "link" => "main.php?module=proxy&submod=blacklist&action=add")));

$sidemenu= new SideMenu();

$sidemenu->setClass("blacklist");
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Proxy status"),"proxy","blacklist","statut"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Blacklist management"),"proxy","blacklist","index"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Add an entry in blacklist"),"proxy","blacklist","add"));



?>
