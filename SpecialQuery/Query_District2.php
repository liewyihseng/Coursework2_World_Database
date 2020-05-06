
<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="select_style.css">
    <link rel="stylesheet" href="../Select/select_style.css">
    <h1>District that Speaks English</h1>

  </head>

  <body>
  
<?php

    require "../database_linking.php";

    $sql = "SELECT district.DistrictName, district.CountryCode, district.PopulationDistrict FROM district INNER JOIN city ON district.DistrictID = city.DistrictID INNER JOIN general_information ON city.CountryCode = general_information.CountryCode INNER JOIN country_language ON general_information.CountryCode = country_language.CountryCode WHERE country_language.Language = 'English'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    //echo "Population More than 1 Million <br>";

    if ($resultCheck > 0) {
        echo "<table class = 'container'>";
        echo "<tr>                              
            <th>District Name</th>
            <th>Country Code</th>
            <th>Population</th>
            </tr>";

     while($row = mysqli_fetch_assoc($result)) {     //insert data into each row as array
        echo "<tr> 
                    <td>" . $row["DistrictName"]. "</td>                
                    <td>" . $row["CountryCode"].  "</td>
                    <td>" . $row["PopulationDistrict"].  "</td>";
        echo "</tr>";
                 
     }
     echo "</table>";

    } else {
      echo "0 results<br>";
    }

?>


</body>
</html>