
# AcademicHub - Academic Resource Sharing Platform

## 📖 About The Project

AcademicHub is a comprehensive full-stack web application designed to revolutionize academic resource sharing and collaborative learning among students. Born from the real-world challenge of inefficient note-sharing and resource dispersion during exam preparation, this platform provides a centralized hub for all academic materials.

### 🎯 Problem Statement
Traditional academic resource sharing often leads to:
- Fragmented study materials across multiple platforms
- Difficulty in accessing quality notes and previous year questions
- Limited collaborative learning opportunities
- Inefficient viva voce preparation methods

### 💡 Our Solution
AcademicHub addresses these challenges through:
- **Unified Platform**: All resources in one place
- **Structured Organization**: Syllabus-based categorization
- **Collaborative Features**: Peer-to-peer resource sharing
- **Interactive Learning**: Hover-to-reveal viva preparation




## ✨ Features

### 🔐 Authentication & Security
- **Role-Based Access Control**: Admin, Moderator, and Student roles

- **Request-Based Permissions**: Controlled resource management access

### 📚 Academic Resources
- **Personal & Shared Notes**: Create, manage, and collaborate on notes
- **Structured Course Materials**: Organized by semester and subject
- **Multimedia Integration**: YouTube links and external articles
- **Exam Preparation**: Previous year questions and important topics

### 🎓 Learning Tools
- **Interactive Viva Practice**: Hover-to-reveal answer system
- **Centralized Document Access**: Books, slides, and notes in one place
- **Topic-wise Tutorials**: Detailed chapter-wise resources
- **User-Friendly Design:** All resources are viewable within the app and available for download.

### 👨‍💼 Administration
- **Admin Dashboard**: Comprehensive management panel
- **Moderator System**: Delegated content management
- **Request Management**: Streamlined permission handling

## 🛠️ System Design & Architecture

    Frontend: HTML, CSS, JavaScript  
            ⬇  
    Backend: PHP 8  
            ⬇  
    Database: MySQL/MariaDB (15 normalized tables) 


- Authentication & user profiles linked via register and profile.

- Content organized hierarchically: **Semester → Subject → Resource.**

- Admins manage permissions and deletion requests.

- Internal messaging system for collaboration.

📂 [Project Structure](./docs/project_structure.md)

## 📋 Database Schema & ERD

**15 tables** covering user management, academic structure, content management, and communication.

- **Core design choices:**

  - **Normalization** for integrity & scalability.

  - **Role-based access control** for security.

  - **Audit trail** with request tables.
  

**📌 Example relationships:**

One-to-One: register ↔ profile

One-to-Many: subject → (book, notes, slide, etc.)

Messaging between users & admins via message.

📄 [Detailed Database Schema](./docs/database_schema.md)


## 🗂️ Entity Relationship Diagram (ERD)

Here is the ERD of the database:

![Entity Relationship Diagram](./erd.jpg)

## Demo Video 🎥
[![Watch the Demo on Loom](./demo.png)](https://www.loom.com/share/9a05028b93b64b039b63ae36fc57a426?sid=92d5cd99-9432-45c1-b9dd-caf7578c8be0)
## 🛠️ Tech Stack
- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP 8.0.28
- **Database:** MariaDB 10.4.28
- **Tool:** GitHub, phpMyAdmin, Loom (demo recording)
## 🏃‍♂️ Installation & Setup

    1. Install a local server (XAMPP/WAMP).

    2. Clone repo:

    3. git clone https://github.com/your-username/noteapp.git


    4. Import SQL schema into phpMyAdmin.

    5. Run index.php in browser.
## 🌱 Future Enhancements

- AI-based quiz generator from uploaded notes.
- Advanced search with filters & tags.
- Mobile app integration.
- Gamified learning (leaderboards, rewards).
## 👨‍💻 My Role

**I designed, implemented, and deployed the entire    application independently,** covering:

- Database schema design (15 normalized tables + ERD).

- Full frontend and backend development.

- Authentication and role-based access control.

- File management and internal messaging.
## 👤 Author  
[Nahid Nisa](https://github.com/NahidNisa) – Full-Stack Developer (Project Owner)  

