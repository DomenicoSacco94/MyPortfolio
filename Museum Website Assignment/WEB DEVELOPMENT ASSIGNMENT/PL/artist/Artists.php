<h1 class="page_title"> [ARTISTS PAGE] </h1> 
<?php
$artist_array = ArtistController::retrieve_artists();
$output='<table class="artist_table"> <tr><th> Artist Info </th> <th> Artist Image </th> </tr>';
for ($i=0;$i<count($artist_array);$i++) {
            $output= $output . '<tr>';
            $output = $output . '<td> <span class=line_description> Artist Name: </span>' . $artist_array[$i]->get_Artist_name() . "</br>";
            $output = $output . '<span class=line_description> Artist description: </span>' . $artist_array[$i]->get_Artist_description() . "</br>";
            $output = $output . '<span class=line_description> Born Date: </span>' . $artist_array[$i]->get_Born_date() . "</br>";
            $output = $output . '<span class=line_description> Death Date: </span>' . $artist_array[$i]->get_Death_date() . "</br> </td>";
            $output = $output . '<td>' . '<img class="artist_image" src="'. $artist_array[$i]->getArtist_image() .'"> </td>';
            $output= $output . '</tr>';   
}
$output = $output. '</table>';
echo $output;
?>

