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
# File Name: adminlib.pl
# $Author: ddrees $
# $Date: 2004/10/17 09:59:42 $
# $Revision: 1.2 $
#

sub admin_template_laden {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  my($menu_aktiv) = @_;
  my $admin_template = "";
  my $zaehler = 1;

  $admin_template .= &datei_lesen("$admin_pfad_cgi/inc/admin_header.html");
  $admin_template.="###CONTENT###";
  $admin_template .= &datei_lesen("$admin_pfad_cgi/inc/admin_footer.html");

  $admin_template =~s/###CMS_ID###/$sys_cms_id/g;
  $admin_template =~s/###ADMIN_PFAD_HTML###/$admin_pfad_html/g;
  $admin_template =~s/###FOOTER###/\<a href=\"http:\/\/www.slim-cms.com\" target=\"_blank\"\>\<u\>slim-CMS ${version}\<\/u\>\<\/a\> $lang_published <a href=\"http:\/\/www.opensource.org\/licenses\/gpl-license.php\" target=\"_blank\"><u>GNU General Public License<\/u><\/a>/g;

  # set active menu (max 8 entrys)
  while ($zaehler le 8) {
    if ($zaehler eq $menu_aktiv) {
      $admin_template=~s/###CLASSMENU${zaehler}###/menu_active/;
    } else {
      $admin_template=~s/###CLASSMENU${zaehler}###/menu/;
    }
    $zaehler++;
  }

  # translate
  $admin_template =~s/###LANG_START###/$lang_start/;
  $admin_template =~s/###LANG_MAINDATA###/$lang_maindata/;
  $admin_template =~s/###LANG_BLOCKS###/$lang_blocks/;
  $admin_template =~s/###LANG_MENU###/$lang_menu/;
  $admin_template =~s/###LANG_LAYOUT###/$lang_layout/;
  $admin_template =~s/###LANG_LOGO###/$lang_logo/;

  return $admin_template;

}

sub adminstart_anzeigen {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  my $adminstart_inhalt = "";

  # load template for admin-mask
  $datei_inhalt = &admin_template_laden(1);

  $adminstart_inhalt .= &datei_lesen("./lang/${language}/lang_adminstart.html");

  $datei_inhalt =~s/###CONTENT###/$adminstart_inhalt/;

}

sub stammdaten_anzeigen {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  my $admin_action = "http://$host/cgi-bin/cms/admin.cgi";
  my $stammdaten_inhalt = "";
  my $select_html="";
  my @SPRACHEN ="";

  # load template for admin-mask
  $datei_inhalt = &admin_template_laden(2);

  $stammdaten_inhalt .= &datei_lesen("$admin_pfad_cgi/inc/stammdaten.html");

  # add formdata
  $stammdaten_inhalt=~s/###ADMIN_ACTION###/$admin_action/g;
  $stammdaten_inhalt=~s/###NAME###/$name/;
  $stammdaten_inhalt=~s/###DESCRIPTION###/$description/;
  $stammdaten_inhalt=~s/###KEYWORDS###/$keywords/;
  $stammdaten_inhalt=~s/###TITLE###/$title/;
  $stammdaten_inhalt=~s/###FUSSZEILE###/$fusszeile/;

  @SPRACHEN=&sprachen_ermitteln;
  foreach my $sprache (@SPRACHEN) {
    if ($language eq $sprache) {
      $select_html.="<option selected value=\"$sprache\">$lang{$sprache}</option>";
    } else {
      $select_html.="<option value=\"$sprache\">$lang{$sprache}</option>";
    }
  }
  $stammdaten_inhalt=~s/###LANGUAGE_SELECT###/$select_html/;


  $stammdaten_inhalt=~s/###CMS_ID###/$sys_cms_id/g;

  # translate
  $stammdaten_inhalt=~s/###LANG_MAINDATA###/$lang_maindata/;
  $stammdaten_inhalt=~s/###LANG_NAME###/$lang_name/;
  $stammdaten_inhalt=~s/###LANG_TITLE###/$lang_title/;
  $stammdaten_inhalt=~s/###LANG_SEARCHENGINES###/$lang_searchengines/;
  $stammdaten_inhalt=~s/###LANG_KEYWORDS###/$lang_keywords/;
  $stammdaten_inhalt=~s/###LANG_FOOTER###/$lang_footer/;
  $stammdaten_inhalt=~s/###LANG_LANGUAGE###/$lang_language/;
  $stammdaten_inhalt=~s/###LANG_SAVE###/$lang_save/;
  $stammdaten_inhalt=~s/###LANG_BACK###/$lang_back/;

  $datei_inhalt =~s/###CONTENT###/$stammdaten_inhalt/;

}

