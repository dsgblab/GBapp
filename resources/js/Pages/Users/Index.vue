<template>
    <AppLayout title="Usuarios del sistema">
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Usuarios del sistema
                </h2>
                <PrimaryButton type="button" class="ml-auto" @click="create" v-permission="'user.create'">
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
                                        Usuario
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Correo Electrónico
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Roles Asociados
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Permisos Asociados
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Reportes asociados
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Creado el
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actualizado el
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="user in records">
                                    <td class="px-6 py-4 text-center text-sm font-medium">
                                        <div class="flex flex-row">
                                            <Link :href="route('users.show', user.id)"
                                                  v-permission="'user.edit'"
                                                  class="mr-2 inline-flex items-center px-2 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                                <font-awesome-icon :icon="['far', 'pen-to-square']"/>
                                            </Link>

                                            <CustomButton @click="destroy(user.id)" v-permission="'user.destroy'">
                                                <font-awesome-icon :icon="['far', 'trash-can']"/>
                                            </CustomButton>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ user.name }}
                                    </td>

                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ user.username }}
                                    </td>

                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ user.email }}
                                    </td>

                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        <span
                                            class="text-xs font-semibold inline-block py-1 px-2 rounded text-indigo-600 bg-indigo-200 uppercase last:mr-0 mr-1"
                                            v-for="role in user.roles"
                                            v-if="user.roles.length > 0">
                                          {{ role.name }}
                                        </span>

                                        <span
                                            class="text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1"
                                            v-else>
                                          sin roles asociados
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        <span
                                            class="text-xs font-semibold inline-block py-1 px-2 rounded text-indigo-600 bg-indigo-200 uppercase last:mr-0 mr-1"
                                            v-for="permission in user.permissions"
                                            v-if="user.permissions.length > 0">
                                          {{ permission.name }}
                                        </span>

                                        <span
                                            class="text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1"
                                            v-else>
                                          sin permisos asociados
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        <span
                                            class="text-xs font-semibold inline-block py-1 px-2 rounded text-indigo-600 bg-indigo-200 uppercase last:mr-0 mr-1"
                                            v-for="report in user.reports"
                                            v-if="user.reports.length > 0">
                                          {{ report.name }}
                                        </span>

                                        <span
                                            class="text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1"
                                            v-else>
                                          sin reportes asociados
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ user.created_at }}
                                    </td>
                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ user.updated_at }}
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
                    <InputLabel value="Nombre"/>
                    <TextInput
                        v-model="modal.form.name"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.name.$error}"
                        required
                        autocomplete="off"
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
                    <InputLabel value="Usuario"/>
                    <TextInput
                        v-model="modal.form.username"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.username.$error}"
                        required
                        autocomplete="off"
                    />
                    <template v-if="v$.modal.form.username.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.username.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Correo electrónico"/>
                    <TextInput
                        v-model="modal.form.email"
                        type="email"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.email.$error}"
                        required
                        autocomplete="off"
                    />
                    <template v-if="v$.modal.form.email.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.email.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="block mt-4" v-if="modal.editMode">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="modal.form.change_password" name="change_password"/>
                        <span class="ml-2 text-sm text-gray-600">Cambiar contraseña</span>
                    </label>
                </div>

                <template v-if="modal.form.change_password || !modal.editMode ">
                    <div class="mt-4">
                        <InputLabel value="Contraseña"/>
                        <TextInput
                            v-model="modal.form.password"
                            type="password"
                            class="mt-1 block w-full"
                            :class="{'border-red-500': v$.modal.form.password.$error}"
                            required
                            autocomplete="off"
                        />
                        <template v-if="v$.modal.form.password.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.password.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div class="mt-4">
                        <InputLabel value="Confirmar Contraseña"/>
                        <TextInput
                            v-model="modal.form.confirm_password"
                            type="password"
                            class="mt-1 block w-full"
                            :class="{'border-red-500': v$.modal.form.confirm_password.$error}"
                            required
                            autocomplete="off"
                        />
                        <template v-if="v$.modal.form.confirm_password.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.confirm_password.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>
                </template>

                <div class="mt-4">
                    <InputLabel value="Reportes disponibles"/>
                    <div class="grid grid-cols-3 gap-5 mt-2">
                        <div class="flex items-center" v-for="report in reports">
                            <Checkbox v-model:checked="modal.form.reports" :value="report.id"/>
                            <div class="ml-2">
                                {{ report.name }}
                            </div>
                        </div>
                    </div>

                    <template v-if="v$.modal.form.reports.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.reports.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Roles Disponibles"/>
                    <div class="grid grid-cols-3 gap-5 mt-2">
                        <div class="flex items-center" v-for="role in roles">
                            <Checkbox v-model:checked="modal.form.roles" :value="role.name"/>
                            <div class="ml-2">
                                {{ role.name }}
                            </div>
                        </div>
                    </div>

                    <template v-if="v$.modal.form.roles.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.roles.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Permisos Disponibles"/>
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

