<?php

function komponenten_show()
{
	$content = '<div class="w3-container w3-teal"><h1>Komponenten</h1></div>
	
	<div id="tablewrapper">
		<div id="filterwrapper">
			<label id="filterlabel" for="filter">Filter:</label>
			<input id="filter" type="text" onkeyup="filterTable(document.getElementById(\'table\'), this.value);"/>
		</div>

		<table id="table" class="table tbodytable tbodytable-striped tbodytable-sortable">
			<thead class="accordion">
				<tr>
		            <th class="clickable" data-sort="string">Name <i class="sort-indicator" aria-hidden="true"></i></th>
					<th class="clickable" data-sort="string">Art <i class="sort-indicator" aria-hidden="true"></i></th>
				</tr>
				<tr class="clickable">
					<td colspan="2">
						<div style="text-align: center">Neue Komponente hinzufügen</div>
					</td>
				</tr>
				<tr><td colspan="2">
					<div class="formbox">
						<form method="POST">
						<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
						<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
						<label>Garantie: <input type="date" name="guar"/></label>

						<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
						<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
						<br>
						<input type="submit"/>
						<input type="reset"/>
						</form>
					</div>
				</td></tr>
			</thead>

			<tbody class="accordion">
				<tr class="clickable"><td>Lenowo SinkPad</td><td>Laptop</td></tr>
				<tr><td colspan="2">
					<div>
						<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
						<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
						<label>Garantie: <input type="date" name="guar"/></label>

						<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
						<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
					</div>
				</td></tr>
			</tbody>

			<tbody class="accordion">
				<tr class="clickable"><td>Apfel iMer</td><td>PC</td></tr>
				<tr><td colspan="2">
					<div>
						<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
						<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
						<label>Garantie: <input type="date" name="guar"/></label>

						<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
						<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
					</div>
				</td></tr>
			</tbody>

			<tbody class="accordion">
				<tr class="clickable"><td>HorstBox</td><td>Router</td></tr>
				<tr><td colspan="2">
					<div>
						<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
						<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
						<label>Garantie: <input type="date" name="guar"/></label>

						<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
						<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
					</div>
				</td></tr>
			</tbody>

			<tbody class="accordion">
				<tr class="clickable"><td>BigMacBook</td><td>Laptop</td></tr>
				<tr><td colspan="2">
					<div>
						<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
						<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
						<label>Garantie: <input type="date" name="guar"/></label>

						<label>Hersteller: <input type="text" name="make" value="Wahwei"/></label>
						<label>Beschreibung: <input type="text" name="desc" value="Ändreud"/></label>
					</div>
				</td></tr>
			</tbody>
		</table>
	</div>';
	
	$content .= '<script>
		makeAccordions();
		makeSorttable("table");
	</script>';

	page_render($content);
	return true;
}

page_add_menu("Komponenten", "/komponenten");

maut_register_path("#komponenten$#", "komponenten_show");
maut_register_path("#^\$#", "komponenten_show");

return true;
?>