sub stammdaten_speichern {

  use Tie::File;

  my $zieldatei="./config/site.var";
  tie @lines, 'Tie::File', $zieldatei;
  $input{'NAME'}=&html_filter($input{'NAME'});
  $input{'TITEL'}=&html_filter($input{'TITEL'});
  $input{'DESCRIPTION'}=&html_filter($input{'DESCRIPTION'});
  $input{'KEYWORDS'}=&html_filter($input{'KEYWORDS'});
  $input{'FUSSZEILE'}=&html_filter($input{'FUSSZEILE'});
  $lines[0] = "\$name=\"$input{'NAME'}\";";
  $lines[1] = "\$title=\"$input{'TITEL'}\";";
  $lines[2] = "\$description=\"$input{'DESCRIPTION'}\";";
  $lines[3] = "\$keywords=\"$input{'KEYWORDS'}\";";
  $lines[4] = "\$fusszeile=\"$input{'FUSSZEILE'}\";";
  $lines[5] = "\$language=\"$input{'LANGUAGE'}\";";
  untie @lines;

}

sub menu_anzeigen {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  require "./config/menu.var";

  my $admin_action = "http://$host/cgi-bin/cms/admin.cgi";
  my $rubriken_inhalt = "";
  my @BAUSTEINE = ();
  my $zaehler=0;

  # load template for admin-mask
  $datei_inhalt = &admin_template_laden(4);

  $rubriken_inhalt .= &datei_lesen("$admin_pfad_cgi/inc/menu.html");

  # read selfdefined blocks in content directory
  opendir(DIR,"$content_pfad_cgi");
  for my $dateien (grep {/.html$/} sort readdir DIR) {
  push(@BAUSTEINE, $dateien);
  }
  closedir(DIR);

  while ($zaehler le 9) {
    my $select_html="";
    my $rubrik_genutzt=0;
    # list selfdefined blocks
    foreach my $baustein (@BAUSTEINE) {
      my $baustein_kurz = $baustein;
      substr($baustein_kurz,-5) = "";
      if ($rubrik_typ[$zaehler] eq $baustein) {
        $select_html.="<option selected value=\"$baustein\">$baustein_kurz</option>";
        $rubrik_genutzt=1;
      } else {
        $select_html.="<option value=\"$baustein\">$baustein_kurz</option>";
      }
    }
    # add menu "not used"
    if ($rubrik_genutzt eq 0) {
      if ($rubrik_typ[$zaehler] eq "ISOLATOR") {
        $select_html.="<option selected value=\"ISOLATOR\">$lang_isolator</option>";
        $select_html.="<option value=\"EMPTY\">$lang_not_used</option>";
      } else {
        $select_html.="<option value=\"ISOLATOR\">$lang_isolator</option>";
        $select_html.="<option selected value=\"EMPTY\">$lang_not_used</option>";
      }
    } else {
      $select_html.="<option value=\"ISOLATOR\">$lang_isolator</option>";
      $select_html.="<option value=\"EMPTY\">$lang_not_used</option>";
    }

    # insert listbox
    $rubriken_inhalt=~s/###RUBRIK${zaehler}_SELECT###/$select_html/;
    $zaehler++;
  }

  $rubriken_inhalt=~s/###ADMIN_ACTION###/$admin_action/g;

  # insert menu headlines
  $zaehler=0;
  while ($zaehler le 9) {
    $rubriken_inhalt=~s/###RUBRIK${zaehler}_TXT###/$rubrik[${zaehler}]/;
    $zaehler++;
  }

  $rubriken_inhalt=~s/###CMS_ID###/$sys_cms_id/g;

  # translate
  $rubriken_inhalt=~s/###LANG_MENU###/$lang_menu/;
  $rubriken_inhalt=~s/###LANG_BLOCK###/$lang_block/;
  $rubriken_inhalt=~s/###LANG_HEADLINE###/$lang_headline/;
  $rubriken_inhalt=~s/###LANG_STARTING_PAGE###/$lang_starting_page/;
  $rubriken_inhalt=~s/###LANG_CATEGORY###/$lang_category/g;
  $rubriken_inhalt=~s/###LANG_SAVE###/$lang_save/;
  $rubriken_inhalt=~s/###LANG_BACK###/$lang_back/;

  $datei_inhalt =~s/###CONTENT###/$rubriken_inhalt/;

}

