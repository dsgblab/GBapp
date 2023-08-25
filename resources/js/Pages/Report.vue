<template>
    <AppLayout title="Reportes">
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Reportes
                </h2>

                <PrimaryButton type="button" class="ml-auto" @click="create" v-permission="'report.create'">
                    <font-awesome-icon icon="plus" class="mr-2"/>
                    Crear
                </PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-6 sm:px-6 lg:px-8">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ultima actualización
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="report in records" v-if="records.length > 0">
                                    <td class="px-6 py-4 text-center text-sm font-medium">
                                        <div class="flex flex-row">
                                            <Link :href="route('report.view', [report.group_id, report.report_id])" class="mr-2 inline-flex items-center px-2 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                                <font-awesome-icon :icon="['fas', 'arrow-up-right-from-square']" />
                                            </Link>
                                            <CustomButton class="mr-2"
                                                    @click="edit(report)"
                                                    v-permission="'report.edit'">
                                                <font-awesome-icon :icon="['far', 'pen-to-square']" />
                                            </CustomButton>
                                            <CustomButton @click="destroy(report.id)"
                                                          v-permission="'report.destroy'">
                                                <font-awesome-icon :icon="['far', 'trash-can']" />
                                            </CustomButton>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ report.name }}
                                    </td>

                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ report.updated_at }}
                                    </td>
                                </tr>

                                <tr v-else>
                                    <td colspan="9" class="px-6 py-4 text-center text-sm font-medium text-red-500">
                                        No se encontraron registros…
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <DialogModal :show="modal.open" @close="closeModal">
            <template #title>
                {{ modal.title }}
            </template>

            <template #content>
                <div class="mt-4">
                    <InputLabel value="Nombre" />
                    <TextInput
                        v-model="modal.form.name"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.name.$error}"
                        required
                        autocomplete="Nombre"
                    />
                    <template v-if="v$.modal.form.name.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.name.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Grupo" />
                    <TextInput
                        v-model="modal.form.group_id"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.group_id.$error}"
                        required
                        autocomplete="Grupo"
                    />
                    <template v-if="v$.modal.form.group_id.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.group_id.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Reporte" />
                    <TextInput
                        v-model="modal.form.report_id"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.report_id.$error}"
                        required
                        autocomplete="Reporte"
                    />
                    <template v-if="v$.modal.form.report_id.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.report_id.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Dataset" />
                    <TextInput
                        v-model="modal.form.dataset_id"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.dataset_id.$error}"
                        required
                        autocomplete="Dataset"
                    />
                    <template v-if="v$.modal.form.dataset_id.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.dataset_id.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal">
                    Cancelar
                </SecondaryButton>

                <PrimaryButton class="ml-3" @click="update" v-if="modal.editMode">
                    Actualizar
                </PrimaryButton>

                <PrimaryButton class="ml-3" @click="store" v-else>
                    Guardar
                </PrimaryButton>
            </template>
        </DialogModal>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import DialogModal from "@/Components/DialogModal.vue";
import Checkbox from "@/Components/Checkbox.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import {required, requiredIf, alpha} from "@/Utils/i18n-validators.js";
import {useVuelidate} from "@vuelidate/core";
import { Link } from '@inertiajs/vue3';
import CustomButton from "@/Components/CustomButton.vue";

export default {
    setup () {
        return { v$: useVuelidate() }
    },

    props: {
        reports: Array
    },

    components: {
        CustomButton,
        TextInput,
        SecondaryButton,
        Checkbox,
        DialogModal,
        InputLabel,
        DangerButton,
        PrimaryButton,
        AppLayout,
        Link
    },

    validations(){
        return {
            modal: {
                form: {
                    id: {
                        requiredIf: requiredIf(this.modal.editMode)
                    },
                    name: {
                        required
                    },
                    group_id: {
                        required,
                    },
                    report_id: {
                        required,
                    },
                    dataset_id: {
                        required,
                    },
                }
            }
        }
    },

    data() {
        return {
            records: this.reports,
            modal: {
                title: '',
                editMode: false,
                open: false,
                form: {
                    id: '',
                    name: '',
                    group_id: '',
                    report_id: '',
                    dataset_id: '',
                }
            }
        }
    },

    methods: {
        create(){
            this.modal.open = true
            this.modal.title = 'Agregar reporte'
        },

        edit(row){
            this.modal = {
                title: 'Editar reporte',
                editMode: true,
                open: true,
                form: {
                    id: row.id,
                    name: row.name,
                    group_id: row.group_id,
                    report_id: row.report_id,
                    dataset_id: row.dataset_id,
                },
            }
        },

        store(){
            this.v$.modal.form.$touch()

            if (this.v$.modal.form.$invalid){
                this.$swal({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Verifica que toda la información este correctamente diligenciada'
                });
            }else {
                axios.post(route('report.store'), this.modal.form).then(resp => {
                    this.closeModal()
                    this.records = resp.data
                }).catch(err => {
                    this.$swal({
                        icon: 'error',
                        title: 'ERROR',
                        text: err.response.data
                    });
                })
            }
        },

        update(){
            this.v$.modal.form.$touch()

            if (this.v$.modal.form.$invalid){
                this.$swal({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Verifica que toda la información este correctamente diligenciada'
                });
            }else {
                axios.put(route('report.update', this.modal.form.id), this.modal.form).then(resp => {
                    this.closeModal()
                    this.records = resp.data
                }).catch(err => {
                    this.$swal({
                        icon: 'error',
                        title: 'Error',
                        text: err.response.data
                    });
                })
            }
        },

        destroy(id){
            this.$swal({
                icon: 'question',
                title: '¿Eliminar reporte?',
                text: "¡Esta acción no es reversible!",
                showCancelButton: true,
                confirmButtonText: '¡Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(route('report.destroy', id)).then(resp => {
                        this.records = resp.data
                    }).catch(err => {
                        this.$swal({
                            icon: 'error',
                            title: 'Error',
                            text: err.response.data
                        });
                    })
                }
            })
        },

        closeModal(){
            this.modal = {
                title: '',
                editMode: false,
                open: false,
                form: {
                    id: '',
                    name: '',
                    group_id: '',
                    report_id: '',
                    dataset_id: '',
                },
            }
            this.v$.modal.form.$reset()
        }
    },
}

</script>

