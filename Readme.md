# 🛡️ XenforoSecureImg

**XenforoSecureImg** is a plugin for Xenforo that hides images from untrusted sources, blocking potential threats like IP loggers and malicious scripts that could exploit cookies or execute unauthorized code.

> 🔐 

---

## ✨ Features

- 🖼️ Hides images from untrusted sources, replacing them with a link: **"Image from untrusted source"**
- ✅ Supports a whitelist using Xenforo's **Media BB Code** system
- ⚙️ Simple installation and configuration via the Xenforo Admin Panel

---

## 📦 Installation

Follow these steps to install **XenforoSecureImg** on your Xenforo forum:

### 1. 🔽 Download the Plugin

[📥 Download SecureImg.zip](https://github.com/1Volk/XenforoSecureImg/releases/download/1.0.1/SecureImg.zip)  
🔗 Or visit the [Releases page](https://github.com/1Volk/XenforoSecureImg/releases) to find the latest version.

### 2. 📁 Upload to Your Server

- Extract the downloaded ZIP file if necessary.
- Upload the contents of the `XenforoSecureImg` folder to the `src/addons/` directory in your Xenforo installation using an FTP client (e.g., FileZilla) or your hosting file manager.

### 3. ⚙️ Install the Add-on

- Log in to your Xenforo Admin Control Panel.
- Go to `Add-ons` in the left sidebar.
- Find `XenforoSecureImg` in the list of available add-ons and click `Install`.
- After installation, the plugin will automatically start hiding images from untrusted sources and blocking potential threats.

---

## 🛠️ How the Whitelist Works

The plugin uses Xenforo's built-in **Media BB Code** system to maintain a list of trusted domains. Images from these trusted domains will be displayed normally, while all other images will be hidden and replaced with a placeholder link:  
**"Image from untrusted source."**

### Adding a New Trusted Source

To add a new trusted source to the whitelist, follow these steps:

1. **Go to Media Site Settings**
   - In the Xenforo Admin Control Panel, navigate to `Content` → `BB code media sites`.

2. **Add a New Media Site**
   - Click the `Add media site` button.
   - Fill out the following fields:
     - **Media site ID**: A unique identifier (e.g., `imgur`).
     - **Site title**: A descriptive name (e.g., `Imgur`).
     - **Site URL**: The base URL (e.g., `https://imgur.com`). This applies to all subdomains (e.g., `https://i.imgur.com`, `https://imgur.com/gallery`).
     - **Embed HTML**: You can enter any placeholder text here; it will not affect the image display functionality.

3. **Save Changes**
   - Click `Save` to add the site to the whitelist.
   - Now, images from this site will be displayed on your forum.

---
