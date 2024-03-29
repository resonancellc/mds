# (c) 2011 Mandriva, http://www.mandriva.com
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
pluginconfdir = $(sysconfdir)/mmc/plugins

if ENABLE_CONF
dist_pluginconf_DATA = mail.ini sshlpk.ini userquota.ini bulkimport.ini shorewall.ini radius.ini
nodist_pluginconf_DATA = samba.ini samba4.ini network.ini proxy.ini squid.ini
endif

EXTRA_DIST = samba.ini.in samba4.ini.in network.ini.in proxy.ini.in squid.ini.in
CLEANFILES = samba.ini samba4.ini network.ini proxy.ini squid.ini

if ENABLE_CONF_BACKUP
INSTALL += --backup=numbered
endif

edit = sed \
        -e 's|@libdir[@]|$(libdir)|g'

samba.ini: Makefile
	rm -f $@ $@.tmp
	$(MKDIR_P) $(@D)
	srcdir=''; \
	  test -f ./$@.in || srcdir=$(srcdir)/; \
	  $(edit) $${srcdir}$@.in >$@.tmp; \
	  [ -f /etc/mandriva-release ] && \
        sed -i 's!/etc/init.d/samba!/etc/rc.d/init.d/smb!g' $@.tmp && \
	    sed -i 's!ou=Computers!ou=Hosts!g' $@.tmp || echo continue;
	mv $@.tmp $@

samba4.ini: Makefile
	rm -f $@ $@.tmp
	$(MKDIR_P) $(@D)
	srcdir=''; \
	  test -f ./$@.in || srcdir=$(srcdir)/; \
	  $(edit) $${srcdir}$@.in >$@.tmp; \
	mv $@.tmp $@

network.ini: Makefile
	rm -f $@ $@.tmp
	$(MKDIR_P) $(@D)
	srcdir=''; \
	  test -f ./$@.in || srcdir=$(srcdir)/; \
	  $(edit) $${srcdir}$@.in >$@.tmp; \
      [ -f /etc/mandriva-release ] && \
	    sed -i 's!/var/run/dhcpd.pid!/var/run/dhcpd/dhcpd.pid!g' $@.tmp && \
	    sed -i 's!/etc/init.d/isc-dhcp-server!/etc/rc.d/init.d/dhcpd!g' $@.tmp && \
	    sed -i 's!/var/log/syslog!/var/log/messages!g' $@.tmp && \
	    sed -i 's!/var/lib/dhcp/dhcpd.leases!/var/lib/dhcpd/dhcpd.leases!g' $@.tmp && \
	    sed -i 's!/var/run/named/named.pid!/var/lib/named/var/run/named.pid!g' $@.tmp && \
	    sed -i 's!/etc/init.d/bind9!/etc/rc.d/init.d/named!g' $@.tmp && \
	    sed -i 's!/var/log/syslog!/var/log/messages!g' $@.tmp && \
	    sed -i 's!/etc/bind/!/var/named!g' $@.tmp && \
	    sed -i 's!^bindgroup = bind!bindgroup = named!g' $@.tmp || echo continue;
	mv $@.tmp $@

proxy.ini: Makefile
	rm -f $@ $@.tmp
	$(MKDIR_P) $(@D)
	srcdir=''; \
	  test -f ./$@.in || srcdir=$(srcdir)/; \
	  $(edit) $${srcdir}$@.in >$@.tmp; \
	  [ -f /etc/mandriva-release ] && \
	    sed -i 's!/var/lib/squidguard/db/bad.destdomainlist!/usr/share/squidGuard-1.2.0/db/bad.destdomainlist!g' $@.tmp && \
	    sed -i 's!/etc/init.d/squid!/etc/rc.d/init.d/squid!g' $@.tmp && \
	    sed -i 's!^user = proxy!user = squid!g' $@.tmp && \
	    sed -i 's!^group = proxy!user = squid!g' $@.tmp || echo continue;
	mv $@.tmp $@

squid.ini: Makefile
	rm -f $@ $@.tmp
	$(MKDIR_P) $(@D)
	srcdir=''; \
	  test -f ./$@.in || srcdir=$(srcdir)/; \
	  $(edit) $${srcdir}$@.in >$@.tmp
	  [ -f /etc/mandriva-release ] && \
	    sed -i 's!squid3!squid!g' $@.tmp && \
	    sed -i 's!/usr/bin/sarg!/usr/sbin/sarg!' $@.tmp || echo continue;
	mv $@.tmp $@
