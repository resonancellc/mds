# (c) 2011 Mandriva, http://www.mandriva.com
#
# $Id$
#
# This file is part of Management Console.
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
#
# Author(s):
#   Jean Parpaillon <jparpaillon@mandriva.com>
#
pythonmodules = plugins.samba4 plugins.samba4.templates \
	plugins.samba plugins.mail plugins.network \
	plugins.proxy plugins.sshlpk plugins.bulkimport \
	plugins.userquota plugins.shorewall plugins.squid \
	plugins.radius

# Expands Python modules list with found *.py files in each module given in pythonmodules
mmcpythondir = $(pythondir)/$(notdir $(realpath $(srcdir)))
nobase_mmcpython_PYTHON = $(wildcard $(patsubst %, $(srcdir)/%/*.*, $(subst .,/,$(pythonmodules))))
