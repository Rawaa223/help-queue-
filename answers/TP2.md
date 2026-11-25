Question 2. 
/tickets/999 returns 404 Not Found because there is no ticket with ID 999. Laravel’s implicit model binding looks it up for the Ticket $ticket parameter in TicketController.php, via the /tickets/{ticket} route in web.php.
Question 3 :
/tickets/create returns 404 Not Found. There isn’t a create-page route yet, so the existing /tickets/{ticket} route in web.php matches create as the ticket parameter. Laravel then tries to find a ticket with that ID for TicketController::show; since none exists, it returns 404.
