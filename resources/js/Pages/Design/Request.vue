<template>
    <AppLayout title="Diseño - Solicitudes">
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Diseño - Solicitudes
                </h2>

                <PrimaryButton type="button" class="ml-auto" @click="modal.open = true" v-permission="'design.state.create'">
                    <font-awesome-icon icon="plus" class="mr-2"/>
                    Nuevo
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
                                        #
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Prioridad
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Diseñador
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vendedor
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cliente
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Comentarios
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha de recepción
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha tentativa
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="row in table.data" v-if="table.data.length > 0">
                                        <td class="px-6 py-4 text-left text-sm font-medium">
                                            {{ row.id }}
                                        </td>
                                    </tr>

                                    <tr v-else>
                                        <td class="px-6 py-4 text-center text-red-500 text-sm font-medium" colspan="9">
                                            Sin registros…
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <DialogModal :show="modal.open" @close="closeModal" max-width="4xl">
            <template #title>
                Solicitud
            </template>

            <template #content>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <InputLabel value="Prioridad" />

                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                v-model="modal.form.priority_id"
                                :class="{'border-red-500': v$.modal.form.priority_id.$error}"
                                required>
                            <option value="" disabled selected>Seleccione…</option>
                            <option v-for="priority in priorities" :value="priority.id">{{ priority.name }}</option>
                        </select>

                        <template v-if="v$.modal.form.priority_id.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.priority_id.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Diseñador" />

                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                v-model="modal.form.priority_id"
                                :class="{'border-red-500': v$.modal.form.priority_id.$error}"
                                required>
                            <option value="" disabled selected>Seleccione…</option>
                            <option v-for="priority in priorities" :value="priority.id">{{ priority.name }}</option>
                        </select>

                        <template v-if="v$.modal.form.priority_id.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.priority_id.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Vendedor" />

                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                v-model="modal.form.priority_id"
                                :class="{'border-red-500': v$.modal.form.priority_id.$error}"
                                required>
                            <option value="" disabled selected>Seleccione…</option>
                            <option v-for="priority in priorities" :value="priority.id">{{ priority.name }}</option>
                        </select>

                        <template v-if="v$.modal.form.priority_id.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.priority_id.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Cliente" />

                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                v-model="modal.form.priority_id"
                                :class="{'border-red-500': v$.modal.form.priority_id.$error}"
                                required>
                            <option value="" disabled selected>Seleccione…</option>
                            <option v-for="priority in priorities" :value="priority.id">{{ priority.name }}</option>
                        </select>

                        <template v-if="v$.modal.form.priority_id.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.priority_id.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Estado" />

                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                v-model="modal.form.state_id"
                                :class="{'border-red-500': v$.modal.form.state_id.$error}"
                                required>
                            <option value="" disabled selected>Seleccione…</option>
                            <option v-for="state in states" :value="state.id">{{ state.name }}</option>
                        </select>

                        <template v-if="v$.modal.form.state_id.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.state_id.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Estado de tiempo" />

                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                v-model="modal.form.time_state_id"
                                :class="{'border-red-500': v$.modal.form.time_state_id.$error}"
                                required>
                            <option value="" disabled selected>Seleccione…</option>
                            <option v-for="time_state in time_states" :value="time_state.id">{{ time_state.name }}</option>
                        </select>

                        <template v-if="v$.modal.form.time_state_id.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.time_state_id.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Fecha de recepción" />

                        <VueDatePicker
                            :class="{'border-red-500': v$.modal.form.reception_date.$error}"
                            v-model="modal.form.reception_date"
                            locale="es"
                            cancelText="Cancelar"
                            selectText="Seleccionar"
                            :enable-time-picker="false"
                            :teleport="true"/>

                        <template v-if="v$.modal.form.reception_date.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.reception_date.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Fecha tentativa" />

                        <VueDatePicker
                            :class="{'border-red-500': v$.modal.form.tentative_date.$error}"
                            v-model="modal.form.tentative_date"
                            locale="es"
                            cancelText="Cancelar"
                            selectText="Seleccionar"
                            :enable-time-picker="false"
                            :teleport="true"/>

                        <template v-if="v$.modal.form.tentative_date.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.tentative_date.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Fecha real" />

                        <VueDatePicker
                            :class="{'border-red-500': v$.modal.form.real_date.$error}"
                            v-model="modal.form.real_date"
                            locale="es"
                            cancelText="Cancelar"
                            selectText="Seleccionar"
                            :enable-time-picker="false"
                            :teleport="true"/>

                        <template v-if="v$.modal.form.real_date.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.real_date.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Fecha de entrega" />

                        <VueDatePicker
                            :class="{'border-red-500': v$.modal.form.delivery_date.$error}"
                            v-model="modal.form.delivery_date"
                            locale="es"
                            cancelText="Cancelar"
                            selectText="Seleccionar"
                            :enable-time-picker="false"
                            :teleport="true"/>

                        <template v-if="v$.modal.form.delivery_date.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.delivery_date.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Fecha aprobación cliente" />

                        <VueDatePicker
                            :class="{'border-red-500': v$.modal.form.customer_approved_date.$error}"
                            v-model="modal.form.customer_approved_date"
                            locale="es"
                            cancelText="Cancelar"
                            selectText="Seleccionar"
                            :enable-time-picker="false"
                            :teleport="true"/>

                        <template v-if="v$.modal.form.customer_approved_date.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.customer_approved_date.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Fecha aproximada sherpa" />

                        <VueDatePicker
                            :class="{'border-red-500': v$.modal.form.estimated_arrival_sherpa_date.$error}"
                            v-model="modal.form.estimated_arrival_sherpa_date"
                            locale="es"
                            cancelText="Cancelar"
                            selectText="Seleccionar"
                            :enable-time-picker="false"
                            :teleport="true"/>

                        <template v-if="v$.modal.form.estimated_arrival_sherpa_date.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.estimated_arrival_sherpa_date.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Comentarios" />

                        <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full resize-none"
                                  v-model="modal.form.comments"
                                  :class="{'border-red-500': v$.modal.form.comments.$error}"
                                  required cols="30" rows="2" ></textarea>

                        <template v-if="v$.modal.form.comments.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.comments.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>

                    <div>
                        <InputLabel value="Observaciones" />

                        <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full resize-none"
                                  v-model="modal.form.observations"
                                  :class="{'border-red-500': v$.modal.form.observations.$error}"
                                  required cols="30" rows="2" ></textarea>

                        <template v-if="v$.modal.form.observations.$error">
                            <ul class="mt-1">
                                <li class="text-red-500"
                                    v-for="(error, index) of v$.modal.form.observations.$errors" :key="index">
                                    {{ error.$message }}
                                </li>
                            </ul>
                        </template>
                    </div>
                </div>




            </template>

            <template #footer>
                <SecondaryButton @click="closeModal">
                    Cancelar
                </SecondaryButton>
            </template>

        </DialogModal>
    </AppLayout>
