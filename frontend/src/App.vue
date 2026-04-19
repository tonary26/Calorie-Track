<script setup>
import ClientLayout from "@/pages/layouts/ClientLayout.vue"
import AdminLayout from "@/pages/layouts/AdminLayout.vue"
import { useRoute } from "vue-router"
import { computed } from "vue"

const route = useRoute()

const isAdmin = computed(() => {
  return route.name ? route.name.startsWith('admin') : false
})

</script>

<template>
  <template v-if="isAdmin === true">
    <AdminLayout>
      <router-view />
    </AdminLayout>
  </template>

  <template v-else>
    <ClientLayout>
      <router-view />
    </ClientLayout>
  </template>
</template>

<style scoped>

</style>
