# WIZDEMY - Academic Resource Sharing Platform

WIZDEMY is an academic resource sharing platform that allows students to share academic resources such as notes, past questions, and textbooks with other students. It is a platform that allows students to learn from each other and share knowledge. WIZDEMY is a platform that is designed to help students succeed in their academic pursuits by providing them with the resources they need to excel in their studies.

## Features

- **User Authentication**: WIZDEMY allows users to create accounts and log in to the platform. Users can create accounts using their email addresses and passwords. Users can also log in using their email addresses and passwords.

- **Resource Sharing**: WIZDEMY allows users to share academic resources such as notes, past questions, and textbooks with other users. Users can upload resources to the platform and share them with other users. Users can also download resources shared by other users.

- **Resource Search**: WIZDEMY allows users to search for academic resources using keywords. Users can search for resources by entering keywords in the search bar. WIZDEMY will display a list of resources that match the search query.

- **Resource Request**: WIZDEMY allows users to request academic resources that are not available on the platform. Users can submit resource requests by entering the details of the resource they are looking for. Other users can respond to resource requests by sharing the requested resources.

- **Project Showcase**: WIZDEMY allows users to showcase their academic projects on the platform. Users can upload their github repositories, websites, and other projects to the platform and share them with other users.

- **User Profile**: WIZDEMY allows users to create profiles and customize their profiles with profile pictures and personal information. Users can view other users' profiles and connect with other users on the platform.

- **Admin Panel**: WIZDEMY has an admin panel that allows administrators to manage users, resources, and resource requests on the platform. Administrators can view user accounts, delete user accounts, view resources, delete resources, view resource requests, and respond to resource requests.

## Tech Stack

WIZDEMY is built using the following technologies:

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Web Server**: Apache

![HTML](https://img.shields.io/badge/-HTML5-E34F26?style=flat&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/-CSS3-1572B6?style=flat&logo=css3)
![JavaScript](https://img.shields.io/badge/-JavaScript-black?style=flat&logo=javascript)
![PHP](https://img.shields.io/badge/-PHP-777BB4?style=flat&logo=php)
![MySQL](https://img.shields.io/badge/-MySQL-black?style=flat&logo=mysql)
![Apache](https://img.shields.io/badge/-Apache-D22128?style=flat&logo=Apache&logoColor=White)

WIZDEMY is a web-based platform that is accessible from any device with an internet connection. Users can access WIZDEMY from their desktop computers, laptops, tablets, and smartphones.

## How to Contribute

To contribute to WIZDEMY, follow these steps:

1. Fork the repository
2. Clone the repository to your local machine
   with docker:
   ```bash
   docker-compose up
   ```
   without docker:
   ```bash
   git clone <your-fork-url>
   ```

3. Configure the project


   without docker:

   ```bash
   cd wizdemy

   # Create a new database
   mysql -u root -p
   CREATE DATABASE wizdemy;
   exit;

   # Import the database schema
   mysql -u root -p wizdemy < wizdemy.sql

   # Update the database configuration
   cd system && cp config.example.php config.php
   ```

   Update the database configuration in `system/config.php` with your database credentials.

   with docker:

   ```bash
   cd wizdemy/system && cp config.example.php config.php
   ```
   Update the database configuration in `system/config.php` with the following credentials:
   
   also update the database configuration in `docker-compose.yml` with the following credentials:
   ```bash
   # everything else is the same
   ---
   MYSQL_ROOT_PASSWORD: <your-password>
   --
   # everything else is the same
   ```
4. Create a new branch for your changes

   ```bash
   git checkout -b branch-name
   ```

5. Make your changes to the code

6. Test your changes

   ```bash
   php -l index.php
   ```

7. Commit your changes

   ```bash
   git commit -am 'Description of changes'
   ```

8. Push your changes to your fork

   ```bash
   git push origin branch-name
   ```

9. Create a pull request

10. Wait for your pull request to be reviewed and merged

11. Celebrate your contribution to WIZDEMY!

## Admin Access

To access the admin panel:

1. Navigate to the `/admin/login` endpoint.
2. Use the following credentials to log in:
   - Username: `bossAdmin`
   - Email: `bossAdmin@wizdemy.com`
   - Password: `12341234`

## Contact Developers for Job Offers

Feel free to reach out to us for any job opportunities. We appreciate your interest in our work!

| Developer                                                                        | Email                  |
| -------------------------------------------------------------------------------- | ---------------------- |
| ![Rayyan Balami](https://github.com/rayyan-balami.png?size=100) Rayyan Balami    | visionrayyan@gmail.com |
| ![Satish Chaudhary](https://github.com/satishcg12.png?size=100) Satish Chaudhary | sc2903175@gmail.com    |

## License

WIZDEMY is licensed under the Creative Commons Attribution-NonCommercial 4.0 International License. You can find more information about the license [here](https://creativecommons.org/licenses/by-nc/4.0/).

In summary, you are free to:

- Share — copy and redistribute the material in any medium or format
- Adapt — remix, transform, and build upon the material
- NonCommercial — You may not use the material for commercial purposes
- The licensor cannot revoke these freedoms as long as you follow the license terms.
