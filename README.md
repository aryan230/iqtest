# IQTestGlobal Staging

## Overview
This repository contains the custom build for the **Home**, **Test**, **Result**, **About**, and **Contact** pages of the staging environment for **[staging.iqtestglobal.org](https://staging.iqtestglobal.org)**.

## Pages Implemented
- **Home Page (`tpl-home.php`)**: Custom-designed landing page with improved UI/UX.
- **Test Page (`tpl-test.php`)**: Customized test interface optimized for performance and usability.
- **Result Page (`tpl-result.php`)**: Displays user scores and results dynamically.
- **About Page (`tpl-about.php`)**: Provides information about the platform and its purpose.
- **Contact Page (`tpl-contact.php`)**: Allows users to get in touch with support or inquiries.

## Features
- **Custom Build**: Optimized front-end for better speed and user experience.
- **Staging Deployment**: Hosted on `staging.iqtestglobal.org` for testing.
- **Performance Enhancements**: Implemented caching and script optimizations.
- **Payment Gateway Integration**: Secure payment handling for premium IQ test results.
- **Custom PHP & CSS**: Developed using optimized PHP and CSS for better maintainability and performance.
- **Dynamic Testimonials**: Integrated a dynamic testimonial section to showcase user feedback.
- **WooCommerce Integration**: Implemented WooCommerce for handling transactions and premium content sales.

## Image Optimization
- Used **WebP format** for faster loading times.
- Implemented **lazy loading** for images to reduce initial page load.
- Optimized image sizes using **lossless compression**.
- Served images via **CDN** for better performance globally.
- Integrated **Smush Image Optimization** for automatic image compression and resizing.

## How to Remove Excessive White Space in WordPress
### Common Causes:
- Extra **CSS margins/padding**.
- Unnecessary **empty elements** in the theme.
- **Auto-generated `<p>` tags** from WordPress filters.

### Solutions:
#### CSS:
```css
body, p, h1, h2, h3, div {
    margin: 0 !important;
    padding: 0 !important;
}
```

#### PHP:
```php
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
```

---



