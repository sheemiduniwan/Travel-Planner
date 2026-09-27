 Infinite Travels Sri Lanka ✈️
Interactive Travel Itinerary Planner & Tourism Web Application

 Academic Coursework:ICT 2206 – Web Technologies  
Institution: Rajarata University of Sri Lanka , Faculty of Technology , Department of ICT  
Assignment:Mini Project – Individual Submission  


📌 Project Overview

Infinite Travels Sri Lanka is a full stack, responsive web application tailored for Sri Lankan tourism. It allows travelers to discover handpicked destinations, customize travel itineraries, calculate live travel budgets, submit inquiries, and manage authenticated accounts.

The application satisfies all requirements specified in the ICT 2206 Web Technologies Mini Project syllabus, incorporating modern frontend design, rich interactive JavaScript features, and secure PHP/MySQL backend integration.

Evaluation Criteria & Feature Mapping

Rubric Category . Weightage , Implemented Features & Modules 

HTML & CSS Layout 20% Semantic HTML5 structure, custom dark luxury theme (`#000000`, gold `#ae812e`, electric blue `#0d6efd`), responsive CSS Grid & Flexbox layouts, Bootstrap 5 integration. 
JavaScript Features 15%  Live dual-currency Trip Budget Calculator, interactive Itinerary Planning Modal (`#plannerModal`), 3D flip navigation bar, automatic CSS keyframe hero slider, real-time clock indicator, FAQ accordion, smooth scrolling.
Database Integration 20% Relational MySQL database (`travel_planner`) featuring `users`, `contact_messages`, and `itineraries` tables with foreign keys and auto-increment primary keys. 
User Authentication 20% Secure registration (`auth/register.php`) with password hashing (`PASSWORD_DEFAULT`), credential validation & session initialization (`auth/login.php`), session destruction (`auth/logout.php`), and dynamic navbar state updates (`auth/check_auth.php`). 
Contact Form & Data Handling 10% Full-featured contact form (`contact.php`) storing inquiries in MySQL using MySQLi prepared statements to prevent SQL injection. 
Creativity & Originality 5% Unique Sri Lankan travel branding, custom interactive budget estimator with live USD/LKR exchange conversions, curated island destinations (Sigiriya, Ella, Galle, Kandy, Mirissa). 
File Structure & Submission 5% Modular directory structure (`auth/`, `Features/`, `Form/`, `services/`, `grid/`) clean code separation, database `.sql` dumps included. 
Documentation & Quality 5% Detailed step-by-step setup guide, clear comments across code, comprehensive `README.md`. 



Key Features

1. Frontend & User Experience
2. Responsive Multi-Page Structure:
3. Home Page (`index.html`):** Hero slider, search bar, radial second-clock, curated hotel showcases, travel partner highlights, inquiry form, and 3-column footer.
Features & Destinations Page (`Features/features.html`):** Interactive tools, smart itinerary builder, live budget estimator, and 6 curated destination guides.
Authentication Pages (`auth/login.php`, `auth/register.php`):** Clean, centered card layout with feedback alerts and home redirection.
3D Flip Navigation Menu: CSS3 3D perspective transforms with gold hover highlights (`rotateX(90deg)`).
Smooth Scrolling: Smooth jump links to sections (`#services`, `#destinations`, `#contact`, `#hero`).

2. Client-Side Interactivity (JavaScript)
Interactive Trip Budget Calculator:
  * Computes estimated costs based on duraion (days), party size, accommodation tier, transport type, and dining level.
  * Calculates room counts automatically (`Math.ceil(travelers / 2)`).
  * Real-time dual currency toggling: **USD ($)** and **LKR (Rs.)**.
  * "Use in Itinerary Planner button to prefill calculations directly into the planner.
* Trip Planner Modal (`Form/form.js`)
  * Pop-up modal overlay with date pickers, traveler selectors, and custom destination input.
  * Client-side validation ensuring start date precedes end date.
* nteractive FAQ Accordion:Clean collapsible question-and-answer toggles.
* Dynamic Header Authentication: Asynchronously polls `auth/check_auth.php` via `fetch()` to switch between `Register / LogIn` and `Hi, [Username] / LogOut`.

