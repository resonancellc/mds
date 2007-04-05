<?php
/**
 * (c) 2004-2007 Linbox / Free&ALter Soft, http://linbox.com
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

$sidemenu= new SideMenu();
$sidemenu->setClass("network");
$sidemenu->addSideMenuItem(new SideMenuItem(_T("DNS zones"),"network","network","index"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Add DNS zone"),"network","network","add"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("DHCP subnets"),"network","network","subnetindex"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Add DHCP subnet"),"network","network","subnetadd"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Network services management"),"network","network","services"));

?>
