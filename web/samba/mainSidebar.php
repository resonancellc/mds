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
<?

$pdc = xmlCall("samba.isPdc",null);

if ($pdc) { //si PDC

$sidebar = array("class" => "shares",
                 "content" => array(array("id" => "global",
                                    "text" => _T("List shares","samba"),
                                    "link" => "main.php?module=samba&submod=shares&action=index"),
                              array("id" => "addShare",
                                    "text" => _T("Add a share","samba"),
                                    "link" => "main.php?module=samba&submod=shares&action=add"),
                              array("id" => "globalMachine",
                                    "text" => _T("List computers","samba"),
                                    "link" => "main.php?module=samba&submod=machines&action=index"),
                              array("id" => "addMachine",
                                    "text" => _T("Add a computer","samba"),
                                    "link" => "main.php?module=samba&submod=machines&action=add"),
                              array("id" => "globalConfig",
                                    "text" => _T("General options","samba"),
                                    "link" => "main.php?module=samba&submod=config&action=index")
                              ));
}
else {
$sidebar = array("class" => "shares",
                 "content" => array(array("id" => "global",
                                    "text" => _T("List shares","samba"),
                                    "link" => "main.php?module=samba&submod=shares&action=index"),
                              array("id" => "addShare",
                                    "text" => _T("Add a share","samba"),
                                    "link" => "main.php?module=samba&submod=shares&action=add"),
                              array("id" => "globalConfig",
                                    "text" => _T("General options","samba"),
                                    "link" => "main.php?module=samba&submod=config&action=index")
                              ));

}
?>