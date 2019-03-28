		var currentPlayerWidth=p_width;
		var currentPlayerHeight=p_height;
		var isFullscreen=false;
		
		function disable_scroll_PlayerWebGL()
		{
			document.body.style.overflow="hidden";
		}
		function enable_scroll_PlayerWebGL()
		{
			document.body.style.overflow="auto";
		}
		
		function initPlayerWebGL(){
			var elem_frameWebGL = document.getElementById('frameWebGL');
			elem_frameWebGL.style.width=currentPlayerWidth+'px';
			elem_frameWebGL.style.height=currentPlayerHeight+'px';
			
			var elem_PlayerWebGL = document.getElementById('PlayerWebGL');
			elem_PlayerWebGL.style.width=currentPlayerWidth+'px';
			elem_PlayerWebGL.style.height=currentPlayerHeight+'px';
			elem_PlayerWebGL.style.overflow='hidden';
			
			var elem_OverlayButton = document.getElementById('OverlayButton');
			elem_OverlayButton.style.position='absolute';
			elem_OverlayButton.style.top=(currentPlayerHeight-37)+'px';
			elem_OverlayButton.style.right='5px';
			elem_OverlayButton.style.width='32px';
			elem_OverlayButton.style.height='32px';
			elem_OverlayButton.style.zIndex='20';
			
			document.getElementById('BoxPlayer').style.position='relative';
			
			document.getElementById('PlayerWebGL').onmouseenter = disable_scroll_PlayerWebGL;
			document.getElementById('PlayerWebGL').onmouseleave = enable_scroll_PlayerWebGL;
			document.getElementById('frameWebGL').onmouseenter = disable_scroll_PlayerWebGL;
			document.getElementById('frameWebGL').onmouseleave = enable_scroll_PlayerWebGL;
			document.getElementById('OverlayButton').onmouseenter = disable_scroll_PlayerWebGL;
		}
		
		window.addEventListener( 'resize', onWindowResizePlayerWebGL, false );
		function onWindowResizePlayerWebGL(){
			if(isFullscreen==true){
				document.body.style.overflow="hidden";
				var elem_OverlayButton = document.getElementById('OverlayButton');
				elem_OverlayButton.style.top=(window.innerHeight-37)+'px';
			}
		}
		
		function cancelFullScreenPlayerWebGL(el) {
			isFullscreen=false;

			var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen || el.msExitFullscreen;

			if (requestMethod) {
				requestMethod.call(el);
			}
			else if(el.msExitFullscreen())
				el.msExitFullscreen();
			else if (typeof window.ActiveXObject !== "undefined") {
				var wscript = new ActiveXObject("WScript.Shell");
				if (wscript !== null) {
					wscript.SendKeys("{F11}");
				}
			}
			isFullscreen=false;
		}

		function requestFullScreenPlayerWebGL(el) {
			isFullscreen=true;
			
			var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullScreen || el.requestFullscreen || el.webkitRequestFullscreen || el.mozRequestFullscreen || el.msRequestFullscreen;

			if (requestMethod){
				requestMethod.call(el);
				el.mozRequestFullScreen();
			}
			else if (typeof window.ActiveXObject !== "undefined") {
				var wscript = new ActiveXObject("WScript.Shell");
				wscript.SendKeys("{F11}");
				if (wscript !== null) {
					wscript.SendKeys("{F11}");
				}
			}
			else if (el.requestFullscreen) {
				el.requestFullscreen();
			}
			else if (el.msRequestFullscreen) {
				el.msRequestFullscreen();
			}
			else if (el.mozRequestFullScreen) {
				el.mozRequestFullScreen();
			}
			else if (el.webkitRequestFullscreen) {
				el.webkitRequestFullscreen();
			} 
			
			isFullscreen=true;
		}
			
		function toggleFullPlayerWebGL() {
			var elem = document.getElementById('frameWebGL');
			
			if(isFullscreen==false){
				elem.style.border='0px'
				elem.style.top='0px';
				elem.style.left='0px';
				elem.style.right='0px';
				elem.style.bottom='0px';
				elem.style.width='100%';
				elem.style.height='100%';
				
				var elem_div_playerwebgl = document.getElementById('PlayerWebGL');
				elem_div_playerwebgl.style.position='absolute';
				elem_div_playerwebgl.style.top='0px';
				elem_div_playerwebgl.style.left='0px';
				elem_div_playerwebgl.style.width='100%';
				elem_div_playerwebgl.style.height='100%';

				var elem_OverlayButton = document.getElementById('OverlayButton');
				elem_OverlayButton.style.top=(window.innerHeight-32-5)+'px';
			}
			else{
				document.body.style.overflow="auto";
				elem.style.width=currentPlayerWidth+'px';
				elem.style.height=currentPlayerHeight+'px';
				
				var elem_div_playerwebgl = document.getElementById('PlayerWebGL');
				elem_div_playerwebgl.style.position='static';
				elem_div_playerwebgl.style.width=currentPlayerWidth+'px';
				elem_div_playerwebgl.style.height=currentPlayerHeight+'px';
				
				var elem_OverlayButton = document.getElementById('OverlayButton');
				elem_OverlayButton.style.position='absolute';
				elem_OverlayButton.style.top=(currentPlayerHeight-37)+'px';
			}
			
			var elem = document.body;
			var isInFullScreen = (document.fullScreenElement && document.fullScreenElement !== null) ||  (document.mozFullScreen || document.webkitIsFullScreen);

			if (isInFullScreen || isFullscreen==true) {
				cancelFullScreenPlayerWebGL(document);
			}
			else if (isInFullScreen==false || isFullscreen==false) {
				requestFullScreenPlayerWebGL(elem);
			}

		}