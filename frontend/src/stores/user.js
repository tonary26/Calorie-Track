import { defineStore } from 'pinia'
import api from "@/api.js"
import { useAuthStore } from "@/stores/auth.js"

export const useUserStore = defineStore('user', {
    state: () => ({
        users: [],
        user: JSON.parse(localStorage.getItem('user'))
    }),

    getters: {
    },

    actions: {
        async getUsers(search = '') {
            try {
                const serverData = await api.get('users', {
                    params: { search }
                })
                const data = serverData.data

                this.users = data.users
            }
            catch (error) {
                console.log(error.message)
            }
        },

        async updateUserRole(id, role) {
            try {
                const serverData = await api.patch(`users/${id}`, { role })
                const updateUser = serverData.data.user

                const index = this.users.findIndex(u => u.id === id)
                if (index !== -1) {
                    this.users[index] = updateUser
                }
            }
            catch (error) {
                console.log(error.message)
            }
        },

        async deleteUser(id) {
            try {
                await api.delete(`users/${id}`)

                const authStore = useAuthStore()

                const isSelfDeletion = authStore.user.id === id

                this.users = this.users.filter(u => u.id !== id)

                if (isSelfDeletion) {
                    await authStore.logout()
                }
            }
            catch (message) {
                console.log(message.error)
            }
        }
    },
})