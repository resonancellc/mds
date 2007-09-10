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

require("modules/network/includes/network-xmlrpc.inc.php");

if (isset($_POST["bconfirm"])) {
    $zone = $_POST["zone"];
    delZone($zone);
    if (!isXMLRPCError()) new NotifyWidgetSuccess(_T("The DNS zone has been deleted."));
    header("Location: main.php?module=network&submod=network&action=index");
} else {
    $zone = urldecode($_GET["zone"]);
}
?>

<p>
<?= sprintf(_T("You will delete the DNS zone %s."), "<strong>$zone</strong>"); ?>
</p>

<form action="main.php?module=network&submod=network&action=delete" method="post">
<input type="hidden" name="zone" value="<?php echo $zone; ?>" />
<input type="submit" name="bconfirm" class="btnPrimary" value="<?= _T("Delete zone"); ?>" />
<input type="submit" name="bback" class="btnSecondary" value="<?= _("Cancel"); ?>" onClick="new Effect.Fade('popup'); return false;" />
</form>
