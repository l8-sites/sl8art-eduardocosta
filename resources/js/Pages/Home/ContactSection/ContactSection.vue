<script>
import Icon from "@/Components/Icon/Icon.vue";
import { Link } from '@inertiajs/inertia-vue3';
import {send} from "@/Helpers/Api";
import FormContact from "@/Components/FormElements/FormContact.vue";
import Modal from "@/Components/Modal/Modal.vue";
import Input from "@/Components/FormElements/Input.vue"
import { PhTruckTrailer } from "@phosphor-icons/vue";




export default {
    name: "ContactSection",
    props: {
        background: String,
        link_drive: "",
        isActive: Boolean,
        departments: Array,
    },
    components: {
        Icon,
        Link,
        FormContact,
        Modal,
        Input,
    },
    data() {
        return {
            bgDesktop: "url(" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgdesk_contact_cdn + ")",
            basic: this.$inertia.page.props.siteConfig.basic_configurations[0],
            departments: [],
            showModal: false,
            department_id: '',
            link_drive: this.$inertia.page.props.siteConfig.l8driver,
            isActive : false,
            expandedDepartment: null,
            expandedIndex: 0
        }
    },
    async mounted () {
        this.departments = await send('department');


        if(this.departments) {
            this.email = this.departments.email1;
            this.phone = this.departments.phone1;
            this.name_department = this.departments.description;
        }
    },
    methods: {
        openModal(id) {
            this.showModal = true;
            this.department_id = id;
            document.body.style.overflow = "hidden";
        },
        closeModal() {
            this.showModal = false;
            document.body.style.overflow = "auto";
        },
        toggleDetails(index) {
            this.expandedIndex = this.expandedIndex === index ? null : index;
        },
        beforeEnter(el) {
            el.style.maxHeight = "150px";
            el.style.opacity = "0";
        },
        enter(el, done) {
            el.style.transition = "max-height 0.5s ease-out, opacity 0.5s ease-in-out";
            el.style.maxHeight = el.scrollHeight + "px";
            el.style.opacity = "1";
            setTimeout(done, 100);
        },
        leave(el, done) {
            el.style.transition = "max-height 0.5s ease-in, opacity 0.5s ease-in-out";
            el.style.maxHeight = "150px";
            el.style.opacity = "0";
            setTimeout(done, 100);
        },

    },
    computed: {
        positionClass() {
            return this.departments.length > 0 ? 'lg:absolute bottom-0 left-0' : 'relative';
        }
    }
}
</script>

<template>
    <section class="py-12 c-contact md:py-16 " id="contact">
        <div class="container">
            <h2 class="z-[3]  text-4xl font-bold lg:text-6xl relative text-white py-10">CONTATO</h2>
            <div class="relative flex flex-col justify-between gap-10 lg:flex-row">
                <div class="z-[3] uppercase content-start mb-14 relative">
                    <span class="tracking-[0.5rem] text-white">downloads</span>
                    <div class="mt-8 text-3xl font-bold tracking-[0.2rem] ">
                        <a :href="'https://'+link_drive" class="px-3 py-3 bg-white lg:py-5 lg:px-6 hover:bg-secondary hover:text-white text-secondary">
                                contratantes
                        </a>
                    </div>
                </div>
                <div>
                    <div v-for="(department, index) in departments" :key="index" class="z-[3] mb-10 w-full text-white content-end">

                        <div class="flex items-center justify-center  gap-1 mb-2 rounded z-[2]">
                            <button class="button_email" @click="openModal(department.id)">
                                <Icon name="icon-mail" class="w-10 h-10 stroke-white"/>
                                <span class="hidden font-bold sm:block ">ENVIAR E-MAIL</span>
                            </button>
                            <span
                                class="w-full px-4 py-3 text-xl font-bold text-center uppercase cursor-pointer md:text-2xl bg-primary md:break-normal hover:opacity-80"
                                @click="toggleDetails(index)">
                                {{ department.description }}
                            </span>
                        </div>
                        <transition name="expand" @before-enter="beforeEnter" @enter="enter" @leave="leave">
                            <div v-if="expandedIndex === index" class="flex flex-col items-end gap-5 text-base md:text-xl bg-primary py-7 px-7">
                                <div class="flex flex-col gap-2">
                                    <span v-if="department.phone1" class="text-right hover:opacity-80 hover:ease-in-out hover:duration-300">{{ department.phone1 }}</span>
                                    <span v-if="department.phone2" class="text-right hover:opacity-80 hover:ease-in-out hover:duration-300">{{ department.phone2 }}</span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span v-if="department.email1" class="text-right break-all">{{ department.email1 }}</span>
                                    <span v-if="department.email2" class="text-right break-all">{{ department.email2 }}</span>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <Modal :show="showModal" :size="'md'" @close="closeModal()">
        <template #header>
            <h3 class="text-3xl font-bold text-center text-white uppercase lg:text-4xl font-secondary lg:mb-2">
                contato
            </h3>
        </template>

        <template #body>
            <FormContact v-if="department_id" :departments="departments" :idDepartament="department_id" @close="closeModal()"/>
        </template>

        <template #footer></template>
    </Modal>
</template>

<style src="./style.scss" lang="scss"></style>

<style lang="scss" scoped>
.c-contact {
    background: v-bind(bgDesktop) no-repeat center center !important;
}
</style>
