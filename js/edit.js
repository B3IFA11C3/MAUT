function clickBearbeiten() {
			var elemente = document.getElementsByClassName("feldAktivieren");
			for(var i = 0; i < elemente.length; i++) {
				elemente[i].removeAttribute("disabled");
			}
			document.getElementById("kompArt_chosen").className =
    document.getElementById("kompArt_chosen").className.replace(/\bchosen-disabled\b/,'');
			document.getElementById("Lieferant_chosen").className =
    document.getElementById("Lieferant_chosen").className.replace(/\bchosen-disabled\b/,'');
	document.getElementById("bearbeiten").setAttribute("disabled","");
	document.getElementById("speichern").removeAttribute("disabled");
		}
		
		function clickSpeichern() {
			var elemente = document.getElementsByClassName("feldAktivieren");
			for(var i = 0; i < elemente.length; i++) {
				elemente[i].setAttribute("disabled", "");
			}
			document.getElementById("kompArt_chosen").className += " chosen-disabled";
			document.getElementById("Lieferant_chosen").className += " chosen-disabled";
			document.getElementById("bearbeiten").removeAttribute("disabled");
	document.getElementById("speichern").setAttribute("disabled","");
		}