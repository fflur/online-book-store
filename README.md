# Project Directory Structure
- `bin`       : This directory contains terminal executables.
- `config`    : This directory contains configurations files.
- `docs`      : This directory contains documentation files.
- `public`    : This directory contains web server files.
- `resources` : This directory contains resource files like images.
- `src`       : This directory contains PHP source files.
- `tests`     : This directory contains test codes for the project.

# Inspiration
To develop an online book store we first need to consider a regular offline book
store. We got to a book store, we notice that the books are laid out in sections
or categories. As an example of sections we can have science fiction, fantasy,
autobiography et cetera. After that we choose a book. Then if we are buying
multiple books we drop each of them in a cart. Or if we just ought to buy single
book then we go to the cashier or sales associate. We make the deal and leave
the store.

Considering the above standard process we get some key functionalities of a book
store. These are:
- Books should be organized in categories or sections.
- When we are interested in a book, we pick it up to check its details.
- In case we aren't planning to buy imperatively, we add it to our wishlist.
- We add the book to a cart or bag in case we are buying multiple books.
- We directly go to the cashier or sales associate in case we are buying just a
  single book.
- Then we pay for the book and in return we get to own it.
- Either we can leave the store or search for some other books.

# Key Functionalities of Online Book Store
- Categorization of books.
- Book's detail viewer.
- Adding to shopping bag or cart.
- Payment process.
- Back to browsing.
- Customer login.
- Customer logout.
- Customer registration.
- Book search feature.

The above functionalities are from the customers point of view.

# Book Supply
Th supply of books can be done by a distributor, publisher or a wholesaler. The
books which are going to arrive need to be added to the store. This is done
manually by a manager or owner. So, we need someone to add those books to the
store manually. This can achieved by implementing an interface for Book Manager
or someone in charge of doing so.

# Key Functionalities include:
- Addition of book along with details.
- Updating the details of the books.
- Removal of book from the store.
- Viewing the detail of the book.
