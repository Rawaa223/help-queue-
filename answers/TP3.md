# TP3 answers

## Exercise 1

**Question 1:** The message is “The selected status is invalid.” The server rejects `sleeping` because the status must be one of `Ticket::STATUSES`.

## Exercise 2

**Question 2:** `Ticket::waiting()->toSql()` returns:

```sql
select * from "tickets" where "status" = ? order by "id" asc
```

## Exercise 3

**Question 3:** After the two status changes in Exercises 1 and 2, six seeded tickets remain waiting. A newly created ticket is at the end of the queue, so six people are ahead of it.

## Exercise 4

**Question 4:** The badges show the topic model serialized as JSON, including its `id`, `name`, and timestamps. Blade is rendering the related `Topic` model itself rather than a text value; Exercise 5 changes the expression to `$ticket->topic->name`.

## Exercise 5

**Question 5:** “The selected topic id is invalid.” The `exists:topics,id` validation rule produced the message because topic ID `99` does not exist.

## Exercise 6

**Question 6:** The Git topic page shows 2 tickets in the current seeded database. This count can vary after reseeding because the factory assigns topics randomly.
