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
# File Name: cms_print.cgi
# $Author: ddrees $
# $Date: 2004/10/16 19:32:13 $
# $Revision: 1.1 $
#

use strict;
use CGI qw(:standard);
use CGI::Carp qw(fatalsToBrowser);

# standard library
require "./stdlib.pl";

###################################################################################
# set vars
###################################################################################
# personal site vars
require "./config/site.var";
# menu vars
require "./config/menu.var";
# global cms vars
require "./config/cms.var";

# read parameter
our $aktuelle_rubrik=param('rubrik');

###################################################################################
# begin generate
###################################################################################
print "Content-type: text/html\n\n";

our $datei_inhalt = "";

our @rubrik;
our $title;

$datei_inhalt .= "<html>";
$datei_inhalt .= "<head>";
$datei_inhalt .= "<link rel=\"stylesheet\" href=\"/###CSS_PFAD###/style.css\" type=\"text/css\">";
$datei_inhalt .= "<title>$title - $rubrik[$aktuelle_rubrik]</title>";
$datei_inhalt .= "</head>";
$datei_inhalt .= "<body bgcolor=\"#ffffff\">";
$datei_inhalt .= "<table width=\"600\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
$datei_inhalt .= "<tr><td>";

&content_einfuegen;
&pfade_anpassen;

$datei_inhalt .= "</td></tr>";
$datei_inhalt .= "</table>";
$datei_inhalt .= "</body>";
$datei_inhalt .= "</html>";

# HTML output
&html_ausgeben;
exit;

###################################################################################
# end generate
###################################################################################

###################################################################################
# subroutines
###################################################################################

sub content_einfuegen {

  use POSIX qw(strftime);

  my $content="";
  our $content_pfad_cgi;
  our @rubrik_typ;
  our $datei_inhalt_tmp;

  $content .= &datei_lesen("$content_pfad_cgi/$rubrik_typ[$aktuelle_rubrik]");;

  $datei_inhalt.=$content;

}

sub pfade_anpassen {

  our $css_pfad_html;

  $datei_inhalt=~s/###CSS_PFAD###/$css_pfad_html/;

}