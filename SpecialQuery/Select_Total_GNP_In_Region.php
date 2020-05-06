<?php
    require "../database_linking.php";
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
    echo '<link rel="stylesheet" href="../css/insert_style.css">';	
?>

<?php
if(isset($_GET['regionID']))
{
	$valueToSearch = $_GET["regionID"];
	$sql = "SELECT country_region.RegionName, SUM(economic_status.GNP) AS \"Total GNP\" FROM country_region INNER JOIN geographical_information ON country_region.RegionID = geographical_information.RegionID INNER JOIN general_information ON geographical_information.CountryCode=general_information.CountryCode INNER JOIN economic_status ON general_information.CountryCode=economic_status.CountryCode where country_region.RegionID = $valueToSearch GROUP BY country_region.RegionName ORDER BY SUM(economic_status.GNP) DESC";
	$result = $conn->query($sql); 
	echo "<br>";
	
	echo "<table class=container>";
	
	if ($result->num_rows > 0) {
			echo "<tr>
					<th>Region Name</th>
					<th>Total GNP</th>
				</tr>";
			echo "<br>";
				
			while($row = $result->fetch_assoc())
			{
				echo "<tr> 
							<td>" . $row["RegionName"]. "</td>
							<td>" . $row["Total GNP"].  "</td>
						</tr>";
				echo "<br>";
			}
		}
	else {
		echo "0 results";
	}
	$conn->close();  
}
else
{
	require "Choose_Total_GNP_In_Region.php";
}

?>

<title>Total GNP In Region</title>
<div class="toprow" style="display:flex;flex-direction: row;">
<button onclick="window.location.href='../SpecialQuery/Choose_Total_GNP_In_Region.php'" style="padding: 15px;">Back</button>
</div>