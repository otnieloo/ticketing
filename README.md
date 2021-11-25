# ticketing

This repo is made for Web Developer Technical Test

Test 1
- Open others/test.php, you can test like the given example.

Test 2
- I made it using Codeigniter and MySQL as the RDBMS
- Step 1: Create database named ticketing then import the sql (others/ticketing.sql)
- Step 2: Composer install
- Step 3: You may update the config first, especially on the base url.
- Step 4: Test the api. If you use postman, i already made a collection. You can just import it (check others/). If you dont, check below endpoint.

Endpoint lists:
1. Get all ticket and one ticket:
	 Endpoint: ticketing/api/{ticket_number}/{limit} (GET)
	 - If you want to get only one specific ticket, you can ignore the limit parameter. Example: ticketing/api/1
	 - If you want to get all ticket without the limit, you can ignore both parameter. Example: ticketing/api/
	 - If you want to get all ticket but with a limit, you can put 0 to ticket number parameter. Example: ticketing/api/0/2 (The limit is 2)
3. Add ticket
   Endpoint: ticketing/api/ (POST)
	 - There are 3 mandatory parameter you should use, subject, message, priority.
	 - I dont include the status because it should be opened by default.
5. Add ticket reply
   Endpoint: ticketing/api/reply (POST)
	 - There are 2 mandatory parameter you should use, ticket_number and message.
7. Close ticket
   Endpoint: ticketing/api/ (PUT)
	 - There is 1 mandatory parameter you should use, ticket_number.
9. Delete ticket
   Endpoint: ticketing/api/ (DELETE)
	 - There is 1 mandatory parameter you should use, id. It is for ticket id.

Note:
- I only use numeric status on the response. 0 -> open, 1 -> answered, 2 -> closed
- After the ticket reply, the status will be 1 and the reply message will show in messages.