3. Backend & Security (PHP & MySQL)
* Secure Authentication:
  * Passwords hashed using bcrypt via PHP's native `password_hash($password, PASSWORD_DEFAULT)`.
  * Verified using `password_verify()` during login.
  * PHP session management (`$_SESSION['user_id']`, `$_SESSION['username']`).
  * Route protection: Logged-in users are automatically redirected away from login/register pages.
* SQL Injection Prevention: All database operations utilize Prepared Statements with parameterized inputs (`$stmt->bind_param(...)`).
  Contact Message Handling (`contact.php`): Validates required inputs, verifies email format with `FILTER_VALIDATE_EMAIL`, and inserts inquiries safely into `contact_messages`.



## Database Architecture

The application connects to a MySQL database named `travel_planner`.


travel_planner
 ├── users (Authentication)
 ├── contact_messages (Inquiries & Customer messages)
 └── itineraries (Trip planner records linked via user_id)


### 1. `users` Table
| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | `INT(11)` | `PRIMARY KEY, AUTO_INCREMENT` | Unique identifier for each user |
| `username` | `VARCHAR(50)` | `NOT NULL` | Display name of the user |
| `email` | `VARCHAR(100)` | `NOT NULL, UNIQUE` | Unique email address for login |
| `password` | `VARCHAR(255)` | `NOT NULL` | Bcrypt hashed password |
| `created_at` | `TIMESTAMP` | `DEFAULT CURRENT_TIMESTAMP` | Account creation timestamp |

### 2. `contact_messages` Table
| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | `INT(11)` | `PRIMARY KEY, AUTO_INCREMENT` | Message identifier |
| `name` | `VARCHAR(100)` | `NOT NULL` | Sender's full name |
| `email` | `VARCHAR(100)` | `NOT NULL` | Sender's email address |
| `phone` | `VARCHAR(20)` | `NULLABLE` | WhatsApp / phone contact |
| `message` | `TEXT` | `NOT NULL` | Inquiry requirements |
| `created_at` | `TIMESTAMP` | `DEFAULT CURRENT_TIMESTAMP` | Submission timestamp |

3. `itineraries` Table
| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | `INT(11)` | `PRIMARY KEY, AUTO_INCREMENT` | Itinerary identifier |
| `user_id` | `INT(11)` | `FOREIGN KEY (users.id) ON DELETE CASCADE` | Associated user |
| `destination` | `VARCHAR(100)` | `NOT NULL` | Destination chosen |
| `start_date` | `DATE` | `NOT NULL` | Starting date of trip |
| `end_date` | `DATE` | `NOT NULL` | Ending date of trip |
| `budget` | `DECIMAL(10,2)`| `NULLABLE` | Estimated budget |
| `created_at` | `TIMESTAMP` | `DEFAULT CURRENT_TIMESTAMP` | Creation timestamp |



## Project Directory Structure

text
Tourism Page/
│
├── index.html                   # Main Home page (slider, search, hotels, contact)
├── style.css                    # Main custom stylesheet for Home page
├── script.js                    # Navbar auth checker & home smooth scroll
├── db_config.php                # Database connection script (MySQLi)
├── contact.php                  # Contact form processing script
├── database.sql                 # Complete MySQL schema & initial dump
├── users.sql                    # Standalone users table export
│
├── auth/                        # User Authentication Module
│   ├── login.php                # Login form & authentication verification
│   ├── register.php             # User registration form with validation
│   ├── logout.php               # Session termination script
│   └── check_auth.php           # JSON session status API endpoint
│
├── Features/                    # Features & Destinations Module
│   ├── features.html            # Features page, destination cards, budget calculator
│   └── style.css                # Dedicated styling matched to main luxury theme
│
├── Form/                        # Interactive Form Handling
│   └── form.js                  # Itinerary modal opener, closer, & validation
│
├── grid/                        # Image assets for photo grid
│   ├── 09.jpg
│   ├── 10.jpg
│   ├── 11.jpg
│   └── 12.jpg
│
├── services/                    # Image assets for partners & services
│   ├── 13.png
│   ├── 14.png
│   ├── 15.png
│   ├── 16.png
│   └── 17.png
│
├── radialIndicator.js           # SVG Radial progress indicator
├── angular.radialIndicator.js   # Angular wrapper for radial indicator
├── all.js                       # FontAwesome icon library bundle
├── 01.png, 08.png               # Compass icon and brand logo
├── 02.jpg - 06.jpg              # Hero slider and background photos
└── README.md                    # Project documentation & setup instructions




## Installation & Setup Instructions

