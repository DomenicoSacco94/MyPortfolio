<h1 class="page_title"> Buy Tickets </h1>
<form action="index.php?category=ticket&page=ticket_resume.php" method="POST">
   <div class="page_div">
      Choose Event: 
      <select name="event_name">
      <?php include("browse_events.php"); ?>
      </select>
      <br/>
      Ticket Owner Name:
      <input type="text" name="owner_name" id="first_name_input" class="input_text" placeholder="Enter user name" required/> <br/>
      Ticket Holder Document ID:
      <input type="text" name="document_id" id="document_id_input" class="input_text" placeholder="Enter document ID" required/> <br/>
      Ticket type: 
      <select name="ticket_type">
         <option value="normal">Normal</option>
         <option value="student">Student</option>
         <option value="reduced">Reduced</option>
      </select>
      <br/>
      Credit Card Number:
      <input type="text" name="credit_card_number" id="ccn_input" class="input_text" placeholder="Enter credit card number" /> <br/>
      Valid Date:
      <input type="text" name="month" id="month_input" class="input_text" placeholder="mm" maxlength="2"/>
      /
      <input type="text" name="year" id="year_input" class="input_text" placeholder="yy" maxlength="2"/> <br/>
      CVV Number:
      <input type="text" name="cvv" id="cvv_input" class="input_text" placeholder="xxx" maxlength="3"/> <br/> 
      <input id="payment_button" type="submit" value="Confirm Payment" name="pay_ticket"> <br/>
   </div>
</form>