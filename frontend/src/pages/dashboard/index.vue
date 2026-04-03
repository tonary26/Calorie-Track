<script setup>
import { useAuthStore } from "@/stores/auth.js"

defineOptions({
  name: 'index'
})

const store = useAuthStore()

</script>

<template>
  <div class="main">
    <div class="slogan-wrapper">
      <h1 class="slogan-text">Build the body of your dreams <a class="slogan-link" href="#">with us.</a></h1>
    </div>

    <template v-if="!store.isAuthenticated" >
      <router-link
          :to="{ name: 'auth.register.index' }"
          class="start-btn">
        Start
      </router-link>
    </template>

    <template v-else>
      <router-link
          :to="{ name: 'products.index' }"
          class="start-btn">
        Start
      </router-link>
    </template>
  </div>

</template>

<style scoped>
  .main {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    margin-top: 200px;
    font-size: 40px;
  }

  .slogan-text {
    color: #058505;
  }

  .slogan-text { color: #058505; }
  .slogan-link { color: #08e108; }

  .start-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    background-color: #058505;
    text-decoration: none;
    height: 100px;
    width: 180px;
    border-radius: 60px;
    border: 3px solid #036103;
    transition: background-color 0.2s;
  }

  .start-btn:hover {
    background-color: #025602;
    color: #e4e3e3;
  }

</style>