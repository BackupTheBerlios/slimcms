<!-- slim-CMS - an easy-to-use content management system -->
<!-- Copyright (C) 2004 Daniel Drees -->
<!-- For further information visit: http://www.slim-cms.com -->

<!-- This program is free software; you can redistribute it and/or modify it under the -->
<!-- terms of the GNU General Public License as published by the Free Software Foundation; -->
<!-- either version 2 of the License, or (at your option) any later version. -->

<!-- This program is distributed in the hope that it will be useful, but WITHOUT ANY -->
<!-- WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A -->
<!-- PARTICULAR PURPOSE. See the GNU General Public License for more details. -->

<!-- You should have received a copy of the GNU General Public License along with -->
<!-- this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, -->
<!-- Suite 330, Boston, MA 02111-1307 USA -->

<!-- File Name: javalib.js -->
<!-- $Author: ddrees $ -->
<!-- $Date: 2004/10/16 19:32:13 $ -->
<!-- $Revision: 1.1 $ -->

function confirmSubmit(question)
{
var agree=confirm(question);
if (agree)
        return true ;
else
        return false ;
}

<!-- Original:  Anders Jennerberg (anders@katedral.se)  -->
<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->
function ViewImage(ifile,ix,iy,ititle) {
  var win;
  var sWidth;
  var sHeight;
  var NS = (document.layers) ? 1 : 0;
  win = window.open("","imageviewer","width="+ix+",height="+iy+",menubar=no,toolbar=no");
  if (NS) {
    sWidth = win.innerWidth;
    sHeight = win.innerHeight;
  } else {
    sWidth = win.document.body.clientWidth;
    sHeight = win.document.body.clientHeight;
  }
  if(sWidth!=ix || sHeight!=iy) {
   win.close();
   setTimeout("ViewImage('"+ifile+"',"+ix+","+iy+",'"+ititle+"')", 250);
   return;
  }
  win.document.open();
  win.focus();
  win.document.write("<html><head><title>"+ititle+"</title>");
  win.document.write("</head><body bgcolor=#ffffff>");
  win.document.write('<div style="position:absolute;width:'+ix+'px;height:'+iy+'px;left:0px;top:0px">');
  win.document.write("<img src="+ifile+"></div></body></html>");
  win.document.close();
}