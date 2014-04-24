<?php echo $header; ?>

<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
 
  <div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
  
  <?php if ($videos) { ?>
    <div class="album_sort">
      <div style="float: left;"><?php echo $text_sort; ?></div>
      <div style="float: left;">
        <select name="sort" onchange="location = this.value">
          <?php foreach ($sorts as $sorts) { ?>
          <?php if (($sort . '-' . $order) == $sorts['value']) { ?>
          <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
          <?php } else { ?>
          <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
          <?php } ?>
          <?php } ?>
        </select>
      </div>
    </div>
    <table class="table_album">
      <?php for ($i = 0; $i < sizeof($videos); $i = $i + 4) { ?>
      <tr>
        <?php for ($j = $i; $j < ($i + 4); $j++) { ?>
        <td class="td_album_image">
	        <?php if (isset($videos[$j])) { 
 
                     if ($videos[$j]['source']=='youtube') {     
                     
                    
                    $url = $videos[$j]['code'];
					parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
					    
                    
                      ?>
                                 
	          <div id="bor"><a  href="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v']; ?>?rel=0&amp;wmode=transparent&autoplay=1"  class="youtube"><img id="play" src="catalog/view/theme/default/image/play.png" /><img id="imag"  src="<?php echo $videos[$j]['thumb']; ?>" width="120" height="90" title="<?php echo $heading_title; ?>"  alt="<?php echo $heading_title; ?>" id="image" /></a></div><br />
	          <a href="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v']; ?>?rel=0&amp;wmode=transparent&autoplay=1" class="youtube" style="text-decoration:none;"><?php echo $videos[$j]['name']; ?></a><br />
	          <span style="color: #999; font-size: 11px;"><?php echo $videos[$j]['date_added'][0]; ?></span><br />
              <?php $descript = $videos[$j]['description']; ?>
              
              <a href="http://www.youtube.com/embed/<?php echo $new_string; ?>?rel=0&amp;wmode=transparent&autoplay=1" class="youtube"  title="'<? echo $descript; ?>">description</a>
	                
                <?php  } elseif ($videos[$j]['source']=='vimeo') {   
                
					$new_string = ereg_replace("[^0-9]", "", $videos[$j]['code']); 
                
                ?>
                
                <div id="bor"><a  href="http://player.vimeo.com/video/<?php echo $new_string; ?>?autoplay=1"  class="vimeo"><img id="play" src="catalog/view/theme/default/image/play.png" /><img id="imag"  src="<?php echo $videos[$j]['thumb']; ?>" width="120" height="90" title="<?php echo $heading_title; ?>"  alt="<?php echo $heading_title; ?>" id="image" /></a></div><br />
	          <a href="http://player.vimeo.com/video/<?php echo $new_string; ?>?autoplay=1" class="vimeo" style="text-decoration:none;"><?php echo $videos[$j]['name']; ?></a><br />
	          <span style="color: #999; font-size: 11px;"><?php echo $videos[$j]['date_added'][0]; ?></span><br />
              <?php $descript = $videos[$j]['description']; ?>
              
              <a href="http://player.vimeo.com/video/<?php echo $new_string; ?>?autoplay=1" class="vimeo"  title="'<? echo $descript; ?>">description</a>
              
              <?php } ?>
              
            <?php } ?>
        </td>
        <?php } ?>
      </tr>
      <?php } ?>
    </table>
    <div class="pagination"><?php echo $pagination; ?></div>
    <?php } ?>
  
  </div>
</div>




<script type="text/javascript">
<!--
// original code by Stuart Langridge 2003-11
// with additions to the code by other good people
// http://www.kryogenix.org/code/browser/nicetitle/
// thank you, sir

// modified by Peter Janes 2003-03-25
// http://peterjanes.ca/blog/archives/2003/03/25/nicetitles-for-ins-and-del
// added in ins and del tags

// modified by Dunstan Orchard 2003-11-18
// http://1976design.com/blog/
// added in accesskey information
// tried ever-so-hard, but couldn't work out how to do what Ethan did

// final genius touch by by Ethan Marcotte 2003-11-18
// http://www.sidesh0w.com/
// worked out how to delay showing the popups to make them more like the browser's own


