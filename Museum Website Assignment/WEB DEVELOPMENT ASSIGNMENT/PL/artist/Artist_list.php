<?php
$artist_array = ArtistController::retrieve_artists();
$output='<table class="artist_table"> <tr> <th> Artist ID </th> <th> Artist Name </th> <th> Artist Description </th> <th> Artist Born Date </th> <th> Artist Death Date </th> <th> Artist Image </th> </tr>';
for ($i=0;$i<count($artist_array);$i++) {
            $output= $output . '<tr>';
            $output = $output . '<td>' . $artist_array[$i]->get_idArtist() . "</td>";
            $output = $output . '<td>' . $artist_array[$i]->get_Artist_name() . "</td>";
            $output = $output . '<td>' . $artist_array[$i]->get_Artist_description() . "</td>";
            $output = $output . '<td>' . $artist_array[$i]->get_Born_date() . "</td>";
            $output = $output . '<td>' . $artist_array[$i]->get_Death_date() . "</td>";
            $output = $output . '<td>' . '<img class="artist_image" src="'. $artist_array[$i]->getArtist_image() .'"> </td>';
            $output= $output . '</tr>';          
}
$output = $output. '</table>';
echo $output;
?>
