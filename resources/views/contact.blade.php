<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Anton Kovalenko | Laravel Backend Developer</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        *{
            font-family:'Inter',sans-serif;
        }

        html{
            scroll-behavior:smooth;
        }

        body{

            background:
                radial-gradient(circle at top left,#1d4ed8 0%,transparent 35%),
                radial-gradient(circle at bottom right,#0f766e 0%,transparent 35%),
                #020617;

            color:white;
        }

        .glass{

            background:rgba(15,23,42,.65);

            backdrop-filter:blur(18px);

            border:1px solid rgba(255,255,255,.08);

            box-shadow:
                0 10px 35px rgba(0,0,0,.45);

        }

        .gradient{

            background:linear-gradient(135deg,#06b6d4,#3b82f6);

        }

        .card{

            transition:.35s;
        }

        .card:hover{

            transform:translateY(-8px);

            border-color:#06b6d4;

        }

        input,
        textarea{

            transition:.25s;

        }

        input:focus,
        textarea:focus{

            outline:none;

            border-color:#06b6d4;

            box-shadow:0 0 0 3px rgba(6,182,212,.2);

        }

    </style>

</head>

<body>


<nav class="fixed w-full z-50 backdrop-blur-xl bg-slate-950/60 border-b border-slate-800">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-20">

            <div>

                <div class="font-bold text-2xl">

                    Anton Kovalenko

                </div>

                <div class="text-slate-400 text-sm">

                    Laravel Backend Developer

                </div>

            </div>

            <div class="h-20 flex items-center gap-4">

            <a
                    href="#me"
                    class="h-full flex items-center text-white-600 hover:text-indigo-600 transition">
                    Обо мне
                </a>

                <a
                    href="#about_prod"
                    class="h-full flex items-center text-white-600 hover:text-indigo-600 transition">
                    О проекте
                </a>

                <a
                    href="#skills"
                    class="h-full flex items-center text-white-600 hover:text-indigo-600 transition">
                    Навыки
                </a>

                <a
                    href="#contact"
                    class="h-full flex items-center text-white-600 hover:text-indigo-600 transition">
                    Связаться
                </a>

                <a href="/api/documentation"
                   target="_blank"
                   class="px-5 py-2 rounded-xl gradient font-semibold">
                    Swagger
                </a>

            </div>

        </div>

    </div>

</nav>



<section class="min-h-screen flex items-center" id="me">

    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">

        <div>

            <span class="text-cyan-400 uppercase tracking-[5px]">

                Laravel 12 • REST API • AI

            </span>

            <h1 class="text-6xl lg:text-7xl font-extrabold leading-tight mt-6">

                Backend
                <br>

                Developer

            </h1>

            <p class="mt-8 text-slate-300 text-xl leading-9">

                Создаю современные backend-приложения
                на Laravel с использованием
                DTO,
                Service Layer,
                Repository Pattern,
                OpenAPI,
                очередей,
                AI-интеграций
                и чистой архитектуры.

            </p>

            <div class="flex gap-5 mt-12">

                <a href="#contact"
                   class="gradient px-8 py-4 rounded-2xl font-semibold">

                    Связаться

                </a>

                <a href="/api/documentation"
                   target="_blank"
                   class="px-8 py-4 rounded-2xl border border-slate-700 hover:border-cyan-500 transition">

                    Swagger API

                </a>

            </div>

        </div>

        <div class="glass rounded-3xl p-10">

            <div class="grid grid-cols-2 gap-5">

                <div class="card glass rounded-2xl p-6">

                    <div class="text-cyan-400 text-4xl">

                        ⚙️

                    </div>

                    <h3 class="mt-4 font-bold text-xl">

                        REST API

                    </h3>

                    <p class="mt-2 text-slate-300">

                        Laravel 12
                        JSON API

                    </p>

                </div>

                <div class="card glass rounded-2xl p-6">

                    <div class="text-cyan-400 text-4xl">

                        🤖

                    </div>

                    <h3 class="mt-4 font-bold text-xl">

                        AI

                    </h3>

                    <p class="mt-2 text-slate-300">

                        Fallback AI /
                        OpenAI

                    </p>

                </div>

                <div class="card glass rounded-2xl p-6">

                    <div class="text-cyan-400 text-4xl">

                        📧

                    </div>

                    <h3 class="mt-4 font-bold text-xl">

                        SMTP

                    </h3>

                    <p class="mt-2 text-slate-300">

                        Gmail
                        Notifications

                    </p>

                </div>

                <div class="card glass rounded-2xl p-6">

                    <div class="text-cyan-400 text-4xl">

                        📖

                    </div>
                    <h3 class="mt-4 font-bold text-xl">
                        Swagger
                    </h3>
                    <p class="mt-2 text-slate-300">
                        OpenAPI 3
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="about_prod"
         class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-5xl font-bold text-center">
            О проекте
        </h2>
        <p class="text-center text-slate-300 mt-8 max-w-4xl mx-auto text-lg leading-9">
            Данный проект демонстрирует современный подход к разработке
            backend-приложений на Laravel.

            Архитектура разделена на DTO,
            Repository,
            Services,
            FormRequest,
            Middleware,
            OpenAPI документацию,
            SMTP уведомления,
            Rate Limiter,
            Feature Tests
            и AI-анализ обращений.
          </p>
    </div>
</section>
<section id="skills"
         class="pb-24">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-5xl font-bold text-center">
            Технологии
        </h2>

        <div class="grid md:grid-cols-4 gap-6 mt-16">

            <div class="glass rounded-2xl p-8 text-center">
                Laravel 12
            </div>

            <div class="glass rounded-2xl p-8 text-center">
                PHP 8.4
            </div>

            <div class="glass rounded-2xl p-8 text-center">
                MySQL
            </div>

            <div class="glass rounded-2xl p-8 text-center">
                REST API
            </div>

            <div class="glass rounded-2xl p-8 text-center">
                OpenAPI
            </div>

            <div class="glass rounded-2xl p-8 text-center">
                SMTP
            </div>

            <div class="glass rounded-2xl p-8 text-center">
                Fallback AI
            </div>

            <div class="glass rounded-2xl p-8 text-center">
                PHPUnit
            </div>

        </div>

    </div>

</section>
<section id="contact"
         class="pb-24">

    <div class="max-w-2xl mx-auto px-6">

        <div class="glass rounded-3xl p-10">

            <h2 class="text-4xl font-bold text-center">

                Обратная связь

            </h2>

            <p class="text-center text-slate-400 mt-4">

                Все поля обязательны для заполнения.

            </p>

            <form id="contactForm"
                  class="space-y-6 mt-10">
                                  <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Имя *
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            required
                            minlength="2"
                            maxlength="20"
                            autocomplete="name"
                            placeholder="Иван Иванов"
                            class="w-full text-black rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                        <p class="text-xs text-gray-500 mt-1">
                            От 2 до 20 символов.
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Email *
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            maxlength="255"
                            autocomplete="email"
                            placeholder="noname@example.com"
                            class="w-full text-black rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                        <p class="text-xs text-gray-500 mt-1">
                            Пример: ivan@example.com
                        </p>
                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Телефон *
                    </label>

                    <input
                        id="phone"
                        name="phone"
                        type="tel"
                        required
                        inputmode="numeric"
                        autocomplete="tel"
                        maxlength="16"
                        placeholder="+79991234567"
                        class="w-full text-black rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    <p class="text-xs text-gray-500 mt-1">
                        Только цифры и знак "+" в начале.
                        От 10 до 15 цифр.
                    </p>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Сообщение *
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        rows="6"
                        required
                        minlength="5"
                        maxlength="2000"
                        placeholder="Опишите ваш проект..."
                        class="w-full text-black rounded-xl border border-gray-300 px-4 py-3 resize-none focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>

                    <div class="flex justify-between mt-1">

                        <p class="text-xs text-gray-500">
                            Минимум 5 символов.
                        </p>

                        <span
                            id="counter"
                            class="text-xs text-gray-500">
                            0 / 2000
                        </span>

                    </div>

                </div>

                <div class="flex items-center gap-4">

                    <button
                        id="submitBtn"
                        class="bg-indigo-600 hover:bg-indigo-700 transition px-8 py-3 rounded-xl text-white font-semibold">

                        Отправить сообщение

                    </button>

                    <div
                        id="loader"
                        class="hidden flex items-center gap-3 text-indigo-600">

                        <svg
                            class="animate-spin h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none">

                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"></circle>

                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>

                        </svg>

                        <span>
                            Отправляем...
                        </span>

                    </div>

                </div>

            </form>

            <div
                id="result"
                class="hidden mt-8 rounded-xl p-5 text-white"></div>

        </div>

    </section>

</main>

<script>

const form = document.getElementById('contactForm');

const loader = document.getElementById('loader');

const result = document.getElementById('result');

const button = document.getElementById('submitBtn');

const phone = document.getElementById('phone');

const message = document.getElementById('message');

const counter = document.getElementById('counter');

message.addEventListener('input', () => {

    counter.innerText = `${message.value.length} / 2000`;

});

phone.addEventListener('input', () => {

    let value = phone.value;

    value = value.replace(/[^\d+]/g, '');

    if (value.indexOf('+') > 0) {
        value = value.replace(/\+/g, '');
    }

    if (value.startsWith('++')) {
        value = '+' + value.replace(/\+/g, '');
    }

    phone.value = value;

});
form.addEventListener('submit', async (e) => {

    e.preventDefault();

    result.classList.add('hidden');
    result.className = 'hidden mt-8 rounded-xl p-5 text-white';

    button.disabled = true;
    button.classList.add('opacity-60', 'cursor-not-allowed');

    loader.classList.remove('hidden');

    const payload = {
        name: document.getElementById('name').value.trim(),
        email: document.getElementById('email').value.trim(),
        phone: document.getElementById('phone').value.trim(),
        message: document.getElementById('message').value.trim()
    };

    try {

        const response = await fetch('/api/contact', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },

            body: JSON.stringify(payload)

        });

        const data = await response.json();

        if (response.ok) {

            result.classList.remove('hidden');

            result.classList.add(
                'bg-green-600',
                'animate-pulse'
            );

            result.innerHTML = `
                <div class="font-bold text-lg mb-2">
                    ✅ Сообщение успешно отправлено
                </div>

                <div>
                    ${data.message}
                </div>

                <div class="mt-3 text-sm opacity-90">
                    ID обращения:
                    <strong>${data.data.uuid}</strong>
                </div>
            `;

            form.reset();

            counter.innerText = '0 / 2000';

        } else {

            let html = '';

            if (data.errors) {

                html += '<ul class="list-disc ml-5 space-y-1">';

                Object.values(data.errors).forEach(items => {

                    items.forEach(item => {

                        html += `<li>${item}</li>`;

                    });

                });

                html += '</ul>';

            } else {

                html = data.message ?? 'Произошла ошибка.';

            }

            result.classList.remove('hidden');

            result.classList.add('bg-red-600');

            result.innerHTML = `
                <div class="font-bold mb-2">
                    ❌ Ошибка
                </div>

                ${html}
            `;

        }

    } catch (e) {

        result.classList.remove('hidden');

        result.classList.add('bg-red-600');

        result.innerHTML = `
            <div class="font-bold mb-2">
                ❌ Ошибка соединения
            </div>

            Не удалось подключиться к серверу.
        `;

    } finally {

        loader.classList.add('hidden');

        button.disabled = false;

        button.classList.remove(
            'opacity-60',
            'cursor-not-allowed'
        );

        window.scrollTo({

            top: document.body.scrollHeight,

            behavior: 'smooth'

        });

    }

});

</script>

</body>
</html>