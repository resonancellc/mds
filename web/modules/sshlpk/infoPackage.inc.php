<?php

/**
 * (c) 2004-2007 Linbox / Free&ALter Soft, http://linbox.com
 * (c) 2007-2009 Mandriva, http://www.mandriva.com
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
 * along with MMC.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once("modules/sshlpk/includes/sshlpk-xmlrpc.php");

/**
 * module declaration
 */
 
$mod = new Module("sshlpk");
$mod->setVersion("2.5.0");
$mod->setRevision('$Rev$');
$mod->setDescription(_T("LDAP Public SSH key management","sshlpk"));
$mod->setAPIVersion("0:0:0");
$mod->setPriority(600);

$mod->addACL("showsshkey", _T("Show/Hide SSH key list", "sshlpk"));
$mod->addACL("sshkeylist", _T("Manage SSH key", "sshlpk"));

$MMCApp =& MMCApp::getInstance();
$MMCApp->addModule($mod);
?>
