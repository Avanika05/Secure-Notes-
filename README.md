# Secure-Notes-
A PHP-based Secure Notes Vault web app that lets users register, log in, and securely store encrypted personal notes using OpenSSL AES-256-CBC encryption. Includes account deletion and logout features for complete data privacy.
# 🔒 Secure Notes Vault

A lightweight and secure web application built with **PHP**, **MySQL**, and **OpenSSL encryption**, allowing users to safely create, view, and manage private notes.

## 🚀 Features
- 🔐 **User Authentication** — Register, log in, and manage your account.
- 🧠 **Encrypted Notes** — All note titles and contents are encrypted using AES-256-CBC.
- 🗑️ **Delete Account** — Permanently remove your account and all notes.
- 🚪 **Logout** — Securely log out anytime.
- 🖋️ **Responsive UI** — Clean, minimal, and aesthetic design using pure CSS.

## 🛠️ Tech Stack
- **Frontend:** HTML5, CSS3
- **Backend:** PHP
- **Database:** MySQL
- **Encryption:** OpenSSL AES-256-CBC

## ⚙️ Setup Instructions
1. Install and start **XAMPP** or **WAMP**.
2. Place the project folder (`secure_notes`) in the `htdocs` directory.
3. Open **phpMyAdmin** and create a database named `secure_notes`.
4. Import the provided `secure_notes.sql` file.
5. Start **Apache** and **MySQL** services.
6. Visit [http://localhost/secure_notes/register.php](http://localhost/secure_notes/register.php) to get started.


## 🧩 Security Notes
- Notes are **encrypted before storage** and decrypted only upon display.
- AES-256-CBC ensures strong protection against data breaches.
- Avoid exposing your encryption key (`ENCRYPTION_KEY`) publicly.

## ✨ Future Enhancements
- Add password reset feature
- Implement user-specific encryption keys
- Include folder-based note organization

---

**Created by:** Avanika Kulkarni  
**Year:** 2025  
