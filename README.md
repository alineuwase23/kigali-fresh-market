# 🛒 Kigali Fresh Market — E-Commerce Web Application

## 👤 Student Information
- **Name:** Aline Uwase
- **Student ID:** 23834/2024
- **Course:** EWA408510 – E-Commerce and Web Application
- **Lecturer:** Eric Maniraguha
- **Academic Year:** 2025–2026 | Semester II
- **Submission Date:** June 17, 2026

---

## 📌 Project Title
**Kigali Fresh Market** — A Full E-Commerce Web Application for Food & Beverages

---

## 🎯 Project Overview
Kigali Fresh Market is a complete e-commerce web application built for a local Rwandan business. The platform enables customers to browse 25+ products, add items to a shopping cart, place orders, and manage purchases online.

---

## 🛠️ Technologies Used
- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Database:** MySQL (via XAMPP)
- **Version Control:** Git & GitHub
- **Containerization:** Docker
- **CI/CD:** GitHub Actions
- **Fonts:** Poppins, Montserrat, Inter
- **Local Server:** XAMPP (Apache + MySQL)

---

## ✅ Features Implemented
- 🏠 **Homepage** — Hero section, sliding product banner, bento grid, stats, CEO section
- 🛍️ **Products Page** — 25 products with search bar and category filter
- 🛒 **Shopping Cart** — Add/remove items, quantity updates, total calculation
- 💳 **Checkout Page** — Customer details form with order summary
- 💾 **Database Integration** — Orders and customers saved to MySQL
- ℹ️ **About Page** — Store story, mission, CEO profile
- 📞 **Contact Page** — Contact form with email, phone, address
- 🎨 **Modern Design** — Glassmorphism cards, bento grid, soft animations

---

## 🗄️ Database Structure
**Database:** `kigali_fresh_market`

| Table | Description |
|-------|-------------|
| `products` | Stores all 25 product details |
| `customers` | Stores customer information |
| `orders` | Stores all placed orders |
---
## 📁 Project Structure
kigali-fresh-market/

├── index.html          # Homepage

├── products.html       # Products page

├── about.html          # About page

├── contact.html        # Contact page

├── cart.html           # Shopping cart

├── checkout.html       # Checkout page

├── style.css           # Main stylesheet

├── cart.js             # Cart functionality

├── db.php              # Database connection

├── submit_order.php    # Order submission

├── Dockerfile          # Docker configuration

├── docker-compose.yml  # Docker services

└── images/             # Product images


## 🖼️ Screenshots

### Homepage
![Homepage](images/coffee.jpg)

---

## ⚙️ Challenges Encountered
- Setting up MySQL connection with XAMPP on a custom port (3306)
- Implementing real-time cart functionality using localStorage
- Designing a responsive bento grid layout
- Configuring Docker for PHP and MySQL services

---

## 🚀 Deployment
- **Local:** XAMPP (localhost:8888)
- **Live URL:** Coming soon via deployment

---

## 📂 GitHub Repository
🔗 [https://github.com/alineuwase23/kigali-fresh-market](https://github.com/alineuwase23/kigali-fresh-market)

---

## 🔄 CI/CD
GitHub Actions workflow automatically:
- Runs on every push to main branch
- Validates HTML and PHP files
- Builds Docker container

---

## 🐳 Docker
The application is containerized using Docker:
- `Dockerfile` — PHP Apache container
- `docker-compose.yml` — PHP + MySQL services

---

## 🔮 Future Work
- Payment gateway integration (Mobile Money)
- User authentication and login
- Admin dashboard for order management
- SMS notifications for orders
- Mobile app version

---

## 📚 Lessons Learned
- How to build a complete e-commerce system from scratch
- PHP and MySQL database integration
- Modern CSS techniques (glassmorphism, bento grid)
- Docker containerization
- CI/CD pipeline setup with GitHub Actions

---

## 🏁 Conclusion
Kigali Fresh Market demonstrates a complete, functional e-commerce platform built with modern web technologies. The project successfully implements all required features including UI, product management, shopping cart, checkout, database integration, deployment, Docker, and CI/CD.

*Designed with ❤️ in Rwanda — 2026*
---

## 📁 Project Structure