// set the namespace
var XHTMLNS = 'http://www.w3.org/1999/xhtml';
var CURRENT_NICE_TITLE;

// browser sniff
var browser = new Browser();



// determine browser and version.
function Browser()
	{
	var ua, s, i;

	this.isIE = false;
	this.isNS = false;
	this.version = null;

	ua = navigator.userAgent;

	s = 'MSIE';
	if ((i = ua.indexOf(s)) >= 0)
		{
		this.isIE = true;
		this.version = parseFloat(ua.substr(i + s.length));
		return;
		}

	s = 'Netscape6/';
	if ((i = ua.indexOf(s)) >= 0)
		{
		this.isNS = true;
		this.version = parseFloat(ua.substr(i + s.length));
		return;
		}

	// treat any other 'Gecko' browser as NS 6.1.
	s = 'Gecko';
	if ((i = ua.indexOf(s)) >= 0)
		{
		this.isNS = true;
		this.version = 6.1;
		return;
		}
	}



// 2003-11-19 sidesh0w
// set delay vars to emulate normal hover delay
var delay;
var interval = 0.1;



// this function runs on window load
// it runs through all the links on the page as starts listening for actions
function makeNiceTitles()
	{
	if (!document.createElement || !document.getElementsByTagName) return;
	if (!document.createElementNS)
		{
		document.createElementNS = function(ns, elt)
			{
			return document.createElement(elt);
			}
		}

	// do regular links
	if (!document.links)
		{
		document.links = document.getElementsByTagName('a');
		}
	for (var ti=0; ti<document.links.length; ti++)
		{
		var lnk = document.links[ti];
		if (lnk.title)
			{
			lnk.setAttribute('nicetitle', lnk.title);
			lnk.removeAttribute('title');
			addEvent(lnk, 'mouseover', showDelay);
			addEvent(lnk, 'mouseout', hideNiceTitle);
			addEvent(lnk, 'focus', showDelay);
			addEvent(lnk, 'blur', hideNiceTitle);
			}
		}

	// 2003-03-25 Peter Janes
	// do ins and del tags
	var tags = new Array(2);
	tags[0] = document.getElementsByTagName('ins');
	tags[1] = document.getElementsByTagName('del');
	for (var tt=0; tt<tags.length; tt++)
		{
		if (tags[tt])
			{
			for (var ti=0; ti<tags[tt].length; ti++)
				{
				var tag = tags[tt][ti];
				if (tag.dateTime)
					{
					var strDate = tag.dateTime;
					// HTML/ISO8601 date: yyyy-mm-ddThh:mm:ssTZD (Z, -hh:mm, +hh:mm)
					var month = strDate.substring(5,7);
					var day = strDate.substring(8,10);
					if (month[0] == '0')
						{
						month = month[1];
						}
					if (day[0] == '0')
						{
						day = day[1];
						}
					var dtIns = new Date(strDate.substring(0,4), month-1, day, strDate.substring(11,13), strDate.substring(14,16), strDate.substring(17,19));
					tag.setAttribute('nicetitle', (tt == 0 ? 'Added' : 'Deleted') + ' on ' + dtIns.toString());
					addEvent(tag, 'mouseover', showDelay);
					addEvent(tag, 'mouseout', hideNiceTitle);
					addEvent(tag, 'focus', showDelay);
					addEvent(tag, 'blur', hideNiceTitle);
					}
				}
			}
		}
	}



// by Scott Andrew
// add an eventlistener to browsers that can do it somehow.
function addEvent(obj, evType, fn)
	{
	if (obj.addEventListener)
		{
		obj.addEventListener(evType, fn, true);
		return true;
		}
	else if (obj.attachEvent)
		{
		var r = obj.attachEvent('on'+evType, fn);
		return r;
		}
	else
		{
		return false;
		}
	}



function findPosition(oLink)
	{
	if (oLink.offsetParent)
		{
		for (var posX = 0, posY = 0; oLink.offsetParent; oLink = oLink.offsetParent)
			{
			posX += oLink.offsetLeft;
			posY += oLink.offsetTop;
			}
		return [posX, posY];
		}
	else
		{
		return [oLink.x, oLink.y];
		}
	}



