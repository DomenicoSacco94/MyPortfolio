<?php
$event_artist_array= Event_ArtistController::retrieve_event_artists();
$output='<table class="events_artists_table"> <tr> <th> Event Name </th> <th> Artist Name </th> <th> Start Date </th> <th> End Date </th> <th> Details </th> </tr>';
for ($i=0;$i<count($event_artist_array);$i++) {
            $output = $output . '<tr>';
            $output = $output . '<td>' . $event_artist_array[$i]->getEvent_name() . "</td>";
            $output = $output . '<td>' . $event_artist_array[$i]->getArtist_name() . "</td>";
            $output = $output . '<td>' . $event_artist_array[$i]->getStart_date() . "</td>";
            $output = $output . '<td>' . $event_artist_array[$i]->getEnd_date() . "</td>";
            $output = $output . '<td>' . $event_artist_array[$i]->getDetails() . "</td>";
            $output = $output . '</tr>';    
}
$output = $output . "</table>";
echo $output;
?>
