<html>
<head>
    <title>Search</title>
    <style type="text/css">
        html{
            display:table;
            margin: auto;
        }
        body{
            padding-top:50px;
            display:table-cell;
        }
        #box{
            width: 505px;
            height: 125px;
            margin-left: 400px;
            margin-right: 400px;
            font-family: Helvetica;
            background-color: #E5E7E9;
            padding-top: 60px;
        }
        #p1{
            margin-top:-60px;
            padding-top:5px;
        }
        #addon{
            margin-top:8px;
            margin-left:-70px;
        }
        #type{
            margin-top:-10px;
        }
    </style>
    <script type="text/javascript">
        var album1=0;
        var post1=0;
        var pic1=0;
        var pic2=0;
        var pic3=0;
        var pic4=0;
        var pic5=0;
        function addInput(){
            if (document.forms["myForm"]["type1"].value=="place"){
                document.getElementById("addon").style.display="block";
            }
            else{
                document.getElementById("addon").style.display="none";
            }
            return true;
        }
        function clearFunction() {
                //document.getElementById("myForm").reset();
                document.getElementById("type1").value = "Users";
                document.getElementById("key").value = "";
                window.location.replace('http://cs-server.usc.edu:18967/Search1.php');
                return false;
            }
        function redirectURLWithPost(e){
                var myForm = document.getElementById('redirectForm'); 
                document.getElementById('selected_id').value =e.childNodes[1].value;
                myForm.submit();
            
        }
        function album(){
            if(album1%2==0){
                document.getElementById("showalbum").style.display="block";
                document.getElementById("showpost").style.display="none";
                album1++;
            }
            else{
              document.getElementById("showalbum").style.display="none";  
                album1++;
            }
        }
        function post(){
            if(post1%2==0){
                document.getElementById("showpost").style.display="block";
                document.getElementById("showalbum").style.display="none";
                document.getElementById("tr1").style.display="none";
                document.getElementById("tr2").style.display="none";
                document.getElementById("tr3").style.display="none";
                document.getElementById("tr4").style.display="none";
                document.getElementById("tr5").style.display="none";
                post1++;
            }
            else{
              document.getElementById("showpost").style.display="none";  
                post1++;
            }
            
        }
        function showpictures1(){
            if(pic1%2==0){
            document.getElementById("tr1").style.display="block";
                pic1++;
            }
            else{
              document.getElementById("tr1").style.display="none";  
                pic1++;
            }
        }
        function showpictures2(){
             if(pic2%2==0){
            document.getElementById("tr2").style.display="block";
                 pic2++;
             }
            else{
              document.getElementById("tr2").style.display="none";  
                pic2++;
            }
        }
        function showpictures3(){
             if(pic3%2==0){
            document.getElementById("tr3").style.display="block";
                 pic3++;
             }
            else{
              document.getElementById("tr3").style.display="none";  
                pic3++;
            }
        }
        function showpictures4(){
             if(pic4%2==0){
            document.getElementById("tr4").style.display="block";
                 pic4++;
             }
            else{
              document.getElementById("tr4").style.display="none";  
                pic4++;
            }
        }
        function showpictures5(){
             if(pic5%2==0){
            document.getElementById("tr5").style.display="block";
                 pic5++;
             }
            else{
              document.getElementById("tr5").style.display="none";  
                pic5++;
            }
        }
    </script>
