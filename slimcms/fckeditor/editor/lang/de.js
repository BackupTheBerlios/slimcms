/*
 * FCKeditor - The text editor for internet
 * Copyright (C) 2003-2004 Frederico Caldeira Knabben
 *
 * Licensed under the terms of the GNU Lesser General Public License
 * (http://www.opensource.org/licenses/lgpl-license.php)
 *
 * For further information go to http://www.fredck.com/FCKeditor/ 
 * or contact fckeditor@fredck.com.
 *
 * de.js: German support.
 *
 * Authors:
 *   Hendrik Kramer (HK@lwd.de)
 * Converted for version 2
 *   Andreas Kansok (socke@phpay.de)
*/
var FCKLang =
{
// Language direction : "ltr" (left to right) or "rtl" (right to left).
"Dir"				: "ltr",

// Toolbar Items and Context Menu
"Cut"			: "Ausschneiden" ,
"Copy"			: "Kopieren" ,
"Paste"			: "Einf&uuml;gen" ,
"PasteText"		: "Einf&uuml;gen als unformatierten Text" ,
"PasteWord"		: "Einf&uuml;gen aus Word" ,
"Find"			: "Suchen" ,
"Replace"			: "Ersetzen" ,
"SelectAll"		: "Alles markieren" ,
"RemoveFormat"		: "Formatierung entfernen" ,
"InsertLink"		: "Link einf&uuml;gen/bearbeiten" ,
"RemoveLink"		: "Link entfernen" ,
"Anchor"			: "Sprungmarke einf&uuml;gen/bearbeiten" ,
"InsertImage"		: "Bild einf&uuml;gen/bearbeiten" ,
"InsertTable"		: "Tabelle einf&uuml;gen/bearbeiten" ,
"InsertLine"		: "Horizontale Linie einf&uuml;gen" ,
"InsertSpecialChar"	: "Sonderzeichen einf&uuml;gen" ,
"InsertSmiley"		: "Smiley einf&uuml;gen" ,
"UniversalKeyboard"	: "Universal Tastatur" ,
"About"			: "&Uuml;ber FCKeditor" ,

"Bold"			: "Fett (STRG+B)" ,
"Italic"			: "Kursiv (STRG+I)" ,
"Underline"		: "Unterstrichen (STRG+U)" ,
"StrikeThrough"		: "Durchgestrichen" ,
"Subscript"		: "Tiefgestellt" ,
"Superscript"		: "Hochgestellt" ,
"LeftJustify"		: "Linksb&uuml;ndig" ,
"CenterJustify"		: "Zentriert" ,
"RightJustify"		: "Rechtsb&uuml;ndig" ,
"BlockJustify"		: "Blocksatz" ,
"DecreaseIndent"		: "Einzug verkleinern" ,
"IncreaseIndent"		: "Einzug vergr&ouml;&szlig;rn" ,
"Undo"			: "R&uuml;ckg&auml;ngig (STRG+Z)" ,
"Redo"			: "Wiederherstellen (STRG+Y)" ,
"NumberedList"		: "Nummerierung" ,
"BulletedList"		: "Aufz&auml;hlungszeichen" ,

"ShowTableBorders"	: "Tabelle mit Gitternetzlinien anzeigen" ,
"ShowDetails"		: "Details anzeigen" ,
"NewPage"			: "Neue Seite" ,
"Preview"			: "Vorschau" ,
"Print"			: "Drucken" ,
"Save"			: "Speichern" ,
"Zoom"			: "Zoom" ,
"SpellCheck"		: "Rechtschreibpr&uuml;fung" ,

"FontStyle"		: "Stil" ,
"FontFormat"		: "Format" ,
"Font"			: "Schriftart" ,
"FontSize"		: "Gr&ouml;&szlig;e" ,
"FontStyleAdv"		: "Erweiterter Schriftstil" ,
"TextColor"		: "Textfarbe" ,
"BGColor"			: "Hintergrundfarbe" ,
"Source"			: "HTML" ,

"Form"			: "Formular" ,
"Checkbox"		: "Ankreuzfeld" ,
"RadioButton"		: "Optionsfeld" ,
"TextField"		: "Textfeld" ,
"Textarea"		: "Textbereich" ,
"HiddenField"		: "Verstecktes Feld" ,
"Button"			: "Schaltfl&auml;che" ,
"SelectionField"		: "Auswahlliste" ,
"ImageButton"		: "Bild Schaltfl&auml;che" ,

// Context Menu
"EditLink"		: "Link bearbeiten" ,
"InsertRow"		: "Zeile einf&uuml;gen" ,
"DeleteRows"		: "Zeilen entfernen" ,
"InsertColumn"		: "Spalte einf&uuml;gen" ,
"DeleteColumns"		: "Spalten entfernen" ,
"InsertCell"		: "Zelle einf&uuml;gen" ,
"DeleteCells"		: "Zelle entfernen" ,
"MergeCells"		: "Zellen verbinden" ,
"SplitCell"		: "Zelle aufteilen" ,
"CellProperties"		: "Zelleigenschaften" ,
"TableProperties"		: "Tabelleneigenschaften" ,
"ImageProperties"		: "Grafik formatieren" ,
"AnchorProperties"	: "Sprungmarke bearbeiten" ,
"ButtonProperties"	: "Schaltfl&auml;che bearbeiten" ,
"CheckboxProperties"	: "Ankreuzfeld bearbeiten" ,
"HiddenFieldProperties"	: "Verstecktes Feld bearbeiten" ,
"RadioButtonProperties"	: "Optionsfeld bearbeiten" ,
"ImageButtonProperties"	: "Bild Schaltfl&auml;che bearbeiten" ,
"FieldProperties"		: "Feld bearbeiten" ,
"SelectionFieldProperties": "Auswahlliste bearbeiten" ,
"TextareaProperties"	: "Textbereich bearbeiten" ,
"FormProperties"		: "Eigenschaften des Formulars" ,

// Alerts and Messages
"ProcessingXHTML"		: "Bearbeite XHTML. Bitte warten..." ,
"Done"			: "Fertig" ,
"PasteWordConfirm"	: "Der einzuf&uuml;gende Text scheint aus Microsoft Word zu stammen. M&ouml;chten Sie ihn vor dem Einf&uuml;gen bereinigen lassen?" ,
"NotCompatiblePaste"	: "Dieser Befehl ist nur f&uuml;r den Internet Explorer Version 5.5 oder h&ouml;her verf&uuml;gbar. M&ouml;chten Sie den Text ohne vorherige Bereinigung einf&uuml;gen?" ,
"NoSpellCheck"		: "Die Rechtschreibpr&uuml;fung konnte auf diesem Computer nicht ausgef&uuml;hrt werden." ,
"DownloadSpellChecker"	: "Die Rechtschreibpr&uuml;fung ist nicht installiert. M&ouml;chten Sie diese Funktion jetzt herunterladen?" ,
"SpellCheckFinished"	: "Die Rechtschreibpr&uuml;fung ist abgeschlossen." ,

// Dialogs
"DlgBtnOK"		: "OK" ,
"DlgBtnCancel"		: "Abbrechen" ,
"DlgBtnClose"		: "Schlie&szlig;en" ,
"DlgStyle"		: "Stil" ,

// Image Dialog
"DlgImgTitleInsert"	: "Bild einf&uuml;gen" ,
"DlgImgTitleEdit"		: "Bild bearbeiten" ,
"DlgImgBtnUpload"		: "Zum Server senden" ,
"DlgImgURL"		: "URL" ,
"DlgImgUpload"		: "Neues Bild" ,
"DlgImgBtnBrowse"		: "Bildkatalog" ,
"DlgImgAlt"		: "Alternativer Text" ,
"DlgImgWidth"		: "Breite" ,
"DlgImgHeight"		: "H&ouml;he" ,
"DlgImgLockRatio"		: "Verh&auml;ltnis beachten" ,
"DlgBtnResetSize"		: "Auf Originalgr&ouml;&szlig; zur&uuml;cksetzen" ,
"DlgImgBorder"		: "Rahmenbreite" ,
"DlgImgHSpace"		: "Horiz. Abstand" ,
"DlgImgVSpace"		: "Vert. Abstand" ,
"DlgImgAlign"		: "Ausrichtung" ,
"DlgImgAlignLeft"		: "Links" ,
"DlgImgAlignAbsBottom"	: "Absolut unten" ,
"DlgImgAlignAbsMiddle"	: "Absolut mittig" ,
"DlgImgAlignBaseline"	: "Grundlinie" ,
"DlgImgAlignBottom"	: "Unten" ,
"DlgImgAlignMiddle"	: "Mittig" ,
"DlgImgAlignRight"	: "Rechts" ,
"DlgImgAlignTextTop"	: "Text Oben" ,
"DlgImgAlignTop"		: "Oben" ,
"DlgImgPreview"		: "Vorschau" ,
"DlgImgMsgWrongExt"	: "Es sind nur folgende Dateitypen erlaubt:\n\n" + FCKConfig.ImageUploadAllowedExtensions + "\n\nBefehl abgebrochen." ,
"DlgImgAlertSelect"	: "Bitte w&auml;hlen Sie ein bereitzustellendes Bild aus.",

// Link Dialog
"DlgLnkWindowTitle"	: "Link" ,
"DlgLnkURL"		: "URL" ,
"DlgLnkUpload"		: "Upload" ,
"DlgLnkTarget"		: "Ziel" ,
"DlgLnkTargetNotSet"	: "<Standard>" ,
"DlgLnkTargetBlank"	: "Neues Fenster (_blank)" ,
"DlgLnkTargetParent"	: "Stammfenster (_parent)" ,
"DlgLnkTargetSelf"	: "Gleiches Fenster (_self)" ,
"DlgLnkTargetTop"		: "Oberstes Fenster (_top)" ,
"DlgLnkTitle"		: "Titel" ,
"DlgLnkBtnUpload"		: "Zum Server senden" ,
"DlgLnkBtnBrowse"		: "Auf Server suchen" ,
"DlgLnkMsgWrongExtA"	: "Es sind nur folgende Dateitypen erlaubt:\n\n" + FCKConfig.LinkUploadAllowedExtensions + "\n\nBefehl abgebrochen." ,
"DlgLnkMsgWrongExtD"	: "Folgende Dateitypen sind nicht erlaubt:\n\n" + FCKConfig.LinkUploadDeniedExtensions + "\n\nBefehl abgebrochen." ,

// Color Dialog
"DlgColorTitle"		: "Farbe ausw&auml;hlen" ,
"DlgColorBtnClear"	: "L&ouml;schen" ,
"DlgColorHighlight"	: "Aktuell" ,
"DlgColorSelected"	: "Ausgew&auml;hlt" ,

// Smiley Dialog
"DlgSmileyTitle"		: "Smiley einf&uuml;gen" ,

// Special Character Dialog
"DlgSpecialCharTitle"	: "Sonderzeichen einf&uuml;gen" ,

// Table Dialog
"DlgTableTitleInsert"	: "Tabelle einf&uuml;gen" ,
"DlgTableTitleEdit"	: "Tabelle bearbeiten" ,
"DlgTableRows"		: "Zeilen" ,
"DlgTableColumns"		: "Spalten" ,
"DlgTableBorder"		: "Rahmenbreite" ,
"DlgTableAlign"		: "Ausrichtung" ,
"DlgTableAlignNotSet"	: "<Standard>" ,
"DlgTableAlignLeft"	: "Links" ,
"DlgTableAlignCenter"	: "Zentriert" ,
"DlgTableAlignRight"	: "Rechts" ,
"DlgTableWidth"		: "Breite" ,
"DlgTableWidthPx"		: "Pixel" ,
"DlgTableWidthPc"		: "Prozent" ,
"DlgTableHeight"		: "H&ouml;he" ,
"DlgTableCellSpace"	: "Zellenabstand" ,
"DlgTableCellPad"		: "Zellauff&uuml;llung" ,
"DlgTableCaption"		: "&Uuml;berschrift" ,

// Table Cell Dialog
"DlgCellTitle"		: "Zelleneigenschaften" ,
"DlgCellWidth"		: "Breite" ,
"DlgCellWidthPx"		: "Pixel" ,
"DlgCellWidthPc"		: "Prozent" ,
"DlgCellHeight"		: "H&ouml;he" ,
"DlgCellWordWrap"		: "Wortumbruch" ,
"DlgCellWordWrapNotSet"	: "<Standard>" ,
"DlgCellWordWrapYes"	: "Ja" ,
"DlgCellWordWrapNo"	: "Nein" ,
"DlgCellHorAlign"		: "Horiz. Ausrichtung" ,
"DlgCellHorAlignNotSet"	: "<Standard>" ,
"DlgCellHorAlignLeft"	: "Links" ,
"DlgCellHorAlignCenter"	: "Zentriert" ,
"DlgCellHorAlignRight"	: "Rechts" ,
"DlgCellVerAlign"		: "Vertik. Ausrichtung" ,
"DlgCellVerAlignNotSet"	: "<Standard>" ,
"DlgCellVerAlignTop"	: "Oben" ,
"DlgCellVerAlignMiddle"	: "Mittig" ,
"DlgCellVerAlignBottom"	: "Unten" ,
"DlgCellVerAlignBaseline"	: "Grundlinie" ,
"DlgCellRowSpan"		: "Zeilenerstreckung" ,
"DlgCellCollSpan"		: "Spaltenerstreckung" ,
"DlgCellBackColor"	: "Hintergrundfarbe" ,
"DlgCellBorderColor"	: "Rahmenfarbe" ,
"DlgCellBtnSelect"	: "Ausw&auml;hlen..." ,

// About Dialog
"DlgAboutVersion"		: "Version" ,
"DlgAboutLicense"		: "Lizensiert unter den Bedingungen der GNU Lesser General Public License" ,
"DlgAboutInfo"		: "Weitere Informationen erhalten Sie unter" ,

// Anchor Dialog
"DlgAnchorTitle"		: "Sprungmarke bearbeiten" ,
"DlgAnchorName"		: "Name der Sprungmarke" ,

// Replace Dialog
"DlgReplaceTitle"		: "Ersetzen" ,
"DlgReplaceFindLbl"	: "Suchen nach:" ,
"DlgReplaceReplaceLbl"	: "Ersetzen mit:" ,
"DlgReplaceCaseChk"	: "Gro&szlig;/Kleinschreibung beachten" ,
"DlgReplaceReplaceBtn"	: "Ersetzen" ,
"DlgReplaceReplAllBtn"	: "Alle ersetzen" ,

// Universal Keyboard Dialog
"DlgUniversalKeyTitle"	: "Universal Tastatur" ,

// Button Dialog
"DlgButtonText"		: "Beschriftung" ,
"DlgButtonType"		: "Typ" ,

// Checkbox and Radio Button Dialogs
"DlgCheckboxName"		: "Name" ,
"DlgCheckboxValue"	: "Wert" ,
"DlgCheckboxSelected"	: "Ausgew&auml;hlt" ,

// Form Dialog
"DlgFormName"		: "Name" ,
"DlgFormAction"		: "Aktion" ,
"DlgFormMethod"		: "Methode" ,

// Select Field Dialog
"DlgSelectName"		: "Name" ,
"DlgSelectValue"		: "Wert" ,
"DlgSelectSize"		: "Gr&ouml;&szlig;e" ,
"DlgSelectLines"		: "Zeilen" ,
"DlgSelectChkMulti"	: "Mehrfachauswahl erlauben" ,
"DlgSelectOpAvail"	: "Verf&uuml;gbare Optionen" ,
"DlgSelectOpText"		: "Text" ,
"DlgSelectOpValue"	: "Wert" ,
"DlgSelectBtnAdd"		: "Hinzuf&uuml;gen" ,
"DlgSelectBtnModify"	: "&Auml;ndern" ,
"DlgSelectBtnUp"		: "H&ouml;her" ,
"DlgSelectBtnDown"	: "Tiefer" ,
"DlgSelectBtnSetValue"	: "Als Vorgabewert setzen" ,
"DlgSelectBtnDelete"	: "L&ouml;schen" ,

// Textarea Dialog
"DlgTextareaName"		: "Name" ,
"DlgTextareaCols"		: "Spalten" ,
"DlgTextareaRows"		: "Zeilen" ,

// Text Field Dialog
"DlgTextName"		: "Name" ,
"DlgTextValue"		: "Wert" ,
"DlgTextCharWidth"	: "Gr&ouml;&szlig;e" ,
"DlgTextMaxChars"		: "Max. L&auml;nge" ,
"DlgTextType"		: "Typ" ,
"DlgTextTypeText"		: "Text" ,
"DlgTextTypePass"		: "Passwort" ,

// Hidden Field Dialog
"DlgHiddenName"		: "Name" ,
"DlgHiddenValue"		: "Wert"
}