function getParent(el, pTagName)
	{
	if (el == null)
		{
		return null;
		}
	// gecko bug, supposed to be uppercase
	else if (el.nodeType == 1 && el.tagName.toLowerCase() == pTagName.toLowerCase())
		{
		return el;
		}
	else
		{
		return getParent(el.parentNode, pTagName);
		}
	}



// 2003-11-19 sidesh0w
// trailerpark wrapper function
function showDelay(e)
	{
    if (window.event && window.event.srcElement)
		{
        lnk = window.event.srcElement
		}
	else if (e && e.target)
		{
        lnk = e.target
		}
    if (!lnk) return;

	// lnk is a textnode or an elementnode that's not ins/del
    if (lnk.nodeType == 3 || (lnk.nodeType == 1 && lnk.tagName.toLowerCase() != 'ins' && lnk.tagName.toLowerCase() != 'del'))
		{
		// ascend parents until we hit a link
		lnk = getParent(lnk, 'a');
		}
	
	delay = setTimeout("showNiceTitle(lnk)", interval * 1000);
	}



// build and show the nice titles
function showNiceTitle(link)
	{
    if (CURRENT_NICE_TITLE) hideNiceTitle(CURRENT_NICE_TITLE);
    if (!document.getElementsByTagName) return;

    nicetitle = lnk.getAttribute('nicetitle');
    
    var d = document.createElementNS(XHTMLNS, 'div');
    d.className = 'nicetitle';
    tnt = document.createTextNode(nicetitle);
    pat = document.createElementNS(XHTMLNS, 'p');
    pat.className = 'titletext';
    pat.appendChild(tnt);

	// 2003-11-18 Dunstan Orchard
	// added in accesskey info
	if (lnk.accessKey)
		{
        axs = document.createTextNode(' [' + lnk.accessKey + ']');
		axsk = document.createElementNS(XHTMLNS, 'span');
        axsk.className = 'accesskey';
        axsk.appendChild(axs);
		pat.appendChild(axsk);
		}
    d.appendChild(pat);

    if (lnk.href)
		{
        tnd = document.createTextNode(lnk.href);
        pad = document.createElementNS(XHTMLNS, 'p');
        pad.className = 'destination';
        d.appendChild(pad);
		}
    
    STD_WIDTH = 300;

	if (lnk.href)
		{
        h = lnk.href.length;
		}
	else
		{
		h = nicetitle.length;
		}
	
    if (nicetitle.length)
		{
		t = nicetitle.length;
		}
	
    h_pixels = h*6;
	t_pixels = t*10;
    
    if (h_pixels > STD_WIDTH)
		{
        w = h_pixels;
		}
	else if ((STD_WIDTH>t_pixels) && (t_pixels>h_pixels))
		{
        w = t_pixels;
		}
	else if ((STD_WIDTH>t_pixels) && (h_pixels>t_pixels))
		{
        w = h_pixels;
		}
	else
		{
        w = STD_WIDTH;
		}
        
    d.style.width = w + 'px';    

    mpos = findPosition(lnk);
    mx = mpos[0];
    my = mpos[1];
    
    d.style.left = (mx+15) + 'px';
    d.style.top = (my+35) + 'px';

    if (window.innerWidth && ((mx+w) > window.innerWidth))
		{
        d.style.left = (window.innerWidth - w - 25) + 'px';
		}
    if (document.body.scrollWidth && ((mx+w) > document.body.scrollWidth))
		{
        d.style.left = (document.body.scrollWidth - w - 25) + 'px';
		}
    
    document.getElementsByTagName('body')[0].appendChild(d);

    CURRENT_NICE_TITLE = d;
	}




function hideNiceTitle(e)
	{
	// 2003-11-19 sidesh0w
	// clearTimeout 
	if (delay) clearTimeout(delay);
	if (!document.getElementsByTagName) return;
	if (CURRENT_NICE_TITLE)
		{
		document.getElementsByTagName('body')[0].removeChild(CURRENT_NICE_TITLE);
		CURRENT_NICE_TITLE = null;
		}
	}

window.onload = function(e) {
makeNiceTitles();
}
-->
</script>



<style type="text/css">
<!--


-->
</style>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>