import {useVuelidate} from '@vuelidate/core'
import {email, minLength, required, requiredIf, sameAs} from '@/Utils/i18n-validators.js'
import InputLabel from "@/Components/InputLabel.vue";
import Checkbox from "@/Components/Checkbox.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import CustomButton from "@/Components/CustomButton.vue";
import {Link} from "@inertiajs/vue3";

export default {
    setup() {
        return {v$: useVuelidate()}
    },

    components: {
        Link,
        CustomButton,
        FontAwesomeIcon,
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
        users: Array,
        roles: Array,
        permissions: Array,
        reports: Array
    },

    validations() {
        return {
            modal: {
                form: {
                    id: {
                        requiredIf: requiredIf(this.modal.editMode)
                    },
                    name: {
                        required
                    },
                    username: {
                        required
                    },
                    email: {
                        required,
                        email
                    },
                    password: {
                        requiredIf: requiredIf(this.modal.form.change_password || !this.modal.editMode),
                        minLength: minLength(8)
                    },
                    confirm_password: {
                        requiredIf: requiredIf(this.modal.form.change_password || !this.modal.editMode),
                        sameAs: sameAs(this.modal.form.password),
                        minLength: minLength(8)
                    },
                    reports: {
                        minLength: minLength(1)
                    },
                    permissions: {
                        requiredIf: requiredIf(this.modal.form.roles.length < 1),
                        minLength: minLength(1)
                    },
                    roles: {
                        requiredIf: requiredIf(this.modal.form.permissions.length < 1),
                        minLength: minLength(1)
                    },
                }
            }
        }
    },

    data() {
        return {
            records: this.users,
            modal: {
                title: '',
                editMode: false,
                open: false,
                form: {
                    id: '',
                    name: '',
                    username: '',
                    email: '',
                    change_password: false,
                    password: '',
                    confirm_password: '',
                    reports: [],
                    permissions: [],
                    roles: []
                },
            }
        }
    },

    methods: {
        create() {
            this.modal.open = true
            this.modal.title = 'Crear Usuario'
        },

        edit(row) {
            this.modal = {
                title: 'Editar Usuario',
                editMode: true,
                open: true,
                form: {
                    id: row.id,
                    name: row.name,
                    username: row.username,
                    email: row.email,
                    change_password: false,
                    password: '',
                    confirm_password: '',
                    reports: row.reports.map(row => row.id),
                    permissions: row.permissions.map(row => row.name),
                    roles: row.roles.map(row => row.name),
                },
            }
        },

        store() {
            this.v$.modal.form.$touch()

            if (this.v$.modal.form.$invalid) {
                this.$swal({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Verifica que toda la información este correctamente diligenciada'
                });
            } else {
                axios.post(route('users.store'), this.modal.form).then(resp => {
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

        update() {
            this.v$.modal.form.$touch()

            if (this.v$.modal.form.$invalid) {
                this.$swal({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Verifica que toda la información este correctamente diligenciada'
                });
            } else {
                axios.put(route('users.update', this.modal.form.id), this.modal.form).then(resp => {
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

        destroy(id) {
            this.$swal({
                icon: 'question',
                title: '¿Eliminar Usuario?',
                text: "¡Esta acción no es reversible!",
                showCancelButton: true,
                confirmButtonText: '¡Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(route('users.destroy', id)).then(resp => {
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

        closeModal() {
            this.modal = {
                title: '',
                editMode: false,
                open: false,
                form: {
                    id: '',
                    name: '',
                    username: '',
                    email: '',
                    change_password: false,
                    password: '',
                    confirm_password: '',
                    reports: [],
                    permissions: [],
                    roles: []
                },
            }

            this.v$.modal.form.$reset()
        }
    }
}
</script>
