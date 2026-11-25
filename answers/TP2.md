Question 2. 
/tickets/999 returns 404 Not Found because there is no ticket with ID 999. Laravel’s implicit model binding looks it up for the Ticket $ticket parameter in TicketController.php, via the /tickets/{ticket} route in web.php.
