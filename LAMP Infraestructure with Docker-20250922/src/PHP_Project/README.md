# Urban Music Awards Web Application

## 1. Description of the Application

The **Music Awards Web Application** is an online platform dedicated to celebrating and recognizing musical talent.  
It allows users to explore different award categories and vote for their favorite artists in sections such as **Best New Artist**, **Best Urban Artist**, and **Artist of the Year**.  
The platform aims to make the voting process transparent, engaging, and accessible to music fans around the world.

## 2. List of Functionalities

- **User Registration and Login:** Users can create an account or sign in to participate in the voting process.
- **Voting System:** Each user can vote once per category (Best New Artist, Best Urban Artist, Artist of the Year).
- **Vote Counting and Results Display:** Votes are automatically counted and displayed in real time.

## 3. Database Design

### TABLE: Users

| Field Name | Data Type    | Description                     |
| ---------- | ------------ | ------------------------------- |
| user_id    | INT (PK)     | Unique identifier for each user |
| username   | VARCHAR(50)  | User’s display name             |
| email      | VARCHAR(100) | User’s email address            |
| password   | VARCHAR(255) | User’s password                 |

---

### TABLE: Artists

| Field Name | Data Type    | Description                                   |
| ---------- | ------------ | --------------------------------------------- |
| artist_id  | INT (PK)     | Unique identifier for each artist             |
| name       | VARCHAR(100) | Artist’s name                                 |
| biography  | TEXT         | Short description or background of the artist |
| image_url  | VARCHAR(255) | URL of the artist’s image                     |

---

### TABLE: Categories

| Field Name  | Data Type    | Description                             |
| ----------- | ------------ | --------------------------------------- |
| category_id | INT (PK)     | Unique identifier for each category     |
| name        | VARCHAR(100) | Category name (e.g., "Best New Artist") |
| description | TEXT         | Description of the category             |

---

### TABLE: Votes

| Field Name  | Data Type | Description                                |
| ----------- | --------- | ------------------------------------------ |
| vote_id     | INT (PK)  | Unique identifier for each vote            |
| user_id     | INT (FK)  | ID of the user who cast the vote           |
| artist_id   | INT (FK)  | ID of the artist who received the vote     |
| category_id | INT (FK)  | ID of the category where the vote was cast |

**Relationships:**

- Each **user** can vote for multiple **artists**, but only once per **category**.
- Each **artist** can belong to multiple **categories**.
