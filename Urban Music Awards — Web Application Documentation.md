# Urban Music Awards — Web Application Documentation

## 1. Description of the Application

The **Urban Music Awards** web application allows users to vote for their favorite artist in the category **“Urban Artist of the Year”**.  
Each user can only submit **one vote** using their **dni**.

---

## 2. List of functionalities

The application includes:

- A homepage displaying the **nominated artists**.
- A **voting form** that collects:
  - Voter’s name
  - Voter’s Dni
  - Chosen artist
- A **database** with two tables: `artists` and `votes`.

---

## 3. Database Design

### TABLE: Artists

| Field Name | Data Type    | Description                       |
| ---------- | ------------ | --------------------------------- |
| artist_id  | INT (PK)     | Unique identifier for each artist |
| name       | VARCHAR(100) | Artist’s name                     |
| last_song  | VARCHAR(255) | Last Song of the artist           |

---

### TABLE: Votes

| Field Name | Data Type    | Description                            |
| ---------- | ------------ | -------------------------------------- |
| voter_dni  | CHAR(9) (PK) | Unique identifier for each vote        |
| voter_name | VARCHAR(100) | Name of the person who voted           |
| artist_id  | INT (FK)     | ID of the artist who received the vote |





**Relationships:**

- Each **artist** can receive many votes.
- Each **vote** belongs to exactly **one artist**.
- Each **Dni** can only appear **once**, ensuring only one vote per person.

## 4. GUI design

![PHP_Project_Model](/home/sanclemente.local/a21braispn/Descargas/PHP_Project_Model.png)
