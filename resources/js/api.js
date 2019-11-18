export default {

    getSettings() {
        return window.axios
            .get(`/nova-vendor/nova-settings/settings`)
            .then(response => response.data);
    },

    updateSetting(data) {
        return window.axios
            .post(`/nova-vendor/nova-settings/settings`, data)
            .then(response => response.data);
    },

};