# WP Ajax Search

## توضیحات (فارسی)

افزونه وردپرس **WP Ajax Search** به شما اجازه می‌دهد تا به سادگی امکان جستجوی سریع و زنده (Ajax) در محتوای سایت خود ایجاد کنید. این افزونه ماژولار بوده و قابلیت استفاده آسان از طریق شورت‌کد یا کد PHP در قالب را دارد.

### امکانات

* جستجوی سریع Ajax بدون بارگذاری مجدد صفحه
* امکان جستجو بر اساس عنوان یا جستجوی عمیق‌تر در محتوای پست‌ها
* رابط کاربری ساده و قابل سفارشی‌سازی
* ماژولار و قابل توسعه

### نحوه نصب

1. پوشه `wp-ajax-search` را در مسیر `/wp-content/plugins/` آپلود کنید.
2. افزونه را از طریق بخش مدیریت وردپرس فعال نمایید.
3. از شورت‌کد `[wp_ajax_search]` در نوشته‌ها و برگه‌ها استفاده کنید.

### نحوه استفاده

#### با شورت‌کد:

```php
[wp_ajax_search placeholder="جستجوی مطالب..."]
```

#### با کد PHP در قالب:

```php
<?php echo do_shortcode('[wp_ajax_search]'); ?>
```

### پشتیبانی

در صورت بروز مشکل یا داشتن پیشنهاد، از بخش Issues در گیت‌هاب استفاده کنید.

## Description (English)

**WP Ajax Search** is a WordPress plugin allowing easy integration of live (Ajax-based) search functionality on your website. The plugin is modular and can be easily embedded via shortcode or PHP code directly into your theme.

### Features

* Fast Ajax search without page reload
* Search by title or perform deeper searches within post content
* Simple and customizable user interface
* Modular and extendable

### Installation

1. Upload the `wp-ajax-search` folder to `/wp-content/plugins/`
2. Activate the plugin through the WordPress admin panel
3. Use shortcode `[wp_ajax_search]` in your posts and pages.

### Usage

#### With Shortcode:

```php
[wp_ajax_search placeholder="Search posts..."]
```

#### With PHP code in your theme:

```php
<?php echo do_shortcode('[wp_ajax_search]'); ?>
```

### Support

If you encounter any issues or have suggestions, please use the Issues section on GitHub.
