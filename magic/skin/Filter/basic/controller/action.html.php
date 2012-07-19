<?php if(!defined("__MAGIC__")) exit; 
/*
 * action파일
 * action.*.php 파일은 Alert을 호출하지 않고 단순한 하나의 행동을하고
 * 결과 값을 알려준다.
 * $result에 결과값을 저장해 줌
 * --------------------------
 * POST로 넘어온 변수는 addslashes를 하고 넘어오기 때문에 제거해준다.
 */

if (!defined('HTMLFILTER_LIB')) {
define('HTMLFILTER_LIB', 1);
/*
HTMLFilter 1.0 - HTML/XHTML filter
----------------------------------
against XSS(Cross Site Scripting) & CSRF(Cross-site request forgery)
Copyright (C) 2008-2009  Jacob Lee

This program is free software and open source software; you can redistribute
it and/or modify it under the terms of the GNU General Public License as
published by the Free Software Foundation; either version 2 of the License,
or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
59 Temple Place, Suite 330, Boston, MA  02111-1307  USA  or visit
http://www.gnu.org/licenses/gpl.html

*** AUTHOR INFORMATION ***

E-mail:      letsgolee at lycos dot co dot kr
*/

/*
HTMLFilter Configuration File

Short Manual:
-------------

$block_url_syntax
	* type: array
	* contains URL syntaxes that you want to prohibit.

$tags
	* type: array
	* contains all the information about HTML tags or nodeName
	* set false not to be used or banned.

$tag_attributes
	* type: array
	* contains all the information about attributes.
*/
class HTMLFilterConfig
{
	var $block_url_syntax = array
	(
		/* '/hacker\.com/i' */
		/* '/'.preg_quote(gethostbyname('hacker.com')).'/' */
		/* '/'.preg_quote($base_url).'\/adm\/[a-z]+\.php/i' */
	);

	//var $css_syntax = "/^([a-z0-9#\.\,\-\*가-힣ㄱ-ㅎㅏ-ㅣ\x20 ]+)$/i";
	// 2010.01.08/똥싼너구리 rgb() 속성이 적용되지 못해서 () 추가..
	var $css_syntax = '/^([()a-z0-9#\!\.\,\-\*가-힣ㄱ-ㅎㅏ-ㅣ\t ]+)$/i';

	// attributes that need URL filtering
	// <img style="background-image:url('http://hackers.site.net')" />
	var $attributes_need_url_filtering = array(
		'background-image',
		'background',
		'-moz-binding',
		'behavior',
		'list-style-image'
	);

	// <a href="javascript:alert('XSS')">
	var $script_types = array(
		'javascript:',
		'behavior:',
		'vbscript:',
		'mocha:',
		'livescript:'
	);

	// object tag security issues
	var $object_security = array(
		// 'name'=>'default value'
		'invokeurls'=>'false',
		'autostart'=>'false',
		'allowscriptaccess'=>'never',
		'allownetworking'=>'internal',
		'enablecontextmenu'=>'false'
	);

	var $tags = array
	(
		'!doctype' => false,
		'a' => true,
		'abbr' => true,
		'acronym' => true,
		'address' => true,
		'applet' => true,
		'area' => true,
		'b' => true,
		'base' => true,
		'basefont' => true,
		'bdo' => true,
		'bgsound' => true,
		'big' => true,
		'blink' => true,
		'blockquote' => true,
		'body' => false,
		'br' => true,
		'button' => false,
		'caption' => true,
		'center' => true,
		'cite' => true,
		'code' => true,
		'col' => true,
		'colgroup' => true,
		'comment' => false,
		'dd' => true,
		'del' => true,
		'dfn' => true,
		'dir' => true,
		'div' => true,
		'dl' => true,
		'dt' => true,
		'em' => true,
		'embed' => true,
		'fieldset' => true,
		'font' => true,
		'form' => false,
		'frame' => false,
		'frameset' => false,
		'h1' => true,
		'h2' => true,
		'h3' => true,
		'h4' => true,
		'h5' => true,
		'h6' => true,
		'head' => false,
		'hr' => true,
		'html' => false,
		'i' => true,
		'iframe' => false,
		'img' => true,
		'input' => false,
		'ins' => true,
		'isindex' => true,
		'kbd' => true,
		'label' => true,
		'legend' => true,
		'li' => true,
		'listing' => false,
		'link' => false,
		'map' => true,
		'marquee' => true,
		'menu' => false,
		'meta' => false,
		'multicol' => true,
		'nobr' => true,
		'noframes' => false,
		'noscript' => false,
		'object' => true,
		'ol' => true,
		'optgroup' => true,
		'option' => false,
		'p' => true,
		'param' => true,
		'plaintext' => true,
		'pre' => true,
		'q' => true,
		's' => true,
		'samp' => true,
		'script' => false,
		'select' => false,
		'server' => true,
		'small' => true,
		'sound'=> true,
		'spacer' => false,
		'span' => true,
		'strike' => true,
		'strong' => true,
		'style' => false,
		'sub' => true,
		'sup' => true,
		'table' => true,
		'tbody' => true,
		'td' => true,
		'textarea' => true,
		'textflow' => true,
		'tfoot' => true,
		'th' => true,
		'thead' => true,
		'title' => false,
		'tr' => true,
		'tt' => true,
		'u' => true,
		'ul' => true,
		'var' => true,
		'wbr' => true,
		'xmp' => true
	);

	var $tag_attributes = array
	(
		'!doctype' => array
		(

		),
		'a' => array
		(
			'accesskey' => true,
			'charset' => true,
			'class' => true,
			'coords' => true,
			'dir' => true,
			'href' => true,
			'hreflang' => true,
			'id' => true,
			'lang' => true,
			'name' => true,
			'onblur' => false,
			'onclick' => false,
			'ondblclick' => false,
			'onfocus' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'rel' => true,
			'rev' => true,
			'shape' => true,
			'style' => true,
			'tabindex' => true,
			'target' => true,
			'title' => true,
			'type' => true
		),
		'abbr' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'acronym' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'address' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'applet' => array
		(
			'align' => true,
			'alt' => true,
			'archive' => true,
			'class' => true,
			'code' => true,
			'codebase' => true,
			'height' => true,
			'hspace' => true,
			'id' => true,
			'name' => true,
			'object' => true,
			'style' => true,
			'title' => true,
			'vspace' => true,
			'width' => true
		),
		'area' => array
		(
			'accesskey' => true,
			'alt' => true,
			'class' => true,
			'coords' => true,
			'dir' => true,
			'href' => true,
			'id' => true,
			'lang' => true,
			'nohref' => true,
			'onblur' => false,
			'onclick' => false,
			'ondblclick' => false,
			'onfocus' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'shape' => true,
			'style' => true,
			'tabindex' => true,
			'target' => true,
			'title' => true
		),
		'b' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'base' => array
		(
			'href' => true,
			'target' => true
		),
		'basefont' => array
		(
			'color' => true,
			'face' => true,
			'id' => true,
			'size' => true
		),
		'bdo' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'style' => true,
			'title' => true
		),
		'big' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'blockquote' => array
		(
			'cite' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'body' => array
		(
			'alink' => true,
			'background' => true,
			'bgcolor' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'link' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onload' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'onunload' => false,
			'style' => true,
			'text' => true,
			'title' => true,
			'vlink' => true
		),
		'br' => array
		(
			'class' => true,
			'clear' => true,
			'id' => true,
			'style' => true,
			'title' => true
		),
		'button' => array
		(
			'accesskey' => true,
			'class' => true,
			'dir' => true,
			'disabled' => true,
			'id' => true,
			'lang' => true,
			'name' => true,
			'onblur' => false,
			'onclick' => false,
			'ondblclick' => false,
			'onfocus' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'tabindex' => true,
			'title' => true,
			'type' => true,
			'value' => true
		),
		'caption' => array
		(
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'center' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'cite' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'code' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'col' => array
		(
			'align' => true,
			'char' => true,
			'charoff' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'span' => true,
			'style' => true,
			'title' => true,
			'valign' => true,
			'width' => true
		),
		'colgroup' => array
		(
			'align' => true,
			'char' => true,
			'charoff' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'span' => true,
			'style' => true,
			'title' => true,
			'valign' => true,
			'width' => true
		),
		'dd' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'del' => array
		(
			'cite' => true,
			'class' => true,
			'datetime' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'dfn' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'dir' => array
		(
			'class' => true,
			'compact' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'div' => array
		(
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'dl' => array
		(
			'class' => true,
			'compact' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'dt' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'em' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'embed' => array
		(
			'height' => true,
			'pluginspage' => true,
			'quality' => true,
			'src' => true,
			'type' => true,
			'width' => true,
			'allowscriptaccess' => false
		),
		'fieldset' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'font' => array
		(
			'class' => true,
			'color' => true,
			'dir' => true,
			'face' => true,
			'id' => true,
			'lang' => true,
			'size' => true,
			'style' => true,
			'title' => true
		),
		'form' => array
		(
			'accept' => true,
			'accept-charset' => true,
			'action' => true,
			'class' => true,
			'dir' => true,
			'enctype' => true,
			'id' => true,
			'lang' => true,
			'method' => true,
			'name' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'onreset' => false,
			'onsubmit' => false,
			'style' => true,
			'target' => true,
			'title' => true
		),
		'frame' => array
		(
			'class' => true,
			'frameborder' => true,
			'id' => true,
			'longdesc' => true,
			'marginheight' => true,
			'marginwidth' => true,
			'name' => true,
			'noresize' => true,
			'scrolling' => true,
			'src' => true,
			'style' => true,
			'title' => true
		),
		'frameset' => array
		(
			'class' => true,
			'cols' => true,
			'id' => true,
			'onload' => false,
			'onunload' => false,
			'rows' => true,
			'style' => true,
			'title' => true
		),
		'h1' => array
		(
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'h2' => array
		(
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'h3' => array
		(
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'h4' => array
		(
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'h5' => array
		(
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'h6' => array
		(
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'head' => array
		(
			'dir' => true,
			'lang' => true,
			'profile' => true
		),
		'hr' => array
		(
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'noshade' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'size' => true,
			'style' => true,
			'title' => true,
			'width' => true
		),
		'html' => array
		(
			'dir' => true,
			'lang' => true,
			'version' => true
		),
		'i' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'iframe' => array
		(
			'align' => true,
			'class' => true,
			'frameborder' => true,
			'height' => true,
			'id' => true,
			'longdesc' => true,
			'marginheight' => true,
			'marginwidth' => true,
			'name' => true,
			'scrolling' => true,
			'src' => true,
			'style' => true,
			'title' => true,
			'width' => true
		),
		'img' => array
		(
			'align' => true,
			'alt' => true,
			'border' => true,
			'class' => true,
			'dir' => true,
			'dynsrc' => true,
			'height' => true,
			'hspace' => true,
			'id' => true,
			'ismap' => true,
			'lang' => true,
			'longdesc' => true,
			'lowsrc' => true,
			'name' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'src' => true,
			'style' => true,
			'title' => true,
			'usemap' => true,
			'vspace' => true,
			'width' => true
		),
		'input' => array
		(
			'accept' => true,
			'accesskey' => true,
			'align' => true,
			'alt' => true,
			'checked' => true,
			'class' => true,
			'dir' => true,
			'disabled' => true,
			'id' => true,
			'ismap' => true,
			'lang' => true,
			'maxlength' => true,
			'name' => true,
			'onblur' => false,
			'onchange' => false,
			'onclick' => false,
			'ondblclick' => false,
			'onfocus' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'onselect' => false,
			'readonly' => true,
			'size' => true,
			'src' => true,
			'style' => true,
			'tabindex' => true,
			'title' => true,
			'type' => true,
			'usemap' => true,
			'value' => true
		),
		'ins' => array
		(
			'cite' => true,
			'class' => true,
			'datetime' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'isindex' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'prompt' => true,
			'style' => true,
			'title' => true
		),
		'kbd' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'label' => array
		(
			'accesskey' => true,
			'class' => true,
			'dir' => true,
			'for' => true,
			'id' => true,
			'lang' => true,
			'onblur' => false,
			'onclick' => false,
			'ondblclick' => false,
			'onfocus' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'legend' => array
		(
			'accesskey' => true,
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'li' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true,
			'type' => true,
			'value' => true
		),
		'link' => array
		(
			'charset' => true,
			'class' => true,
			'dir' => true,
			'href' => true,
			'hreflang' => true,
			'id' => true,
			'lang' => true,
			'media' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'rel' => true,
			'rev' => true,
			'style' => true,
			'target' => true,
			'title' => true,
			'type' => true
		),
		'map' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'name' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'menu' => array
		(
			'class' => true,
			'compact' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'meta' => array
		(
			'content' => true,
			'dir' => true,
			'http-equiv' => true,
			'lang' => true,
			'name' => true,
			'scheme' => true
		),
		'noframes' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'noscript' => array
		(
/*			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
*/
		),
		'object' => array
		(
			'align' => true,
			'allownetworking' => true,
			'allowscriptaccess' => true,
			'archive' => true,
			'autostart' => true,
			'border' => true,
			'class' => true,
			'classid' => true,
			'codebase' => true,
			'codetype' => true,
			'data' => true,
			'declare' => true,
			'dir' => true,
			'enablecontextmenu'=> true,
			'height' => true,
			'hspace' => true,
			'id' => true,
			'invokeurls' => true,
			'lang' => true,
			'name' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'src' => true,
			'standby' => true,
			'style' => true,
			'tabindex' => true,
			'title' => true,
			'type' => true,
			'usemap' => true,
			'vspace' => true,
			'width' => true
		),
		'ol' => array
		(
			'class' => true,
			'compact' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'start' => true,
			'style' => true,
			'title' => true,
			'type' => true
		),
		'optgroup' => array
		(
			'class' => true,
			'dir' => true,
			'disabled' => true,
			'id' => true,
			'label' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'option' => array
		(
			'class' => true,
			'dir' => true,
			'disabled' => true,
			'id' => true,
			'label' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'selected' => true,
			'style' => true,
			'title' => true,
			'value' => true
		),
		'p' => array
		(
			'align' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'param' => array
		(
			'id' => true,
			'name' => true,
			'type' => true,
			'value' => true,
			'valuetype' => true
		),
		'pre' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true,
			'width' => true
		),
		'q' => array
		(
			'cite' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		's' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'samp' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'script' => array
		(
			'charset' => true,
			'defer' => true,
			'language' => true,
			'src' => true,
			'type' => true
		),
		'select' => array
		(
			'class' => true,
			'dir' => true,
			'disabled' => true,
			'id' => true,
			'lang' => true,
			'multiple' => true,
			'name' => true,
			'onblur' => false,
			'onchange' => false,
			'onclick' => false,
			'ondblclick' => false,
			'onfocus' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'size' => true,
			'style' => true,
			'tabindex' => true,
			'title' => true
		),
		'small' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'span' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'strike' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'strong' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'style' => array
		(
			'dir' => true,
			'lang' => true,
			'media' => true,
			'title' => true,
			'type' => true
		),
		'sub' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'sup' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'table' => array
		(
			'align' => true,
			'bgcolor' => true,
			'border' => true,
			'cellpadding' => true,
			'cellspacing' => true,
			'class' => true,
			'dir' => true,
			'frame' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'rules' => true,
			'style' => true,
			'summary' => true,
			'title' => true,
			'width' => true
		),
		'tbody' => array
		(
			'align' => true,
			'char' => true,
			'charoff' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true,
			'valign' => true
		),
		'td' => array
		(
			'abbr' => true,
			'align' => true,
			'axis' => true,
			'bgcolor' => true,
			'char' => true,
			'charoff' => true,
			'class' => true,
			'colspan' => true,
			'dir' => true,
			'headers' => true,
			'height' => true,
			'id' => true,
			'lang' => true,
			'nowrap' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'rowspan' => true,
			'scope' => true,
			'style' => true,
			'title' => true,
			'valign' => true,
			'width' => true
		),
		'textarea' => array
		(
			'accesskey' => true,
			'class' => true,
			'cols' => true,
			'dir' => true,
			'disabled' => true,
			'id' => true,
			'lang' => true,
			'name' => true,
			'onblur' => false,
			'onchange' => false,
			'onclick' => false,
			'ondblclick' => false,
			'onfocus' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'onselect' => false,
			'readonly' => true,
			'rows' => true,
			'style' => true,
			'tabindex' => true,
			'title' => true
		),
		'tfoot' => array
		(
			'align' => true,
			'char' => true,
			'charoff' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true,
			'valign' => true
		),
		'th' => array
		(
			'abbr' => true,
			'align' => true,
			'axis' => true,
			'bgcolor' => true,
			'char' => true,
			'charoff' => true,
			'class' => true,
			'colspan' => true,
			'dir' => true,
			'headers' => true,
			'height' => true,
			'id' => true,
			'lang' => true,
			'nowrap' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'rowspan' => true,
			'scope' => true,
			'style' => true,
			'title' => true,
			'valign' => true,
			'width' => true
		),
		'thead' => array
		(
			'align' => true,
			'char' => true,
			'charoff' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true,
			'valign' => true
		),
		'title' => array
		(
			'dir' => true,
			'lang' => true
		),
		'tr' => array
		(
			'align' => true,
			'bgcolor' => true,
			'char' => true,
			'charoff' => true,
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true,
			'valign' => true
		),
		'tt' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'u' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		),
		'ul' => array
		(
			'class' => true,
			'compact' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true,
			'type' => true
		),
		'var' => array
		(
			'class' => true,
			'dir' => true,
			'id' => true,
			'lang' => true,
			'onclick' => false,
			'ondblclick' => false,
			'onkeydown' => false,
			'onkeypress' => false,
			'onkeyup' => false,
			'onmousedown' => false,
			'onmousemove' => false,
			'onmouseout' => false,
			'onmouseover' => false,
			'onmouseup' => false,
			'style' => true,
			'title' => true
		)
	);
	
	var $unanalyzed_tags = array
	(
		'textarea',
		'script',
		'style'
	);

	var $empty_tags = array
	(
		'!doctype',
		'area',
		'base',
		'basefont',
		'br',
		'hr',
		'img',
		'input',
		'link',
		'meta',
		'param'
	);

	var $empty_attributes = array
	(
		'checked',
		'compact',
		'declare',
		'defer',
		'disabled',
		'ismap',
		'multiple',
		'noresize',
		'nosave',
		'noshade',
		'nowrap',
		'readonly',
		'selected'
	);

	var $css_properties = array
	(
		// Text and Fonts:
		'font' => true,
		'font-family' => true,
		'font-size' => true,
		'font-weight' => true,
		'font-style' => true,
		'font-variant' => true,
		'line-height' => true,
		'letter-spacing' => true,
		'word-spacing' => true,
		'text-align' => true,
		'text-decoration' => true,
		'text-indent' => true,
		'text-transform' => true,
		'vertical-align' => true,
		'white-space' => true,

		// Colours and Backgrounds:
		'color' => true,
		'background-color' => true,
		'background' => true,
		'background-image' => true,
		'background-repeat' => true,
		'background-position' => true,
		'background-attachment' => true,

		// The Box Model - dimensions, padding, margin and borders:
		'padding' => true,
		'padding-top' => true,
		'padding-right' => true,
		'padding-bottom' => true,
		'padding-left' => true,
		'border' => true,
		'border-top' => true,
		'border-right' => true,
		'border-bottom' => true,
		'border-left' => true,
		'border-style' => true,
		'border-top-style' => true,
		'border-right-style' => true,
		'border-bottom-style' => true,
		'border-left-style' => true,
		'border-color' => true,
		'border-top-color' => true,
		'border-right-color' => true,
		'border-bottom-color' => true,
		'border-left-color' => true,
		'border-width' => true,
		'border-top-width' => true,
		'border-right-width' => true,
		'border-bottom-width' => true,
		'border-left-width' => true,
		'outline' => true,
		'outline-style' => true,
		'outline-color' => true,
		'outline-width' => true,
		'margin' => true,
		'margin-top' => true,
		'margin-right' => true,
		'margin-bottom' => true,
		'margin-left' => true,
		'width' => true,
		'height' => true,
		'min-width' => true,
		'max-width' => true,
		'min-height' => true,
		'max-height' => true,

		// Positioning and Display:
		'position' => true,
		'top' => true,
		'right' => true,
		'bottom' => true,
		'left' => true,
		'clip' => true,
		'overflow' => true,
		'z-index' => true,
		'float' => true,
		'clear' => true,
		'display' => true,
		'visibility' => true,

		// Lists:
		'list-style' => true,
		'list-style-type' => true,
		'list-style-image' => true,
		'list-style-position' => true,

		// Tables:
		'table-layout' => true,
		'border-collapse' => true,
		'border-spacing' => true,
		'empty-cells' => true,
		'caption-side' => true,

		// The Whole Shebang:
		'background' => true,
		'background-attachment' => true,
		'background-color' => true,
		'background-image' => true,
		'background-position' => true,
		'background-repeat' => true,
		'border' => true,
		'border-collapse' => true,
		'border-color' => true,
		'border-spacing' => true,
		'border-style' => true,
		'border-width' => true,
		'bottom' => true,
		'caption-side' => true,
		'clear' => true,
		'clip' => true,
		'color' => true,
		'content' => true,
		'counter-increment' => true,
		'counter-reset' => true,
		'cursor' => true,
		'direction' => true,
		'display' => true,
		'empty-cells' => true,
		'float' => true,
		'font' => true,
		'font-family' => true,
		'font-size' => true,
		'font-style' => true,
		'font-variant' => true,
		'font-weight' => true,
		'height' => true,
		'left' => true,
		'letter-spacing' => true,
		'line-height' => true,
		'list-style' => true,
		'list-style-image' => true,
		'list-style-position' => true,
		'list-style-type' => true,
		'margin' => true,
		'max-height' => true,
		'max-width' => true,
		'min-height' => true,
		'min-width' => true,
		'orphans' => true,
		'outline' => true,
		'outline-color' => true,
		'outline-style' => true,
		'outline-width' => true,
		'overflow' => true,
		'padding' => true,
		'page-break-after' => true,
		'page-break-before' => true,
		'page-break-inside' => true,
		'position' => true,
		'quotes' => true,
		'right' => true,
		'table-layout' => true,
		'text-align' => true,
		'text-decoration' => true,
		'text-indent' => true,
		'text-transform' => true,
		'top' => true,
		'unicode-bidi' => true,
		'vertical-align' => true,
		'visibility' => true,
		'white-space' => true,
		'widows' => true,
		'width' => true,
		'word-spacing' => true,
		'z-index' => true,

		// Generated Content:
		'content' => true,
		'counter-increment' => true,
		'counter-reset' => true,
		'quotes' => true,

		// Paged Media:
		'page-break-before' => true,
		'page-break-after' => true,
		'page-break-inside' => true,
		'orphans' => true,
		'widows' => true,

		// Misc.:
		'cursor' => true,
		'direction' => true,
		'unicode-bidi' => true
	);
}
/*
HTMLFilter 2.00 - HTML/XHTML filter
----------------------------------
against XSS(Cross Site Scripting) & CSRF(Cross-site request forgery)
Copyright (C) 2008-2009  Jacob Lee

This program is free software and open source software; you can redistribute
it and/or modify it under the terms of the GNU General Public License as
published by the Free Software Foundation; either version 2 of the License,
or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
59 Temple Place, Suite 330, Boston, MA  02111-1307  USA  or visit
http://www.gnu.org/licenses/gpl.html

*** AUTHOR INFORMATION ***

E-mail:      letsgolee at lycos dot co dot kr
*/


define('HTMLFILTER_TEXT', 0);
define('HTMLFILTER_OPENTAG', 1);
define('HTMLFILTER_CLOSETAG', 2);
define('HTMLFILTER_CMMT', 3);
define('HTMLFILTER_UNANALYZED', 4);
define('HTMLFILTER_NODE', 1);

class HTMLFilter extends HTMLFilterConfig
{
	var $_rgb = false;

	var $_html = '';

	var $_func = array();

	var $_htmlentity = false;

	var $_debug = false;

	var $_p = 0;

	var $_state = 0;

	var $_len = 0;

	var $_tagname = '';

	/* Public functions */

	function use_rgb() {
		$this->_rgb = true;
	}

	function add_block_url_syntax($syntax) {
		$this->block_url_syntax[] = $syntax;
	}

	function set_tag($tagname, $set=false) {
		$this->tags[$tagname] = $set;
	}

	function set_tag_attribute($tagname, $attrname, $set=false) {
		if (!array_key_exists($tagname, $this->tags)) {
			$this->tags[$tagname] = true;
		}
		$this->tag_attributes[$tagname][$attrname] = $set;
	}

	function register_function($name, $type) {
		if (strtolower($type) == 'tag') {
			$this->_func['tag'][] = $name;
		}
		else if (strtolower($type) == 'text') {
			$this->_func['text'][] = $name;
		}
	}

	function set_htmlentity_flag() {
		$this->_htmlentity = true;
	}

	function parse($html) {
		if (is_array($html)) {
			return '';
		}
		$this->_html = trim($html);

		// disable server-side script
		// server-side script can be in the attribute value
		$this->_html = str_replace(array('<?', '?>'), array('&lt;?', '?&gt;'), $this->_html);
		$this->_len = strlen($this->_html);
		$this->_p = 0;
		$this->_state = 0;
		$this->_tagname = '';

		// no input no work!
		if (!$this->_len) {
			return '';
		}

		$nodes = $this->_getNodes();

		if ($this->_debug) {
			return $nodes;
		}
		return $this->_getHTML($nodes);
	}

	/* Private functions */

	function _isspace($c) {
		return preg_match("/^[ \r\n\t]$/", $c);
	}

	function _isset($val) {
		return isset($val) && $val;
	}

	function _getTag() {
		$tag = array();
		$type = HTMLFILTER_TEXT;
		$p = $this->_p;

		$tagname = '';
		$attrname = '';
		$attrval = '';
		$quot = '';
		$c = '';
		$len = 0;

		while ($this->_p < $this->_len)
		{
			$c = $this->_html[$this->_p++];

			switch ($this->_state) {
				case 0: /* get until encounters '<' */
					if ($c == '<') {
						$this->_state = 1;
						break;
					}
					break;
				case 1: /* got '<', check if it is a tag opener */
					if (preg_match('/^[a-z]$/i', $c)) { /* a tagname starts */
						$this->_state = 2;
						$data = substr($this->_html, $p, $this->_p-$p-2);
						$this->_p--;
						if ($data) {
							return array('type'=>HTMLFILTER_TEXT, 'data'=>$data);
						}
						break;
					}
					if ($c == '/') { /* close tag */
						// what if </ and the html is ended.
						if (preg_match('/^[a-z]$/i', $this->_html[$this->_p])) {
							$this->_state = 13;
							$data = substr($this->_html, $p, $this->_p-$p-2);
							$this->_p--;
							if ($data) {
								return array('type'=>HTMLFILTER_TEXT, 'data'=>$data);
							}
							break;
						}
					}
					if ($c == '!') {
						if (substr($this->_html, $this->_p, 2) == '--') {
							$this->_state = 10;
							$data = substr($this->_html, $p, $this->_p-$p-2);
							$this->_p += 1;
							if ($data) {
								return array('type'=>HTMLFILTER_TEXT, 'data'=>$data);
							}
							break;
						}
						/* avoid tags like 'doctypehacked' */
						if (preg_match("/^doctype[ \t\r\n]$/i", substr($this->_html, $this->_p, 8))) {
							$this->_p += 7;
							$this->_state = 14;
							$data = substr($this->_html, $p, $this->_p-$p-2);
							if ($data) {
								return array('type'=>HTMLFILTER_TEXT, 'data'=>$data);
							}
							break;
						}
					}
					if ($c == '<') { /* <<<<script> */
						$this->_p--;
					}
					$this->_state = 0;
					break;
				case 2: /* getting tag name */
					if ($this->_isspace($c) || $c == '/') {
						if (!$type) {
							$type = HTMLFILTER_OPENTAG;
						}
						$tagname = strtolower($tagname);
						// if $c is '/' then unget it so that next state it will be dealt.
						if ($c ==  '/') {
							$this->_p--;
						}
						$this->_state = 3;
						break;
					}
					if ($c == '>') { // let's close the tag.
						if (!$type) {
							$type = HTMLFILTER_OPENTAG;
						}
						$tagname = strtolower($tagname);
						$this->_p--;
						$this->_state = 4;
						break;
					}
					$tagname .= $c;
					break;
				case 3: /* got $tagname, waiting any word as a attribute name or '>' or '/' */
					if ($this->_isspace($c)) {
						/* ignore space character */
						break;					
					}
					if ($c == '/') {
						/* ignore '/' anyway */
						if ($this->_html[$this->_p] == '>') {
							$this->_state = 4;
							break;
						}
						break;
					}
					if ($c == '>') {
						$this->_p--;
						$this->_state = 4;
						break;
					}
					$attrname = $c; /* got any character as a attribute name starter */
					$attrval = '';
					$this->_state = 5;
					break;
				case 4: /* close a tag */
					$tag['type'] = $type;
					$tag['tag'] = $tagname;
					$this->_state = 0;

					/* when $tagname is a tag that has contents that should be not analyzed */
					if ($type == HTMLFILTER_OPENTAG && in_array($tagname, $this->unanalyzed_tags)) {
						$this->_state = 12;
						$this->_tagname = $tagname;
					}
					return $tag;
				case 5: /* getting attribute name */
					/* checking whether $attrname is allowed or not will be done after $attrval is given */
					if ($this->_isspace($c)) {
						/* got attribut name */
						$attrname = strtolower($attrname);
						$this->_state = 6;
						break;
					}					
					if ($c == '/' || $c == '>') {
						/* got attribute name but has no value */
						/* '/' will be ignored */
						$attrname = strtolower($attrname);
						$tag['attr'][$attrname] = '';
						$attrname = '';
						if ($c == '>') { /* tag finisher */
							$this->_p--;
							$this->_state = 4;
						}
						else {
							$this->_state = 3;
						}
						break;
					}
					if ($c == '=') {
						$this->_state = 7;
						break;
					}
					if ($c == '"' || $c == "'") {
						$attrname .= '?'; /* " or ' will be changed as ? */
					}
					else {
						$attrname .= $c;
					}
					break;
				case 6: /*  got $attrname waiting '=' */
						/* <a href   = "#"> */
					if ($this->_isspace($c)) {
						break;
					}
					if ($c == '=') {
						$this->_state = 7;
						break;
					}
					/* got any word for attribute */
					$attrname = strtolower($attrname);
					$tag['attr'][$attrname] = '';
					$attrname = '';
					$this->_p--;
					$this->_state = 3;
					break;
				case 7: /* got '=', waiting attribute value starter */
						/* <a href   =   aaa/bbb/ccc> */
					if ($this->_isspace($c)) {
						break;
					}
					if ($c == '>') {
						$attrname = strtolower($attrname);
						$tag['attr'][$attrname] = '';
						$attrname = '';
						$this->_p--;
						$this->_state = 4;
						break;
					}
					if ($c == '"' || $c == "'") {
						$quot = $c;
						$this->_state = 9;
						break;
					}
					$attrval = $c;
					$this->_state = 8;
					break;
				case 8: /* getting attribute value */
					/* <a href   =   aaa/bbb/ccc> */
					if ($this->_isspace($c) || $c == '>') {
						$attrname = strtolower($attrname);
						$tag['attr'][$attrname] = $attrval;
						$attrname = $attrval = '';
						if ($c == '>') {
							$this->_p--;
							$this->_state = 4;
						}
						else {
							$this->_state = 3;
						}
						break;
					}
					$attrval .= $c;
					break;				
				case 9: /* got attribute quote value, waiting any character or the quote type value */
					if ($c == $quot) {
						$attrname = strtolower($attrname);
						$tag['attr'][$attrname] = $attrval;
						$attrname = $attrval = $quot = '';
						$this->_state = 3;
						break;
					}
					$attrval .= $c;
					break;
				case 10: /* comment */
					if ($c == '-' && substr($this->_html, $this->_p, 2) == '->') {
						$this->_p += 2;
						$this->_state = 0;
						return array('type'=>HTMLFILTER_CMMT, 'data'=>substr($this->_html, $p, $this->_p-$p-3));
					}
					break;
				case 11: /* ! tag start */
					/* get rid of it */
					if ($c == '>') {
						$p = $this->_p;
						$this->_state = 0;
					}
					break;
				case 12: /* don't analyze until meet a close tag of textarea or style or script */
					if (!$len) {
						$len = strlen($this->_tagname);
					}
					if ($c == '<' && $this->_html[$this->_p] == '/' && strtolower(substr($this->_html, $this->_p+1, $len)) == $this->_tagname) {
						$data = substr($this->_html, $p, $this->_p-$p-1);
						$this->_p--;
						$this->_state = 0;
						return array('type'=>HTMLFILTER_UNANALYZED, 'tag'=>$this->_tagname, 'data'=>$data);
					}
					break;
				case 13: /* close tag */
					$type = HTMLFILTER_CLOSETAG;
					$this->_state = 2;
					break;
				case 14: /* got !doctype */
					$type = HTMLFILTER_OPENTAG;
					$tagname = '!doctype';
					$this->_state = 3;
					break;
			}
		} /* end of while */

		if ($this->_p == $this->_len) {
			// check if the tag is not finished
			// <a href=http://richarea.net target= */

			// let's increase $this->_p. otherwise it will loop for ever
			$this->_p++;
			switch ($this->_state) {
				case 0:
				case 1:
					$data = substr($this->_html, $p, $this->_p-$p-1);
					if ($data) {
						return array('type'=>HTMLFILTER_TEXT, 'data'=>$data);
					}
					break;
				case 2:
				case 3:
					/* <strong */
					return array('type'=>$type, 'tag'=>$tagname);
				case 5:
				case 6:
					/* <div style */
				case 7:
					/* <div style= */
					$tag['attr'][$attrname] = '';
					$tag['type'] = $type;
					$tag['tag'] = $tagname;
					return $tag;
				case 8:
				case 9:
					/* <div style=color:red */
					/* <div style=' */
					/* <div style='color:red */
					$tag['attr'][$attrname] = $attrval;
					$tag['type'] = $type;
					$tag['tag'] = $tagname;
					return $tag;
				case 10:
					/* <!-- comment */
					return array('type'=>HTMLFILTER_CMMT, 'data'=>substr($this->_html, $p));
				case 12:
					/* <textarea> this is a text */
					return array('type'=>HTMLFILTER_UNANALYZED, 'tag'=>$this->_tagname, 'data'=>$data);
			}
		}
		return false;
	}
	
	function _getNodes($parentTag='') {
		$tree = array();
		$level = 0;

		while ($tag = $this->_getTag()) {
			$node = array();

			switch ($tag['type']) {
				case HTMLFILTER_OPENTAG:
					if ($tag['tag'] == $parentTag) {
						// if parent tagname and the tagname is the same lets level up
						$level++;
					}
					$node['type'] = HTMLFILTER_NODE;
					$node['name'] = $tag['tag'];
					$node['attr'] = $tag['attr'];
					if (!in_array($tag['tag'], $this->empty_tags)) {
						if (in_array($tag['tag'], $this->unanalyzed_tags)) {
							$node['data'] = $this->_getUnanalyzedData();
						}
						else {
							$node['data'] = $this->_getNodes($tag['tag']);
							if ($tag['tag'] == $parentTag) {
								$level--;
							}							
						}
					}
					$tree[] = $node;
					break;
				case HTMLFILTER_CLOSETAG:
					if ($parentTag == $tag['tag']) {
						if (!$level) {
							return $tree;
						}
						if ($level) {
							$level--;
						}
					}
					break;
				case HTMLFILTER_CMMT:
					$node['type'] = HTMLFILTER_CMMT;
					$node['data'] = $tag['data'];
					$tree[] = $node;
					break;
				case HTMLFILTER_TEXT:
					$node['type'] = HTMLFILTER_TEXT;
					$node['data'] = $tag['data'];
					$tree[] = $node;
					break;
			}
		}
		return $tree;
	}

	function _getUnanalyzedData() {
		if (($tag = $this->_getTag()) && $tag['type'] == HTMLFILTER_UNANALYZED) {
			return $tag['data'];
		}
		// otherwise it must be the close tag of the unanalyzed tag
		// <textarea></textarea>
		return '';
	}

	function _getHTML($nodes) {
		$html = '';

		// user defined functions
		$exe_tag_func = false;
		$exe_text_func = false;

		if (count($this->_func['tag'])) {
			$this->_func['tag'] = array_map('strtolower', $this->_func['tag']);
			$exe_tag_func = true;
		}
		if (count($this->_func['text'])) {
			$this->_func['text'] = array_map('strtolower', $this->_func['text']);
			$exe_text_func = true;
		}

		foreach ($nodes as $node) {
			$outerHTML = '';
			switch ($node['type']) {
				case HTMLFILTER_TEXT:
					if ($exe_text_func) {
						foreach ($this->_func['text'] as $func) {
							// user defined function($data)
							// 2010.01.08/똥산너구리 - Call-time pass-by-reference has been deprecated 오류 때문에 레퍼런스로 넘기는걸 지움.. 문제가 안생길까?
							//$func(&$node['data']);
							$func($node['data']);
						}
					}
					$html .= $this->_filterText($node['data']);
					break;
				case HTMLFILTER_NODE:
					// node name can be changed by user defined functions
					$name = $node['name'];
					if ($exe_tag_func) {
						foreach ($this->_func['tag'] as $func) {
							// user defined function($nodeName, $attributes)
							// 2010.01.08/똥산너구리 - Call-time pass-by-reference has been deprecated 오류 때문에 레퍼런스로 넘기는걸 지움.. 문제가 안생길까?
							//$func(&$node['name'], &$node['attr']);
							$func($node['name'], $node['attr']);
						}
					}
					if (!$node['name'] || !$this->_isset($this->tags[$node['name']])) {
						break;
					}
					if ($node['name'] == 'object') {
						$node['attr'] = $this->_secureObject($node['attr']);
					}
					$attr = $this->_getAttr($node['attr'], $node['name']);
					if (in_array($node['name'], $this->empty_tags)) {
						$html .= '<'.$node['name'].$attr.' />';
						break;
					}
					if (is_array($node['data'])) {
						$innerHTML = $this->_getHTML($node['data']);
						if ($node['name'] == 'textarea') {
							$innerHTML = $this->_filterText($innerHTML);
						}
					}
					else {
						if (in_array($node['name'], $this->unanalyzed_tags)) {
							$innerHTML = $this->_filterText($node['data']);
						}
						else {
							if ($this->_htmlentity) {
								$innerHTML = $this->_filterText($node['data']);
								$this->_htmlentity = false;
							}
							else {
								$filter = new HTMLFilter();
								$filter->_func = $this->_func;
								$innerHTML = $filter->parse($node['data']);
							}
						}
					}
					$outerHTML = '<'.$node['name'].$attr.'>'.$innerHTML.'</'.$node['name'].'>';
					$html .= $outerHTML;
					break;
				case HTMLFILTER_CMMT:
					break;
			}
		}
		return $html;
	}

	function _getAttr($attr, $tag) {
		$ret = '';

		$f_param_url = false;
		$f_obj_data = false;
		$http_equiv_type = '';

		if (!is_array($attr) || !count($attr)) {
			return '';
		}
		foreach ($attr as $name=>$val) {
			if (!$this->_isset($this->tag_attributes[$tag][$name])) {
				continue;
			}
			switch ($name) {
				/* <param name="url" value="malicious-url" /> */
				case 'name':
					if ($tag == 'param' && $this->_checkExpress($val, array('url', 'movie'), true)) {
						$f_param_url = true;
					}
					break;
				case 'value':
					if ($f_param_url) {
						$val = $this->_filterURL($val);
					}
					break;
				/* <OBJECT TYPE="text/x-scriptlet" DATA="http://ha.ckers.org/scriptlet.html"></OBJECT> in Opera 9.02 */
				case 'type':
					if ($tag == 'object' && $this->_checkExpress($val, 'text/x-scriptlet', true)) {
						$f_obj_data = true;
					}
					break;
				case 'data':
					if ($f_obj_data) {
						$val = $this->_filterURL($val);
					}
					break;
				case 'classid':
				case 'archive':
				case 'code':
				case 'codebase':
					if ($tag == 'applet' || $tag == 'object') {
						$val = $this->_filterURL($val);			
					}
					break;
				case 'style':
					$val = $this->_filterStyle($val);
					break;
				case 'href':
				case 'lowsrc':
				case 'dynsrc':
				/* <TABLE BACKGROUND="javascript:alert('XSS')"> */
				/* <TD BACKGROUND="javascript:alert('XSS')"> */
				case 'background':
					$val = $this->_filterURL($val);
					break;
				case 'src':
					if ($tag == 'embed' && $this->_checkExpress($val, 'data:', false)) {
						/* <EMBED SRC="data:image/svg+xml;base64,PHN2ZyB4bWxuczpzdmc9Imh0dH A6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcv MjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hs aW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjAiIHk9IjAiIHdpZHRoPSIxOTQiIGhlaWdodD0iMjAw IiBpZD0ieHNzIj48c2NyaXB0IHR5cGU9InRleHQvZWNtYXNjcmlwdCI+YWxlcnQoIlh TUyIpOzwvc2NyaXB0Pjwvc3ZnPg==" type="image/svg+xml" AllowScriptAccess="always"></EMBED> */
						/* decoded code:
						<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0" y="0" width="194" height="200" id="xss"><script type="text/ecmascript">alert("XSS");</script></svg> */
						/* we don't know what is inside the data in many cases... so remove it!!! */
						$val = false;
					}
					else {
						$val = $this->_filterURL($val);
					}
					break;
				case 'http-equiv':
					if ($tag == 'meta') {
						$http_equiv_type = $val;
					}
					break;
				case 'content':
					if ($tag == 'meta') {
						$val = $this->_filterMETA($val, $http_equiv_type);
					}
					break;
			}
			if ($val !== false) {
				if (!$this->_rgb) {
					$val = $this->_rgb2hex($val);
				}
				if (in_array($name, $this->empty_attributes) && !strlen($val)) {
					$val = $name;
				}
				$ret .= ' '.$name.'="'.$this->_escapeQuote($val, '"').'"';
			}
		}
		return $ret;
	}

	function _filterText($data) {
		return preg_replace(array('/</', '/>/', '/"/'), array('&lt;', '&gt;', '&quot;'), $data);
	}

	function _getHostByDword($protocol, $dword) {
		return $protocol.long2ip($dword);
	}

	function _filterURL($path) {
		$path = trim($path);

		$p = $this->_sanitize($path);

		/* <a href=\"http://2826829833/hack/\"> */
		$p = preg_replace('/((ht|f)tp(s)?\:\/\/)([0-9]{10})/ei', "\$this->_getHostByDword('\\1','\\4')", $p);
		//echo $p."<br>";

		foreach ($this->block_url_syntax as $syntax) {
			if (preg_match($syntax, $p)) {
				return false;
			}
		}
		if ($this->_hasScript($p)) {
			return false;
		}

		/* file name can be broken if $p is returned.
		ex)
		http://mfiles.naver.net/9e4dab71653453e1cb9f/data25/2008/9/6/95/%C2%DF_%C2%DE%BF%ED-rarra777.mp3
		is changed to 
		http://mfiles.naver.net/9e4dab71653453e1cb9f/data25/2008/9/6/95/��_�޿�-rarra777.mp3 */
		return $path;
	}

/* <img src="http://badguy.com/a.jpg"> could be dangerous when apache .htaccess is:
Redirect 302 /a.jpg http://victimsite.com/admin.asp&deleteuser */

	function _filterMETA($content, $type) {
		$type = strtolower($this->_sanitize($type));
		switch ($type) {
			case 'set-cookie':
				/* <META HTTP-EQUIV="Set-Cookie" Content="USERID=&lt;SCRIPT&gt;alert('XSS')&lt;/SCRIPT&gt;"> */
				$filter = new HTMLFilter();
				$content = $filter->parse(html_entity_decode($content));
				return $content;
			case 'link':
				/* <META HTTP-EQUIV="Link" Content="<http://ha.ckers.org/xss.css>; REL=stylesheet"> */
				if (!$this->_filterURL($content)) {
					return false;
				}
				else {
					return $content;
				}
			case 'refresh':
				/* <META HTTP-EQUIV="refresh" CONTENT="0;url=javascript:alert('XSS');"> */
				$content_arr = explode(';', $content);
				$content = array();

				$f_data = false;
				foreach ($content_arr as $cnt) {
					if ($f_data) {
						/* <META HTTP-EQUIV="refresh" CONTENT="0;url=data:text/html;base64,PHNjcmlwdD5hbGVydCgnWFNTJyk8L3NjcmlwdD4K"> */
						$f_data = false;
						continue;
					}
					if (preg_match('/url\s*=(.*)/i', $cnt, $m)) {
						if ($this->_checkExpress($m[1], 'data:', false)) {
							/* we don't know what is the data in many cases, get rid of it!!! */
							$f_data = true;
							continue;
						}
						if (!$this->_filterURL($m[1])) {
							continue;
						}
					}
					$content[] = $cnt;
				}
				if (!count($content)) {
					return false;
				}
				return implode(';', $content);
			default:
				return $content;
		}
	}

	function _needURLFilter($name) {
		return in_array($name, $this->attributes_need_url_filtering);
	}

	function _filterStyle($style) {
		// style="color:#FFFFFF; font-size:12px"
		$retval = '';

		// style="width: expr/*XSS*/ession(alert('XSS'))"
		$style = preg_replace('/\/\*.*\*\//Us', '', $style);

		$css_arr = explode(';', $style);
		$style = array();
		foreach ($css_arr as $css) {
			list($name, $val) = explode(':', $css);
			$name = strtolower(trim($name));
			$val = trim($val);
			if (!$this->_isset($this->css_properties[$name])) {
				continue;
			}
			if ($this->_needURLFilter($name) &&
				preg_match("/^url\s*\((.*)\)/i", $val, $m)
			) {
				if (!$this->_filterURL($m[1])) {
					continue;
				}
			}
			else {
				if (!preg_match($this->css_syntax, $val)) {
					continue;
				}
				if ($this->_checkExpress($val, 'expression(', false)) {
					continue;
				}
			}
			$style[] = $name.':'.$val;
		}
		if (!count($style)) {
			return false;
		}
		return implode(';', $style);
	}

	function _secureObject($attr) {
		foreach ($this->object_security as $name=>$default) {
			$attr[$name] = $default;
		}
/*
		<object style="LEFT: 15px; WIDTH: 294px; TOP: 10px; HEIGHT: 45px" src=http://domain.com/sample.wma width=294 height=45 type=octet-stream invokeURLs="false" autostart="false" allowScriptAccess="never" allowNetworking="internal" EnableContextMenu="false">
*/
		return $attr;
	}

	function _hasScript($str) {
		return $this->_checkExpress($str, $this->script_types, false, false);
	}

	function _checkExpress($str, $express, $exact_match=false, $remove_encoding=true) {
		// $express can be a array
		if (is_array($express)) {
			$express = implode('|', array_map('preg_quote', $express, array_fill(0, count($express), '/')));
		}
		else {
			$express = preg_quote($express, '/');
		}
		$str = preg_replace("/[\r\n\t ]/", '', $str);
		if ($remove_encoding) {
			$str = $this->_sanitize($str);
		}
		$str = preg_replace('/[^a-z0-9_:;&\/\(\)\!#\.\,\-\*가-힣ㄱ-ㅎㅏ-ㅣ]/i', '', $str);
		$str = trim($str);

		return $exact_match ? preg_match("/^($express)$/i", $str) : preg_match("/($express)/i", $str);
	}

	function _sanitize($str) {
		$str = html_entity_decode($str);
		$str = preg_replace('/\0+/', '', $str);
		$str = preg_replace("/\\\\(00)([a-z0-9]{2}(\.[0-9]{4})?)/ie", 'chr(hexdec("\\2"))', $str);
		$str = preg_replace('/(\\\\0)+/', '', $str);
		$str = preg_replace('/%u0([a-z0-9]{3})/ei', 'chr(hexdec("\\1"))', $str);
		$str = preg_replace('/%([a-z0-9]{2,3})/ei', 'chr(hexdec("\\1"))', $str);
		$str = preg_replace('/&#x([0-9a-f]+)(;)?/ei', 'chr(hexdec("\\1"))', $str);
		$str = preg_replace('/&#([0-9]{7})/e', 'chr("\\1")', $str);
		$str = preg_replace('/&#([0-9]{2,3})(;)?/e', 'chr("\\1")', $str);

		return trim($str);
	}

	function _escapeQuote($str, $quot) {
		if (!$quot) {
			$quot = '"';
		}
		if ($quot == '"') {
			return str_replace('"', '\"', $str);
		}
		return str_replace("'", "\\'", $str);
	}

	function _rgb2hex($s) {
		return preg_replace('/rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)/eiUs', "\$this->_hex(array('\\0', '\\1', '\\2', '\\3'));", $s);
	}

	function _hex($color) {
		$hex = '#';
		for ($i = 1; $i < count($color); $i++) {
			$color[$i] = intval($color[$i]);
			if ($color[$i] < 0 || $color[$i] > 255) {
				return $color[0];
			}
			$hex .= strtoupper(str_pad(dechex($color[$i]), 2, 0, STR_PAD_LEFT));
		}
		return $hex;
	}
} /* end of class */

} /* end of defined('HTMLFILTER') */


$filter = new HTMLFilter();
$result = addslashes($filter->parse(stripcslashes($att[1])));