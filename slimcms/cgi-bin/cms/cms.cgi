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
# File Name: cms.cgi
# $Author: ddrees $
# $Date: 2004/10/17 09:59:42 $
# $Revision: 1.2 $
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
# language file
our $language;
require "./lang/${language}/lang_cms.var";

# read parameter
our $aktuelle_rubrik=param('rubrik');

###################################################################################
# begin generate
###################################################################################
print "Content-type: text/html\n\n";

our $datei_inhalt = "";
our $letzte_aenderung = "";

our $template_pfad_cgi;
our $template_id;

# read standard header
$datei_inhalt .= &datei_lesen("$template_pfad_cgi/header_std.html");

# read template
$datei_inhalt .= &datei_lesen("$template_pfad_cgi/$template_id/layout.html");

# read standard footer
$datei_inhalt .= &datei_lesen("$template_pfad_cgi/footer_std.html");

# insert content
&navigation_einfuegen;
&content_einfuegen;
&standard_fuellen;

# HTML output
&html_ausgeben;
exit;

###################################################################################
# end generate
###################################################################################

###################################################################################
# subroutines
###################################################################################

sub navigation_einfuegen {

  our @link;
  our @rubrik;
  our @rubrik_typ;
  our $anz_rubriken;

  my $navigation = "";
  my $navigation_aktiv = "";
  my $navigation_html = "";
  my $navigation_isolator = "";

  $navigation .= &datei_lesen("$template_pfad_cgi/$template_id/navigation.html");
  $navigation_aktiv .= &datei_lesen("$template_pfad_cgi/$template_id/navigation_aktiv.html");
  $navigation_isolator .= &datei_lesen("$template_pfad_cgi/$template_id/navigation_isolator.html");

  my $zaehler = 0;
  while ($zaehler <= $anz_rubriken) {
    if ($rubrik_typ[$zaehler] eq "ISOLATOR") {
      $navigation_html .= $navigation_isolator;
    } else {
      if ($zaehler eq $aktuelle_rubrik) {
        $navigation_html .= $navigation_aktiv;
      } else {
        $navigation_html .= $navigation;
      }
    }
    $navigation_html=~s/###LINK###/$link[$zaehler]/;
    $navigation_html=~s/###RUBRIK###/$rubrik[$zaehler]/;
    $zaehler++;
  }

  $datei_inhalt=~s/###NAV###/$navigation_html/;

}

sub content_einfuegen {

  use POSIX qw(strftime);

  my $content="";
  our @rubrik_typ;
  our $content_pfad_cgi;

  $content .= &datei_lesen("$content_pfad_cgi/$rubrik_typ[$aktuelle_rubrik]");

  # Letzte Aenderung ermitteln
  my $filetime = (stat("$content_pfad_cgi/$rubrik_typ[$aktuelle_rubrik]"))[9];
  $letzte_aenderung = strftime("%d.%m.%Y %X", localtime $filetime);

  $datei_inhalt=~s/###CONTENT###/$content/;

}

sub standard_fuellen {

  my $host = $ENV{HTTP_HOST};
  our $description;
  our $keywords;
  our $language;
  our $name;
  our $title;
  our $robots;
  our $css_pfad_html;
  our $img_pfad_html;
  our $own_pics_pfad_html;
  our $fusszeile;
  our @rubrik;
  our $lang_last_update;
  our $lang_printerfriendly;

  $datei_inhalt=~s/###DESCRIPTION###/$description/;
  $datei_inhalt=~s/###KEYWORDS###/$keywords/;
  $datei_inhalt=~s/###ROBOTS###/$robots/;
  $datei_inhalt=~s/###LANGUAGE###/$language/;
  $datei_inhalt=~s/###AUTHOR###/$name/;
  $datei_inhalt=~s/###PUBLISHER###/$name/;
  $datei_inhalt=~s/###COPYRIGHT###/$name/;
  $datei_inhalt=~s/###TITLE###/$title - $rubrik[$aktuelle_rubrik]/;
  $datei_inhalt=~s/###CSS_PFAD###/$css_pfad_html/;

  $datei_inhalt=~s/###FUSS###/$fusszeile/;

  $datei_inhalt=~s/###IMG_PFAD###/$img_pfad_html/g;
  $datei_inhalt=~s/###LOGO_PFAD###/$own_pics_pfad_html/;

  my $print_link = "http:\/\/$host\/cgi-bin\/cms\/cms_print.cgi?rubrik=$aktuelle_rubrik";
  my $std_fuss = "<img src=\"$img_pfad_html/hp.gif\" width=\"14\" height=\"14\" border=\"0\" alt=\"\" align=\"middle\">&nbsp;<a href=\"http://www.slim-cms.com\" target=\"_blank\">slim-cms.com</a>&nbsp;&nbsp;&nbsp;<img src=\"$img_pfad_html/last_update.gif\" width=\"14\" height=\"14\" border=\"0\" alt=\"\" align=\"middle\">&nbsp;$lang_last_update:&nbsp;$letzte_aenderung&nbsp;&nbsp;&nbsp;<img src=\"$img_pfad_html/printerfriendly.gif\" width=\"14\" height=\"14\" border=\"0\" alt=\"\" align=\"middle\">&nbsp;<a href=\"$print_link\" target=\"_blank\">$lang_printerfriendly</a>";

 $datei_inhalt=~s/###STD_FUSS###/$std_fuss/;

}