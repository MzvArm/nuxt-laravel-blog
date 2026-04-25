<template>
  <header class="blog-header">
    <div class="brand">
      <NuxtLink to="/posts" class="brand-title">bash.today</NuxtLink>
      <p class="brand-subtitle">Блог об ивентах, местах и кейсах</p>
    </div>

    <nav class="nav-links">
      <NuxtLink to="/posts" class="nav-link">
        <UButton variant="ghost" size="sm" color="neutral" class="u-button"
          >Главная</UButton
        >
      </NuxtLink>
      <NuxtLink to="/posts" class="nav-link">
        <UButton variant="ghost" size="sm" color="warning" class="u-button"
          >Посты</UButton
        >
      </NuxtLink>
      <NuxtLink to="/posts" class="nav-link">
        <UButton variant="ghost" size="sm" color="neutral" class="u-button"
          >Авторы</UButton
        >
      </NuxtLink>
      <NuxtLink to="/posts" class="nav-link">
        <UButton variant="ghost" size="sm" color="neutral" class="u-button"
          >Контакты</UButton
        >
      </NuxtLink>
    </nav>
  </header>
</template>

<script setup lang="ts"></script>

<style scoped>
.blog-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
  padding: 1.25rem 1rem;
  border-radius: 32px;
  background: rgba(255, 255, 255, 0.86);
  box-shadow: 0 14px 35px rgba(37, 45, 61, 0.08);
  margin-bottom: 2rem;
  backdrop-filter: blur(12px);
}

.brand {
  display: flex;
  flex-direction: column;
  gap: 0.2rem;
}

.brand-title {
  font-size: 1.55rem;
  font-weight: 800;
  color: var(--text);
  text-decoration: none;
}

.brand-subtitle {
  margin: 0;
  color: var(--muted);
  font-size: 0.95rem;
}

.nav-links {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
  align-items: center;
}

.nav-link {
  display: inline-flex;
}

.nav-link :deep(button) {
  color: var(--text);
}

.nav-link:nth-child(2) :deep(button) {
  color: var(--accent);
}
</style>
