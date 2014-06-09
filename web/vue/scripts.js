




{
	var popup = (function(){

		var opened = null;
		
		return function(url){
			if(opened != null){
				if(opened.url == url){
					opened.ref.focus();
					return ;
				}
				opened.ref.close();
			}

			var h = 600, w = 400,
				left = (screen.width/2)-(w/2),
				top = (screen.height/2)-(h/2);

			opened = {
				url: url,
				ref: window.open(url, "", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
			};

			console.log(opened);
			
		};
	}());

	$(window).ready(function(){


		$("table a:not(.button)").click(function(){
			popup($(this).attr("href"));
			return false;
		});

	});

}
