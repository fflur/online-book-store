# Project Directory Structure
- `bin`       : This directory contains terminal executables.
- `config`    : This directory contains configurations files.
- `docs`      : This directory contains documentation files.
- `public`    : This directory contains web server files.
- `resources` : This directory contains resource files like images.
- `src`       : This directory contains PHP source files.
- `tests`     : This directory contains test codes for the project.

# Functions of the online book store
- Maintain data associated with the inventory (a collection of books)
  - A book has a title, author and price
  - The inventory also keep track of the stock/quantity of each book
- Maintain records for many customers
  - A customer can be either a member or non-member
  - A customer has a username (unique across all users), password, email,
  address, and postal address (unverified.
  - Anyone may sign up for a customer account
- Allow any customer to become a member.
- Show a listing of available books
  - Books are to be displayed in ascending alphabetical order by title.
  - Each book will list the following from left to right.
    - Title
    - Author
    - Price
- Allow customers and managers to log in and out of the system.
  - Users (both customers and the manager) will be logged out if inactive for 30
  minutes.
- Shopping cart.
  - Anyone is able to add one or more books to the shopping cart.
  - The shopping cart does not need to allow multiple copies of any book.
- Checkout
  - Checkout is only available to logged-in customers. A user that is not logged
  in as a customer is given a chance to log in.
  - Member customers may enter a promotion code.
  - Only one promotion code may be used per purchase. 
  - The promotion is a fixed percentage discount that is to be applied to an
  entire order.
  - The discount is specified by the manager at the time of the promotion’s
  creation or most recent update/edit.
  - Collect a 16-digit credit card number from the customer.
  - Log/record the transaction.
- Allow manager to specify a stop-order for a book.
  - Each book has its own stop-order status – either on or off. Details of its
  use are involved in the following feature
- Notify manager when books need to be reordered.
  - When the quantity a book falls below a threshold, the manager is notified
  that the book needs to be reordered.
  - One exception is if the manager has already specified a stop-order for this
  book.
    - Every book must either have stop-order enabled or disabled.
- Allow manager to update stock quantities.
  - Allow manager to change any book's price.
  - Allow manager to view transaction logs.
  - Allow manager to create promotions.
    - A promotion is a percentage discount that can be applied to an entire
    order.
  - Promotions may only be used by member customers.
  - A promotion has an expiration date specified by the manager.
  - When a promotion is created, it is emailed to all member customers via the
  email address on record.

# Functionalities for book sellers

An online bookstore should provide a robust back end system to manage inventory,
orders, and customer interactions efficiently. Here are some key functionalities
from a bookseller's perspective:

- **Inventory Management:**
- **Product Catalog:**
    - Add, edit, and delete book details (title, author, ISBN, publisher, genre,
    price, description, etc.)
    - Upload high-quality images of book covers.
    - Organize books into categories and subcategories.
    - Set inventory levels and track stock.
- **Supplier Management:**
    - Maintain a list of suppliers and their contact information.
    - Place purchase orders directly to suppliers.
    - Track order status and delivery dates.
- **Pricing and Discounts:**
    - Set pricing strategies, including discounts and promotions.
    - Implement dynamic pricing based on factors like demand and competition.
    - Manage coupon codes and special offers.

- **Order Management:**
  - **Order Processing:**
      - Receive and process orders automatically.
      - Generate packing slips and shipping labels.
      - Integrate with shipping carriers to calculate shipping costs and track
      shipments.
  - **Order Fulfillment:**
      - Manage inventory to ensure timely order fulfillment.
      - Coordinate with warehouse or fulfillment centers for efficient order
      picking and packing.
  - **Returns and Refunds:**
      - Process returns and issue refunds.
      - Handle customer inquiries and complaints related to orders.

- **Customer Management:**
  - **Customer Profiles:**
      - Create and manage customer profiles, including address, contact
      information, and order history.
      - Segment customers based on purchase behavior and preferences.
  - **Customer Support:**
      - Provide efficient customer support through various channels (email, phone,
      chat).
      - Handle inquiries, resolve issues, and provide assistance.
  - **Loyalty Programs:**
      - Implement loyalty programs to reward repeat customers.
      - Track customer points and offer exclusive benefits.

- **Financial Management:**
  - **Sales Reports:**
      - Generate detailed sales reports to analyze performance.
      - Track revenue, expenses, and profit margins.
  - **Payment Processing:**
      - Integrate with payment gateways to process online payments securely.
      - Handle refunds and chargebacks.
  - **Tax Calculations:**
      - Calculate and collect sales tax based on customer location and applicable
      tax rates.