sub menu_speichern {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  my @tmp_rubrik_typ = ();
  my @tmp_rubrik = ();
  my $zieldatei="./config/menu.var";

  $tmp_rubrik_typ[0]=$input{'RUBRIK0'};
  $tmp_rubrik_typ[1]=$input{'RUBRIK1'};
  $tmp_rubrik_typ[2]=$input{'RUBRIK2'};
  $tmp_rubrik_typ[3]=$input{'RUBRIK3'};
  $tmp_rubrik_typ[4]=$input{'RUBRIK4'};
  $tmp_rubrik_typ[5]=$input{'RUBRIK5'};
  $tmp_rubrik_typ[6]=$input{'RUBRIK6'};
  $tmp_rubrik_typ[7]=$input{'RUBRIK7'};
  $tmp_rubrik_typ[8]=$input{'RUBRIK8'};
  $tmp_rubrik_typ[9]=$input{'RUBRIK9'};
  $tmp_rubrik[0]=&html_filter($input{'RUBRIK0_TXT'});
  $tmp_rubrik[1]=&html_filter($input{'RUBRIK1_TXT'});
  $tmp_rubrik[2]=&html_filter($input{'RUBRIK2_TXT'});
  $tmp_rubrik[3]=&html_filter($input{'RUBRIK3_TXT'});
  $tmp_rubrik[4]=&html_filter($input{'RUBRIK4_TXT'});
  $tmp_rubrik[5]=&html_filter($input{'RUBRIK5_TXT'});
  $tmp_rubrik[6]=&html_filter($input{'RUBRIK6_TXT'});
  $tmp_rubrik[7]=&html_filter($input{'RUBRIK7_TXT'});
  $tmp_rubrik[8]=&html_filter($input{'RUBRIK8_TXT'});
  $tmp_rubrik[9]=&html_filter($input{'RUBRIK9_TXT'});

  for($i = 0;$i < 10;$i++) {
    if ($tmp_rubrik_typ[$i] eq "EMPTY" || $tmp_rubrik_typ[$i] eq "ISOLATOR") {
      $tmp_rubrik[$i]="";
    }
  }

  if ($tmp_rubrik_typ[9] ne "EMPTY") {
    $tmp_anz_rubriken=9;
  }
  elsif ($tmp_rubrik_typ[8] ne "EMPTY") {
    $tmp_anz_rubriken=8;
  }
  elsif ($tmp_rubrik_typ[7] ne "EMPTY") {
    $tmp_anz_rubriken=7;
  }
  elsif ($tmp_rubrik_typ[6] ne "EMPTY") {
    $tmp_anz_rubriken=6;
  }
  elsif ($tmp_rubrik_typ[5] ne "EMPTY") {
    $tmp_anz_rubriken=5;
  }
  elsif ($tmp_rubrik_typ[4] ne "EMPTY") {
    $tmp_anz_rubriken=4;
  }
  elsif ($tmp_rubrik_typ[3] ne "EMPTY") {
    $tmp_anz_rubriken=3;
  }
  elsif ($tmp_rubrik_typ[2] ne "EMPTY") {
    $tmp_anz_rubriken=2;
  }
  elsif ($tmp_rubrik_typ[1] ne "EMPTY") {
    $tmp_anz_rubriken=1;
  } else {
    $tmp_anz_rubriken=0;
  }

  if ( $tmp_anz_rubriken gt 0 && ($tmp_rubrik_typ[0] eq "EMPTY" || $tmp_rubrik_typ[0] eq "ISOLATOR")) {
    &nachricht($lang_err_005);
  } else {
    use Tie::File;
    tie @lines, 'Tie::File', $zieldatei;
    $lines[0] = "\$rubrik_typ[0]=\"$tmp_rubrik_typ[0]\";";
    $lines[1] = "\$rubrik_typ[1]=\"$tmp_rubrik_typ[1]\";";
    $lines[2] = "\$rubrik_typ[2]=\"$tmp_rubrik_typ[2]\";";
    $lines[3] = "\$rubrik_typ[3]=\"$tmp_rubrik_typ[3]\";";
    $lines[4] = "\$rubrik_typ[4]=\"$tmp_rubrik_typ[4]\";";
    $lines[5] = "\$rubrik_typ[5]=\"$tmp_rubrik_typ[5]\";";
    $lines[6] = "\$rubrik_typ[6]=\"$tmp_rubrik_typ[6]\";";
    $lines[7] = "\$rubrik_typ[7]=\"$tmp_rubrik_typ[7]\";";
    $lines[8] = "\$rubrik_typ[8]=\"$tmp_rubrik_typ[8]\";";
    $lines[9] = "\$rubrik_typ[9]=\"$tmp_rubrik_typ[9]\";";
    $lines[10] = "\$rubrik[0]=\"$tmp_rubrik[0]\";";
    $lines[11] = "\$rubrik[1]=\"$tmp_rubrik[1]\";";
    $lines[12] = "\$rubrik[2]=\"$tmp_rubrik[2]\";";
    $lines[13] = "\$rubrik[3]=\"$tmp_rubrik[3]\";";
    $lines[14] = "\$rubrik[4]=\"$tmp_rubrik[4]\";";
    $lines[15] = "\$rubrik[5]=\"$tmp_rubrik[5]\";";
    $lines[16] = "\$rubrik[6]=\"$tmp_rubrik[6]\";";
    $lines[17] = "\$rubrik[7]=\"$tmp_rubrik[7]\";";
    $lines[18] = "\$rubrik[8]=\"$tmp_rubrik[8]\";";
    $lines[19] = "\$rubrik[9]=\"$tmp_rubrik[9]\";";
    $lines[20] = "\$anz_rubriken=$tmp_anz_rubriken;";
    untie @lines;
  }

}

