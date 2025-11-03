# استخدم صورة PHP الرسمية من Docker Hub
FROM php:8.2

# انسخ ملفات المشروع إلى السيرفر داخل المجلد /var/www/html
COPY . /var/www/html

# حدد مجلد العمل الرئيسي
WORKDIR /var/www/html

# افتح المنفذ 10000 (اللي يستخدمه Render)
EXPOSE 10000

# شغّل خادم PHP الداخلي
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]