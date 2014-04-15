# -*- coding: utf-8; -*-g
#
# (c) 2014 Zentyal S.L., http://www.zentyal.com
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
#

"""
MDS samba4 plugin for the MMC agent.
"""

import os
import os.path
import logging
from mmc.core.version import scmRevision
from mmc.core.audit import AuditFactory as AF
from mmc.plugins.samba4.audit import AA, PLUGIN_NAME
from mmc.plugins.samba4.config import Samba4Config
from mmc.plugins.samba4.smb_conf import SambaConf
from mmc.plugins.samba4.samba_ad import SambaAD
from mmc.plugins.samba4.helpers import shellquote
from mmc.support.mmctools import shlaunchBackground, shLaunchDeferred


logger = logging.getLogger()

VERSION = "1.0.0"
APIVERSION = "1.0.0"
REVISION = scmRevision("$Rev$")


def getVersion(): return VERSION
def getApiVersion(): return APIVERSION
def getRevision(): return REVISION

def activate():
    """
    This function define if the module "base" can be activated.
    @return: True if this module can be activated
    @rtype: boolean
    """
    config = Samba4Config("samba4")

    if config.disabled:
        logger.info("samba4 plugin disabled by configuration.")
        return False

    if not os.path.exists(config.init_script):
        logger.error(config.init_script + " does not exist")
        return False

    return True

def reloadSamba():
    r = AF().log(PLUGIN_NAME, AA.SAMBA4_RELOAD)
    shlaunchBackground(Samba4Config("samba4").init_script + ' restart')
    r.commit()
    return 0

restartSamba = reloadSamba

def purgeSamba():
    r = AF().log(PLUGIN_NAME, AA.SAMBA4_PURGE)

    def _purgeSambaConfig():
        samba = SambaConf()
        conf_files = []
        conf_files.append(shellquote(samba.smb_conf_path))
        conf_files.append(shellquote(samba.PRIVATE_DIR + '/*'))
        shlaunchBackground("rm -rf %s" % ' '.join(conf_files))

    # FIXME should we use deferred instead?
    shlaunchBackground(Samba4Config("samba4").init_script + ' stop',
                       endFunc=_purgeSambaConfig)
    r.commit()
    return True

def isSamba4Provisioned():
    """
    @return: check if Samba4 has been provisioned already
    @rtype: boolean
    """
    global_info = SambaConf().getGlobalInfo()
    if global_info["realm"] and global_info["server role"]:
        return True
    return False

def getSamba4GlobalInfo():
    """
    @return: values from [global] section in smb.conf
    @rtype: dict
    """
    return SambaConf().getGlobalInfo()

def provisionSamba(mode, netbios_domain, realm):
    r = AF().log(PLUGIN_NAME, AA.SAMBA4_PROVISION)
    if mode != 'dc':
        raise NotImplemented("We can only provision samba4 as Domain Controller")

    samba = SambaConf()
    config = samba.writeSambaConfig(mode, netbios_domain, realm)

    params = {'domain': netbios_domain, 'realm': realm, 'prefix': samba.PREFIX,
              'role': mode, 'workgroup': config['workgroup']}
    cmd = ("%(prefix)s/bin/samba-tool domain provision"
           " --domain='%(domain)s'"
           " --workgroup='%(workgroup)s'"
           " --realm='%(realm)s'"
           " --use-xattr=yes"
           " --use-rfc2307"
           " --server-role='%(role)s'" % params)

    def domain_provision_cb(sambatool):
        if sambatool.exitCode != 0:
            logger.debug("Fail executing %s, ret code %d",
                         cmd, sambatool.exitCode)
            logger.debug(sambatool.out)
            logger.debug(sambatool.err)
        return sambatool.exitCode == 0

    d = shLaunchDeferred(cmd)
    d.addCallback(domain_provision_cb)

    r.commit()
    return d

# v Shares --------------------------------------------------------------------

def getACLOnShare(name):
    if name:
        return SambaConf().getACLOnShare(name)
    else:
        return []

def getProtectedSamba4Shares():
    return ["", "homes", "netlogon", "archive", "sysvol"]

def getShares():
    return SambaConf().getDetailedShares()

def getShare(name):
    return SambaConf().getDetailedShare(name)

def addShare(name, path, comment, browseable, permAll, usergroups, users):
    samba = SambaConf()
    samba.addShare(name, path, comment, browseable, permAll, usergroups, users)
    samba.save()
    return name

def editShare(name, path, comment, browseable, permAll, usergroups, users):
    samba = SambaConf()
    samba.addShare(name, path, comment, browseable, permAll, usergroups, users,
                   mod=True)
    return samba.save()

def deleteShare(name, file):
    samba = SambaConf()
    samba.delShare(name, file)
    return samba.save()

def isAuthorizedSharePath(path):
    return not path or SambaConf().isAuthorizedSharePath(path)

# v Machines ------------------------------------------------------------------

# TODO

# v Users ---------------------------------------------------------------------

def userHasSambaAccount(username):
    return SambaAD().existsUser(username)

def updateSambaUserPassword(username, password):
    return SambaAD().changeUserPassword(username, password['scalar'],
                                        password['xmlrpc_type'])

def createSambaUser(username, password):
    return SambaAD().createUser(username, password)

def enableSambaUser(username):
    return SambaAD().enableUser(username)

def disableSambaUser(username):
    return SambaAD().disableUser(username)

def deleteSambaUser(username):
    return SambaAD().deleteUser(username)
