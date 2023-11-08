# Time Records

Time Record Software is a tool that allows you to record and manage your work hours. You can input start and end times, and generate reports for different time periods, such as daily, monthly, and yearly summaries dependind on projects you worked on.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Generating Reports](#generating-reports)
- [Contributing](#contributing)
- [License](#license)

## Introduction

Time tracking is essential for managing your work hours efficiently. This software provides an easy-to-use interface for recording your start and end times. You can then generate reports to track your work hours over different time periods.

## Features

- Record start and end times for your work activities.
- Generate daily, monthly, and yearly reports to track your work hours.
- User-friendly interface for easy data entry and retrieval.

## Installation
Be sure to have these installed in your PC beforehand : 
1. Xampp-8.2.4-0
2. Composer v2.6.5
3. Laravel 5.1.3

To use the Time Records Software, follow these steps:

1. Download the repository to your local machine.
2. Extract and move it to this path : "C:\xampp\htdocs".
3. Start Xampp server and start Apache and mysql module.
4. Open the project in your IDEA and run the terminal.
5. Create a database according to the database name from .env file.
6. Run this command for table migration :
    ```shell
    php artisan migrate:fresh
7. Write this command for running the software:
    ```shell
    php artisan serve
8. Go the following link from the terminal to Enter into the software GUI

Usage
Launch the Time Tracking Software.

1. Use the user-friendly interface to input your start and end times for different work activities.

2. Save the entries, and the software will automatically calculate the total hours for each day.

3. Generate reports by clicking the time "Download Report" button.

4. The reports will provide you with an overview of your work hours during the selected period.


