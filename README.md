# Bot Analytics With PHP

A PHP-based application for detecting and logging bot activity on your website. This project utilizes CrawlerDetect to differentiate between human users and crawlers, storing relevant data in a MySQL database.

## Features

- Detects various web crawlers and bots using the CrawlerDetect library.
- Logs bot activity with relevant details such as IP address, user agent, domain name, full path, and check value.
- Sends email notifications to the admin when a bot is detected.
- Stores data in a MySQL database for easy retrieval and analysis.

## Prerequisites

- PHP 7.0 or higher
- MySQL
- Composer (for installing dependencies)
- A web server (Apache/Nginx) configured to run PHP

## Installation

### 1. Install dependencies

Make sure you have Composer installed, then run:

```bash
composer install

```

- install CrawlerDetect

You need to install the [CrawlerDetect](https://github.com/JayBizzle/Crawler-Detect/) library using Composer:

```bash
composer require jaybizzle/crawler-detect
```

### 2. Set up the database

Create a MySQL database and run the SQL commands. Look in the `info.txt` file to create the necessary tables

### 3. Configure the project

Update the `config/config.php` file with your database connection details and admin email address.

### 4. Set up your web server

Make sure your web server is configured to serve the `public` directory. You may need to adjust the document root settings.

### 6. Access the application

Open your web browser and navigate to your server's URL followed by `/stat.php` to start monitoring bot activity.

### Additional steps:
You can test your project by running the server:

```bash
php -S localhost:8000 -t public

```

## Usage

Once set up, the application will automatically log bot visits to the `bot_data` table in the database and send email notifications when a bot is detected.

## Logging

Logs are stored in the `logs/bot-analytics.log` file. You can check this file for any errors or additional information about the bot detections.

## Acknowledgments

[CrawlerDetect](https://github.com/JayBizzle/Crawler-Detect/) The web used library for this project.
