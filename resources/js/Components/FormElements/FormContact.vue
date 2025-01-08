<script setup>
import * as func from '@/Helpers/functions';
</script>

<script>
import Input from "@/Components/FormElements/Input.vue";
import Select from "@/Components/FormElements/Select.vue";
import Textarea from "@/Components/FormElements/Textarea.vue";
import Button from "@/Components/Button/Button.vue";
import * as yup from "yup";
import {pt} from "yup-locale-pt";
import {send} from "@/Helpers/Api";
import { inject } from "vue";
const swal = inject("$swal");

export default {
    name: "FormContact",
    components:{
        Input,
        Select,
        Textarea,
        Button
    },
    emits: ['close'],
    props:{
        idDepartament: Number,
        departments: Object
    },
    data(){
        return{
            states: [],
            cities: [],
            typeEvent: [],
            recaptcha: import.meta.env.VITE_RECAPTCHA_KEY,
            form: {
                id: this.$id,
                token: "",
                name: "",
                phone: "",
                email: "",
                departament_id: "",
                date_show: "",
                time_show: "",
                place: "",
                type_event: "",
                state: "",
                city: "",
                message: "",
                processing: false,
            },
            isShow: false,
            loadingState: false,
            validator: {
                name: "",
                phone: "",
                email: "",
                city: "",
                type_event: "",
                state: "",
                message: "",
                date_show: "",
                time_show: "",
            },
            today: new Date(),
        }
    },
    methods:{
        onSubmit() {
            this.clearValidator();

            this.schema
                .validate(this.form, { abortEarly: false })
                .then(() => {
                    this.form.processing = true;

                    send("contact_create", this.form, "POST").then((res) => {

                        if (res.success === true) {
                            setTimeout(() => {
                                this.$swal({
                                    title: "Mensagem Enviada",
                                    text: "Sua mensagem foi enviada com sucesso!",
                                    confirmButtonText: "ok",
                                    icon: "success",
                                    type: "success",
                                    allowOutsideClick: false,
                                    confirmButtonColor: "#00a233",
                                    background: "bg-orange",
                                    customClass: {
                                        confirmButton: "sw-btn sw-btn--green",
                                        cancelButton: "sw-btn sw-btn--black-oultline",
                                        popup: "sw-popup",
                                        title: "sw-title",
                                    },
                                });
                                this.clearForm();
                            }, 500);
                            this.$emit('close')
                            this.form.processing = false;
                        } else {
                            setTimeout(() => {
                                this.form.processing = false;
                                this.closeModal();
                                this.$swal({
                                title: "Mensagem não enviada",
                                text: "Sua mensagem não foi enviada com sucesso!",
                                confirmButtonText: "ok",
                                icon: "error",
                                type: "error",
                                allowOutsideClick: false,
                                background: "bg-orange",
                                customClass: {
                                    confirmButton: "sw-btn sw-btn--red",
                                    cancelButton: "sw-btn sw-btn--black-oultline",
                                    popup: "sw-popup",
                                    title: "sw-title",
                                },
                            });
                            }, 500);
                        }
                        this.form.processing = false;
                    });
                })
                .catch((err) => {
                    this.form.processing = false;
                    err.inner.forEach((error) => {
                        this.validator = { ...this.validator, [error.path]: error.message };
                    });
                });
        },
        validate($attribute) {
            Object.keys(this.validator).forEach((key) => {
                if ($attribute === key) {
                    this.validator[key] = "";
                }
            });

            this.schema
                .validate(this.form, { abortEarly: false })
                .then(() => {
                    //   this.errors.user = {};
                })
                .catch((err) => {
                    //  this.errors.user = {};

                    err.inner.forEach((error) => {
                        if ($attribute === error.path) {
                            this.validator = { ...this.validator, [error.path]: error.message };
                        }
                    });
                });
        },
        async getCities(id) {
            this.form.city = ""
            await send("cities", id).then((response) => {
                setTimeout(() => {
                    this.loadingState = false;
                    this.cities = response;
                }, 1000);
            });
        },
        clearValidator() {
            this.validator = {
                name: "",
                phone: "",
                email: "",
                city: "",
                state: "",
                type_event: "",
                message: "",
                date_show: "",
                time_show: "",
            };
        },
        clearForm() {
            for (let index in this.form) {
                if (index !== "id" || index !== "token") this.form[index] = "";
            }
        },
    },
    async mounted() {
        this.form.departament_id = this.idDepartament

        this.states = await send('states')

        this.typeEvent = await send('type_event')

        yup.setLocale(pt);
        this.schema = yup.object().shape({
            name: yup.string().min(3, 'Digite ao menos 3 caracteres').required('Obrigatório'),
            email: yup.string().email('Informe um E-mail válido').min(8, 'E-mail incompleto').required('Obrigatório')
                .matches(func.emailRegex, "E-mail inválido"),
            phone: yup.string().min(14, 'Telefone inválido').required('Obrigatório'),
            message: yup.string().required('Obrigatório'),
            city: yup.string().required('Obrigatório'),
            state: yup.string().required('Obrigatório'),
            departament_id: yup.string().required('Obrigatório'),
            date_show: yup.string().when("departament_id", {
                is: () => this.isShow === true,
                then: (schema) => schema.required('Obrigatório'),
            }),
            time_show: yup.string().when("departament_id", {
                is: () => this.isShow === true,
                then: (schema) => schema.required('Obrigatório'),
            }),
            type_event: yup.string().when("departament_id", {
                is: () => this.isShow === true,
                then: (schema) => schema.required('Obrigatório'),
            }),
            place: yup.string().when("departament_id", {
                is: () => this.isShow === true,
                then: (schema) => schema.required('Obrigatório'),
            }),
        })
    },
    watch: {
        "form.state"() {
            this.loadingState = true
            this.getCities(this.form.state)
        },
        async "form.departament_id"() {
            await send("department").then((response) => {
                const department = response.find(
                    (element) => element.id == this.form.departament_id
                );
                this.isShow = department.is_show === true;
            });
        },
    },
}
</script>

