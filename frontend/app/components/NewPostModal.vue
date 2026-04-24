<template>
  <div class="new-post-block">
    <UButton color="warning" variant="solid" @click="open = true">Новый пост</UButton>

    <div v-if="open" class="modal-overlay" @click.self="open = false">
      <div class="modal-card">
        <div class="modal-header">
          <div>
            <p class="modal-label">Новый пост</p>
            <p class="modal-secondary">Заполните данные и добавьте публикацию</p>
          </div>
          <UButton type="button" variant="ghost" size="sm" class="modal-close" @click="open = false">×</UButton>
        </div>

        <form class="new-post-form" @submit.prevent="handleSubmit()">
          <UInput
            v-model="title"
            label="Заголовок"
            placeholder="Например, Как я писал блог"
            required
          />

          <UInput
            v-model="author"
            label="Автор"
            placeholder="Например, Иван Иванов"
            required
          />

          <!-- <UInput
            v-model="publishedAt"
            label="Дата публикации"
            type="date"
            required
          /> -->

          <UInput
            v-model="topic"
            label="Тема"
            placeholder="Например, Кейтеринг, Свадьба"
            required
          />

          <UTextarea
            v-model="description"
            label="Описание поста"
            placeholder="Напишите краткое описание публикации…"
            :rows="6"
            required
          />

          <div class="dialog-actions">
            <UButton type="button" variant="ghost" @click="open = false">Закрыть</UButton>
            <UButton type="submit" color="warning" :disabled="!canSubmit || loading" :loading="loading">
              Добавить пост
            </UButton>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
const emit = defineEmits(['created'] as const)

const { createPost } = usePosts()
const open = ref(false)
const title = ref('')
const author = ref('')
const publishedAt = ref('')
const topic = ref('')
const description = ref('')
const loading = ref(false)

const canSubmit = computed(
  () =>
    title.value.trim() &&
    author.value.trim() &&
    // publishedAt.value.trim() &&
    topic.value.trim() &&
    description.value.trim()
)

const resetForm = () => {
  title.value = ''
  author.value = ''
  publishedAt.value = ''
  topic.value = ''
  description.value = ''
}

const handleSubmit = async () => {
  if (!canSubmit.value) return

  loading.value = true
  try {
    await createPost({
      title: title.value,
      author: author.value,
      published_at: publishedAt.value,
      topic: topic.value,
      content: description.value
    })
    resetForm()
    open.value = false
    emit('created')
  } catch (error) {
    console.error('Ошибка создания поста:', error)
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.new-post-block {
  display: flex;
  justify-content: flex-end;
}

.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(17, 25, 39, 0.62);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1.5rem;
  z-index: 1000;
}

.modal-card {
  width: min(100%, 540px);
  background: var(--surface);
  border-radius: 32px;
  box-shadow: 0 36px 80px rgba(15, 23, 42, 0.22);
  padding: 1.75rem;
  display: grid;
  gap: 1.5rem;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 1rem;
}

.modal-label {
  margin: 0;
  font-size: 1.25rem;
  font-weight: 700;
}

.modal-secondary {
  margin: 0.35rem 0 0;
  color: var(--muted);
  line-height: 1.6;
}

.modal-close {
  min-width: 2.5rem;
  min-height: 2.5rem;
  border-radius: 999px;
  font-size: 1.15rem;
  line-height: 1;
}

.new-post-form {
  display: grid;
  gap: 1rem;
}

.dialog-actions {
  display: flex;
  justify-content: flex-end;
  gap: 0.75rem;
  margin-top: 1rem;
}

@media (max-width: 640px) {
  .modal-card {
    padding: 1.25rem;
  }
}
</style>