sub contentpflege_auswahl {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  my $contentpflege_inhalt = "";
  my $admin_action = "http://$host/cgi-bin/cms/admin.cgi";
  my $auswahl_html="";
  my @BAUSTEINE = ();

  # load template for admin-mask
  $datei_inhalt = &admin_template_laden(3);

  $contentpflege_inhalt .= &datei_lesen("$admin_pfad_cgi/inc/contentpflege_auswahl.html");

  opendir(DIR,"$content_pfad_cgi");

  for my $dateien (grep {/.html$/} sort readdir DIR) {
  push(@BAUSTEINE, $dateien);
  }
  closedir(DIR);

  foreach my $baustein (@BAUSTEINE) {
    substr($baustein,-5) = "";
    $auswahl_html .= "<tr><td align=\"right\" width=\"400\" valign=\"top\" class=\"normal\"><a href=\"http://$host/cgi-bin/cms/admin.cgi?aktion=content_anzeigen&baustein=$baustein&cms_id=###CMS_ID###\"><b>$baustein</b> $lang_edit</a></td><td align=\"left\" width=\"400\"><form name=\"loeschen_$baustein\" method=\"post\" action=\"###ADMIN_ACTION###\"><input type=\"hidden\" name=\"aktion\" value=\"baustein_loeschen\"><input type=\"hidden\" name=\"baustein\" value=\"$baustein\"><input type=\"hidden\" name=\"cms_id\" value=\"###CMS_ID###\"><input type=\"submit\" value=\"$lang_delete_block\" onclick=\"return confirmSubmit('$lang_msg_003')\"></form></td></tr>"
  }

  $contentpflege_inhalt=~s/###AUSWAHL###/$auswahl_html/;
  $contentpflege_inhalt=~s/###ADMIN_ACTION###/$admin_action/g;
  $contentpflege_inhalt=~s/###CMS_ID###/$sys_cms_id/g;

  # translate
  $contentpflege_inhalt=~s/###LANG_BLOCKS###/$lang_blocks/;
  $contentpflege_inhalt=~s/###LANG_CREATE_BLOCK###/$lang_create_block/g;
  $contentpflege_inhalt=~s/###LANG_UPLOAD_BLOCK###/$lang_upload_block/g;
  $contentpflege_inhalt=~s/###LANG_FILE###/$lang_file/;
  $contentpflege_inhalt=~s/###LANG_BACK###/$lang_back/;

  $datei_inhalt =~s/###CONTENT###/$contentpflege_inhalt/;

}

