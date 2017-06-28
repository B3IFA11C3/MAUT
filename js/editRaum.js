function clickEditRoom() {
			var elemente = document.getElementsByClassName("changeEditStatus");
			for(var i = 0; i < elemente.length; i++) {
				elemente[i].removeAttribute("disabled");
				elemente[i].setAttribute("enabled", "enabled");
			}

    var elementeChosen = document.getElementsByClassName("selectKoArt");
			for(var i = 0; i < elementeChosen.length; i++) {
				elementeChosen[i].removeAttribute("disabled");
				elementeChosen[i].setAttribute("enabled", "enabled");
			}
  
	$(document.getElementsByClassName("selectKoArt")).trigger("chosen:updated");
	
	document.getElementById("btnAdd").setAttribute("disabled","");
	document.getElementById("btnRem").removeAttribute("disabled");
	document.getElementById("btnAdd").removeAttribute("disabled");
		

}
		
		function clickSaveRoom() {
			var elemente = document.getElementsByClassName("feldAktivieren");
			for(var i = 0; i < elemente.length; i++) {
				elemente[i].setAttribute("disabled", "");
			}
			
			document.getElementById("bearbeiten").removeAttribute("disabled");
	document.getElementById("speichern").setAttribute("disabled","");
	
		$(document.getElementsByClassName("Lieferant")).trigger("chosen:updated");
	$(document.getElementsByClassName("kompArt")).trigger("chosen:updated");
		}