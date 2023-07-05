<template>
    <AppLayout :title="report.name">
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ report.name }}
                </h2>

            </div>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-6 sm:px-6 lg:px-8">
                {{ report.token}} <br>

                {{ report.userAccessToken }}

            </div>
        </div>
    </AppLayout>
</template>

<script>
import { PowerBIReportEmbed } from 'powerbi-client-vue-js';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
export default {
    props: {
        report: Object
    },

    components: {
        PrimaryButton,
        AppLayout,
        PowerBIReportEmbed
    },


}
</script>
