<h1 class="page_title"> [CONTRIBUTIONS PAGE] </h1> 
<?php
$work_artist_array= Work_ArtistController::retrieve_artist_works();
$output='<table class="works_artists_table"> <tr> <th> Artist Name </th> <th> Work Name </th> <th> Contribution </th> </tr>';
for ($i=0;$i<count($work_artist_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . '<td>' . $work_artist_array[$i]->getArtist_name() . "</td>";
            $output = $output . '<td>' . $work_artist_array[$i]->getWork_name() . "</td>";
            $output = $output . '<td>' . $work_artist_array[$i]->get_contribuition() . "</td>";
            $output = $output . '</tr>';    
}
$output = $output . "</table>";
echo $output;
?>

