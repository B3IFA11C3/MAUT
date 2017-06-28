<?php
    $komponenten = array(
        0 => array(
            "name" => "Test1",
            "art" => "Storage"
        ),
        1 => array(
            "name" => "Test2",
            "art" => "Server"
        ),
        2 => array(
            "name" => "Test3",
            "art" => "Switch"
        ),
        3 => array(
            "name" => "Test4",
            "art" => "Client-PC"
        )
    );
    $komponenten_arten = array(
        "Storage",
        "Server",
        "Switch",
        "Client-PC",
        "Client-PC"
    );
?>

<html>
    <head>
        <title>Test</title>
        <script src='../js/jquery.min.js' type='text/javascript'></script>
          <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href='../css/JQuery-ui.css'>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		  
		
		<script src='../js/chosen/chosen.jquery.min.js' type='text/javascript'></script>
		<script src='../js/bootstrap.min.js' type='text/javascript'></script>
        <link rel='stylesheet' href='../js/chosen/chosen.css'>
		<link rel='stylesheet' href='../css/style.css'>		
		<link rel='stylesheet' href='../css/bootstrap.min.css'>

		<script src="../js/mast.js"></script>
    </head>
    
    <body>
	<br/>
	<div class="row">
		<div class="col-md-2">
		</div>	
		<div class="card card-block" id="card-shadow">
			<div class="card-title">
                <input type="text" placeholder="Raum-Nr." name="roomnr" />
                <input type="text" placeholder="Bezeichnung" name="roomdsg" />
			</div>
			<div class="card-text">
				<br/>
				<div class="vboxLeft">
						<div class="row">
						<div class="col-md-1">
						</div>	
						<div class="col-md-4">
				        </div>	
						<div class="col-md-1">
						</div>	
						</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-4">	
							<table class="table table-hover">
								<thead>
								<tr>
									<th>Name</th>
									<th>Art</th>
								</tr>
								</thead>
                                <?php
                                    if (!empty($komponenten)) {
                                        echo "<tbody>";
                                        
                                        foreach ($komponenten as $komponent) {
                                            $name = $komponent['name'];
                                            $art = $komponent['art'];
                                            
                                            echo "<tr>";
                                            echo "<td>".$name."</td>";
                                            echo "<td>".$art."</td>";
                                            echo "</tr>";
                                        }
                                        
                                        echo "</tbody>";
                                    }
                                ?>
							</table>
							</div>
							<div class="col-md-1">
							</div>	
							<div class="col-md-4">
								<div class="short-div">
								<label>Komponentenart:</label>
                                    <select data-placeholder='test placeholder' class='chosen-select' style="width: 150px;" onchange="filterTableBySelect(document.getElementById('table_left'), this.value);">
                                        <?php
                                            foreach (array_unique($komponenten_arten) as $komponent) {

                                                echo "<option value=\"".$komponent."\">".$komponent."</option>";
                                            }
                                        ?>
                                    </select>
								</div>
								<div class="short-div">
								<table id="table_left" class="table table-hover">
								<thead>
								<tr>
									<th>Name</th>
									<th>Art</th>
								</tr>
								</thead>
                                <?php
                                    if (!empty($komponenten)) {
                                        
                                        foreach ($komponenten as $komponent) {
                                            $name = $komponent['name'];
                                            $art = $komponent['art'];
                                            
                                            echo "<tbody>";
                                            echo "<tr>";
                                            echo "<td>".$name."</td>";
                                            echo "<td>".$art."</td>";
                                            echo "</tr>";
                                            echo "</tbody>";
                                        }
                                        
                                    }
                                ?>
							</table>
								</div>
							</div>
					</div>	
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-1">
							<input name="btnBearb" type="button" class="btn btn-primary" value="Bearbeiten"/>
						</div>
						<div class="col-md-1">
							<input name="btnSave" type="button" class="btn btn-primary" value="Speichern"/>
						</div>
						<div class="col-md-1">
							<input name="txtAnzahl" type="text"  value="55"/>
						</div>
						<div class="col-md-1">
							<input name="btnAdd" type="button" class="btn btn-primary" value="Add"/>
						</div>
					</div>
				</div>
			</div>
		
		</div>
		<div class="col-md-2">
		</div>
	</div>
    </body>
    <!-- zum initialisieren der chosen selects muss $('.chosen-select').chosen(); aufgerfen werden -->
    <script type='text/javascript'>
        $('.chosen-select').chosen();
		
			$( function() {
				$( "#datepicker" ).datepicker();
			} );
	
	
		
    </script>
</html>
