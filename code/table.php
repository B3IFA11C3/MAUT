<?php

function table_render($columns, $contents, $addcontent=NULL)
{
	global $tableid;
	if(!isset($tableid))
		$tableid = 0;
	else
		++$tableid;

	$content = '<div class="tablewrapper">
		<div class="filterwrapper">
			<label class="filterlabel" for="filter">Filter:</label>
			<input class="filter" type="text" onkeyup="filterTable(document.getElementById(\'table' . $tableid . '\'), this.value);"/>
		</div>';

	$content .= '<table id="table' . $tableid . '" class="table tbodytable tbodytable-striped tbodytable-sortable">
			<thead class="accordion">
				<tr>';

	foreach($columns as $name => $type)
		$content .= '<th class="clickable" data-sort="' . $type . '">' . $name . ' <i class="sort-indicator" aria-hidden="true"></i></th>';

	$content .= '</tr>';

	if(is_array($addcontent))
	{
		$content .= '<tr class="clickable">
					<td colspan="' . count($columns) . '">
						<div style="text-align: center">' . $addcontent["header"] . '</div>
					</td>
				</tr>';

		$content .= '<tr><td colspan="' . count($columns) . '">' . $addcontent["content"] . "</td></tr>";
	}
	
	$content .= '</thead>';

	foreach($contents as $index => $item)
	{
		$content .= '<tbody class="accordion">';

		if(isset($item["content"]))
			$content .= '<tr class="clickable">';
		else
			$content .= '<tr>';

		foreach($item["cols"] as $col)
			$content .= '<td style="padding: 10.5px !important">' . htmlentities($col) . '</td>';

		$content .= '</tr>';

		if(isset($item["content"]))
			$content .= '<tr><td colspan="' . count($columns) . '">' . $item["content"] . '</td></tr>';

		$content .= '</tbody>';
	}
	
	$content .= '</table>';
	
	$content .= '<script>
		makeAccordions();
		makeSorttable("table' . $tableid . '");
	</script>';
	
	return $content;
}

?>
