# Barangay Document Request System (BDORS Enhanced)

A comprehensive web-based system for managing barangay document requests, featuring user-friendly interfaces for residents and powerful admin tools for managing requests and users.

## Features

- **Resident Portal**: Sign up, login, request documents, track request status
- **Admin Dashboard**: Manage all requests, user accounts, and system oversight
- **Complete Workflow**: Request → Approve/Reject → Complete/Cancel
- **Status Tracking**: Pending, Approved, Completed, Denied, Canceled
- **User Management**: View and delete user accounts
- **Secure Authentication**: Session-based login system
- **Responsive Design**: Works on desktop and mobile devices

## Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Modern web browser

## Installation & Setup

### 1. Database Setup

The database and tables are automatically created when you first access the application. The system will:

1. Connect to MySQL server (default: localhost, root, no password)
2. Create the `barangay_db` database if it doesn't exist
3. Create all required tables and insert default data
4. Set up admin account (username: admin, password: admin123)

If you need to use different database credentials, update `connect.php`:
```php
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$db = "barangay_db";
```

### 2. File Structure

Ensure all files are in the web server's document root:
```
/
├── index2.php (Landing page)
├── login.php
├── signup.php
├── residents-dashboard-page.php
├── request.php
├── track.php
├── profile.php
├── help.php
├── logout.php
├── admin-dashboard.php
├── admin-all-requests.php
├── admin-all-users.php
├── admin-approve.php
├── admin-reject.php
├── admin-done.php
├── delete-user.php
├── user-cancel.php
├── process_login.php
├── process_signup.php
├── process_request.php
├── connect.php
├── session_check.php
├── sql.txt
└── img/ (image assets)
```

### 3. Admin Account Setup

The admin account is automatically created when importing the database schema from `sql.txt`. The default admin credentials are:
- Username: admin
- Password: admin123
```

## User Guide

### For Residents

#### 1. Account Registration
1. Visit the landing page (`index2.php`)
2. Click "SIGN UP"
3. Fill in all required fields:
   - First Name, Surname
   - Address, Birthday, Contact Number
   - Email, Username, Password
4. Click "Sign Up" to create your account

#### 2. Logging In
1. Click "LOG IN" from the landing page
2. Enter your username and password
3. Click "Login" to access your dashboard

#### 3. Requesting Documents
1. From your dashboard, click "REQUEST DOCUMENT"
2. Fill in the request form:
   - Personal Information (Name, Birthdate, Age, Gender)
   - Contact Information (Address, Contact, Email)
   - Identification (ID Type, upload front/back photos)
   - Document Type and Purpose
3. Review and confirm your request
4. Your request will be submitted with a reference number

#### 4. Tracking Requests
1. Click "TRACK REQUEST" from your dashboard
2. View all your requests in a table showing:
   - Reference Number
   - Document Type
   - Status (Pending, Approved, Completed, Denied, Canceled)
   - Date Submitted
3. For pending requests, you can click "Cancel" to cancel the request

#### 5. Viewing Profile
1. Click your profile icon in the top navigation
2. View your account information

### Status Explanations
- **Pending**: Request submitted, waiting for admin approval
- **Approved**: Request approved, being processed
- **Completed**: Request fulfilled, document ready for pickup
- **Denied**: Request rejected by admin
- **Canceled**: Request canceled by user

## Admin Guide

### Accessing Admin Panel
1. Login with admin credentials (username: admin, password: admin123)
2. You'll be redirected to the admin dashboard

### Managing Requests
1. From admin dashboard, click "All Requests"
2. View requests organized by status in separate tables

#### For Pending Requests:
- Click "Approve" to approve the request
- Click "Reject" to deny the request

#### For Approved Requests:
- Click "Mark as Completed" when the document is ready

#### For Completed/Denied/Canceled Requests:
- Click "Delete" to remove the request from the system

### Managing Users
1. From admin dashboard, click "All Users"
2. View all registered user accounts
3. Click "Delete" next to any user to remove their account

### Dashboard Overview
- View total requests count
- See pending approvals count
- Monitor recent activity
- Access all management functions via sidebar

## File Descriptions

### Core System Files
- `connect.php`: Database connection configuration
- `session_check.php`: Session validation for protected pages
- `sql.txt`: Database schema and sample data

### User-Facing Pages
- `index2.php`: Landing page with sign up/login links
- `login.php` / `signup.php`: Authentication pages
- `residents-dashboard-page.php`: User dashboard
- `request.php`: Document request form
- `track.php`: Request tracking page
- `profile.php`: User profile page
- `help.php`: Help and support page

### Admin Pages
- `admin-dashboard.php`: Admin overview
- `admin-all-requests.php`: Complete request management
- `admin-all-users.php`: User account management

### Processing Scripts
- `process_login.php`: Login authentication
- `process_signup.php`: User registration
- `process_request.php`: Request submission
- `admin-approve.php`: Approve requests
- `admin-reject.php`: Reject requests
- `admin-done.php`: Mark requests complete
- `delete-user.php`: Delete user accounts
- `user-cancel.php`: Cancel user requests

## Security Notes

- All passwords are hashed using MD5 (consider upgrading to bcrypt for production)
- Session-based authentication prevents unauthorized access
- File uploads are handled securely
- SQL injection prevention through prepared statements

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Verify database credentials in `connect.php`
   - Ensure MySQL server is running
   - Check database name and table creation

2. **Login Issues**
   - Verify username/password combination
   - Check if account exists in database
   - Ensure correct usertype (user/admin)

3. **File Upload Errors**
   - Check upload directory permissions
   - Verify file size limits in PHP configuration
   - Ensure supported file formats

4. **Page Not Loading**
   - Verify file paths and permissions
   - Check PHP error logs
   - Ensure all required files are present

### Support

For technical support or questions about the system, please contact the development team or refer to the help page within the application.

## Version History

- **v1.0**: Initial BDORS implementation
- **v2.0**: Enhanced with complete workflow management, user management, and improved UI

---

**Note**: This system is designed for barangay use. Ensure compliance with local data privacy regulations when deploying.
