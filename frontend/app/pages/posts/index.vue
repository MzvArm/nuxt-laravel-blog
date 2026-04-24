<script setup lang="ts">
import Header from '../../components/Header.vue'
import Footer from '../../components/Footer.vue'
import NewPostModal from '../../components/NewPostModal.vue'
import PostList from '../../components/PostList.vue'
import PostsSidebar from '../../components/PostsSidebar.vue'

const { getPosts } = usePosts()
const { data, pending, refresh } = await getPosts()

const categories = [
  'Все',
  'Места в Москве',
  'День рождения',
  'Кейтеринг',
  'Свадьба',
  'Event-бизнес',
  'Рестораны',
  'Девичник'
]
</script>

<template>
  <div class="page-shell">
    <Header />

    <UCard class="hero-card" radius="xxl" border>
      <div class="hero-copy">
        <UBadge color="warning" variant="soft" size="sm">Журнал</UBadge>
        <h1>Пишем о мероприятиях: где, как и за сколько</h1>
        <p class="hero-lead">Промежуток между идеей и событием — это контент. Премиальный белый фон, лаконичная серая типографика и акцентные оранжевые детали.</p>
      </div>

      <div class="hero-action">
        <NewPostModal @created="refresh" />
      </div>
    </UCard>

    <UCard class="featured-panel" radius="xxl" border>
      <div class="featured-copy">
        <p class="subtitle">В подборке</p>
        <h2>Лучшие материалы для организаторов и заказчиков</h2>
        <p>Собрали ключевые публикации, чтобы открывать городские локации, планировать праздники и быстро выбрать подрядчика.</p>
      </div>
      <div class="featured-actions">
        <UButton variant="outline" size="sm" color="warning">Гид по площадкам</UButton>
        <UButton variant="outline" size="sm" color="warning">Тренды 2026</UButton>
      </div>
    </UCard>

    <section class="topics-row">
      <UButton
        v-for="category in categories"
        :key="category"
        variant="ghost"
        size="sm"
        color="warning"
        class="topic-pill"
      >
        {{ category }}
      </UButton>
    </section>

    <div class="content-layout">
      <main class="main-column">
        <div class="posts-header">
          <div>
            <p class="subtitle">НЕДАВНЕЕ</p>
            <h2>Последние статьи</h2>
          </div>
          <span class="posts-count">{{ data?.data?.length ?? 0 }} публикаций</span>
        </div>

        <div v-if="pending" class="skeleton-grid">
          <USkeleton v-for="i in 4" :key="i" class="skeleton-card" />
        </div>

        <div v-else>
          <PostList :posts="data?.data ?? []" />
        </div>
      </main>

      <PostsSidebar />
    </div>

    <Footer />
  </div>
</template>

<style scoped>
.page-shell {
  max-width: 1180px;
  margin: 0 auto;
  padding: 2.5rem 1.5rem 4rem;
}

.hero-card {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 1.75rem;
  align-items: center;
  padding: 2.4rem;
  background: var(--surface);
  border-radius: 36px;
  box-shadow: 0 22px 60px rgba(37, 45, 61, 0.08);
  margin-bottom: 1.75rem;
}

.hero-copy {
  max-width: 720px;
}

.hero-copy :deep(.u-badge) {
  border-radius: 999px;
}

.hero-copy h1 {
  margin: 1rem 0 1rem;
  font-size: clamp(2.2rem, 4vw, 3.6rem);
  line-height: 1.02;
  letter-spacing: -0.03em;
}

.hero-lead {
  margin: 0;
  max-width: 66ch;
  color: var(--muted);
  line-height: 1.85;
}

.hero-action {
  display: flex;
  justify-content: flex-end;
}

.featured-panel {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 1.5rem;
  align-items: center;
  padding: 1.9rem 2.2rem;
  background: rgba(217, 119, 6, 0.08);
  border-radius: 36px;
  margin-bottom: 1.75rem;
}

.featured-copy {
  max-width: 700px;
}

.featured-copy p {
  color: var(--muted);
  line-height: 1.75;
  margin: 0.85rem 0 0;
}

.featured-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.topics-row {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
  margin: 1.5rem 0;
}

.topic-pill {
  border-radius: 999px;
  letter-spacing: 0.02em;
}

.content-layout {
  display: grid;
  grid-template-columns: minmax(0, 1.7fr) minmax(320px, 0.9fr);
  gap: 2rem;
}

.posts-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.subtitle {
  margin: 0 0 0.35rem;
  color: var(--accent);
  font-size: 0.85rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.08em;
}

.posts-header h2 {
  margin: 0;
  font-size: 2.2rem;
}

.posts-count {
  color: var(--muted);
}

.skeleton-grid {
  display: grid;
  gap: 1.5rem;
}

.skeleton-card {
  min-height: 210px;
  border-radius: 32px;
}

@media (max-width: 980px) {
  .content-layout,
  .hero-card,
  .featured-panel {
    grid-template-columns: 1fr;
  }
}
</style>