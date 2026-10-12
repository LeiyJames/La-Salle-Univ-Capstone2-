# La Salle University Website of Student Events
> **BSIT Capstone 2 Project** &bull; 4th Year Bachelor of Science in Information Technology  
> **Institution:** La Salle University – Ozamiz City  
> **Project Team:**
> - **Leigh James Presno**
> - **Lucy Mae Tan**
> - **Femarie Corpuz**

---

## 📌 Project Overview

The **La Salle University Website of Student Events** is a centralized, interactive web application developed as a 4th-year Capstone 2 project for the BSIT program at La Salle University. 

Designed in close alignment with the **Student Activities Center (SAC)** and campus organizations, the platform streamlines the discovery, promotion, scheduling, and administration of university events. It bridges the gap between campus organizers and the student body by replacing fragmented social media announcements with an authoritative, unified digital hub.

---

## ✨ Features Showcase

### 🎓 1. Public & Student Portal

#### 🌟 Interactive Hero Carousel & Spotlight Banner
- **Dynamic Event Highlights:** High-impact carousel banner on the homepage showcasing major upcoming university activities, institutional assemblies, and flagship celebrations.
- **Quick Feature Navigation:** Floating shortcut bar providing instant access to the event directory, interactive calendar, FAQ section, and SAC info.

#### 🔍 Real-Time Campus Event Discovery & Filtering
- **Debounced Live Search:** Instant search functionality allowing students to search for activities by title, description, or keyword without full page reloads.
- **Event Lifecycle Tabs:** Quick switching between **Upcoming Events** and the **Past Archive**.
- **Department & Category Filter Chips:** One-click filtering tailored to collegiate departments and activity classifications:
  - **Academic Departments:** CCSEA, CBA, CTE, CON
  - **Education Levels:** Basic Education & Higher Education
  - **Organization Types:** Academic-Based Organizations (ABO) & Interest-Based Organizations (IBO)
  - **Special Categories:** Sports, Workshops, Seminars, and Campus-Wide Events
- **Active Filter Indicators:** Visual chips showing active search queries with a single-click "Clear All Filters" reset button.

#### 📅 Interactive Monthly Calendar of Events
- **Month-by-Month Navigation:** Intuitive traversal across past, current, and upcoming academic months.
- **Visual Activity Indicators:** Color-coded calendar day highlights marking days with scheduled events.
- **Interactive Hover Tooltips:** Alpine.js-powered popover cards previewing event titles and summaries upon hovering over marked dates.

#### 🏆 Spotlight Events Showcase
- **Flagship Celebration Hub:** Dedicated showcase page designed for major multi-day university events (e.g., Intramurals, Lasallian Week, University Days).
- **Segmented Schedule of Activities:** Separate itinerary tabs for **Basic Education** and **Higher Education**.
- **Day-by-Day Chronological Itinerary:** Detailed schedules outlining activity names, venues, dates, and times.
- **Affiliation Filtering:** Filter spotlight sub-events by Academic-Based or Interest-Based student organizations.

#### 📄 Comprehensive Event Details & Direct Registration
- **High-Definition Event Posters:** Responsive media banners served through Spatie Media Library.
- **Event Metadata Badges:** Clear display of start/end dates, campus venues/rooms, and topic tags.
- **Direct Workshop Registration Link:** Integrated call-to-action button linking directly to external registration forms (e.g., Google Forms) for workshops and seminars requiring prior sign-ups.
- **Related Events Carousel:** Displays recommended and related campus happenings at the bottom of the event view.
- **Integrated Sidebar:** Includes a mini monthly calendar and a quick list of other upcoming activities.

#### ❓ Searchable Student FAQ (Frequently Asked Questions)
- **Live Searchable FAQs:** Real-time query matching across questions and answers.
- **Student Activity Guidelines:** Clarifies procedures for student organization activity proposals, facility reservations, equipment borrowing, and SAC policies.

#### 🏛️ Student Activities Center (SAC) Institutional Page
- **Vision & Mission Showcase:** Outlines the core formation principles of La Salle University student affairs.
- **Programs & Services Breakdown:** Highlights leadership training programs (Lasallian Leadership Academy), student empowerment showcases (theater, debate, arts), and community engagement initiatives.

