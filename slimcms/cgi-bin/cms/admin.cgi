#!/usr/bin/perl

# slim-CMS - an easy-to-use content management system
# Copyright (C) 2004 Daniel Drees
# For further information visit: http://www.slim-cms.com
#
# This program is free software; you can redistribute it and/or modify it under the
# terms of the GNU General Public License as published by the Free Software Foundation;
# either version 2 of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful, but WITHOUT ANY
# WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
# PARTICULAR PURPOSE. See the GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License along with
# this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
# Suite 330, Boston, MA 02111-1307 USA
#
# File Name: admin.cgi
# $Author: ddrees $
# $Date: 2004/10/21 20:25:01 $
# $Revision: 1.2 $
#

use CGI qw(:standard);
use CGI::Carp qw(fatalsToBrowser);

# global cms vars
require "./config/cms.var";
# standard library
require "./stdlib.pl";
# admin library
require "./adminlib.pl";

# Read Parameters / different behaviour for upload-requests (enctype=multipart/form_data)
my $content_type = $ENV{CONTENT_TYPE};

if (substr($content_type,0,9) eq "multipart") {
  our $cgi = new CGI;
  our $cms_id = $cgi->param("cms_id");
  our $aktion = $cgi->param("aktion");
  our $file = $cgi->param("file");
}
else {
  our $input="";
  &decode_input;
  our $aktion=$input{'aktion'};
  our $cms_id=$input{'cms_id'};
}

our $host = $ENV{HTTP_HOST};
our $lock = 1 if ($ENV{WINDIR} eq "");

###################################################################################
# begin generate
###################################################################################

our $datei_inhalt = "";
our $nachrichten = "";

our $sys_cms_id;

print "Content-type: text/html\n\n";

if ($cms_id eq $sys_cms_id) {
  if ($aktion eq "adminstart_anzeigen") {
    &adminstart_anzeigen;
  }
  elsif ($aktion eq "stammdaten_anzeigen") {
    &stammdaten_anzeigen;
  }
  elsif ($aktion eq "stammdaten_speichern") {
    &stammdaten_speichern;
    &stammdaten_anzeigen;
  }
  elsif ($aktion eq "menu_anzeigen") {
    &menu_anzeigen;
  }
  elsif ($aktion eq "menu_speichern") {
    &menu_speichern;
    &menu_anzeigen;
  }
  elsif ($aktion eq "contentpflege_auswahl") {
    &contentpflege_auswahl;
  }
  elsif ($aktion eq "content_anzeigen") {
    &content_anzeigen;
  }
  elsif ($aktion eq "baustein_erstellen") {
    &baustein_erstellen;
    &contentpflege_auswahl;
  }
  elsif ($aktion eq "baustein_loeschen") {
    &baustein_loeschen;
    &contentpflege_auswahl;
  }
  elsif ($aktion eq "baustein_hochladen") {
    &baustein_hochladen;
    &contentpflege_auswahl;
  }
  elsif ($aktion eq "content_speichern") {
    &content_speichern;
    &content_anzeigen;
  }
  elsif ($aktion eq "layout_anzeigen") {
    &layout_anzeigen;
  }
  elsif ($aktion eq "layout_speichern") {
    &layout_speichern;
    &layout_anzeigen;
  }
  elsif ($aktion eq "logo_dialog_anzeigen") {
    &logo_dialog_anzeigen;
  }
  elsif ($aktion eq "logo_hochladen") {
    &logo_hochladen;
    &logo_dialog_anzeigen;
  }
  elsif ($aktion eq "logo_anzeige_speichern") {
    &logo_anzeige_speichern;
    &logo_dialog_anzeigen;
  }
  # HTML output
  &html_ausgeben;
} else {
  print $lang_err_001;
  #warn $lang_err_001;
}
exit;

###################################################################################
# end generate
###################################################################################