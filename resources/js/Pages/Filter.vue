<template>
    <AppLayout title="Filtros">
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Filtros
                </h2>

                <PrimaryButton type="button" class="ml-auto" @click="create" v-permission="'filter.create'">
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
                                        Tabla
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Columna
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Operador
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Valor
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Creado el
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="filter in records" v-if="records.length > 0">
                                    <td class="px-6 py-4 text-center text-sm font-medium">
                                        <div class="flex flex-row">
                                            <CustomButton class="mr-2"
                                                          @click="edit(filter)"
                                                          v-permission="'filter.edit'">
                                                <font-awesome-icon :icon="['far', 'pen-to-square']" />
                                            </CustomButton>
                                            <CustomButton @click="destroy(filter.id)"
                                                          v-permission="'filter.destroy'">
                                                <font-awesome-icon :icon="['far', 'trash-can']" />
                                            </CustomButton>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ filter.name }}
                                    </td>
                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ filter.table }}
                                    </td>

                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ filter.column }}
                                    </td>

                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ filter.operator }}
                                    </td>

                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ filter.values }}
                                    </td>
                                    <td class="px-6 py-4 text-left text-sm font-medium">
                                        {{ filter.created_at }}
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
                    <InputLabel value="Tabla" />
                    <TextInput
                        v-model="modal.form.table"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.table.$error}"
                        required
                    />
                    <template v-if="v$.modal.form.table.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.table.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Columna" />
                    <TextInput
                        v-model="modal.form.column"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.column.$error}"
                        required
                    />
                    <template v-if="v$.modal.form.column.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.column.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Operador" />
                    <TextInput
                        v-model="modal.form.operator"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.operator.$error}"
                        required
                    />
                    <template v-if="v$.modal.form.operator.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.operator.$errors" :key="index">
                                {{ error.$message }}
                            </li>
                        </ul>
                    </template>
                </div>

                <div class="mt-4">
                    <InputLabel value="Valor" />
                    <TextInput
                        v-model="modal.form.values"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{'border-red-500': v$.modal.form.values.$error}"
                        required
                    />
                    <template v-if="v$.modal.form.values.$error">
                        <ul class="mt-1">
                            <li class="text-red-500"
                                v-for="(error, index) of v$.modal.form.values.$errors" :key="index">
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
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import {Link} from "@inertiajs/vue3";
import CustomButton from "@/Components/CustomButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import DialogModal from "@/Components/DialogModal.vue";
import {useVuelidate} from "@vuelidate/core";
import {required, requiredIf} from "@vuelidate/validators";

export default {
    setup () {
        return { v$: useVuelidate() }
    },

    components: {
        DialogModal,
        InputLabel,
        SecondaryButton,
        CustomButton,
        Link,
        TextInput,
        PrimaryButton,
        AppLayout
    },

    props: {
        filters: Array
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
                    table: {
                        required
                    },
                    column: {
                        required,
                    },
                    operator: {
                        required,
                    },
                    values: {
                        required,
                    },
                }
            }
        }
    },

    data() {
        return {
            records: this.filters,
            modal: {
                title: '',
                editMode: false,
                open: false,
                form: {
                    id: '',
                    name: '',
                    table: '',
                    column: '',
                    operator: '',
                    values: '',
                }
            }
        }
    },

    methods: {
        store(){
            this.v$.modal.form.$touch()

            if (this.v$.modal.form.$invalid){
                this.$swal({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Verifica que toda la información este correctamente diligenciada'
                });
            }else {
                axios.post(route('filters.store'), this.modal.form).then(resp => {
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
                axios.put(route('filters.update', this.modal.form.id), this.modal.form).then(resp => {
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


        create(){
            this.modal.open = true
            this.modal.title = 'Agregar filtro'
        },

        edit(row){
            this.modal = {
                title: 'Editar filtro',
                editMode: true,
                open: true,
                form: {
                    id: row.id,
                    name: row.name,
                    table: row.table,
                    column: row.column,
                    operator: row.operator,
                    values: row.values,
                },
            }
        },

        destroy(id){
            this.$swal({
                icon: 'question',
                title: '¿Eliminar filtro?',
                text: "¡Esta acción no es reversible!",
                showCancelButton: true,
                confirmButtonText: '¡Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(route('filters.destroy', id)).then(resp => {
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
        }, // sudo mount -t nfs 192.168.1.49:/APLICACIONES/SERVIDOR12 /var/www/html/intranet_ci/assets/nfs_test

        closeModal(){
            this.modal = {
                title: '',
                editMode: false,
                open: false,
                form: {
                    id: '',
                    name: '',
                    table: '',
                    column: '',
                    operator: '',
                    values: '',
                },
            }
            this.v$.modal.form.$reset()
        }
    }
}
</script>
