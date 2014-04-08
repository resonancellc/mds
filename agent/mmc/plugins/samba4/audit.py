# -*- coding: utf-8; -*-g
#
# (c) 2014 Zentyal S.L., http://www.zentyal.com
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
#
# Author(s):
#   Julien Kerihuel <jkerihuel@zentyal.com>
#

"""
Constants for the audit framework and the SAMBA4 plugin.
"""

from mmc.plugins.base.audit import AT

PLUGIN_NAME=u'MMC-SAMBA4'

class AuditActions:
    SAMBA_RESTART_S4=u'SAMBA_RESTART_S4'
    SAMBA_RELOAD_S4=u'SAMBA_RELOAD_S4'
    SAMBA_PURGE_S4=u'SAMBA_PURGE_S4'

AA = AuditActions

class AuditTypes(AT):
    DOMAIN=u'DOMAIN'

AT = AuditTypes
