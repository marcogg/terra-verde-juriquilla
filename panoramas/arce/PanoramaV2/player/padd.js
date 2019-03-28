var params =
	{
	allowFullScreen:"true",
	scale:"noscale",
	allowScriptAccess:"always"
	};

var flashvars = { };

if (p_width == "replaceWidth" ){
	p_width = 640;
}

if (p_height == "replaceHeight" ){
	p_height = 480;
}

if (swfobject.hasFlashPlayerVersion("10")) 
{
	// if the panorama is local, do not create its path for Flash
	if( p_panorama_directory != "" )
		flashvars.panoramaDirectory = p_panorama_directory;
		
	flashvars.widthHTML = p_width;
	flashvars.heightHTML = p_height;
	
	swfobject.embedSWF("player/paddplayer3.swf", "myAlternativeContent", p_width, p_height, "10", false, flashvars, params);
}
else if( swfobject.hasFlashPlayerVersion("8")) 
{
	document.write("<div id=\"promenadd\" style=\"margin-top:50px ; text-align:center\">");
	document.write("<embed src=\"player/checkversion.swf\" width=\""+p_width+"\" height=\""+p_height+"\" ></embed></object>");
	document.write("</div>");
}
else
{
	swfobject.embedSWF("player/checkversion.swf", "myAlternativeContent", p_width, p_height, "9", false, flashvars, params);
}
