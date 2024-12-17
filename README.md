# Project Directory Structure
- `bin`       : This directory contains terminal executables.
- `config`    : This directory contains configurations files.
- `docs`      : This directory contains documentation files.
- `public`    : This directory contains web server files.
- `resources` : This directory contains resource files like images.
- `src`       : This directory contains PHP source files.
- `tests`     : This directory contains test codes for the project.

# Functions of the online book store
- Maintain records for many customers
  - A customer can be either a member or non-member
  - A customer has a username (unique across all users), password, email,
  address.
  - Anyone may sign up for a customer account.
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
  - Collect a 16-digit credit card number from the customer.
  - Log/record the transaction.
- Allow manager to update stock quantities.
  - Allow manager to change any book's price.
  - Allow manager to view transaction logs.

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
