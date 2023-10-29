# F23_CIS3760_101

# Team

-   Team Lead:
    -  Fee Kim Ah-Poa 
-   Team Members:
    -   Sara Adi
    -   Simardeep Singh
    -   Emily Kozatchiner
    -   Maneesh K. Wijewardhana

## How to Run
Please reference the following files existing in the sprint5_docs folder:
-   the API.md file for the associated URLs of the API calls in POSTMAN
-   the my_sql_use.md file for the creation and copying of the cis3760 database table.
-   We have it on our homepage where there is a button which will bring you to the API document

The two documents state clear instructions on how to operate the database and all the API calls associated with them.

## Current Sprint

Sprint 5

## Description

F23 CIS\*3760 Sprint 5:

The objective of this sprint is to design and create a navigable MySQL database using the VM provided. To do so, we need to establish server side REST API to access and modify the database. Documentation the API calls for database manipualtion should be provided. 

We mainly focused on improving our API endpoints and also we added some get endpoints to getSubject as we completed most of the work in the previous sprint.


The criteria that we needed to meet were:
-   Transfer all course data from excel to the VM MySQL database
-   Create a server side REST API in PHP
-   Presenting documentation and examples on how to interact with the database with REST API

## Visuals
MariaDB: Database creation and usage

![db1](./sprint5/Images/MicrosoftTeams-image__7_.png) 
![db2](./sprint5/Images/MicrosoftTeams-image__8_.png)

POSTMAN: API call example
![api1](./sprint5/Images/APICallExample.png)

API Doc: How to get the document on how to use our API from our website 
This is the link to it https://cis3760f23-01.socs.uoguelph.ca/apidocs.php


![apiDoc](./sprint5/Images/APIDoc.png)

## Team Approach
Approaching the sprint, we had to set up a local development environment for the team. Coding on the VM would be inefficient and potentially dangerous, so before approaching outstanding tasks, the team set-up their environment.

The sprint was divided into two sections: 
1. The creation and population of a new database in MySQL that holds all given csv file information
2. The connection of the database to establish the four main API calls in PHP scripts

Database task featured brainstorming on design on both the database and table organization, research on how to use MariaDB, and creation of the populated database.

For the API calls, we had multiple subtasks that everyone would take on to complete full communication between the database.
-   Establishing the connection to the database was done by Maneesh
-   GET request calls were done by Maneesh
-   POST request calls were done by Simardeep
-   PUT request calls were done by Fee Kim
-   DELETE request calls were done by Maneesh

We also accounted for various different database queries within these calls, and had to decide which fields were required to be present and which were not.

We have also implemented a link that directs you to the API document.
This is the link to it https://cis3760f23-01.socs.uoguelph.ca/apidocs.php

It can be easily access from the home page of our website


## Authors and acknowledgment

    - Sara Adi
    - Emily Kozatchiner
    - Fee Kim Ah-Poa
    - Maneesh K. Wijewardhana
    - Simardeep Singh

## Project status

Complete!!

