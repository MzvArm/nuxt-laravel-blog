<template>
  <div class="post-page">
    <UContainer>
      <UCard class="post-card" radius="3xl" border>
        <img
          v-if="post?.image_path"
          :src="post.image_path"
          :alt="post?.title"
          class="post-image"
        />

        <div class="card-head">
          <span class="post-meta"
            >{{ formatDate(post?.published_at || post?.created_at) }} · 3-5 мин
            чтения</span
          >
        </div>

        <h1>{{ post?.title || "Пост не найден" }}</h1>
        <p class="author">Автор: {{ post?.author }}</p>
        <p class="topic">Тема: {{ post?.topic }}</p>

        <div class="content" v-html="post?.content"></div>

        <div class="card-footer">
          <NuxtLink to="/posts">
            <UButton variant="ghost" size="sm" color="warning" class="u-button"
              >Назад к ленте</UButton
            >
          </NuxtLink>
        </div>
      </UCard>
    </UContainer>
  </div>
</template>

<script setup lang="ts">
import { computed } from "vue";

const route = useRoute();
const slug = route.params.slug as string;

const { getPost } = usePosts();
const { data: postData } = getPost(slug);

const post = computed(() => postData.value?.data);
// const post = computed(() => data.value?.data); //Тест

const formatDate = (date: string): string => {
  return new Date(date).toLocaleDateString("ru-RU", {
    day: "2-digit",
    month: "long",
    year: "numeric",
  });
};

const readingTime = computed(() => {
  if (!post.value?.content) return 0;
  const words = post.value.content.split(" ").length;
  return Math.ceil(words / 200); // Предполагаем 200 слов в минуту
});
</script>

<style scoped>
.post-page {
  padding: 2rem 0;
}

.post-card {
  max-width: 800px;
  margin: 0 auto;
}

.post-image {
  width: 100%;
  height: 300px;
  object-fit: cover;
  border-radius: 1rem;
  margin-bottom: 1rem;
}

.card-head {
  margin-bottom: 1rem;
}

.post-meta {
  color: #666;
  font-size: 0.9rem;
}

h1 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.author,
.topic {
  color: #666;
  margin-bottom: 0.5rem;
}

.content {
  line-height: 1.6;
  margin-bottom: 2rem;
  word-break: break-word;
  overflow-wrap: break-word;
}

.card-footer {
  border-top: 1px solid #eee;
  padding-top: 1rem;
}
</style>
