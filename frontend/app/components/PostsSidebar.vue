<template>
  <aside class="posts-sidebar">
    <UCard class="sidebar-card" radius="xxl" border>
      <p class="sidebar-title">Категории</p>
      <ul class="sidebar-list">
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">Все</UButton></li>
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">Места в Москве</UButton></li>
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">День рождения</UButton></li>
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">Кейтеринг</UButton></li>
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">Свадьба</UButton></li>
      </ul>
    </UCard>

    <UCard class="sidebar-card" radius="xxl" border>
      <p class="sidebar-title">Блоги авторов</p>
      <ul class="sidebar-list">
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">Bash Today</UButton></li>
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">B-Style</UButton></li>
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">С дзеном по кухне</UButton></li>
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">Все авторы</UButton></li>
      </ul>
    </UCard>

    <UCard class="sidebar-card" radius="xxl" border>
      <p class="sidebar-title">Популярное</p>
      <ul class="sidebar-list compact">
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">ТОП-25 кейтеринговых компаний</UButton></li>
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">Лазертаг в Москве — топ-20</UButton></li>
        <li><UButton variant="ghost" size="sm" color="neutral" class="u-button">Лучшие места для выпускного</UButton></li>
      </ul>
    </UCard>
  </aside>
</template>

<script setup lang="ts"></script>

<style scoped>
.posts-sidebar {
  /* display: grid; */
  gap: 1.5rem;
}

.sidebar-card {
  padding: 1.5rem;
  border-radius: 32px;
}

.sidebar-title {
  margin: 0 0 1rem;
  color: var(--text);
  font-weight: 700;
}

.sidebar-list {
  list-style: none;
  margin: 0;
  padding: 0;
  display: grid;
  gap: 0.75rem;
}

.sidebar-list li {
  display: block;
}

.sidebar-list :deep(button) {
  justify-content: flex-start;
  width: 100%;
  text-align: left;
  color: var(--muted);
}

.sidebar-list :deep(button):hover {
  color: var(--accent);
}
</style>
