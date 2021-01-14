<?php
$artist_array = ArtistController::retrieve_artists();
$output="";
for ($i=0;$i<count($artist_array);$i++) {
             $output = $output . '<option value="' . $artist_array[$i]->get_Artist_name() . '">' . $artist_array[$i]->get_Artist_name() . "</option>";
}
echo $output;
 ?>

