# Time Records

Time Record Software is a tool that allows you to record and manage your work hours. You can input start and end times, and generate reports for different time periods, such as daily, monthly, and yearly summaries dependind on projects you worked on.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [License](#license)

## Introduction

Time tracking is essential for managing your work hours efficiently. This software provides an easy-to-use interface for recording your start and end times. You can then generate reports to track your work hours over different time periods.

## Features

- Record start and end times for your work activities.
- Generate daily, monthly, and yearly reports to track your work hours.
- User-friendly interface for easy data entry and retrieval.

## Installation
1. Download the zip file or use the clone command.
2. Extract the folder and start a git bash from the folder.
3. Run the command ``composer install``.
4. Run the command ``npm install``.
5. Run the command ``npm run dev``.
6. Open the project folder and start a new terminal there.
7. Run this command ``cp .env.example .env``
8. Open the .env file and create a database according to the DB_DATABASE name.
9. Run the command ``php artisan key:generate``.
10. Start the mysql and apache server from Xampp.
11. Run the command ``php artisan migrate:fresh``.
12. Run the command ``php artisan serve``.


## Usage

1. Launch the Time Records Software.

2. Use the user-friendly interface to input your start and end times for different work activities.

3. Save the entries, and the software will automatically calculate the total hours for each day.

4. Generate reports by clicking the time "Download Report" button.

5. The reports will provide you with an overview of your work hours during the selected period.


## License

This project is licensed under the GNU General Public License, version 3.0. See the [LICENSE](LICENSE) file for details.

For a full copy of the license, please visit [GNU GPL-3.0](https://www.gnu.org/licenses/gpl-3.0.html).
