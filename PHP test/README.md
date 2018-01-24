# PHP tech test

## Assumptions
Below are the lists of assumptions for the tech challenge
- Column header names
- The date format for both the salary payment date and bonus payment date
- User can specify the name of the output file
- Return records for all months of the current year


## Requirements
This application was written on a machine running Mac Operating System and PHP Version 7.1.7. However the minimum requirement is a machine running PHP version 5.2 or later.

## How to run the application
After copying the Tech test folder, open your terminal/command prompt.
Navigate to where you have installed the files.

```
cd 'PHP test'
php solution.php
```

This will generate a csv called payroll followed by the current year.
E.g. 'payroll2018.csv' would be generated for the year 2018.

If you want to change where the data is saved to, pass in the name as a second argument.
**Do not include the file extension in the name.**

```
php solution.php mypayroll.csv
```
The csv will be called mypayroll.csv instead of payroll2018.csv

## Future Enchanced

- Add functionality to catering for bank holidays
