<template>
    <AppLayout :title="report.name">
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ report.name }}
                </h2>

                <PrimaryButton type="button" class="ml-auto" @click="toggle">
                    <font-awesome-icon icon="expand" class="mr-2"/>
                    Pantalla completa
                </PrimaryButton>
            </div>
        </template>

        <fullscreen v-model="fullscreen">
            <div class="py-12">
                <div class="max-w-8xl mx-6 sm:px-6 lg:px-8">
                    <PowerBIReportEmbed :embed-config="embedConfig" css-class-name="h-screen">
                    </PowerBIReportEmbed>
                </div>
            </div>
        </fullscreen>
    </AppLayout>
</template>

<script>
import {PowerBIReportEmbed} from 'powerbi-client-vue-js';
import {models} from "powerbi-client";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    props: {
        report: Object
    },

    components: {
        PrimaryButton,
        AppLayout,
        PowerBIReportEmbed,
    },

    data() {
        return {
            embedConfig: {
                type: "report",
                id: this.report.report_id,
                embedUrl: this.report.embedUrl,
                accessToken: this.report.token,
                tokenType: models.TokenType.Embed,
                pageView: 'fitToWidth',
                settings: {
                    panes: {
                        filters: {
                            expanded: false,
                            visible: false
                        }
                    },
                    background: models.BackgroundType.Transparent,
                },
                filters: JSON.parse(this.report.filter_array),
            },
            fullscreen: false,
        }
    },

    methods: {
        toggle() {
            this.fullscreen = !this.fullscreen
        },
    }
}
</script>
