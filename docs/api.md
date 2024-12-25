# API DOCUMENTATION

## The book API
The API endpoint is http://localhost/src/api/book

This API only accepts GET & OPTIONS requests. The query string can send these
values:
- 'filter'
- 'genre' or just
- a number which is the book identifier.

When sending GET request with the 'filter' query, it accepts as of now four
variables in total with their corresponding values. It will return a set of
books with their given values with OR logic.

For example, you can send these prefixed variables **athr** (author), **gnre**
(genre), **pblr** (publisher), **lnge** (language) with their respective values.
Each variable can only have one value.

When sending GET request with the 'genre' query, it expects a single value or
multiple values for the 'gnre' variable.

When sending GET request with just a number, it returns the details of that
particular book as it is treated as book's identifier. If no parameter is
provided it return a 400 response.
