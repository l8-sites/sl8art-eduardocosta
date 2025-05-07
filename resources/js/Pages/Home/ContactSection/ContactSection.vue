<script>
import Icon from "@/Components/Icon/Icon.vue";
import {Link} from '@inertiajs/inertia-vue3';
import {send} from "@/Helpers/Api";
import FormContact from "@/Components/FormElements/FormContact.vue";
import Modal from "@/Components/Modal/Modal.vue";
import Input from "@/Components/FormElements/Input.vue"
import {PhTruckTrailer} from "@phosphor-icons/vue";


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
            isActive: false,
            expandedIndex: null,
            isDesktop: window.innerWidth >= 1024,
        }
    },
    async mounted() {
        this.departments = await send('department');

        if (this.departments) {
            this.email = this.departments.email1;
            this.phone = this.departments.phone1;
            this.name_department = this.departments.description;
        }

        window.addEventListener('resize', this.handleResize);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.handleResize);
    },
    methods: {
        handleResize() {
            this.isDesktop = window.innerWidth >= 1024;
        },
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
            if (this.isDesktop) {
                this.expandedIndex = this.expandedIndex === index ? null : index;
            }
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
    <section class="w-full md:h-[120vh] h-[180vh] relative c-contact overflow-hidden" id="contact">
        <div class="absolute inset-0 z-0 bg-cover bg-center c-contact-blur"></div>

        <div class="container relative mx-auto px-4 h-full">
            <h2 class="text-4xl lg:text-6xl 2xl:text-7xl font-bold text-white py-10" data-aos="fade-up" data-aos-delay="400">CONTATO</h2>

            <div class="flex flex-col gap-10 lg:flex-row w-full h-full">

                <div class="flex flex-col gap-6 relative top-[940px] 2xl:top-[700px] md:top-[400px]">
                    <span class="uppercase tracking-[0.5rem] text-white text-lg">Downloads</span>
                    <div class="flex flex-col gap-4 text-2xl font-bold tracking-wide">
                        <a :href="'https://' + link_drive" class="px-4 py-3 w-1/3 sm:w-48 bg-white text-secondary hover:bg-secondary hover:text-white transition">
                            Rádios</a>
                        <a :href="'https://' + link_drive" class="px-4 py-3 w-1/2 sm:w-60 bg-white text-secondary hover:bg-secondary hover:text-white transition">
                            Imprensa</a>
                        <a :href="'https://' + link_drive" class="px-4 py-3 w-2/3 sm:w-60 bg-white text-secondary hover:bg-secondary hover:text-white transition">
                            Contratantes
                        </a>

                    </div>
                </div>


                <div class="flex flex-col md:top-14 2xl:top-28 gap-6 md:w-50 w-auto  md:items-end items-start md:right-0 absolute" data-aos="fade-up" data-aos-delay="400">
                    <div
                        v-for="(department, index) in departments"
                        :key="index"
                        class="flex flex-col gap-3">
          <span
              class="px-4 py-3 bg-primary text-white text-xl md:text-2xl font-bold uppercase text-center cursor-pointer hover:opacity-80 transition"
              @click="toggleDetails(index)" >
            {{ department.description }}
          </span>

                        <div
                            v-if="!isDesktop || expandedIndex === index"
                            class="bg-primary text-white px-6 py-5 flex flex-col gap-4 text-base md:text-xl text-right"
                        >
                            <div>
                                <span v-if="department.phone1">{{ department.phone1 }}</span>
                                <span v-if="department.phone2">{{ department.phone2 }}</span>
                            </div>
                            <div class="break-words">
                                <span v-if="department.email1">{{ department.email1 }}</span>
                                <span v-if="department.email2">{{ department.email2 }}</span>
                            </div>
                        </div>
                        <button
                            class="flex items-center justify-center gap-2 px-4 py-2 w-36 10 sm:w-44 bg-black hover:opacity-80 transition"
                            @click="openModal(department.id)">
                            <Icon name="icon-mail" class="w-6 h-6 stroke-white"/>
                            <span class="font-bold hidden md:block text-white">ENVIAR E-MAIL</span>
                        </button>
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
            <FormContact v-if="department_id" :departments="departments" :idDepartament="department_id"
                         @close="closeModal()"/>
        </template>

        <template #footer></template>
    </Modal>
</template>

<style src="./style.scss" lang="scss"></style>

<style lang="scss" scoped>
.c-contact {
    background: v-bind(bgDesktop) no-repeat center center!important;
    background-size: cover !important;

    @media (max-width: 768px) {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        background: v-bind(bgDesktop) no-repeat -350px !important;
        background-size: cover !important;
    }
}


</style>
