# TP3 answers

## Exercise 1

**Question 1:** The message is “The selected status is invalid.” The server rejects `sleeping` because the status must be one of `Ticket::STATUSES`.

## Exercise 2

**Question 2:** `Ticket::waiting()->toSql()` returns:

```sql
select * from "tickets" where "status" = ? order by "id" asc
```
