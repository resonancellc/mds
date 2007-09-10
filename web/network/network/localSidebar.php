<?php
/**
 * (c) 2004-2007 Linbox / Free&ALter Soft, http://linbox.com
 * (c) 2007 Mandriva, http://www.mandriva.com/
 *
 * $Id$
 *
 * This file is part of Mandriva Management Console (MMC).
 *
 * MMC is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * MMC is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MMC; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

$sidemenu= new SideMenu();
$sidemenu->setClass("network");
$sidemenu->addSideMenuItem(new SideMenuItem(_T("DNS zones"),"network","network","index", "modules/network/graph/img/network_active.png", "modules/network/graph/img/network_inactive.png"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Add DNS zone"),"network","network","add", "modules/network/graph/img/networkadd_active.png", "modules/network/graph/img/networkadd_inactive.png"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("DHCP subnets"),"network","network","subnetindex", "modules/network/graph/img/network_active.png", "modules/network/graph/img/network_inactive.png"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Add DHCP subnet"),"network","network","subnetadd", "modules/network/graph/img/networkadd_active.png", "modules/network/graph/img/networkadd_inactive.png"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Network services management"),"network","network","services", "modules/network/graph/img/network_active.png", "modules/network/graph/img/network_inactive.png"));

?>

