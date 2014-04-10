<?php
/**
 * (c) 2014 Zentyal, http://www.zentyal.com
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
 *
 * Author(s):
 *   Julien Kerihuel <jkerihuel@zentyal.com>
 *   Miguel Julián <mjulian@zentyal.com>
 */

require("modules/samba4/includes/domaincontroller-xmlrpc.inc.php");
require("modules/samba4/mainSidebar.php");
require("graph/navbar.inc.php");

/* Provision has been ordered, just handle it or show the form */
if (isset($_POST["bprovision"])) {
    if (_doProvision($_POST)) {
        header("Location: " . urlStrRedirect("base/main/default"));
        exit;
    } else {
        $f = new PopupForm(_T("Provision has failed"));
        $f->addText(_T("Provision has failed, please try again or ask for support."));
        $f->addValidateButton("bconfirmerror");
        $f->display();
    }
} elseif (isset($_POST["bconfirmerror"])) {
        header("Location: " . urlStrRedirect("samba4/domaincontroller/provision"));
        exit;
} else {
    _showProvisionForm($sidemenu);
}

function _showProvisionForm($sidemenu) {
    $page = new PageGenerator(_T("Samba provisioning"));
    $page->setSideMenu($sidemenu);
    $page->display();

    $form = new ValidatingForm(array('method' => 'POST','enctype' => 'multipart/form-data'));
    $form->push(new Table());

    $tr = new TrFormElement(_T("NetBIOS domain name", "samba4"), new InputTpl("domainName"));
    $form->add($tr, array("value" => "", "required" => True));

    $tr = new TrFormElement(_T("Realm", "samba4"), new InputTpl("realm"));
    $form->add($tr, array("value" => "", "required" => True));

    $tr = new TrFormElement(_("Description"), new InputTpl("description"));
    $form->add($tr, array("value" => "", "required" => True));

    $mobile = False;
    $tr = new TrFormElement(_T("Foo de los móviles", "samba4"), new CheckboxTpl("mobile"),
                                array("tooltip" => _T("If checked, this makes tones of magic", "samba4")));
    $form->add($tr, array("value" => $mobile ? "checked" : ""));

    $form->pop();

    $form->addButton("bprovision", _("Do provision"));

    $form->pop();
    $form->display();
}

function _doProvision($_POST) {
    if (isset($_POST["domainName"])) {
        $domainName = $_POST["domainName"];
    }

    if (isset($_POST["realm"])) {
        $realm = $_POST["realm"];
    }

    if (!$domainName or !$realm) {
        return False;
    }

    return provisionSamba4($domainName, $realm);
}

?>
