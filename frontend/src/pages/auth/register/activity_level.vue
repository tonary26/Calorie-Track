<script setup>
import { useAuthStore } from "@/stores/auth.js"
import { ref, onMounted } from "vue"
import { useRouter } from "vue-router"

defineOptions({
  name: 'activity_level'
})

const store = useAuthStore()

const router = useRouter()

const selectedActivityLevel = ref(null)

const registerData = JSON.parse(localStorage.getItem('registerData'))

const confirmForm = async function () {
  if (!selectedActivityLevel.value) {
    alert('Select activity level!')
    return
  }

  await store.register({
    ...registerData,
    activity_level_id: selectedActivityLevel.value
  })

  router.push({
    name: 'auth.login.index'
  })
}

onMounted(async () => {
  await store.getActivityLevels()
})

</script>

<template>
  <div class="activity-levels-wrapper">
    <h2 class="title">Choose your activity level</h2>
    <div class="activity-levels">
      <div v-for="activity_level in store.activity_levels"
          :key="activity_level.id"
          class="activity-level-wrapper"
          @click="selectedActivityLevel = activity_level.id"
          :class="{ active: selectedActivityLevel === activity_level.id }">
        <span class="activity-level">{{ activity_level.name }}</span>
        <p class="activity-level-description">{{ activity_level.description }}</p>
      </div>
    </div>
  </div>
  <button @click="confirmForm()"
          type="submit"
          class="btn">
    Submit
  </button>
</template>

<style scoped>
  .activity-levels-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 48px 24px;
    gap: 32px;
  }

  .title {
    font-size: 24px;
    font-weight: 600;
    color: #1a4d2e;
    margin: 0;
    letter-spacing: -0.3px;
  }

  .activity-levels {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
  }

  .activity-level-wrapper {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 24px 20px;
    border-radius: 16px;
    border: 1.5px solid #d6eed9;
    background: #ffffff;
    box-shadow: 0 2px 16px rgba(34, 120, 60, 0.07);
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
    cursor: pointer;
  }

  .activity-level-wrapper:hover {
    border-color: #2e9e5b;
    box-shadow: 0 4px 24px rgba(46, 158, 91, 0.18);
    transform: translateY(-3px);
  }

  .activity-level-wrapper.active {
    border-color: #2e9e5b;
    background: #f0faf3;
  }

  .activity-level {
    font-size: 20px;
    font-weight: 600;
    color: #1a4d2e;
    text-decoration: none;
    transition: color 0.2s;
  }

  .activity-level:hover {
    color: #2e9e5b;
  }

  .activity-level-description {
    font-size: 14px;
    color: #5a8a6a;
    margin: 0;
    line-height: 1.5;
  }

  .btn {
    width: 300px;
    height: 50px;
    font-size: 22px;
    background-color: #1e9710;
    color: white;
    border: none;
    border-radius: 20px;
    transition: background-color 0.2s;
  }

  .btn:hover {
    background-color: #025602;
    color: #e4e3e3;
  }
</style>