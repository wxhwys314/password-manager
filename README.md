# Password Manager

A secure and easy-to-use password manager that helps users store and manage their passwords effectively.

Initial master password: **Welkom123!**

Change master password: Login->Defaut User->Wachtwoord Wijzigen

## 📌 Features

- 🔒 Securely store passwords
- 🔑 Log in using a **master password** (no username required)
- 📁 Organize passwords into **categories**
- ✏️ **Add, edit, or delete** stored passwords
- 🔍 **Hide passwords** by default (displayed as asterisks)
- 👀 **Show passwords in plain text** or **copy passwords to the clipboard**
- 🛠️ Change the **master password** in the settings (requires old password first)
- 🔄 Set **password refresh frequency** (users define how many weeks until a password needs to be changed)

## 📦 Installation

To install the project, run the following commands:

```bash
git clone https://github.com/tallandcollege/wachtwoord-manager-wxhwys314.git
cd wachtwoord_manager
npm install

#database
php artisan migrate:fresh
php artisan db:seed

#run server(use two terminals)
npm run dev
php artisan serve