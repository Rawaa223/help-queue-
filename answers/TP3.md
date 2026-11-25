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
