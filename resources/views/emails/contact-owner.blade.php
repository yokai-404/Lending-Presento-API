<h2>Новое обращение с сайта</h2>

<p><strong>Имя:</strong> {{ $contact->name }}</p>

<p><strong>Email:</strong> {{ $contact->email }}</p>

<p><strong>Телефон:</strong> {{ $contact->phone }}</p>

<p><strong>Комментарий:</strong></p>

<p>{{ $contact->message }}</p>

<hr>

<h3>AI-анализ</h3>

<p><strong>Тональность:</strong> {{ $contact->sentiment }}</p>

<p><strong>Категория:</strong> {{ $contact->category }}</p>

<p><strong>AI-ответ:</strong></p>

<p>{{ $contact->ai_reply }}</p>

<hr>

<p>
    Отправлено:
    {{ $contact->created_at->format('d.m.Y H:i:s') }}
</p>