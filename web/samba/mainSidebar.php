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
?>
<?

$pdc = xmlCall("samba.isPdc",null);

if ($pdc) { // if SAMBA is configured as a PDC
    $sidebar = array("class" => "shares",
                     "content" => array(array("id" => "global",
                                              "text" => _T("List shares","samba"),
                                              "link" => urlStr("samba/shares/index")),
                                        array("id" => "addShare",
                                              "text" => _T("Add a share","samba"),
                                              "link" => urlStr("samba/shares/add")),
                                        array("id" => "globalMachine",
                                              "text" => _T("List computers","samba"),
                                              "link" => urlStr("samba/machines/index")),
                                        array("id" => "addMachine",
                                              "text" => _T("Add a computer","samba"),
                                              "link" => urlStr("samba/machines/add")),
                                        array("id" => "globalConfig",
                                              "text" => _T("General options","samba"),
                                              "link" => urlStr("samba/config/index"))
                                        ));
}
else {
    $sidebar = array("class" => "shares",
                     "content" => array(array("id" => "global",
                                              "text" => _T("List shares","samba"),
                                              "link" => urlStr("samba/shares/index")),
                                        array("id" => "addShare",
                                              "text" => _T("Add a share","samba"),
                                              "link" => urlStr("samba/shares/add")),
                                        array("id" => "globalConfig",
                                              "text" => _T("General options","samba"),
                                              "link" => urlStr("samba/config/index"))
                                        ));
    
}
?>
