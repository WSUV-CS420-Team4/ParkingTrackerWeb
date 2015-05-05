![South Waterfront](http://www.southwaterfront.com/images/swcr-logo.png)

# Parking Tracker Web Application

[Android](https://github.com/WSUV-CS420-Team4/ParkingTracker)

[Web API](https://github.com/WSUV-CS420-Team4/ParkingTrackerApi)

[Docs](https://github.com/WSUV-CS420-Team4/ParkingTrackerDocs)

ParkingTracker is an application designed to help neighborhood/community groups track the usage of parking spaces
within their neighborhood. An Android device is used to collect data by inputting license plates via the system camera
and OCR. This data is then stored in a database and accessed/analyzed by a web application.

Sponsor: [South Waterfront](http://www.southwaterfront.com/)

## Component Overview

This is the web frontend. It will allow interaction and administration of the data set stored by the backend. It's currently
developed in AngularJS, however AngularJS is surprisingly terrible and I may yet switch to something like Laravel. It interacts
with the REST API to display the data collected and to provide information on utilization of parking. It also provides the interface
for authentication.

## Authors

- Vito
- Joel
- Bob
- Jason

## Current Status

The web application is currently displaying the data collected by the Parking Tracker application, displaying and allowing modification
of the "streetmodel" or the data structure defining blocks and blockfaces. It also allows for the export of a spreadsheet with the
parking data for a given day.

## Build/Install

- See installation directions

## Configuration

Database configuration is in fuel/app/config/

## Known Bugs & Caveats

None so far

## To Do

- Provide an interface for OAuth authentication
- Expand functionality
- Put authentication between user and data
- Provide administrative interface
