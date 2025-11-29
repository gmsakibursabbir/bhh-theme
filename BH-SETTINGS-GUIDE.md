
#  BH Theme Settings - User Guide

  

**Version:** 1.2.0

**Last Updated:** November 2025

  

---

  

## Table of Contents

  

1.  [Introduction](#introduction)

2.  [Accessing BH Settings](#accessing-bh-settings)

3.  [Understanding the Interface](#understanding-the-interface)

4.  [General Settings](#general-settings)

5.  [Page Settings](#page-settings)

6.  [Field Types](#field-types)

7.  [Adding and Managing Fields](#adding-and-managing-fields)

8.  [Using Generated PHP Code](#using-generated-php-code)

9.  [Import & Export](#import--export)

10.  [Troubleshooting](#troubleshooting)

  

---

  

## Introduction

  

BH Theme Settings is a powerful, ACF-like settings management system built specifically for the Business Hub theme. It allows you to:

  

- ✅ Manage global site settings (logo, favicon)

- ✅ Create custom fields for different page templates

- ✅ Generate PHP code snippets automatically

- ✅ Import/Export settings for backup or migration

- ✅ No coding required for basic content management

  

---

  

## Accessing BH Settings

  

###  Step 1: Log into WordPress Admin

  

Navigate to your WordPress admin dashboard.

  

**![\[SCREENSHOT: WordPress admin login page\]](https://i.ibb.co.com/MD1ns90n/image.png)**

  

###  Step 2: Locate BH Settings

  

In the left sidebar, look for **"BH Settings"** with a gear icon.

  

**[SCREENSHOT: WordPress sidebar showing BH Settings menu item]**

  

###  Step 3: Open Settings Page

  

Click on **"BH Settings"** to access the settings interface.

  

**![\[SCREENSHOT: BH Settings page overview\]](https://i.ibb.co.com/WvN8Q8nL/image.png)**

  

---

  

## Understanding the Interface

  

The BH Settings page is divided into **three main tabs**:

  

###  1. General Tab

  

- Manage site-wide settings

- Logo and Favicon uploads

- Fixed fields (cannot be deleted)

  

**![\[SCREENSHOT: General tab showing logo and favicon fields\]](https://i.ibb.co.com/zV3LN1fV/image.png)**

  

###  2. Pages Tab

  

- Create custom fields for specific page templates

- Select template from dropdown

- Add, edit, and remove fields dynamically

  

**![\[SCREENSHOT: Pages tab with template selector\]](https://i.ibb.co.com/dwpvs5V6/image.png)**

  

###  3. Tools Tab

  

- Export current settings to JSON

- Import settings from JSON file or text

- Backup and restore functionality

  

**![\[SCREENSHOT: Tools tab showing export/import options\]](https://i.ibb.co.com/F4MK076c/image.png)**

  

---

  

## General Settings

  

General settings apply **site-wide** and include:

  

###  Site Logo

  

-  **Purpose:** Display your logo in the header

-  **Field Type:** Image

-  **Recommended Size:** 288px × auto (maintains aspect ratio)

  

**How to Upload:**

  

1. Click **"Upload Image"** button

2. Select image from Media Library or upload new

3. Image preview appears below

4. Click **"Save Changes"**

  

**![\[SCREENSHOT: Logo upload process\]](https://i.ibb.co.com/W4SZfKXT/image.png)**

  

###  Site Favicon

  

-  **Purpose:** Browser tab icon

-  **Field Type:** Image

-  **Recommended Size:** 32px × 32px or 64px × 64px (square)

-  **Format:** PNG or ICO

  

**![\[SCREENSHOT: Favicon upload process\]](https://i.ibb.co.com/LD4G9xsv/image.png)**

  

---

  

## Page Settings

  

Page Settings allow you to create custom content fields for **specific page templates**.

  

###  Available Templates

  

The system includes two special templates by default:

  

1.  **🏠 Front Page (Home)** - Your homepage template

2.  **📱 Business Mobile Page** - Business mobile services page

  

**![\[SCREENSHOT: Template selector dropdown\]](https://i.ibb.co.com/wqVHZ1T/image.png)**

  

###  Selecting a Template

  

1. Go to **Pages** tab

2. Click **"Select Template"** dropdown

3. Choose the template you want to edit

4. Fields for that template will appear below

  

**![\[SCREENSHOT: Template selection process\]](https://i.ibb.co.com/mrf1T5zz/image.png)**

  

---

  

## Field Types

  

BH Settings supports **8 different field types** to handle various content:

  

###  1. Text

  

-  **Use Case:** Short text content (headings, names, labels)

-  **Example:** "Section Title", "Button Text"

-  **Output:** Plain text

  

**![\[SCREENSHOT: Text field example\]](https://i.ibb.co.com/KcdLCBC8/image.png)**

  

###  2. Textarea

  

-  **Use Case:** Longer text content (paragraphs, descriptions)

-  **Example:** "About Us Description", "Service Details"

-  **Output:** Multi-line text

  

**![\[SCREENSHOT: Textarea field example\]](https://i.ibb.co.com/hRNMW5Tq/image.png)**

  

###  3. Image

  

-  **Use Case:** Photos, graphics, backgrounds

-  **Example:** "Hero Image", "Service Icon"

-  **Output:** Image URL

-  **Features:** Media library integration, preview

  

**![\[SCREENSHOT: Image field with preview\]](https://i.ibb.co.com/TBr7P5v2/image.png)**

  

###  4. URL

  

-  **Use Case:** Links, external resources

-  **Example:** "Button Link", "Read More URL"

-  **Output:** Valid URL with validation

  

**![\[SCREENSHOT: URL field example\]](https://i.ibb.co.com/xqrWffwY/image.png)**
---

  

## Adding and Managing Fields

  

###  Adding a New Field

  

**Step 1:** Select a template from the dropdown

  

**Step 2:** Click **"+ Add Field"** button

  

**![\[SCREENSHOT: Add Field button location\]](https://i.ibb.co.com/ym292syq/image.png)**

  

**Step 3:** Configure the field:

  

-  **Field Name (ID):** Unique identifier (auto-generated from label)

  

- Use lowercase, underscores only

- Example: `hero_title_1`, `service_description`

  

-  **Label:** Human-readable name shown in admin

  

- Example: "Hero Title", "Service Description"

  

-  **Type:** Select the appropriate field type from dropdown

  

-  **Value:** Enter the actual content/data

  

**![\[SCREENSHOT: Field configuration interface\]](https://i.ibb.co.com/r2T2j0tM/image.png)**

  

**Step 4:** Click **"Save Changes"** to save

  

###  Auto-Generated Field Names

  

The system automatically creates field names from labels:

  

| Label Example | Auto-Generated Name |

|  -------------------  |  ---------------------  |

| Hero Title 1 |  `hero_title_1`  |

| Service Description |  `service_description`  |

| About Us - Image |  `about_us_image`  |

  

**![\[SCREENSHOT: Auto-generation in action\]](https://i.ibb.co.com/m5QBdhrZ/image.png)**

  

###  Editing Existing Fields

  

1. Click on any field to select it

2. Modify name, label, type, or value

3. Changes save automatically on blur

4. Click **"Save Changes"** to persist

  

**![\[SCREENSHOT: Editing a field\]](https://i.ibb.co.com/sdgndNZ1/image.png)**

  

###  Duplicating Fields

  

Useful for creating similar fields quickly:

  

1. Click the **duplicate icon** (📄) on the field

2. A copy appears below with `_copy` suffix

3. Edit the duplicate as needed

  

**![\[SCREENSHOT: Duplicate button and result\]](https://i.ibb.co.com/Q0zRX5L/image.png)**

  

###  Removing Fields

  

1. Click the **trash icon** (🗑️) on the field

2. Confirm deletion in popup dialog

3. Field is permanently removed

4. Click **"Save Changes"**

  

**![\[SCREENSHOT: Delete confirmation dialog\]](https://i.ibb.co.com/WNYhYKcN/image.png)**

  

###  Reordering Fields

  

Drag and drop to reorder:

  

1. Click and hold the **drag handle** (☰) icon

2. Drag field to desired position

3. Release to drop

4. Order is saved automatically

  

**![\[SCREENSHOT: Drag and drop in action\]](https://i.ibb.co.com/4Rf7k9Cq/image.png)**

  

---

  

## Using Generated PHP Code

  

The **Code Preview Panel** (right side) automatically generates PHP code for your fields.

  

**![\[SCREENSHOT: Code preview panel overview\]](https://i.ibb.co.com/76sk3Gb/image.png)**

  

###  Code View Modes

  

**1. All Fields (Default)**

  

- Shows code for all fields in selected template

- Copy entire block to template file

  

**2. Selected Field**

  

- Shows code for currently selected field only

- Useful for copying individual snippets

  

**![\[SCREENSHOT: Code view mode toggle\]](https://i.ibb.co.com/CKR3zM6s/image.png)**

  

###  Generated Code Structure

  

```php

<?php

// Get settings

$settings = get_option('bh_theme_settings');

$fields = isset($settings['front-page']) ? $settings['front-page'] : [];

  

// --- Field: Hero Title (hero_title_1) ---

$val = '';

foreach  ($fields  as  $f)  {

if  ($f['name'] === 'hero_title_1')  {

$val = $f['value'];

break;

}

}

if  ($val)  {

echo wp_kses_post($val);

}

?>

```

  

###  How to Use Generated Code

  

**Step 1:** Select the template you're working on

  

**Step 2:** Copy the generated code:

  

- Click **"Copy Code"** button

- Or manually select and copy

  

**![\[SCREENSHOT: Copy code button\]](https://i.ibb.co.com/WNDctVqx/image.png)**

  

**Step 3:** Open your template file (e.g., `front-page.php`)

  

**Step 4:** Paste the code where you want the content to appear

  

**Example Usage:**

  

```php

<h1>

<?php

// Get settings

$settings = get_option('bh_theme_settings');

$fields = isset($settings['front-page']) ? $settings['front-page'] : [];

  

// --- Field: Hero Title (hero_title_1) ---

$val = '';

foreach  ($fields  as  $f)  {

if  ($f['name'] === 'hero_title_1')  {

$val = $f['value'];

break;

}

}

if  ($val)  {

echo wp_kses_post($val);

}

?>

</h1>

```

  

**![\[SCREENSHOT: Code pasted in template file\]](https://i.ibb.co.com/6c9dH1dX/image.png)**

  

###  Output Functions by Field Type

  

Different field types use different output functions:

  

| Field Type | Output Function | Purpose |

|  --------------  |  ----------------  |  ------------------  |

| Text, Textarea |  `wp_kses_post()`  | Sanitized HTML |

| Image, URL |  `esc_url()`  | Sanitized URL |

| Toggle, Number | Direct output | No escaping needed |

  

---

  

## Import & Export

  

###  Exporting Settings

  

**Purpose:** Create a backup or transfer settings to another site

  

**Step 1:** Go to **Tools** tab

  

**Step 2:** Click **"Export JSON"** button

  

**![\[SCREENSHOT: Export button in Tools tab\]](https://i.ibb.co.com/5h1Q1Vxm/image.png)**

  

**Step 3:** A JSON file downloads automatically

  

- Filename: `bh_theme_settings.json`

- Contains all your settings

  

**![\[SCREENSHOT: Downloaded JSON file\]](https://i.ibb.co.com/ycTpYgzF/image.png)**

  

###  Importing Settings

  

**Purpose:** Restore backup or import from another site

  

**Method 1: File Upload**

  

1. Go to **Tools** tab

2. Scroll to **"Import Settings"** section

3. Click **"Choose File"**

4. Select your JSON file

5. Click **"Import Settings"**

6. Page reloads automatically with imported data

  

**![\[SCREENSHOT: File upload import process\]](https://i.ibb.co.com/03w6qpY/image.png)**

  

**Method 2: Paste JSON**

  

1. Go to **Tools** tab

2. Scroll to **"Import Settings"** section

3. Paste JSON content in textarea

4. Click **"Import Settings"**

5. Page reloads automatically

  

**![\[SCREENSHOT: Paste JSON import process\]](https://i.ibb.co.com/XxMnpVXT/image.png)**

  

###  ⚠️ Important Import Notes

  

-  **Existing data will be overwritten** - Export first!

-  **Page reloads automatically** after 1.5 seconds

-  **No need to click "Save Changes"** - data saves immediately

-  **Check imported fields** in admin to verify

  

  

---

  

## Troubleshooting

  

###  Issue: Fields Not Showing on Live Site

  

**Possible Causes & Solutions:**

  

1.  **Forgot to Save Changes**

  

- Solution: Always click **"Save Changes"** after editing

  

2.  **PHP Code Not Copied Correctly**

  

- Solution: Use **"Copy Code"** button to avoid errors

- Check for typos in field names

  

3.  **Wrong Template Selected**

  

- Solution: Verify you're editing the correct template

- Check `isset($settings['front-page'])` matches your template

  

4.  **Field Name Mismatch**

- Solution: Field name in code must exactly match field name in admin

- Check for spaces, capitals, or special characters

  


  

###  Issue: Import Doesn't Update Fields

  

**Solution:**

  

- Ensure you're importing valid JSON (check format)

- Wait for automatic page reload (1.5 seconds)

- If still not working, clear browser cache

  

###  Issue: Cannot Upload Images

  

**Solution:**

  

- Check file size limits in WordPress settings

- Ensure image formats are supported (JPG, PNG, GIF, SVG)

- Verify file permissions on `/wp-content/uploads/`

  

###  Issue: Generated Code Doesn't Work

  

**Solution:**

  

- Verify you're using the code in the correct template file

The **Code Preview Panel** (right side) automatically generates PHP code for your fields.

  


  

###  Code View Modes

  

**1. All Fields (Default)**

  

- Shows code for all fields in selected template

- Copy entire block to template file

  

**2. Selected Field**

  

- Shows code for currently selected field only

- Useful for copying individual snippets

  



  

###  Generated Code Structure

  

```php

<?php

// Get settings

$settings = get_option('bh_theme_settings');

$fields = isset($settings['front-page']) ? $settings['front-page'] : [];

  

// --- Field: Hero Title (hero_title_1) ---

$val = '';

foreach  ($fields  as  $f)  {

if  ($f['name'] === 'hero_title_1')  {

$val = $f['value'];

break;

}

}

if  ($val)  {

echo wp_kses_post($val);

}

?>

```

  

###  How to Use Generated Code

  

**Step 1:** Select the template you're working on

  

**Step 2:** Copy the generated code:

  

- Click **"Copy Code"** button

- Or manually select and copy

  

**![\[SCREENSHOT: Copy code button\]](https://i.ibb.co.com/6c9dH1dX/image.png)**

  

**Step 3:** Open your template file (e.g., `front-page.php`)

  

**Step 4:** Paste the code where you want the content to appear

  

**Example Usage:**

  

```php

<h1>

<?php

// Get settings

$settings = get_option('bh_theme_settings');

$fields = isset($settings['front-page']) ? $settings['front-page'] : [];

  

// --- Field: Hero Title (hero_title_1) ---

$val = '';

foreach  ($fields  as  $f)  {

if  ($f['name'] === 'hero_title_1')  {

$val = $f['value'];

break;

}

}

if  ($val)  {

echo wp_kses_post($val);

}

?>

</h1>

```

  

**![\[SCREENSHOT: Code pasted in template file\]](https://i.ibb.co.com/6c9dH1dX/image.png)**

  

###  Output Functions by Field Type

  

Different field types use different output functions:

  

| Field Type | Output Function | Purpose |

|  --------------  |  ----------------  |  ------------------  |

| Text, Textarea |  `wp_kses_post()`  | Sanitized HTML |

| Image, URL |  `esc_url()`  | Sanitized URL |

| Toggle, Number | Direct output | No escaping needed |

  

---

  

## Import & Export

  

###  Exporting Settings

  

**Purpose:** Create a backup or transfer settings to another site

  

**Step 1:** Go to **Tools** tab

  

**Step 2:** Click **"Export JSON"** button

  



  

**Step 3:** A JSON file downloads automatically

  

- Filename: `bh_theme_settings.json`

- Contains all your settings

  



  

###  Importing Settings

  

**Purpose:** Restore backup or import from another site

  

**Method 1: File Upload**

  

1. Go to **Tools** tab

2. Scroll to **"Import Settings"** section

3. Click **"Choose File"**

4. Select your JSON file

5. Click **"Import Settings"**

6. Page reloads automatically with imported data

  


  

**Method 2: Paste JSON**

  

1. Go to **Tools** tab

2. Scroll to **"Import Settings"** section

3. Paste JSON content in textarea

4. Click **"Import Settings"**

5. Page reloads automatically

  


  

###  ⚠️ Important Import Notes

  

-  **Existing data will be overwritten** - Export first!

-  **Page reloads automatically** after 1.5 seconds

-  **No need to click "Save Changes"** - data saves immediately

-  **Check imported fields** in admin to verify

  


  


  

---

  

## Quote Form

  

The theme includes a powerful multi-step quote form for capturing business leads.

  

###  How to Use

  

The quote form is implemented as a shortcode and can be placed on any page.

  

**Shortcode:**  `[quote_form]`

  


  

###  Configuration

  

-  **Email Recipient:** The form sends emails to `info@thebusinesshub.co.uk` (configurable in `functions.php`).

-  **Redirect:** After successful submission, users are redirected to `/thank-you`.

-  **Styling:** The form uses a React-based multi-step interface with Tailwind CSS.

  

---

  

## Newsletter Signup

  

A built-in newsletter signup handler is available for capturing email subscribers.

  

###  How to Use

  

The newsletter form is typically located in the footer or dedicated sections.

  

**Form Action:** Points to `admin-post.php` with action `bh_newsletter_signup`.

  

  

###  Configuration

  

-  **Email Recipient:** Notifications are sent to `info@thebusinesshub.co.uk`.

-  **Fields:** First Name, Last Name, Email, Note.

-  **Redirect:** Redirects back to the referring page with a success/error query parameter.

  

---

  

## Customizer Settings

  

In addition to the BH Settings page, some standard theme options are managed via the WordPress Customizer.

  

**Accessing Customizer:**

  

1. Go to **Appearance** → **Customize**

2. Use standard WordPress controls for Site Identity (Title, Tagline).

  

  

---

  

## Best Practices

  

###  Naming Conventions

  

✅ **Good Field Names:**

  

-  `hero_title_1`

-  `service_card_image`

-  `about_us_description`

  

❌ **Bad Field Names:**

  

-  `Title 1` (spaces)

-  `Service-Image` (hyphens)

-  `AboutUs` (capital letters)

  

###  Organization Tips

  

1.  **Use Descriptive Labels**

  

- Instead of "Image 1", use "Hero Background Image"

  

2.  **Group Related Fields**

  

- Use drag-and-drop to keep related fields together

- Example: Keep all "Service Card 1" fields together

  

3.  **Regular Backups**

  

- Export settings weekly or before major changes

- Keep exports in a safe location

  

4.  **Test After Import**

  

- Always check the live site after importing

- Verify critical fields (logo, contact info)

  

5.  **Field Naming Pattern**

- Use consistent patterns: `section_element_number`

- Example: `hero_title_1`, `hero_image_1`, `hero_button_1`

  


  

---

  

## Need Help?

  

If you encounter issues not covered in this guide:

  

1.  **Check the field configuration** - Ensure field types are correct

2.  **Verify PHP code** - Look for syntax errors

3.  **Export and inspect JSON** - Check data structure

4.  **Clear caches** - Browser and WordPress caches

5.  **Contact Support** - Provide screenshots and error messages

  

---

  

**End of Guide**

  

_This documentation is for BH Theme Settings v1.2.0. For updates and additional resources, contact your theme developer._