
## Database Schema
The application uses a MySQL database with **15 tables** designed to manage academic resources, user authentication, and content management. The schema supports a comprehensive learning management system with role-based access control.

### Core Tables Structure

#### 1. User Management Tables
- **`register`** - User registration and authentication
  - `id`, `name`, `username`, `email`, `password`, `cpassword`
- **`profile`** - Extended user profiles
  - `Id`, `Name`, `Username`, `Roll`, `Session`, `Email`, `PhoneNumber`, `Image`, `Batch`, `request`
- **`admin`** - Administrator accounts with elevated privileges
  - `id`, `name`, `username`, `roll`, `session`, `email`, `phone`, `image`, `batch`, `password`, `confirm_password`

#### 2. Academic Structure Tables
- **`main`** - Semester management
  - `id`, `semester`
- **`subject`** - Course catalog organized by semester
  - `id`, `semester`, `coursecode`, `course`, `picture`

#### 3. Content Management Tables
- **`book`** - Textbook resources
  - `id`, `coursecode`, `course`, `book`
- **`notes`** - Student and teacher notes
  - `id`, `coursecode`, `subject`, `topic`, `created`, `note`
- **`slide`** - Lecture slides and presentations
  - `id`, `coursecode`, `course`, `lecture`, `topic`, `slide`
- **`question`** - Previous year questions
  - `id`, `coursecode`, `course`, `sesion`, `questions`
- **`topic`** - Topic-wise tutorials and resources
  - `id`, `coursecode`, `course`, `chaptername`, `topic`, `tutorial`, `website`
- **`viva`** - Viva voce questions with answers
  - `id`, `coursecode`, `course`, `question`, `answer`
- **`important`** - Important topics and questions
  - `id`, `coursecode`, `course`, `chapter`, `topic`

#### 4. Communication & Administration Tables
- **`request`** - Permission requests for resource management
  - `id`, `roll`, `name`, `batch`, `session`, `username`, `email`, `subject`, `reason`, `status`, `seen`
- **`delete_request`** - Resource deletion requests
  - `id`, `roll`, `name`, `session`, `batch`, `username`, `email`, `subject`, `reason`, `status`
- **`message`** - Internal messaging system
  - `id`, `username`, `message`, `status`, `sender`, `receiver`

### Key Relationships

- **One-to-One**: `register` ↔ `profile` (user authentication to profile data)
- **One-to-Many**: 
  - `subject` → Content tables (`book`, `notes`, `slide`, etc.)
  - `admin` → `request` (admin manages permission requests)
  - Users → `message` (user communication)
- **Self-Referencing**: `message` table supports conversations between users and admin

### Design Features

- **Normalization**: Separate tables for different content types ensure data integrity
- **Role-Based Access**: Distinct `admin` and user tables with permission workflows
- **Academic Hierarchy**: Semester → Subject → Topic content organization
- **Audit Trail**: Request tables track permission changes and content modifications
- **File Management**: File paths stored for PDFs, images, and other resources