Follow these steps to run the project locally on your machine using XAMPP

Step 1: Install & Launch XAMPP
1. Download and install [XAMPP](https://www.apachefriends.org/) (PHP 8.0 or newer recommended).
2. Open the **XAMPP Control Panel**.
3. Start both **Apache** and **MySQL** services.

Step 2: Place Project in `htdocs`
1. Navigate to your XAMPP installation directory:
   
   C:\xampp\htdocs\   (or your respective drive, e.g. F:\XAMPP\htdocs\)
   
2. Copy the project folder into `htdocs`:
   
   htdocs/Tourism Page/Tourism Page/
   

Step 3: Import the Database
1. Open your web browser and access phpMyAdmin:
   
   http:/localhost/phpmyadmin/
   
2. Click New on the left sidebar to create a database.
3. Set the database name to:
   
   travel_planne
4. With `travel_planner` selected, click the Impor tab at the top.
5. Click Choose File, select `database.sql` located inside the project folder, and click Import (or Go).
6. Verify that tables `users`, `contact_messages`, and `itineraries` have been created.

Step 4: Verify Database Connection Config
Open `db_config.php` and verify your local MySQL credentials:

<?php
$host = "localhost";
$db_user = "root";      // Default XAMPP username
$db_pass = "";          // Default XAMPP password (empty)
$db_name = "travel_planner";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>


Step 5: Run the Application
Open your browser and navigate to the project URL:

http://localhost/Tourism%20Page/Tourism%20Page/index.html



Testing & Demonstration Guide

1. User Registration & Redirection
1. Click **Register** in the top navigation bar (or navigate to `auth/register.php`).
2. Enter username, email, and a password (minimum 6 characters).
3. Submit the form. The system will display a success alert and redirect to `auth/login.php?registered=1`.

2. User Login & Dynamic Navigation
1. Enter your registered email and password.
2. Click **Login**. On success, an alert greets the user and redirects to `index.html`.
3. Notice the navigation bar: `Register` and `LogIn` are dynamically replaced with `Hi, [Username]` and `LogOut`.
   
3. Trip Budget Calculator
1. Navigate to Features (`Features/features.html`).
2. Under Feature 2 (Live Budget Estimator), click Calculate Budget.
3. Adjust days, number of travelers, hotel style, transport, and dining tier.
4. Switch between USD ($) and LKR (Rs.) to observe real-time recalculations.
5. Click Use in Itinerary Planner  to transfer your budget directly to the planning modal.

4. Contact Message Submission
1. On the Home page, scroll down to the Start Planning Your Journey section.
2. Fill in Name, Email, Phone/WhatsApp, and Message.
3. Click Send Message. The data is securely validated and inserted into the `contact_messages` table in MySQL.

5. Logout Flow
1. Click LogOut in the navigation bar.
2. The session is destroyed via `auth/logout.php` and the browser is redirected to `index.html`.
3. The navigation returns to displaying `Register` and `LogIn`.


 Security Practices Implemented

* Bcrypt Password Encryption: Passwords are never stored in plaintext; `password_hash()` generates a cryptographically secure hash.
* Prepared Statements: Protection against SQL Injection vulnerabilities on user login, registration, and contact forms.
* XSS Defense: User-supplied variables displayed in alerts or HTML attributes are sanitized using `htmlspecialchars()`.
Session Protection: Session state is validated prior to granting access or redirecting already logged-in users.
* Input Validation: Email sanitization and regex validation on both client-side and server-side.


 Author & Submission Details

* ourse Module: ICT 2209 – Web Technologies  
* Department: Department of Information and Communication Technology  
* Faculty:*Faculty of Technology  
* University: Rajarata University of Sri Lanka  
* Academic Year 2026




  References

  Department of ICT, Faculty of Technology
  *PHP/MySQL integration, session management, and HTML5/CSS3 web design fundamentals.
  *https://developer.mozilla.org/
  *HTML, CSS Flexbox/Grid layouts, modern JavaScrip, and dynamic DOM manipulation methods.
  *https://www.w3schools.com/
  *Used for PHP MySQLi prepared statements syntax, form handling and validation guidelines, and Bootstrap 5 responsive layout implementation.
  *https://www.php.net/docs.php
  *Technical documentation for `password_hash()`, `password_verify()`, native PHP session management (`$_SESSION`), and MySQLi database connection setup.
