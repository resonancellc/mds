<?php
/**
 * (c) 2004-2007 Linbox / Free&ALter Soft, http://linbox.com
 * (c) 2007-2008 Mandriva, http://www.mandriva.com/
 *
 * This file is part of Management Console.
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
$sidemenu->setClass("internet");
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Blacklist"),"squid","internet","blackmanager",
                                            "modules/squid/graph/actions/icn_blacklist_active.gif", "modules/squid/graph/actions/icn_blacklist.gif"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Extension blacklist"),"squid","internet","extmanager",
                                            "modules/squid/graph/actions/icn_blacklist_extend_active.gif", "modules/squid/graph/actions/icn_blacklist_extend.gif"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Whitelist"),"squid","internet","whitemanager",
                                            "modules/squid/graph/actions/icn_whitelist_active.gif", "modules/squid/graph/actions/icn_whitelist.gif"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("Time range whitelist"),"squid","internet","timemanager",
                                            "modules/squid/graph/actions/icn_interval_active.png", "modules/squid/graph/actions/icn_interval.png"));
$sidemenu->addSideMenuItem(new SideMenuItem(_T("IP whitelist"),"squid","internet","machmanager",
                                            "modules/squid/graph/actions/icn_ip_autorised_active.png", "modules/squid/graph/actions/icn_ip_autorised.png"));
//$sidemenu->addSideMenuItem(new SideMenuItem(_T("Logs"),"squid","internet","accesslog"));
?>

