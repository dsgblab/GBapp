<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { PowerBIEmbedModule } from 'powerbi-client-vue-js';

const config = {
    type: "report",
    id: "",
    embedUrl: "",
    accessToken: "",
    tokenType: '',
    settings: {
        panes: {
            filters: {
                expanded: false,
                visible: false
            }
        },
        background: 'transparent',
    }
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <iframe title="GBLab BI" width="2500" height="1000" src="https://app.powerbi.com/reportEmbed?reportId=1da6dfbe-c3d4-4597-8f10-021843773608&autoAuth=true&embeddedDemo=true" frameborder="0" allowFullScreen="true"></iframe>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
