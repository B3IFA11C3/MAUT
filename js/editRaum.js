//Diese Funktion tauscht den Bearbeiten Button mit einem Speichern Button und tauscht diesen wieder zurück
//Zusätzlich aktiviert die Funktion im Bearbeitungsmodus alle Felder und deaktiviert diese nach dem Speichern wieder
function clickEditRoom() {
	//Klassen einlesen
		var elemente = document.getElementsByClassName("changeEditStatus");
		var btnType = document.getElementsByClassName("btnEditRoom");
		
		if(btnType.length > 0){
			for(var i = 0; i < elemente.length; i++) {
				elemente[i].removeAttribute("disabled");
				elemente[i].setAttribute("enabled", "enabled");
			}
			
			//Tausche alle Buttons zu SaveButtons
			while(btnType.length > 0){
				btnType[0].value="Raum speichern";
				btnType[0].className = "btn btnSaveRoom btn-primary";
				btnType = document.getElementsByClassName("btnEditRoom");				
			}
			
			//Aktiviere die Selects für die Bearbeitung
			var elementeChosen = document.getElementsByClassName("selectKoArt");
			
			for(var i = 0; i < elementeChosen.length; i++) {
				elementeChosen[i].removeAttribute("disabled");
				elementeChosen[i].setAttribute("enabled", "enabled");
			}
  
			$(document.getElementsByClassName("selectKoArt")).trigger("chosen:updated");
	
			document.getElementById("btnRem").removeAttribute("disabled");
			document.getElementById("btnAdd").removeAttribute("disabled");
				
			}
		else{
			//Tausche alle Buttons zu bearbeiten Buttons
			btnType = document.getElementsByClassName("btnSaveRoom");
			while(btnType.length > 0){
				btnType[0].value="Raum bearbeiten";
				btnType[0].className = "btn btnEditRoom btn-primary";
				btnType = document.getElementsByClassName("btnSaveRoom");				
			}
			
			for(var i = 0; i < elemente.length; i++) {
				elemente[i].setAttribute("disabled","");
				
			}
			
			//Deaktiviere die Selects wieder, wenn gespeichert wurde
			var elementeChosen = document.getElementsByClassName("selectKoArt");
			
			for(var i = 0; i < elementeChosen.length; i++) {
				elementeChosen[i].setAttribute("disabled", "disabled");
			}
			
			$(document.getElementsByClassName("selectKoArt")).trigger("chosen:updated");
		}
}

function addKomponentenToCurrentList(id){
    
        var tableRight = "table_right"+id;
        var tableLeft = "table_left"+id;
        var table = document.getElementById(tableRight);
    
        for(var x=1; x<table.rows.length; x++){

            var name = table.rows[x].cells[0];
            var art = table.rows[x].cells[1];
            var checkbox = table.rows[x].cells[2];
            
           
            
            
            if($("input[type=checkbox]", checkbox)[0].checked) {    
                //$('#table_left'.id').after('<tr>...</tr><tr>...</tr>');
                
                $("#"+tableLeft).after("td").append("<tr><td>"+name.innerHTML+"</td><td>"+art.innerHTML+"</td><td></td></tr>");
            }
        }  
        
}
