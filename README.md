# B-Link: Integrated Resident Information & Services Management System

B-Link is a mini-capstone PHP MVC web application for barangay resident information management, household records, document generation, disaster response retrieval, and basic administrative reporting.

## Project Purpose

The system is designed for barangay staff who need a centralized way to:

- manage resident and household records;
- generate barangay documents using stored resident data;
- retrieve vulnerable resident groups during disaster response;
- monitor affected households and residents;
- view dashboard analytics for administrative reporting.

## Core Modules

### Authentication and Users

- Login and logout for barangay staff.
- Session-based route protection.
- Role-based access for `admin` and `staff`.
- Admin user management for adding staff/admin accounts.

### Residents

- Register residents.
- View resident list and search records.
- View full resident profile.
- Edit resident information.
- Archive resident records.
- Track sectoral and vulnerability information:
  - senior citizen;
  - PWD;
  - solo parent;
  - indigenous people;
  - 4Ps member;
  - out-of-school youth;
  - minor;
  - pregnant;
  - lactating mother;
  - bedridden.
- Track health and evacuation details:
  - medical condition;
  - medicine needs;
  - mobility status;
  - evacuation priority.

### Households

- Register household records.
- View household list.
- View household profile.
- Edit household information.
- Assign household head from residents already attached to the household.
- Show resident count per household.

### Documents

- Generate and save barangay documents:
  - Barangay Clearance;
  - Certificate of Residency;
  - Indigency Certificate.
- Auto-fill document content using resident data.
- Print generated documents using the browser print dialog.

### Disaster Response

- Filter residents by:
  - senior citizens;
  - minors;
  - PWD;
  - solo parents;
  - out-of-school youth;
  - pregnant residents;
  - lactating mothers;
  - bedridden residents;
  - 4Ps members;
  - purok;
  - gender.
- View household count by purok.
- Create disaster/incident monitoring reports.
- Update disaster report status.
- Print disaster response reports.

### Dashboard

- Total residents.
- Total households.
- Generated documents.
- Active disaster reports.
- Resident demographic breakdown.
- Disaster monitoring summary.

## Technology Stack

- PHP
- MySQL/MariaDB
- PDO
- Custom MVC structure
- XAMPP local server
- HTML/CSS

## Project Structure

```txt
app/
  Config/
  Controllers/
  Core/
  Helpers/
  Models/
  Services/
  Views/
public/
  css/
  index.php
```

## Setup Guide

1. Place the project folder inside:

```txt
C:\xampp\htdocs\b-link-system
```

2. Create the database:

```sql
CREATE DATABASE blink_db;
```

3. Configure `.env`:

```env
APP_URL=http://localhost/b-link-system/public
DB_HOST=localhost
DB_NAME=blink_db
DB_USER=root
DB_PASS=
```

4. Create the required database tables:

- users
- households
- residents
- documents
- disaster_reports

5. Seed or manually create an admin account.

6. Open the system in the browser:

```txt
http://localhost/b-link-system/public
```

## Important Database Notes

The `households` table uses `head_resident_id` to point to an actual resident record. This avoids duplicating household head names as plain text.

The resident archive feature does not physically delete records. It changes the resident status to `archived`, preserving historical data for reporting.

## Final Test Checklist

- Login works with a valid account.
- Invalid login is rejected.
- Logout returns the user to the login page.
- Protected pages cannot be accessed without login.
- Admin can add user accounts.
- Staff cannot access admin-only user management.
- Resident can be created.
- Resident can be searched.
- Resident profile can be viewed.
- Resident can be edited.
- Resident can be archived.
- Household can be created.
- Household can be edited.
- Household head can be assigned.
- Household profile can be viewed.
- Household resident count updates correctly.
- Document can be generated for a resident.
- Document can be printed cleanly.
- Disaster report can be created.
- Disaster report status can be updated.
- Disaster filters return expected residents.
- Dashboard cards and charts display correct values.
- Flash messages appear after important actions.
- Print views hide navigation, buttons, flash messages, and screen-only text.

## Presentation Notes

Suggested demo flow:

1. Login as an admin or staff user.
2. Show the dashboard analytics.
3. Register or view a household.
4. Register or view a resident assigned to that household.
5. Show resident vulnerability and evacuation information.
6. Generate and print a barangay document.
7. Use disaster filters to retrieve vulnerable residents.
8. Create or update a disaster monitoring report.
9. Show admin user management if presenting the admin role.

## Scope Limitations

The prototype does not include:

- public resident portal;
- online payments;
- SMS/email notifications;
- integration with national government systems;
- advanced audit logs;
- production-grade deployment hardening.

These limitations keep the project aligned with the mini-capstone timeline and local MVC learning goals.
