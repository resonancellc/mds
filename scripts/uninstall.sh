#!/bin/bash -e

#
# (c) 2004-2007 Linbox / Free&ALter Soft, http://linbox.com
# (c) 2007-2009 Mandriva, http://www.mandriva.com
#
# $Id$
#
# This file is part of Mandriva Management Console (MMC).
#
# MMC is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# MMC is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MMC.  If not, see <http://www.gnu.org/licenses/>.

echo "MDS auto-uninstallation script"
echo
echo "WARNING: this script will erase some parts of your configuration !"
echo "         type Ctrl-C now to exit if you are not sure"
echo "         type Enter to continue"
read

PREFIX=/usr

service mmc-agent stop || true

rm -fr /etc/mmc*
rm -f /etc/init.d/mmc-agent $PREFIX/sbin/mmc-agent

rm -fr $PREFIX/lib/python2.*/site-packages/mmc
rm -fr $PREFIX/share/mmc $PREFIX/lib/mmc

echo "Uninstallation done"
exit 0