</head>
    <body> 
        <div id="box">
        <center><div id="p1"><p><i>Facebook Search</i></p></div></center>
        <hr width="95%">
        <form id="myForm" action="" method="get">
        <table id="searchTable">
        <tr>
            <td><label for="keyword">Keyword:</label></td>
            <td><input type="text" id="key" name="key" required value="<?php echo isset($_GET['key']) ? $_GET['key'] : '' ?>" ></td>
        </tr>
        <tr>
            <td><div id="type"><label>Type:</label></div></td>
            <td><div id="select">
                <select name="type1" id="type1" onchange="addInput()" value="<?php echo isset($_GET['type1']) ? $_GET['type1'] : '' ;?>" >
                <option value="user">Users</option>
                <option value="page">Pages</option>
                <option value="event">Events</option>
                <option value="group">Groups</option>
                <option value="place">Places</option>
                </select>
                <script type="text/javascript">
                document.getElementById('type1').value="<?php echo $_GET['type1'];?>";
                </script></div>
                <div id="addon" style="display:none">
                Location:<input type="text" name="location" value="<?php echo isset($_GET['location']) ? $_GET['location'] : '' ?>" >
                Distance(meters):<input type="text" name="distance" value="<?php echo isset($_GET['distance']) ? $_GET['distance'] : '' ?>">
                </div>
                <script type="text/javascript">
                  addInput(document.getElementById("type1").value);
                </script>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Search"> 
                <button id="Reset" value="Clear" onclick="clearFunction()">Clear</button>
            </td>
        </tr> 
        </table>
        </form>
        </div>
        <br/>
        
     <?php
            require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
            date_default_timezone_set('America/Los_Angeles');
            if(isset($_GET['key'])){
            $type=$_GET['type1'];
            $keyword=$_GET['key'];
            if(isset($_GET['id1']))
      {
                $id = $_GET['id1'];
                $fb = new Facebook\Facebook([
                'app_id' => '743397835811303',
                'app_secret' => 'adb22db670462b9c19e508d1f393ced1',
                'default_graph_version' => 'v2.8',
                ]);
                $fb->setDefaultAccessToken('EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz');
                $response = $fb->get('/'.$id.'?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name,picture}},posts.limit(5)');
                $graphEdge = $response->getGraphNode();
                $json_content = json_decode($graphEdge,true);
                $picture = $fb->get('/'.$id.'/picture?'); 
                if(!(isset($json_content['albums']))){
                    $count1=0;
                }
                else{
                    $count1=1;
                }
                if(!(isset($json_content['posts']))){
                    $count2=0;
                }
                else{
                    $count2=1;
                }
                echo "<table id = 'some1' style=' text-align: center ; border-collapse:collapse;' align='center'; border='1'; >";
                if($count1 == 0){
                    echo "<tr><td colspan='2' bgcolor='#F8F9F9' style='width:500px;'>No Albums have been found.<td></tr>";
                }
                echo "</table></br>";
                echo "<table id = 'some2' style=' text-align: center; border-collapse:collapse;' align='center'; border='1'; >";
                if($count2 == 0){
                    echo "<tr><td colspan='2' bgcolor='#F8F9F9' style='width:500px;'>No Posts have been found.<td></tr>";
                }
                echo "</table>";
                if($count1!=0 && $count2!=0){
                echo "<div id='searchResult3'>";
                echo "<table id = 'result3' style=' text-align: center ; border-collapse:collapse;' align='center'; border='0'; >";
                echo "<tr><td colspan='2' bgcolor='#BDC3C7' style='width:500px;'><a href='#' onclick='album()'>Albums<td></tr>";
                echo "</table>";
                echo "<div id='showalbum' style='display:none'>";
                echo "<table id = 'result4' style=' text-align: center ; border-collapse:collapse;' align='center'; cellpadding='0' cellspacing='0' border='1' >";
                 /*data*/  
                    
                    echo "<tr>";
                    echo "<td style='text-align:left; padding-left: 50px; padding-right: 50px; width:400px;'><a href='#' onclick='showpictures1()'>".$json_content['albums'][0]['name']."</a></td>";
                    echo "<td> </td></tr>";
                    echo "<tr id='tr1' style='display:none'><td style='text-align:left; padding-left: 50px; padding-right: 50px; height:50px; width:1000px;'><a href='https://graph.facebook.com/v2.8/".$json_content['albums'][0]['photos'][0]['id']."/picture?access_token=EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz' target='_blank'><img src='".$json_content['albums'][0]['photos'][0]['picture']."'></a> <a href='https://graph.facebook.com/v2.8/".$json_content['albums'][0]['photos'][1]['id']."/picture?access_token=EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz' target='_blank'><img src='".$json_content['albums'][0]['photos'][1]['picture']."'></a></td></tr>";
                    
                    echo "<tr>";
                    echo "<td style='text-align:left; padding-left: 50px; padding-right: 50px; width:400px;'><a id='id2' href='#' onclick='showpictures2()'>".$json_content['albums'][1]['name']."</a></td>";
                    echo "<td> </td></tr>";
                    echo "<tr id='tr2' style='display:none'><td style='text-align:left; padding-left: 50px; padding-right: 50px; height:50px; width:1000px;'><a href='https://graph.facebook.com/v2.8/".$json_content['albums'][1]['photos'][0]['id']."/picture?access_token=EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz' target='_blank'><img src='".$json_content['albums'][1]['photos'][0]['picture']."'></a> <a href='https://graph.facebook.com/v2.8/".$json_content['albums'][1]['photos'][1]['id']."/picture?access_token=EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz' target='_blank'><img src='".$json_content['albums'][1]['photos'][1]['picture']."'></a></td></tr>";
                          
                    echo "<tr>";
                    echo "<td style='text-align:left; padding-left: 50px; padding-right: 50px; width:400px;'><a id='id2' href='#' onclick='showpictures3()'>".$json_content['albums'][2]['name']."</a></td>";
                    echo "<td> </td></tr>";
                    echo "<tr id='tr3' style='display:none'><td style='text-align:left; padding-left: 50px; padding-right: 50px; height:50px; width:1000px;'><a href='https://graph.facebook.com/v2.8/".$json_content['albums'][2]['photos'][0]['id']."/picture?access_token=EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz' target='_blank'><img src='".$json_content['albums'][2]['photos'][0]['picture']."'></a> <a href='https://graph.facebook.com/v2.8/".$json_content['albums'][2]['photos'][1]['id']."/picture?access_token=EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz' target='_blank'><img src='".$json_content['albums'][0]['photos'][1]['picture']."'></a></td></tr>";
            
                    echo "<tr>";
                    echo "<td style='text-align:left; padding-left: 50px; padding-right: 50px; width:400px;'><a id='id2' href='#' onclick='showpictures4()'>".$json_content['albums'][3]['name']."</a></td>";
                    echo "<td> </td></tr>";
                    echo "<tr id='tr4' style='display:none'><td style='text-align:left; padding-left: 50px; padding-right: 50px; height:50px; width:1000px;'><a href='https://graph.facebook.com/v2.8/".$json_content['albums'][3]['photos'][0]['id']."/picture?access_token=EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz' target='_blank'><img src='".$json_content['albums'][3]['photos'][0]['picture']."'></a> <a href='https://graph.facebook.com/v2.8/".$json_content['albums'][3]['photos'][1]['id']."/picture?access_token=EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz' target='_blank'><img src='".$json_content['albums'][0]['photos'][1]['picture']."'></a></td></tr>";
                
                    
                    echo "<tr>";
                    echo "<td style='text-align:left; padding-left: 50px; padding-right:50px; width:400px;'><a id='id2' href='#' onclick='showpictures5()'>".$json_content['albums'][4]['name']."</a></td>";
                    echo "<td> </td></tr>";
                    echo "<tr id='tr5' style='display:none'><td style='text-align:left; padding-left: 50px; padding-right: 50px; height:50px; width:1000px;'><a href='https://graph.facebook.com/v2.8/".$json_content['albums'][4]['photos'][0]['id']."/picture?access_token=EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz' target='_blank'><img src='".$json_content['albums'][4]['photos'][0]['picture']."'></a> <a href='https://graph.facebook.com/v2.8/".$json_content['albums'][4]['photos'][1]['id']."/picture?access_token=EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz' target='_blank'><img src='".$json_content['albums'][0]['photos'][1]['picture']."'></a></td></tr>";
                    
            /*end of data*/
              echo "</table>";
              echo "</div></br></br>";
              echo "<table id = 'result5' style=' text-align: center ; border-collapse:collapse;' align='center'; border='0'; >";
              echo "<tr><td colspan='2' bgcolor='#BDC3C7' style='width:500px;' ><a href=# onclick='post()'>Posts<td></tr>";
              echo "</table>";
              echo "<td><div id='showpost' style='display:none'></td>";
              echo "<table id = 'result6' style=' text-align: center ; border-collapse:collapse;' align='center'; border='1'; >";
              $count3 = count($json_content['posts']);
              //echo $count3;
              for($i=0; $i<$count3; $i++){
                    echo "<tr>";
                    echo "<td style='text-align:left; height:50px; width:500px;'>".$json_content['posts'][$i]['message']."</td>";
            }
            echo "</table></div>";
                }   }
            else{
            if($type=="user" || $type=="page" || $type=="group")
            {
                $fb = new Facebook\Facebook([
                'app_id' => '743397835811303',
                'app_secret' => 'adb22db670462b9c19e508d1f393ced1',
                'default_graph_version' => 'v2.8',
                ]);
                $fb->setDefaultAccessToken('EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz');
                $response = $fb->get('/search?q='.$keyword.'&type='.$type.'&fields=id,name,picture.width(700).height(700)');
                $graphEdge = $response->getGraphEdge();
                $json_content = json_decode($graphEdge);
                //reset form values
                echo "<script type='text/javascript'>selectedObj = document.getElementById('type1');selectedObj.value ='". $type."';";
                echo "document.getElementById('key').value ='". $keyword."';</script>  " ;
                
                $count = count($json_content);
                if($count == 0){
                    echo "<table align='center' style='width:500px; text-align:center; border-collapse:collapse;' border='1'><tr><td bgcolor='#BDC3C7'>No records have been found.</td></tr></table>";}
                else{
                    echo "<div id='searchResult'>";
                    echo "<table id = 'result' style=' text-align: center ; border-collapse:collapse;' align='center' border='1' >";
                    echo "<tr bgcolor='#F2F3F4'><th>Profile Photo</th><th>Name</th><th>Details</th></tr>";
                    foreach($json_content as $obj){
                    echo "<tr>";
                    echo "<td style='text-align:left; padding-left: 50px; padding-right: 50px; height:50px; width:50px;'><a href='".$obj->picture->url."' target='_blank'><img src='".$obj->picture->url."' height='30px' width='40px'/></a></td>"; 
                    echo "<td style ='padding-left: 50px; padding-right: 50px;'>".$obj->name."</td>";
                    echo "<td style = 'padding-left: 50px; padding-right: 50px;'><a id='id1' href='Search1.php?type1=".$type."&key=".$keyword."&id1=".$obj->id."'>Details<input type='hidden' value='".$obj->id."'/></a></td>";
                    echo "</tr>";
                    }
                //'Search1.php?type1=".$type."&key=".$keyword."&id=".$obj->id."'
                    echo "</table>";
                    echo "<form style='display: none' action='http://cs-server.usc.edu:18967/Search1.php/' method='get' id='redirectForm'>";
                    echo "<input type='hidden' name='type' value='".$type."'/>";
                    echo "<input type='hidden' name='keyword' value='".$keyword."'/>";
                    echo "<input type='hidden' name='id1' id='selected_id' value=''/>";
                    echo "<input type='hidden' name='access_token' value='EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz'/>";
                    echo "</form>";
                    echo "</div>";
            } }
            if($type=="event"){
                $fb = new Facebook\Facebook([
                'app_id' => '743397835811303',
                'app_secret' => 'adb22db670462b9c19e508d1f393ced1',
                'default_graph_version' => 'v2.8',
                ]);
                $fb->setDefaultAccessToken('EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz');
                $response = $fb->get('/search?q='.$keyword.'&type='.$type.'&fields=id,name,picture.width(700).height(700),place');
                $graphEdge = $response->getGraphEdge();
                $json_content = json_decode($graphEdge);
                //reset form values
                echo "<script type='text/javascript'>selectedObj = document.getElementById('type1');selectedObj.value ='". $type."';";
                echo "document.getElementById('key').value ='". $keyword."';</script>  " ;
                $count = count($json_content);
                if($count == 0){
                   echo "<table align='center' style='width:500px; text-align:center; border-collapse:collapse;' border='1'><tr><td bgcolor='#BDC3C7'>No records have been found.</td></tr></table>";}
                else{
                echo "<div id='searchResult1'>";
                echo "<table id = 'result1' style=' text-align: center ; border-collapse:collapse; border:2;' align='center' border='1' >";
                echo "<tr bgcolor='#F2F3F4'><th>Profile Photo</th><th>Name</th><th>Place</th></tr>";
                foreach($json_content as $obj){
                    echo "<tr>";
                    echo "<td style='text-align:left; padding-left: 50px; padding-right: 50px; height:50px; width:50px;'><a href='".$obj->picture->url."' target='_blank'><img src='".$obj->picture->url."' height='30px' width='40px'/></a></td>"; 
                    echo "<td style ='padding-left: 50px; padding-right: 50px;'>".$obj->name."</td>";
                    echo "<td style = 'padding-left: 50px; padding-right: 50px;'>".$obj->place->name."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                
            }}
            if($type=="place"){
                $location=$_GET['location'];
                $distance=$_GET['distance'];
                $fb = new Facebook\Facebook([
                    'app_id' => '743397835811303',
                    'app_secret' => 'adb22db670462b9c19e508d1f393ced1',
                    'default_graph_version' => 'v2.8',
                    ]);
                    $fb->setDefaultAccessToken('EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz');
                if($location=="" || $distance==""){
                    $response = $fb->get('/search?q='.$keyword.'&type='.$type.'&fields=id,name,picture.width(700).height(700)');
                }
                else{
                    $url="https://maps.googleapis.com/maps/api/geocode/json?address=".$location."&key=AIzaSyC1JCk3sMODMl8z0nMRaf0SIrVOn4UqfHg";
                    $url = str_replace(" ", "%20", $url);
                    $jsonData=json_decode(file_get_contents($url));
                    $lat=$jsonData->results[0]->geometry->location->lat;
                    $long=$jsonData->results[0]->geometry->location->lng;
                    $response = $fb->get('/search?q='.$keyword.'&type='.$type.'&center='.$lat.','.$long.'&distance='.$distance.'&fields=id,name,picture.width(700).height(700)');
                }
                $graphEdge = $response->getGraphEdge();
                $json_content = json_decode($graphEdge);
                echo "<script type='text/javascript'>selectedObj = document.getElementById('type1');selectedObj.value ='". $type."';";
                echo "document.getElementById('key').value ='". $keyword."';</script>  " ;
                $count = count($json_content);
                if($count == 0){
                    echo "<table align='center' style='width:500px; text-align:center; border-collapse:collapse;' border='1'><tr><td bgcolor='#BDC3C7'>No records have been found.</td></tr></table>";}
                else{
                echo "<div id='searchResult2'>";
                echo "<table id = 'result2' style=' text-align: center ; border-collapse:collapse; border:2;' align='center' border='1' >";
                echo "<tr bgcolor='#F2F3F4'><th>Profile Photo</th><th>Name</th><th>Details</th></tr>";
                foreach($json_content as $obj){
                    echo "<tr>";
                    echo "<td style='text-align:left; padding-left: 50px; padding-right: 50px; height:50px; width:50px;'><a href='".$obj->picture->url."' target='_blank'><img src='".$obj->picture->url."' height='30px' width='40px'/></a></td>"; 
                    echo "<td style ='padding-left: 50px; padding-right: 50px;'>".$obj->name."</td>";
                    echo "<td style = 'padding-left: 50px; padding-right: 50px;'><a id='id1' href='Search1.php?type1=".$type."&key=".$keyword."&id1=".$obj->id."&location=".$location."&distance=".$distance."'>Details<input type='hidden' value='".$obj->id."'/></a></td>";
                    echo "</tr>";
                }//'Search1.php?type1=".$type."&key=".$keyword."&id=".$obj->id."'
                echo "</table>";
                echo "<form style='display: none' action='http://cs-server.usc.edu:18967/Search1.php/' method='get' id='redirectForm'>";
                echo "<input type='hidden' name='type' value='".$type."'/>";
                echo "<input type='hidden' name='keyword' value='".$keyword."'/>";
                echo "<input type='hidden' name='id1' id='selected_id' value=''/>";
                echo "<input type='hidden' name='access_token' value='EAAKkHcvuKecBAGiyPfxz4szyRl9pyN4mNPehZCyMoTVSkOpoWOO5Oe5Ylijr61NlbPNCmZAyM2OX94nZB8llHwiE7i2YKZAu3uMfuraw2jtUXpBIZA3ZAneZCsQS5l7xZCE7sxEUX8ZCUaY1sQ9F08jpz'/>";
                echo "</form>";
                echo "</div>";
                
            }
        }}}
      
    ?>    
        
     <noscript></noscript>   
    </body>
</html>