sub baustein_erstellen {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  my $bausteinname = $input{'neuer_baustein'};
  if ($bausteinname eq "") {
    &nachricht($lang_err_101);
  } else {
    if (not $bausteinname =~ /\W/) {
      if (-e "$content_pfad_cgi/$bausteinname.html") {
        &nachricht($lang_err_102);
      } else {
        if (not open (NEUEDATEI, ">$content_pfad_cgi/$bausteinname.html")) {
          &nachricht($lang_err_103);
        }
      }
    } else {
      &nachricht($lang_err_104);
    }
  }

}

sub baustein_loeschen {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  require "./config/menu.var";

  my $bausteinname = $input{'baustein'};
  my $zaehler=0;
  my $baustein_verwendet=0;

  while ($zaehler le $anz_rubriken) {
    if ($rubrik_typ[$zaehler] eq "$bausteinname.html") {
      $baustein_verwendet=1;
    }
    $zaehler++;
  }
  if ($baustein_verwendet eq 1) {
    &nachricht($lang_err_201);
  } else {
    if (not unlink "$content_pfad_cgi/$bausteinname.html") {
      &nachricht($lang_err_202);
    }
  }

}

sub baustein_hochladen {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  if ($file eq "") {
    &nachricht($lang_err_301);
  } else {
    if ($file=~/.*\.html$/i) {
      my $fname = ${content_pfad_cgi}."/".$file;
      if (-e "$fname") {
        &nachricht($lang_err_302);
      } else {
        my $upload = upload_file($file,$fname);
        if ($upload eq 0) {
          &nachricht($lang_msg_001.$file);
        } else {
          &nachricht($lang_err_303);
        }
      }
    } else {
      &nachricht($lang_err_304);
    }
  }

}

sub content_anzeigen {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  my $admin_action = "http://$host/cgi-bin/cms/admin.cgi";
  my $contentpflegen_inhalt = "";
  my $content = "";

  # load template for admin-mask
  $datei_inhalt = &admin_template_laden(3);

  $contentpflegen_inhalt .= &datei_lesen("$admin_pfad_cgi/inc/contentpflege.html");

  # read content
  $content = &datei_lesen("$content_pfad_cgi/$input{'baustein'}.html");

  $contentpflegen_inhalt=~s/###ADMIN_ACTION###/$admin_action/g;
  $contentpflegen_inhalt=~s/###BAUSTEIN###/$input{'baustein'}/g;
  $contentpflegen_inhalt=~s/###CONTENT###/$content/;
  $contentpflegen_inhalt=~s/###CMS_ID###/$sys_cms_id/g;

  # translate
  $contentpflegen_inhalt=~s/###LANG_BLOCK###/$lang_block/;
  $contentpflegen_inhalt=~s/###LANG_EDIT###/$lang_edit/;
  $contentpflegen_inhalt=~s/###LANG_SAVE###/$lang_save/;
  $contentpflegen_inhalt=~s/###LANG_BACK###/$lang_back/;

  $datei_inhalt =~s/###CONTENT###/$contentpflegen_inhalt/g;

}

sub content_speichern {

  my $zieldatei = "$content_pfad_cgi/$input{'baustein'}.html";

  open(ZIELDATEI, ">>$zieldatei");
  flock(ZIELDATEI,LOCK_EX) if ($lock == 1);
  truncate (ZIELDATEI,0);
  print ZIELDATEI "$input{'seiteninhalt'}";
  close(ZIELDATEI);

}

