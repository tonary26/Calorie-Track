import { defineStore } from 'pinia'
import api from "@/api.js"

export const useActivityLevelStore = defineStore('activity-level', {
    state: () => ({
        activityLevels: [],
        activityLevel: {}
    }),

    getters: {
    },

    actions: {
        async getActivityLevels () {
            try {
                const serverData = await api.get('activityLevels')
                const data = serverData.data

                this.activityLevels = data.activity_levels

                return data
            }
            catch(error) {
                console.log(error.message)
            }
        },

        async addActivityLevel(formData) {
            try {
                const serverData = await api.post('activityLevels', formData)
                const data = serverData.data

                this.activityLevel = data.activity_level

                return data
            }
            catch(error) {
                console.log(error.message)
            }
        }
    },
})