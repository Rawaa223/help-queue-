Question 2. 
/tickets/999 returns 404 Not Found because there is no ticket with ID 999. Laravel’s implicit model binding looks it up for the Ticket $ticket parameter in TicketController.php, via the /tickets/{ticket} route in web.php.
Question 3 :
/tickets/create returns 404 Not Found. There isn’t a create-page route yet, so the existing /tickets/{ticket} route in web.php matches create as the ticket parameter. Laravel then tries to find a ticket with that ID for TicketController::show; since none exists, it returns 404.
Question 4 : 
Without @csrf, Laravel returns 419 Page Expired because the POST request has no valid CSRF token. The token protects against Cross-Site Request Forgery (CSRF) attacks.

Question 5 :
1. Empty submission: “The name field is required.” and “The topic field is required.”
2. Name entered, no topic: “The topic field is required.” The name remains in the form.
3. Changed the option to Cooking and submitted: “The selected topic is invalid.”

The name remains because `value="{{ old('name') }}"` in create.blade.php repopulates it after validation fails.

Question 6 :
Browser-side options can be changed or bypassed, so they can’t be trusted to enforce allowed topics. The server validates the submitted value against `Ticket::TOPICS` in TicketController.php.