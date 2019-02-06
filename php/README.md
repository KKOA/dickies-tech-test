# PHP tech test
This is my solution for the below requirement.

## Test Requirements
You are required to create a small command-line utility to help a fictional company determine the dates they need to pay salaries to their sales department.

This company is handling their sales payroll in the following way: 
- Sales staff get a regular monthly fixed base salary and a monthly bonus. 
- The base salaries are paid on the last day of the month unless that day is a Saturday or a Sunday (weekend). In that case, salaries are paid before the weekend. 
- On the 15th of every month bonuses are paid for the previous month, unless that day is a week-end. In that case, they are paid the first Wednesday after the 15th. 

The output of the utility should be a CSV file, containing the payment dates for the remainder of this year. The CSV file should contain a column for the month name, a column that contains the salary payment date for that month, and a column that contains the bonus payment date.

Flowchart For your convenience, the diagram on the following page depicts the process of determining the pay dates of the sales department.

![flowchart](https://github.com/KKOA/dickies-tech-test/blob/master/php/requirement.jpg)

## Assumptions
Below are the lists of assumptions for the tech challenge
- Column header names
- The date format for both the salary payment date and bonus payment date
- User can specify the name of the output file
- Return records for all months of the current year
- Bonuses run from February to January the following year. E.g. February 2018 - January 2019


## Requirements
This application was written on a machine running Mac Operating System and PHP Version 7.1.7. However the minimum requirement is a machine running PHP version 5.2 or later.

## How to run the application
After copying the Tech test folder, open your terminal/command prompt.
Navigate to where you have installed the files.

```
cd 'php'
php solution.php
```

This will generate a csv called payroll followed by the current year.
E.g. 'payroll2018.csv' would be generated for the year 2018.

If you want to change where the data is saved to, pass in the name as a second argument.
**Do not include the file extension in the name.**

```
php solution.php payroll
```
The csv will be called payroll.csv instead of payroll2018.csv

## Future enhancements

- Add functionality to catering for bank holidays
