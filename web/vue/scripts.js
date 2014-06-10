
function reloadParent(){
	if( window.opener !== undefined )
		window.opener.location.reload();
}



{
	var popup = ( function(){

		var opened = { url: null };
		
		return function(url, title){
			if(opened.url != null){
				if(opened.url == url){
					opened.ref.focus();
					return ;
				}
				opened.ref.close();
			}

			var h = 400, w = 400,
				left = (screen.width/2)-(w/2),
				top = (screen.height/2)-(h/2);

			opened = {
				url: url,
				ref: window.open(url, "", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
			};
			opened.ref.onbeforeunload = function(){
				console.log(opened);
				opened.url = null;
			};

			console.log(opened);
			
		};
	}() );

	$(window).ready(function(){

		$("a.add, a.edit, a.delete").click(function(){
			var url = $(this).attr("href");
			popup(url);
			return false;
		});

		var $resetButton = $("button.reset");
		if( $resetButton.length > 0 ){ //in a popup
			var $buttons = $resetButton.add("button.submit");
			
			$("input").on('input', function(){
				$buttons.attr("disabled", null);
			});

			$resetButton.click(function(){
				setTimeout(function(){$buttons.attr("disabled", "disabled")}, 0);
				return true;
			});

			$buttons.attr("disabled", "disabled");

		}
		

	});


}
