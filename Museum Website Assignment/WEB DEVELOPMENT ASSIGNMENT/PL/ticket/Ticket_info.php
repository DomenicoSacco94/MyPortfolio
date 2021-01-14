<h1 class="page_title"> Thanks for buying a ticket ! </h1>
<span class='ticket_data'> Ticket user:  <?php echo $_POST['owner_name']?> </span> </br>
<span class='ticket_data'> Ticket owner ID:  <?php echo $_POST['document_id'] ?> </span> </br>
<span class='ticket_data'> Ticket type:  <?php echo $_POST['ticket_type'] ?> </span> </br>
<span class='ticket_data'> Ticket cost: <?php echo Event::retrieve_event_price($_POST['event_name'], $_POST['ticket_type'])?>$</span> </br>