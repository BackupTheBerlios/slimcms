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
# File Name: stdlib.pl
# $Author: ddrees $
# $Date: 2004/10/17 09:59:42 $
# $Revision: 1.2 $
#

sub datei_lesen {

  my($src_file) = @_;
  my $datei_inhalt_tmp="";
  open(DAT,"<$src_file");
  my @lines=<DAT>;
  foreach(@lines){
    while($_=~/<%%([\$\@\&%].+?)%%>/g){$_=$`.eval($1).$'};
      $datei_inhalt_tmp .= $_;
  }
  close(DAT);
  return $datei_inhalt_tmp;

}

sub html_ausgeben {

  # add messages for user (admin area)
  $datei_inhalt=~s/###FEHLER###/$nachrichten/;
  print $datei_inhalt;
  print "\n";

}

sub decode_input {

  my $idname="";
  my $content="";
  my @couples="";
  my $tmp="";
  my $temp="";

  read(STDIN,$tmp,$ENV{'CONTENT_LENGTH'});
  if ($ENV{'QUERY_STRING'} ne "") {
    $temp = "$tmp\&$ENV{'QUERY_STRING'}";
  } else {
    $temp = "$tmp";
  }
  @couples = split(/&/,$temp);
  foreach $couple (@couples) {
    ($idname,$content) = split(/=/,$couple,2);
    $idname =~ tr/+/ /;
    $content =~ tr/+/ /;
    $content =~ s/%(..)/pack("c",hex($1))/ge;
    $content =~ s/\r\n/\n/g;
    $input{$idname} = $content;
  }

}

sub nachricht {

  my ($u_nachricht) = @_;
  $nachrichten.=$u_nachricht;
  # print messages to error.log
  # warn $nachrichten;

}

sub html_filter {

  my ($temp_var) = @_;

  # remove all HTML tags
  $temp_var =~ s/<.+?>//g;

  return $temp_var;

}

sub templates_ermitteln {

  @TEMPLATES = ();
  opendir(DIR,"$template_pfad_cgi");
  for my $datei (readdir DIR) {
    if ($datei ne "." && $datei ne "..") {
      push(@TEMPLATES, $datei) if -d $template_pfad_cgi."/".$datei;
    }
  }
  closedir(DIR);
  my @TEMPLATESSORTIERT = sort(@TEMPLATES);
  return @TEMPLATESSORTIERT;

}

sub sprachen_ermitteln {

  @SPRACHEN = ();
  my $pfad = "./lang";
  
  opendir(DIR,$pfad);
  for my $datei (readdir DIR) {
    if ($datei ne "." && $datei ne "..") {
      push(@SPRACHEN, $datei) if -d $pfad."/".$datei;
    }
  }
  closedir(DIR);
  my @SPRACHENSORTIERT = sort(@SPRACHEN);
  return @SPRACHENSORTIERT;

}

sub upload_file {

  my($src_file,$target_file) = @_;
  if (open ZIELDATEI,'>'.$target_file) {
    binmode $src_file;
    binmode ZIELDATEI;
    my $data;
    while(read $src_file,$data,1024) {
      print ZIELDATEI $data;
    }
    close ZIELDATEI;
    return 0;
   } else {
    return 1;
   }

}

#
1;