<template>
    <form @submit.prevent="onSubmit">
        <div class="flex flex-col md:flex-row md:gap-6">
            <Input type="text" label="Nome" name="name" placeholder="Digite o nome"
                   autocomplete="name" v-model="form.name"
                   :error="validator.name"  @validate="validate('name')"/>

            <Input type="tel" label="Telefone" name="phone" placeholder="(00) 00000-0000"
                   autocomplete="tel" :error="validator.phone" v-model="form.phone"
                   v-mask="['(##) #####-####', '(##) ####-####']" @validate="validate('phone')" />
        </div>

        <div class="flex flex-col md:flex-row md:gap-6">
            <Input type="text" label="E-mail" :name="form.email" placeholder="email@email.com"
                   autocomplete="email" @validate="validate('email')" v-model="form.email"
                   :error="validator.email" />

            <Select label="Departamento:" :name="form.departament_id" text="Selecione" :error="validator.departament_id"
                    v-model="form.departament_id" @validate="validate('departament_id')">
                <option v-for="(item, index) in departments" :value="item.id" :key="index">
                    {{ item.description }}
                </option>
            </Select>
        </div>

        <div class="flex flex-col md:flex-row md:gap-6">
            <Input v-if="isShow" type="date" label="Data do Show" placeholder="dd/mm/aaaa"
                   :min="func.dateFormatInvert(today)"
                   @validate="validate('date_show')" :error="validator.date_show" v-model="form.date_show" />

            <Input v-if="isShow" type="time" label="Hora do Show" placeholder="--:--"
                   @validate="validate('time_show')" :error="validator.time_show" v-model="form.time_show" />
        </div>

        <div class="flex flex-col md:flex-row md:gap-6">
            <Input v-if="isShow" type="text" label="Local do Show" placeholder="Digite o local"
                   @validate="validate('place')" :error="validator.place" v-model="form.place" />

            <Select v-if="isShow" label="Tipo do Show" text="Selecione" name="type_event"
                    @validate="validate('type_event')" :error="validator.type_event" v-model="form.type_event">
                <option v-for="(event, index) in typeEvent" :value="event.id" :key="index">
                    {{ event.name }}
                </option>
            </Select>
        </div>

        <div class="flex flex-col md:flex-row md:gap-6">
            <Select label="Estado" name="state" text="Selecione"
                    :error="validator.state"
                    v-model="form.state"
                    @validate="validate('state')">
                <option v-for="(state, index) in states" :value="state.id" :key="index">
                    {{ state.name }}
                </option>
            </Select>

            <Select label="Cidade" name="city" text="Selecione"
                    :error="validator.city" v-model="form.city"
                    :loading="loadingState"
                    @validate="validate('city')">
                <template v-if="!loadingState">
                    <option v-for="(city, index) in cities" :value="city.id" :key="index">
                        {{ city.name }}
                    </option>
                </template>
            </Select>
        </div>

        <Textarea label="Mensagem" name="message" placeholder="Digite sua mensagem" rows="5"
                  @validate="validate('message')" :error="validator.message"
                  v-model="form.message" />

        <div class="flex justify-center mt-4">
            <Button type="submit" color="success" class="w-full md:w-4/12 rounded"
                    :disabled="form.processing" :loading="form.processing">
                Enviar E-mail
            </Button>
        </div>
    </form>
</template>

<style scoped>

</style>
