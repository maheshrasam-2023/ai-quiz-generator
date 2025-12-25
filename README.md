# AI Quiz Generator (Laravel)

An AI-powered multiple-choice quiz generator built with Laravel.  
The application generates quizzes based on a topic using the Gemini API.

---

## Features

- Generate MCQs dynamically based on topic
- AI-powered question generation (Gemini API)
- Graceful fallback when AI quota is exceeded
- Required questions (no partial submission)
- Score calculation with explanations
- Clean MVC architecture (SOLID principles)

---

## Tech Stack

- Laravel 10+
- PHP 8+
- Gemini API
- Wikipedia context injection
- Blade templates

---

## Setup Instructions

```bash
git clone https://github.com/YOUR_USERNAME/ai-quiz-generator.git
cd ai-quiz-generator
composer install
cp .env.example .env
php artisan serve
