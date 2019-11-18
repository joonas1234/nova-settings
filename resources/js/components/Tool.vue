<template>
    <loading-view :loading="loading">
        <div class="card">
            <div class="relative"><!----> 
                <div class="overflow-hidden overflow-x-auto relative">
                    <table cellpadding="0" cellspacing="0" class="table w-full">
                        <thead>
                        <tr>
                            <th class="text-left">
                                {{ __('Key') }}
                            </th> 
                            <th class="text-left">
                                {{ __('Value') }}
                            </th>
                            
                            <th></th>
                        </tr>
                        </thead> 
                        <tbody v-if="settings">
                            <tr v-for="(value, key) in settings" :key="key">
                                <td>
                                    <div class="text-left text-left">
                                        <span class="whitespace-no-wrap">{{ key }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-left">{{ value }}</span>
                                </td>
                                <td>
                                    <span>
                                        <button @click="openEditModal(key, value)" class="cursor-pointer text-70 hover:text-primary mr-3" :title="__('Edit')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" aria-labelledby="edit" role="presentation" class="fill-current"><path d="M4.3 10.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM6 14h2.59l9-9L15 2.41l-9 9V14zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h6a1 1 0 1 1 0 2H2v14h14v-6z"></path></svg>
                                        </button>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <update-modal v-if="updateModalOpen" :data="editingSetting" @update="updateSetting" @cancel="closeEditModal"></update-modal>

        </div>
    </loading-view>
</template>

<script>

import api from '../api';
import UpdateModal from './UpdateModal';

export default {
    components: {
        UpdateModal
    },
    async created() {
        return api.getSettings().then(settings => {
            this.settings = settings;
            this.loading = false;
        });

    },

    data() {
        return {
            loading: true,
            settings: [],
            updateModalOpen: false,
            editingSetting: null
        };
    },

    methods: {
        openEditModal(key, value) {
            this.editingSetting = {'key': key, 'value': value};
            this.updateModalOpen = true;
        },
        closeEditModal() {
            this.updateModalOpen = false;
            this.editingSetting = null;
        },
        updateSetting(data) {
            api.updateSetting(data).then(editedSetting => {
                this.closeEditModal();
                this.settings[editedSetting.key] = editedSetting.value;
            });
        },
    }

}
</script>
