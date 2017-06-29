$(function() {
  $(".filter").keyup(function() {
    input = this.value.toLowerCase().split(" ")
    $('.spse').each(function() {
        returns = true;
        cell = this
        cell_text = this.innerText.toLowerCase()
        $.each(input, function(i, match) {
            tbody = $(cell).closest(".container").closest("tr").prev(".clickable").closest("tbody")
            console.log(tbody)
            if (cell_text.indexOf(match) !== -1 || input.length == 0) {
              $(tbody).show()
              returns = false;
              return returns;
            } else {
              $(tbody).hide()
            }
        });
        return returns;
    });
  });
});


function filterTable(table, filter)
{
	var words = filter.toLowerCase().split(" ");
	
	for(var i = 0; i < table.tBodies.length; ++i)
	{
		var tbody = table.tBodies[i];
		var row = tbody.rows[0];
		
		var found = false;
		if(words.length == 1 && words[0].length == 0)
			found = true;
		else
		{
			for(var w = 0; w < words.length && !found; ++w)
				for(var c = 0; words[w].length > 0 && c < row.cells.length && !found; ++c)
				{
					var text = row.cells[c].innerText.toLowerCase();
					if(text.indexOf(words[w]) !== -1)
						found = true;
				}
		}
		
		tbody.style.display = found ? "" : "none";
	}
}

function filterTableBySelect(table, filter)
{
        
	var words = filter.toLowerCase();

	for(var i = 1; i < table.rows.length; ++i)
	{
		var row = table.rows[i];
		console.log(row);
		var found = row.cells[1].innerText === filter;
        
        if(filter=="all"){
            found = true;
        }
		
		row.style.display = found ? "" : "none";
	}
}

function makeAccordions()
{
	var clickables = $(".tbodytable > * > tr.clickable");
	for(var i = 0; i < clickables.length; ++i)
	{
		clickables[i].onclick = function() {
			if(this.parentNode.classList.contains("accordion"))
			{
				// Hide other accordions
				$(".tbodytable > * > tr.clickable").each(function(i,e) {
					e.parentNode.classList.add("accordion");
				});
				
				this.parentNode.classList.remove("accordion");
			}
			else
				this.parentNode.classList.add("accordion");
		};
	}
}

function makeSorttable(tableID)
{
	var table = $(document.getElementById(tableID)),
	tbody = $("> tbody", table),
	th_index = 0,
	th_sortType = "string";
	
	$("> thead > tr > th", table).data("sort-direction","ASC");
	
	function getSortList(i, elem)
	{
		var txt = $("> tr > td", elem).eq(th_index).text();
		$(elem).attr("data-sortval", txt);
	}
	
	function sortAsc(a, b)
	{
		var aData = $(a).attr("data-sortval"),
		bData = $(b).attr("data-sortval");
		
		if(th_sortType==="int")
			return +bData < +aData ? 1 : -1; // Integer
			else
				return  bData <  aData ? 1 : -1; // String or else
	}
	
	function sortDesc(a, b)
	{
		var aData = $(a).attr("data-sortval"),
		bData = $(b).attr("data-sortval");
		
		if(th_sortType==="int")
			return +bData > +aData ? 1 : -1; // Integer
			else
				return  bData >  aData ? 1 : -1; // String or else
	}
	
	//header sort
	$("> thead > tr > th", table).on("click", function() {
		//toggle the sorting direction
		$(this).data('sort-direction', ( $(this).data('sort-direction') == 'ASC' ? 'DESC' : 'ASC'));
		var dir = $(this).data('sort-direction');
		
		th_sortType = $(this).data('sort'); //get "int" or "string" from data-sort on th
		th_index = $(this).index();
		
		tbody = $("> tbody", table).each(getSortList);
		
		table.find('.sort-indicator').removeClass('sort-desc').removeClass('sort-asc');
		
		if ( dir == "ASC") {
			$(this).find('.sort-indicator').addClass('sort-asc'); //css class for ASC arrow
			tbody.sort(sortAsc).detach().appendTo(table); //sort table
		} else {
			$(this).find('.sort-indicator').addClass('sort-desc'); //css class for DESC arrow
			tbody.sort(sortDesc).detach().appendTo(table);  //sort table
		}
	});
}

function myAccFunc(elem) {
	var x = elem.nextElementSibling;
	if (x.className.indexOf("w3-show") == -1) {
		x.className += " w3-show";
		x.previousElementSibling.className += " w3-green";
	} else { 
		x.className = x.className.replace(" w3-show", "");
		x.previousElementSibling.className = 
		x.previousElementSibling.className.replace(" w3-green", "");
	}
}

function divSliderShowLeft(elem) {
	elem.children[0].style.maxHeight = "200px";
	elem.children[1].style.maxHeight = "0px";
}

function divSliderShowRight(elem) {
	elem.children[0].style.maxHeight = "0px";
	elem.children[1].style.maxHeight = "200px";
}
