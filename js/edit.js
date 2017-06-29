function clickBearbeiten() {
			var elemente = document.getElementsByClassName("feldAktivieren");
			
			for(var i = 0; i < elemente.length; i++) {
				elemente[i].removeAttribute("disabled");
				elemente[i].setAttribute("enabled", "enabled");
			}
			
			var bearbeitenElemente = document.getElementsByClassName("bearbeitenDeaktivieren");
			for(var i = 0; i < bearbeitenElemente.length; i++) {
				bearbeitenElemente[i].setAttribute("disabled", "");
			}

			
				$(document.getElementsByClassName("Lieferant")).trigger("chosen:updated");
				$(document.getElementsByClassName("kompArt")).trigger("chosen:updated");
				$(document.getElementsByClassName("Raeume")).trigger("chosen:updated");
	
				document.getElementById("speichern").removeAttribute("disabled");
		}
		
function clickSpeichern() {
			var elemente = document.getElementsByClassName("feldAktivieren");
			
			for(var i = 0; i < elemente.length; i++) {
				elemente[i].setAttribute("disabled", "");
			}
			
			var bearbeitenElemente = document.getElementsByClassName("bearbeitenDeaktivieren");
			for(var i = 0; i < bearbeitenElemente.length; i++) {
				bearbeitenElemente[i].removeAttribute("disabled");
				bearbeitenElemente[i].setAttribute("enabled", "enabled");
			}

	
			$(document.getElementsByClassName("Lieferant")).trigger("chosen:updated");
			$(document.getElementsByClassName("kompArt")).trigger("chosen:updated");
			$(document.getElementsByClassName("Raeume")).trigger("chosen:updated");
			
		}