<?php
    require "../database_linking.php";
    echo '<link rel="stylesheet" href="Select_Style.css">';
    echo '<link rel="stylesheet" href="insert_style.css">';	
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>Select Country</title>';
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<button style="position:absolute;top:10px;left:10px;font-size:20px;font-family: 'Open Sans', sans-serif;" onclick="window.location.href='javascript:window.history.back()'">BACK</button>
<form id="Choose_Update_Country_Form" method="get" action="Country_Detail_New.php">
    <div style="margin:25vh auto;padding:5px;height:40vh;max-width:500px;width:100vw;">
        <fieldset style="padding:0px;font-size:30px;height:100%;max-height:300px;">
        <legend style="padding:20px;font-size:40px;">Country</legend>
            <div style="padding:10px;font-size:30px;height:30%;max-height:100px;">
                <label for="city_name">Country Name :</label></br></br></br>
                    <?php
                        $sql = "SELECT country_name.CountryCode,country_name.CountryName FROM country_name ORDER BY country_name.CountryCode ASC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo    "<select id='CountryCode' form='Choose_Update_Country_Form' name='CountryCode' required>"	;
                            echo    "<option value='' disabled selected>Select your option</option>"    ;
                            while($row = $result->fetch_assoc())
                            {
                                echo "<option value=". $row["CountryCode"].">"
                                                        . $row["CountryName"].
                                        "</option>";
                            }
                            echo "</select></br></br>";
                        }
                    ?>
            </div>
            <div style="font-size:30px;width:40%;height:40%;;width:100%;position:relative;">
                <button type="submit" style="padding:15px;border:1px solid white;font-family: 'Open Sans', sans-serif;position:absolute;right:0;bottom:0;font-size:20px;">SUBMIT</button>
            </div>
        </fieldset>
    </div>
</form>


