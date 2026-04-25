<template>
  <div class="new-post-block">
    <UButton color="warning" variant="solid" @click="open = true" class="u-button">Новый пост</UButton>

    <div v-if="open" class="modal-overlay" @click.self="open = false">
      <div class="modal-card">
        <div class="modal-header">
          <div>
            <p class="modal-label">Новый пост</p>
            <p class="modal-secondary">Заполните данные и добавьте публикацию</p>
          </div>
          <UButton type="button" variant="ghost" size="sm" class="modal-close u-button" @click="open = false">×</UButton>
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

          <div class="form-group">
            <label class="form-label">Тема</label>
            <select
              v-model="topic"
              class="form-select"
              required
            >
              <option value="" disabled>Выберите тему поста</option>
              <option v-for="opt in topicOptions" :key="opt.value" :value="opt.value">
                {{ opt.label }}
              </option>
            </select>
          </div>

          <UTextarea
            v-model="description"
            label="Описание поста"
            placeholder="Напишите краткое описание публикации…"
            :rows="6"
            required
          />

          <div class="form-group">
            <label class="form-label">Фотография</label>
            <div class="image-upload">
              <input
                ref="fileInput"
                type="file"
                accept="image/*"
                class="file-input"
                @change="handleImageSelect"
              />
              <label class="upload-label" @click.prevent="fileInput?.click()">
                <span v-if="!imagePreview" class="upload-text">
                  📷 Выберите фотографию
                </span>
                <img v-else :src="imagePreview" alt="Preview" class="image-preview" />
              </label>
            </div>
          </div>

          <div class="dialog-actions">
            <!-- <UButton type="button" variant="ghost" @click="open = false">Закрыть</UButton> -->
            <UButton type="submit" color="warning" :disabled="!canSubmit || loading" :loading="loading" class="u-button">
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
const imageFile = ref<File | null>(null)
const imagePreview = ref<string>('')
const fileInput = ref<HTMLInputElement | null>(null)

const topicOptions = [
  { label: 'Свадьба', value: 'Свадьба' },
  { label: 'День рождения', value: 'День рождения' },
  { label: 'Корпоратив', value: 'Корпоратив' },
  { label: 'Фотосессия', value: 'Фотосессия' },
  { label: 'Ресторан', value: 'Ресторан' },
  { label: 'Выпускной', value: 'Выпускной' },
  { label: 'Вечеринки', value: 'Вечеринки' }
]

const handleImageSelect = (event: Event) => {
  const target = event.target as HTMLInputElement
  const file = target.files?.[0]
  if (file) {
    imageFile.value = file
    const reader = new FileReader()
    reader.onload = (e) => {
      imagePreview.value = e.target?.result as string
    }
    reader.readAsDataURL(file)
  }
}

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
  imageFile.value = null
  imagePreview.value = ''
  if (fileInput.value) {
    fileInput.value.value = ''
  }
}

const handleSubmit = async () => {
  if (!canSubmit.value) return

  loading.value = true
  try {
    const today = new Date().toISOString().split('T')[0]
    const config = useRuntimeConfig()
    
    const formData = new FormData()
    formData.append('title', title.value)
    formData.append('author', author.value)
    formData.append('published_at', publishedAt.value || today)
    formData.append('topic', topic.value)
    formData.append('content', description.value)
    if (imageFile.value) {
      formData.append('image', imageFile.value)
    }

    await $fetch(`${config.public.apiBase}/posts`, {
      method: 'POST',
      body: formData
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
  overflow: visible;
}

.modal-card {
  width: min(100%, 540px);
  background: var(--surface);
  border-radius: 32px;
  box-shadow: 0 36px 80px rgba(15, 23, 42, 0.22);
  padding: 1.75rem;
  display: grid;
  gap: 1.5rem;
  position: relative;
  z-index: 1001;
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
  overflow: visible;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-label {
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--text);
}

.form-select {
  padding: 0.75rem 1rem;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  background-color: white;
  color: #1f2937;
  font-size: 1rem;
  font-family: Inter, system-ui;
  cursor: pointer;
  transition: border-color 0.2s, box-shadow 0.2s;
}

.form-select:hover {
  border-color: #d1d5db;
}

.form-select:focus {
  outline: none;
  border-color: #f97316;
  box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
}

.form-select option {
  padding: 0.5rem;
}

.image-upload {
  position: relative;
}

.file-input {
  display: none;
}

.upload-label {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 120px;
  border: 2px dashed #e5e7eb;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.2s;
  background-color: #fafafa;
}

.upload-label:hover {
  border-color: #f97316;
  background-color: #fffbf7;
}

.upload-text {
  font-size: 1rem;
  color: #6b7280;
  font-weight: 500;
}

.image-preview {
  max-width: 100%;
  max-height: 200px;
  object-fit: cover;
  border-radius: 8px;
  cursor: pointer;
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
