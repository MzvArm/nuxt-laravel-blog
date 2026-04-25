<template>
  <footer class="site-footer">
    <div class="footer-grid">
      <div>
        <NuxtLink to="/posts" class="footer-logo">bash.today</NuxtLink>
        <p>Блог о мероприятиях, площадках и сервисах для праздников.</p>
      </div>

      <div>
        <p class="footer-title">Разделы</p>
        <ul>
          <li><a href="#">Посты</a></li>
          <li><a href="#">Авторы</a></li>
          <li><a href="#">Категории</a></li>
          <li><a href="#">Контакты</a></li>
        </ul>
      </div>

      <div>
        <p class="footer-title">Блог</p>
        <ul>
          <li><a href="#">Свадьба</a></li>
          <li><a href="#">Кейтеринг</a></li>
          <li><a href="#">День рождения</a></li>
          <li><a href="#">Рестораны</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-note">
      © 2026 bash.today · Все права защищены
    </div>
  </footer>
</template>

<script setup lang="ts"></script>

<style scoped>
.site-footer {
  margin-top: 3rem;
  padding: 2rem 1.5rem 1.25rem;
  border-top: 1px solid rgba(113, 113, 122, 0.14);
  color: var(--muted);
  background: rgba(255, 255, 255, 0.9);
  border-radius: 32px;
  box-shadow: 0 18px 40px rgba(37, 45, 61, 0.06);
}

.footer-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 2rem;
}

.footer-logo {
  display: block;
  font-weight: 800;
  font-size: 1.25rem;
  color: var(--text);
  text-decoration: none;
  margin-bottom: 0.75rem;
}

.footer-title {
  margin: 0 0 0.75rem;
  font-weight: 700;
  color: var(--text);
}

.footer-grid ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: grid;
  gap: 0.7rem;
}

.footer-grid a {
  color: var(--muted);
  text-decoration: none;
  transition: color 0.2s ease;
}

.footer-grid a:hover {
  color: var(--accent);
}

.footer-note {
  margin-top: 2rem;
  text-align: center;
  font-size: 0.95rem;
}

@media (max-width: 900px) {
  .footer-grid {
    grid-template-columns: 1fr;
  }
}
</style>