---

### 🛠️ 2. Administrative & Management Portal

#### 📊 Executive Admin Dashboard
- **Real-Time Key Metrics:** High-level dashboard counters tracking:
  - Total Events registered in the system
  - Active & Published Events
  - Upcoming Events scheduled for the current month
  - Active Spotlight Programs
  - Total Registered Users & Student Officer counts
- **Recent Activity Feed:** Quick-reference cards showing the latest event submissions and active spotlight timelines.

#### 📝 Event Management System (Full CRUD)
- **Event Creation & Editing:** Form with validations for title, dates, venues, organization types, custom tags, and workshop settings.
- **Poster Media Uploader:** Secure file uploads supporting JPG, PNG, and WebP formats up to 5MB.
- **Live Event Preview Modal:** Interactive preview allowing administrators and organizers to preview the exact event card and banner appearance prior to publishing.
- **Status Lifecycle Toggling:** One-click toggle between **Published (Active)** and **Draft (Inactive)** modes.
- **Multi-Tab Event Sorting:** Organized tab views for *All*, *Upcoming*, *Ongoing*, *Past*, and *Draft* events with real-time record count badges.
- **Soft Deletion & Recovery Safeguards:** Built-in soft deletes with confirmation modals to prevent accidental permanent data loss.

#### 🎯 Spotlight Event Builder
- **Multi-Day Activity Scheduler:** Add, arrange, and manage multi-event schedules for university celebrations.
- **Departmental Activity Partitioning:** Assign schedules specifically to Basic Education or Higher Education divisions.
- **Custom Chronological Date Validation:** Enforces schedule integrity ensuring activity dates align within the master event timeline.

#### 🖼️ Campus Gallery Manager
- **Photo Highlights Curation:** Upload and curate campus photography, event recaps, and memorable student moments.
- **Slide-Over Modal Interface:** Clean slide-over drawers for image uploads and metadata configuration.
- **Visibility Control & Deletion:** Instant toggle for active gallery items and confirmation-backed deletion.

#### 💡 FAQ Management System
- **Dynamic Content Administration:** Add, edit, and reorganize FAQ items for immediate publication on the public portal.
- **Status Activation:** Control which FAQs are visible to the student body with live status toggling.

#### 👥 User & Organization Officer Management
- **Role-Based Access Control (RBAC):**
  - **Administrator:** Full system access, event oversight, gallery control, and user provisioning.
  - **Editor:** Student organization leaders and department coordinators with event publishing rights.
  - **Student:** Registered student accounts.
- **Institutional Domain Restriction:** Enforces `@lsu.edu.ph` email regex validation to guarantee accounts belong to legitimate university constituents.
- **Organization Affiliation Tagging:** Associate user accounts with specific campus organizations and councils.
- **Search & User Directory:** Filter users by role tabs (*All*, *Admin*, *Editor*, *Student*) with live search.

#### 🔒 Profile & Credential Management
- **Secure Account Control:** Update personal details, maintain organizational information, and update passwords with secure hashing.

---

## 💻 Tech Stack & Architecture

- **Backend Framework:** [Laravel 10](https://laravel.com/) (PHP 8.1+)
- **Full-Stack Reactivity:** [Laravel Livewire 3](https://livewire.laravel.com/) & [Livewire Volt](https://livewire.laravel.com/docs/volt) (Single-page app responsiveness with server-side simplicity)
- **Frontend Styling:** [Tailwind CSS 3](https://tailwindcss.com/) with `@tailwindcss/forms`
- **Dynamic UI Interactions:** [Alpine.js](https://alpinejs.dev/)
- **Media Handling:** [Spatie Laravel MediaLibrary](https://spatie.be/docs/laravel-medialibrary)
- **Database & ORM:** MySQL / MariaDB via Laravel Eloquent ORM
- **Build Tool:** [Vite](https://vitejs.dev/)

---

*Developed in partial fulfillment of the requirements for **Capstone 2** at **La Salle University**.*
