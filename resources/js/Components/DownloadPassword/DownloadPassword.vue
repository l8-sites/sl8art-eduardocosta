<script setup>
import * as func from '@/Helpers/functions';
import { inject } from "vue";
const swal = inject("$swal");
</script>

<script>
import * as yup from "yup";
import { pt } from 'yup-locale-pt';
import { useForm } from "@inertiajs/inertia-vue3";
import { send } from "@/Helpers/Api";
import Button from "@/Components/Button/Button.vue";
import Input from "@/Components/FormElements/Input.vue";
import Icon from '@/Components/Icon/Icon.vue'


export default {

    components:{
        Button,
        Icon,
        Input,
    },
    props: {
        linkDrive: '',
    },

    data() {
        return {
            showForm: false,
            password: '',
             accessGranted: false,
                     showModal: false,
            validator: {
                 password: ''
            },
            passwordcorrect: ''

        }
    },
    async mounted() {
      const res = await send('users_file')
      var user_pass = res.filter((r) => r.name == "contratante");
      this.passwordcorrect = user_pass[0].secret;
    },
    methods: {
         validate($attribute) {
            Object.keys(this.validator).forEach(key => {
                if ($attribute === key) {
                    this.validator[key] = ''
                }
            });

            this.schema
                .validate(this.form, { abortEarly: false })
                .then(() => {
                    //   this.errors.user = {};
                })
                .catch(err => {
                    //  this.errors.user = {};

                    err.inner.forEach((error) => {
                        if ($attribute === error.path) {
                            this.validator = { ...this.validator, [error.path]: error.message };
                        }
                    });
                });
        },
        async checkPassword() {
            try {
                // Definindo o esquema de validação
                const validationSchema = yup.object().shape({
                    password: yup.string().required('Senha é obrigatória').min(6, 'A senha deve ter no mínimo 6 caracteres')
                });

                // Valida apenas o campo de senha
                await validationSchema.validateAt('password', { password: this.password });

                // Se a validação for bem-sucedida
                if (this.password === passwordcorrect) {


                    this.$swal({
                        title: 'Seja bem-vindo!',
                        text: 'Para acessar os materiais, clique no botão abaixo!',
                        confirmButtonColor: '#02cc01',
                        confirmButtonText: '<a href="' + this.linkDrive + '" target="__blank"> Acessar</a>',
                        cancelButtonText: 'Não',
                        icon: 'success',
                        type: 'success',
                        allowOutsideClick: false,
                        background: 'bg-green',
                        customClass: {
                            confirmButton: 'sw-btn ',
                            popup: 'sw-popup',
                            title: 'sw-title',
                        }
                    });
                } else {
                    this.$swal({
                        title: "Senha incorreta!",
                        confirmButtonText: "ok",
                        icon: 'error',
                        type: 'error',
                        allowOutsideClick: false,
                        background: 'bg-orange',
                        customClass: {
                            confirmButton: 'sw-btn sw-btn--red',
                            popup: 'sw-popup',
                            title: 'sw-title',
                        }
                    });
                }

                // Limpa o erro de validação, se houver
                this.validator.password = '';
            } catch (error) {
                // Captura e exibe a mensagem de erro
                this.validator.password = error.message;
            }
        }
    }
}
</script>

<template>

    <div class="relative  h-[4rem] lg:h-[5rem]   lg:w-[17rem]">

        <!-- <Button type="button" @click="showForm = true" color="tertiary" size="lg" :class="[showForm ? 'opacity-0' : '']"
            class="ml-auto lg:text-5xl text-white  text-3xl mt-4 lg:mt-0 tracking-[.32rem]  w-full">
            CONTRATANTES
        </Button> -->
        <div v-if="showForm" class="absolute  -top-1 left-0  w-full">
            <form @submit.prevent="checkPassword" @keydown.enter.prevent="checkPassword" class="w-full ">

                <Input type="password" name="password" placeholder="Digite a senha" autocomplete="password"
                    v-model="password" :error="validator.password" @validate="validate('password')" />

                <Button type="submit" class="text-white bg-black absolute  -right-28 top-4">Enviar</Button>
            </form>
            <button @click="showForm = false" class="absolute top-7 right-3 bg-black pl-1">
                <Icon name="icon-close" class="w-4  object-contain fill-white" />
            </button>
        </div>

    </div>

</template>