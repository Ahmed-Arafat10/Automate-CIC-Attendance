# CIC Automating Attendance


I have created this project to remove the burden of attendance process

In each Lab/Tutorial we have to take a paper then each student must write his Name & ID

The problem here is that:
 - Some students can write the name of their friends who are not attending 
 - Some students hand writing is not so good resulting in confusion while reading their IDs and/or Names
 - It is time-consuming process
 - This process Cumulating more than 10 `A4` papers each week that pollute the environment (More Paper = More Wood)

### The Project is Hosted on `AWS EC2` with `SSL` certificate & `Domain`

### How to use it ?
- Open the following link in your browser
````
https//khuh.ml/CIC_ATTEND
````

- Features
  - A signing in page appears to students
  - They have to type the name & password to be redirected to the where they can type their names & IDs
  - In sign in page, each meeting with me will have a different password
  - Me as an admin in admin panel can change password for each meeting
  - This website only works during the meeting, for example it will be only avariable on Sunday from 8:00 to 10:00, this  is the time of ``Programming 3`` course, at `7:59AM` the following message will be shown
  ``No Lab/Tutorial With Ahmed Arafat At This Time``
  - Each student can make attend ONLY ONCE at each meeting, this will prevent some students from typing the name of their friends
  - Also I record the `IP Address` of each student to track each device so that if any student at any circumstances added his friend I can know who have done this
  - In admin panel as I said I can change password of each meeting + viewing name & ID of students who have registered during the meeting
  - I can `Edit` or `Delete` any record
  - Now all I have to do is to count the number of students attending the Lab/Tutorial then comparing it with number of students who have registered in the website

#### At the end of each semester, to assign grades for each student depending on their attendance
#### All I have to do is to execute the following `SQL` query
````
SELECT Student_ID , Student_Name , COUNT(Student_ID) 
from attendance 
where Meeting_ID in (SELECT ID FROM meetings where Meeting_Name LIKE '%IS%') 
GROUP by Student_ID 
ORDER BY Student_ID ASC;
````
> All I have to do is to change `'%IS%'` to code of course I teach, that's it

- Then exporting the result of above query to `Excel` file, then using `Vlookup` built-in function I can assign number of Labs/Tutorials attended by specific student next to his record 
