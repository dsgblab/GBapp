<template>
    <AppLayout title="Roles">
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Roles
                </h2>
                <PrimaryButton type="button" class="ml-auto" @click="create">
                    Crear
                </PrimaryButton>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                                        Permisos asociados
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Creado el
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actualizado el
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="role in records">
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        {{ role.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-indigo-600 bg-indigo-200 uppercase last:mr-0 mr-1"
                                              v-for="(permission, index) in role.permissions">
                                          {{ permission.name }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        {{ role.created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        {{ role.updated_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <SecondaryButton class="mr-2" @click="edit(role)">
                                            Editar
                                        </SecondaryButton>
                                        <DangerButton @click="destroy(role.id)">
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
                    <InputLabel value="Permisos Disponibles" />
                    <div class="grid grid-cols-3 gap-5 mt-2">
                        <div class="flex items-center" v-for="permission in permissions">
                            <Checkbox v-model:checked="modal.form.permissions" :value="permission.name"/>
                            <div class="ml-2">
                                {{ permission.name }}
                            </div>
                        </div>
                    </div>

                    <template v-if="v$.modal.form.permissions.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.permissions.$errors" :key="index">
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
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

import { useVuelidate } from '@vuelidate/core'
import { required, requiredIf, minLength } from '@vuelidate/validators'
import InputLabel from "@/Components/InputLabel.vue";
import Checkbox from "@/Components/Checkbox.vue";
import DangerButton from "@/Components/DangerButton.vue";

export default {
    setup () {
        return { v$: useVuelidate() }
    },

    components: {
        DangerButton,
        Checkbox,
        InputLabel,
        InputError, TextInput,
        PrimaryButton,
        SecondaryButton,
        AppLayout,
        DialogModal
    },

    props: {
        roles: Array,
        permissions: Array
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
                    permissions: {
                        required,
                        minLength: minLength(1)
                    },
                }
            }
        }
    },

    data(){
        return {
            records: this.roles,
            modal: {
                title: '',
                editMode: false,
                open: false,
                form: {
                    id: '',
                    name: '',
                    permissions: []
                },
            }
        }
    },

    methods: {
        create(){
            this.modal.open = true
            this.modal.title = 'Crear Rol'
        },

        edit(row){
            this.modal = {
                title: 'Editar Rol',
                editMode: true,
                open: true,
                form: {
                    id: row.id,
                    name: row.name,
                    permissions: row.permissions.map(row => row.name)
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
                axios.post(route('roles.store'), this.modal.form).then(resp => {
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
                axios.put(route('roles.update', this.modal.form.id), this.modal.form).then(resp => {
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
                title: '¿Eliminar Rol?',
                text: "¡Esta acción no es reversible!",
                showCancelButton: true,
                confirmButtonText: '¡Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(route('roles.destroy', id)).then(resp => {
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
                    permissions: []
                },
            }

            this.v$.modal.form.$reset()
        }
    }
}
</script>
