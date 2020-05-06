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
	$sql = "SELECT country_region.RegionName, AVG(population.LifeExpectancy) AS 'AverageLifeExpectancy' FROM country_region INNER JOIN geographical_information ON country_region.RegionID= geographical_information.RegionID INNER JOIN general_information ON geographical_information.CountryCode=general_information.CountryCode INNER JOIN population ON general_information.CountryCode=population.CountryCode where country_region.RegionID= '$valueToSearch' GROUP BY country_region.RegionName";
	$result = $conn->query($sql); 
	echo "<br>";
	
	echo "<table class=container>";
	
	if ($result->num_rows > 0) {
			echo "<tr>
					<th>Region Name</th>
					<th>Average Life Expectancy</th>
				</tr>";
			echo "<br>";
				
			while($row = $result->fetch_assoc())
			{
				echo "<tr> 
							<td>" . $row["RegionName"]. "</td>
							<td>" . $row["AverageLifeExpectancy"].  "</td>
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
	require "Choose_Average_Life_Expectancy_In_Region.php";
}

?>

<title>Average Life Expectancy In Region</title>

<div class="toprow" style="display:flex;flex-direction: row;">
<button onclick="window.location.href='../SpecialQuery/Choose_Average_Life_Expectancy_In_Region.php'" style="padding: 15px;">Back</button>
</div>