</template>


<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {useVuelidate} from "@vuelidate/core";
import {required} from "@vuelidate/validators";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
    components: {
        InputLabel,
        TextInput,
        FontAwesomeIcon,
        SecondaryButton,
        DialogModal,
        PrimaryButton,
        AppLayout,
        VueDatePicker
    },

    setup () {
        return { v$: useVuelidate() }
    },

    props: {
        requests: Array,
        priorities: Array,
        time_states: Array,
        states: Array
    },

    validations(){
        return {
            modal: {
                form: {
                    priority_id: {required},
                    designer_id: {required},
                    seller_id: {required},
                    customer_id: {required},
                    comments: {required},
                    reception_date: {required},
                    tentative_date: {required},
                    real_date: {required},
                    delivery_date: {required},
                    customer_approved_date: {required},
                    estimated_arrival_sherpa_date: {required},
                    time_state_id: {required},
                    state_id: {required},
                    observations: {required},
                }
            }
        }
    },

    data(){
        return {
            table: {
                data: this.requests
            },

            modal: {
                open: false,
                editMode: false,
                form: {
                    priority_id: '',
                    designer_id: '',
                    seller_id: '',
                    customer_id: '',
                    comments: '',
                    reception_date: '',
                    tentative_date: '',
                    real_date: '',
                    delivery_date: '',
                    customer_approved_date: '',
                    estimated_arrival_sherpa_date: '',
                    time_state_id: '',
                    state_id: '',
                    observations: ''
                }
            }
        }
    },

    methods: {
        store(){

        },

        update(){

        },

        closeModal(){
            this.modal = {
                open: false,
                editMode: false,
                form: {
                    priority_id: '',
                    designer_id: '',
                    seller_id: '',
                    customer_id: '',
                    comments: '',
                    reception_date: '',
                    tentative_date: '',
                    real_date: '',
                    delivery_date: '',
                    customer_approved_date: '',
                    estimated_arrival_sherpa_date: '',
                    time_state_id: '',
                    state_id: '',
                    observations: ''
                }
            }
        }
    }

}
</script>