sub layout_anzeigen {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  my $admin_action = "http://$host/cgi-bin/cms/admin.cgi";
  my $layout_inhalt = "";
  my $virt_tabelle = "";
  my $zaehler = 0;
  my $temp_images = "";
  my $temp_radios = "";
  my @TEMPLATES = "";

  # load template for admin-mask
  $datei_inhalt = &admin_template_laden(5);

  $layout_inhalt .= &datei_lesen("$admin_pfad_cgi/inc/layoutwaehlen.html");

  @TEMPLATES=&templates_ermitteln;

  # build thumbnail view for templates
  foreach my $template (@TEMPLATES) {
    $temp_images .= "<td align=\"center\"><a href=\"javascript:ViewImage('/$template_pfad_html/$template/img/layout_big.jpg',760,500,'$lang_layout $template')\"><img src=\"/$template_pfad_html/$template/img/layout.jpg\" width=\"130\" height=\"86\" border=\"1\"></a></td>";
    if ($template_id eq $template) {
      $temp_radios .= "<td align=\"center\"><input type=\"radio\" name=\"TEMPLATE_ID\" value=\"$template\" checked></td>";
    } else {
      $temp_radios .= "<td align=\"center\"><input type=\"radio\" name=\"TEMPLATE_ID\" value=\"$template\"></td>";
    }
    $zaehler++;
    if ($zaehler eq 4) {
      $virt_tabelle .= "<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"100%\"><tr>$temp_images</tr><tr>$temp_radios</tr></table><br>";
      $zaehler = 0;
      $temp_images = "";
      $temp_radios = "";
    }
  }
  # close last table
  if ($zaehler ne 0) {
    $virt_tabelle .= "<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\" width=\"100%\"><tr>$temp_images</tr><tr>$temp_radios</tr></table><br>";
  }

  # insert content
  $layout_inhalt=~s/###ADMIN_ACTION###/$admin_action/g;
  $layout_inhalt=~s/###VIRT_TABELLE###/$virt_tabelle/;
  $layout_inhalt=~s/###CMS_ID###/$sys_cms_id/g;

  # translate
  $layout_inhalt=~s/###LANG_LAYOUT###/$lang_layout/g;
  $layout_inhalt=~s/###LANG_SAVE###/$lang_save/g;
  $layout_inhalt=~s/###LANG_BACK###/$lang_back/g;

  $datei_inhalt =~s/###CONTENT###/$layout_inhalt/;

}

sub layout_speichern {

  use Tie::File;

  my $zieldatei="./config/site.var";

  tie @lines, 'Tie::File', $zieldatei;
  $lines[6] = "\$template_id=$input{'TEMPLATE_ID'};";
  untie @lines;

}

sub logo_dialog_anzeigen {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  my $admin_action = "http://$host/cgi-bin/cms/admin.cgi";
  my $logo_inhalt = "";

  # Admintemplate laden
  $datei_inhalt = &admin_template_laden(6);

  $logo_inhalt .= &datei_lesen("$admin_pfad_cgi/inc/logoupload.html");

  $logo_inhalt=~s/###ADMIN_ACTION###/$admin_action/g;
  $logo_inhalt=~s/###CMS_ID###/$sys_cms_id/g;
  $logo_inhalt=~s/###LOGO_PFAD###/$own_pics_pfad_cgi/g;

  # translate
  $logo_inhalt=~s/###LANG_LOGO###/$lang_logo/g;
  $logo_inhalt=~s/###LANG_FILE###/$lang_file/g;
  $logo_inhalt=~s/###LANG_UPLOAD_LOGO###/$lang_upload_logo/g;
  $logo_inhalt=~s/###LANG_ACTUAL_LOGO###/$lang_actual_logo/g;
  $logo_inhalt=~s/###LANG_BACK###/$lang_back/g;

  $datei_inhalt =~s/###CONTENT###/$logo_inhalt/;

}

sub logo_hochladen {

  # personal site vars
  require "./config/site.var";
  # language file
  require "./lang/${language}/lang_admin.var";

  if ($file eq "") {
    &nachricht($lang_err_401);
  } else {
    if ($file=~/.*\.gif$/i) {
      my $fname = $own_pics_pfad_cgi.'/cms_logo.gif';
      my $upload = upload_file($file,$fname);
      if ($upload eq 0) {
        &nachricht($lang_msg_002);
      } else {
        &nachricht($lang_err_402);
      }
    } else {
      &nachricht($lang_err_403);
    }
  }

}

#
1;