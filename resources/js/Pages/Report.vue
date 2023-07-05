<template>
    <AppLayout title="Reportes">
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Reportes
                </h2>

                <PrimaryButton type="button" class="ml-auto" @click="create">
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
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Grupo
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Reporte
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dataset
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nivel de acceso
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Creado por
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Permiso
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="report in records">
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        {{ report.name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        {{ report.groupId }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        {{ report.reportId }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        {{ report.datasetId }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        {{ report.accessLevel }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        {{ report.user.name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        {{ report.permission }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <Link :href="route('report.view', [report.groupId, report.reportId])" class="mr-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                            Ver
                                        </Link>
                                        <SecondaryButton class="mr-2" @click="edit(report)">
                                            Editar
                                        </SecondaryButton>
                                        <DangerButton @click="destroy(report.id)">
                                            Eliminar
                                        </DangerButton>
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
                        v-model="modal.form.groupId"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.groupId.$error}"
                        required
                        autocomplete="Grupo"
                    />
                    <template v-if="v$.modal.form.groupId.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.groupId.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Reporte" />
                    <TextInput
                        v-model="modal.form.reportId"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.reportId.$error}"
                        required
                        autocomplete="Reporte"
                    />
                    <template v-if="v$.modal.form.reportId.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.reportId.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Dataset" />
                    <TextInput
                        v-model="modal.form.datasetId"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.datasetId.$error}"
                        required
                        autocomplete="Dataset"
                    />
                    <template v-if="v$.modal.form.datasetId.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.datasetId.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Nivel de acceso" />
                    <TextInput
                        v-model="modal.form.accessLevel"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.accessLevel.$error}"
                        required
                        autocomplete="Nivel de acceso"
                    />
                    <template v-if="v$.modal.form.accessLevel.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.accessLevel.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Permiso" />
                    <TextInput
                        v-model="modal.form.permission"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.permission.$error}"
                        required
                        autocomplete="Permiso"
                    />
                    <template v-if="v$.modal.form.permission.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.permission.$errors" :key="index">
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
import {required, requiredIf, alpha} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import { Link } from '@inertiajs/vue3';

export default {
    setup () {
        return { v$: useVuelidate() }
    },

    props: {
        reports: Array
    },

    components: {
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
                    groupId: {
                        required,
                    },
                    reportId: {
                        required,
                    },
                    accessLevel: {
                        required,
                    },
                    datasetId: {
                        required,
                    },
                    permission: {
                        required,
                        alpha
                    }
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
                    groupId: '',
                    reportId: '',
                    accessLevel: '',
                    datasetId: '',
                    permission: ''
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
                    groupId: row.groupId,
                    reportId: row.reportId,
                    accessLevel: row.accessLevel,
                    datasetId: row.datasetId,
                    permission: row.permission
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
                        title: 'ERROR',
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
                            title: 'ERROR',
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
                    groupId: '',
                    reportId: '',
                    accessLevel: '',
                    datasetId: '',
                    permission: ''
                },
            }

            this.v$.modal.form.$reset()
        }
    },



}

</script>

