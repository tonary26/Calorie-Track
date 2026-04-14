<script setup>
import { useAuthStore } from "@/stores/auth.js"
import { useRouter } from "vue-router"

defineOptions({
  name: 'ClientLayout'
})

const store = useAuthStore()

const router = useRouter()

const logout = async function () {
  await store.logout()

  router.push({
    name: 'dashboard.index'
  })
}
</script>

<template>
  <div class="header">
    <div class="nav-menu">

      <div class="left">
        <router-link
            :to="{ name: 'dashboard.index' }"
            class="nav-text">
          Calorie Track
        </router-link>
      </div>

      <div class="center">
        <router-link
            class="nav-text"
            :to="{ name: 'products.index' }">
          Products
        </router-link>

        <router-link
            class="nav-text"
            :to="{ name: 'nutrition.index' }">
          Nutrition
        </router-link>
      </div>

      <div class="right">
          <a
              @click="logout()"
              v-if="store.isAuthenticated"
              class="nav-text">
            Logout
          </a>

        <template v-else>
          <router-link
              :to="{ name: 'auth.register.index' }"
              class="nav-text">
            Register
          </router-link>

          <router-link
              :to="{ name: 'auth.login.index' }"
              class="nav-text">
            Login
          </router-link>
        </template>
      </div>
    </div>
  </div>
  <div class="main-wrapper">
    <slot />
  </div>
</template>

<style scoped>
.header {
  background-color: #058505;
}

.nav-menu {
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
  padding-right: 100px;
  padding-left: 100px;
  height: 100px;
}

.left,
.center,
.right {
  display: flex;
  gap: 20px;
}

.right,
.left {
  flex: 1;
}

.right {
  justify-content: flex-end;
}

.nav-text {
  color: white;
  font-size: 19px;
  text-decoration: none;
  cursor: pointer;
}

.main-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  font-size: 40px;
}
</style>