import { defineStore } from 'pinia'
import api from "@/api.js"
import router from "@/router/router.js";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: JSON.parse(localStorage.getItem('user')),
        token: localStorage.getItem('token'),
        activity_levels: [],

    }),

    getters: {
        isAuthenticated: state => !!state.token,
    },

    actions: {
        async register(formData) {
            try {
                const serverData = await api.post('auth/register', formData)
                const data = serverData.data

                this.user = data.user

                return data
            }
            catch (error) {
                console.log(error.message)
            }
        },

        async getActivityLevels() {
            try {
                const serverData = await api.get('activityLevels')
                const data = serverData.data

                this.activity_levels = data.activity_levels

                return data
            }
            catch (error) {
                console.log(error.message)
            }
        },

        async login(formData) {
            try {
                const serverData = await api.post('auth/login', formData)
                const data = serverData.data

                this.user = data.user
                this.token = data.token

                localStorage.setItem('user', JSON.stringify(data.user))
                localStorage.setItem('token', data.token)

                return data
            }
            catch (error) {
                console.log(error.message)
            }
        },

        async logout() {
            try {
                await api.post('auth/logout')
                alert('You have successfully logged out of your account.')
            }
            catch (error) {
                console.log(error.message)
            }
            finally {
                localStorage.removeItem('user')
                localStorage.removeItem('token')

                this.user = null
                this.token = null

                delete api.defaults.headers.common['Authorization']

                router.push({
                    name: 'auth.login.index'
                })
            }
        }
    },
})