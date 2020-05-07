<?php
    require "../database_linking.php";
    echo '<link rel="icon" href="../css/globe.png">';
    echo '<title>General Information</title>';
?>
<?php
    require "../nav_.php";
    echo '<link rel="stylesheet" href="../css/Select_Style.css">';
?>
<meta charset="UTF-8">
<meta name = "viewport" content = "width = device-width, initial-scale = 0.5"/>
<body style="padding:10px;width:100vw;margin:0 auto;">
    <h1 style="text-align:left;width:75%;margin: 0 auto;padding:20px;">GENERAL INFORMATION OF COUNTRY</h1>
    <div class="search-div" style="display:flex; flex-direction: row;">
        <div style="width:70%">
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../SpecialQuery/achieveindep.php';">People Achieving Independence</button>
        <button type="submit" class="search" id="search-btn" name="search" onclick="window.location.href = '../Insert/Insert_Country.php';">Insert New Country Data</button>
        </div>
        <form id="content" action="Select_General_Information.php" method="get">
        <input type="text" name="input" class="input" id="search-input" value="<?php if (!empty($_GET["input"])) echo $_GET["input"];?>" placeholder="Country Name">
        <button type="submit" class="search" id="search-btn" name="search">FILTER</button>
        </form>
    </div>	

    <?php
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
    
        $no_of_records_per_page = 50;
        $offset = ($pageno-1) * $no_of_records_per_page;
    
        if(isset($_GET['search']))
        {
            $valueToSearch = $_GET["input"];
            $sql = "SELECT * FROM `general_information` INNER JOIN country_name ON country_name.CountryCode=general_information.CountryCode AND country_name.CountryName='$valueToSearch'";
            $result = $conn->query($sql);   
        }
        else
        {
    
        $total_pages_sql = "SELECT COUNT(*) FROM general_information";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        $sql = "SELECT * FROM general_information LIMIT $offset, $no_of_records_per_page";
        $result = $conn->query($sql);
        
        }
    
        echo "<table class=container>";
    	if ($result->num_rows > 0) {
    		echo "<tr>
    				<th>Country Name</th>
    				<th>Independent Year of the Country</th>
                    <th>Form of Government in the Country</th>
                    <th>Ruler of the Country</th>
                    <th>Capital of the Country</th>
                    <th>Action</th>
    			  </tr>";
    			
            while($row = $result->fetch_assoc())
            {   $countrycode=$row["CountryCode"];
                $sql1 = "SELECT country_name.CountryName from country_name WHERE country_name.CountryCode='$countrycode'";
                $data1 = mysqli_query($conn, $sql1);
                $result1 = mysqli_fetch_assoc($data1);
                $CountryName = $result1['CountryName'];
                $GovernmentForm=$row["GovernmentForm"];
                $HeadOfState = $row["HeadOfState"];
                $IndepYear=$row["IndepYear"];
                $Capital = $row["Capital"];
                if ($GovernmentForm == NULL)
                    $GovernmentForm='-';
                if ($HeadOfState == NULL)
                    $HeadOfState='-';
                if ($IndepYear == NULL)
                    $IndepYear='-';
                if ($Capital == NULL)
                    $Capital='-';
                else
                    {
                    	$sql1 = "SELECT city.CityName FROM city WHERE city.CityID=$Capital";
                        $data1 = mysqli_query($conn, $sql1);
                        $result1 = mysqli_fetch_assoc($data1);
                        $CapitalName = $result1['CityName'];
                    }
                echo "<tr> 
                            <td><a href='http://hfyyl2.mercury.nottingham.edu.my/SpecialQuery/Country_Detail.php?CountryCode=".utf8_encode($row["CountryCode"])."'><div>" . utf8_encode($CountryName). "</div></a></td>
                            <td>" . utf8_encode($IndepYear).  "</td>
                            <td>" . utf8_encode($HeadOfState).  "</td>
                            <td>" . utf8_encode($HeadOfState).  "</td>
                            <td>" . utf8_encode($CapitalName).  "</td>
                            <td><button type='submit' class='search_delete_update' style='margin:2px;' id='search-btn' name='search' onclick='window.location.href = `http://hfyyl2.mercury.nottingham.edu.my/Delete/Delete_Country.php?CountryCode=". $row["CountryCode"]."`'>Delete Data</button>
                                <button type='submit' class='search_delete_update' id='search-btn' name='search' style='margin:2px;' onclick='window.location.href = `http://hfyyl2.mercury.nottingham.edu.my/ChooseUpdate/Update/UpdateCountry.php?CountryCode=". $row["CountryCode"]."`'>Update Data</button>
                            </td>";
    			echo "</tr>";
    		}
    		echo "</table>";
    	}
    	else {
            echo "<tr>
                    <th>Country Name</th>
                    <th>Independent Year of the Country</th>
                    <th>Form of Government in the Country</th>
                    <th>Ruler of the Country</th>
                    <th>Capital of the Country</th>
                 </tr>";
            echo "</br></br>";
            echo "<tr><th  colspan='5' style='background-color:#323C50'>0 Result</th><tr>";
    	}
    	$conn->close();
    ?>
        <div class="pagination">
            <button><a href="?pageno=1">First</a></button>
            <button class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1);}?>" style='background-color: transparent;color:#fff'">Prev</a>
            </button>
                    <h2>&emsp;<?php echo $pageno; ?>&emsp;</h2>
            <button class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" style='background-color: transparent;color:#fff'">Next</a>
            </button>
            <button><a href="?pageno=<?php echo $total_pages; ?>">Last</a></button>
        </div>