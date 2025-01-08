<script>
import App from "@/Pages/App.vue";

export default {
    components: {
        App,
    },
    created() {
        document.body.style.overflow = 'auto'
    }
}
</script>

<template>
    <Head :title="'Política de Privacidade | ' + this.$title" />

    <App>
        <section class="c-privacy bg-white py-12 md:py-16">
            <div class="container max-w-4xl font-secondary">

                <h2 class="text-black text-3xl md:text-4xl font-bold pb-10 md:pb-16">
                    Política de Privacidade
                </h2>

                <h3 class="text-xl md:text-2xl font-bold text-black mb-3">
                    Privacidade
                </h3>
                <p class="text-black text-lg mb-4">
                    A privacidade dos visitantes do site é muito importante para nós.
                </p>
                <p class="text-black text-lg mb-4">
                    Reconhecemos a relevância da privacidade. Seus dados pessoais não serão comercializados,
                    distribuídos ou
                    compartilhados com terceiros, exceto em casos de cumprimento de ordens judiciais.
                </p>
                <p class="text-black text-lg mb-4">
                    Todas as informações pessoais relativas a membros, assinantes, clientes ou visitantes que usem este
                    site
                    serão tratadas em concordância com a Lei da Proteção de Dados Pessoais de 26 de outubro de 1998&nbsp;(Lei
                    n.º 67/98).
                </p>
                <p class="text-black text-lg mb-4">
                    Os dados relacionados a pagamentos utilizados nas compras nunca são armazenados em nossos servidores
                    e
                    as senhas são armazenadas em bancos de dados de maneira criptografada.
                </p>
                <p class="text-black text-lg mb-4">
                    Informações submetidas em nossas páginas de contato são utilizadas pela equipe de suporte ao cliente
                    apenas para a finalidade de ajuda e não serão compartilhadas.
                </p>
                <p class="text-black text-lg mb-8">
                    O endereço de e-mail está seguro e nunca será divulgado. Nós detectamos o spam e protegemos sua
                    privacidade integralmente.
                </p>
                <h3 class="text-xl md:text-2xl font-bold text-black mb-3">
                    Registros
                </h3>
                <p class="text-black text-lg mb-4">
                    Assim como outros websites, coletamos e usamos informações relativas aos registros. A informação
                    contida
                    nos registros inclui o seu endereço IP&nbsp;(Internet Protocol), o seu ISP&nbsp;(Internet Service
                    Provider), o navegador que utilizou ao visitar-nos, o tempo da sua visita e que páginas visitou
                    neste
                    site.
                </p>
                <p class="text-black text-lg mb-8">
                    Rastreamos a localização/endereços de protocolo de internet&nbsp;(IP)&nbsp;para fornecer serviços
                    livres
                    de spam e segurança para todos os nossos clientes.
                </p>
                <h3 class="text-xl md:text-2xl font-bold text-black mb-3">
                    Os Cookies e Web Beacons
                </h3>
                <p class="text-black text-lg mb-4">
                    Utilizamos cookies para armazenar informação, tais como as suas preferências pessoais quando visita
                    nosso site, isso poderá incluir um simples popup. Você detém o poder de desligar seus cookies nas
                    opções
                    do browser, ou efetuando alterações nas ferramentas de programas antivírus, como o Norton Internet
                    Security. No entanto, isso poderá modificar a forma de interagir neste ou em outros sites, como a
                    forma
                    de fazer login que pode ser prejudicada.
                </p>
                <p class="text-black text-lg mb-4">
                    Você pode optar por excluir a coleta e uso das informações para direcionamento de anúncios ou sair
                    de
                    nossa lista de e-mail clicando em “unsubscribe” ao final dos e-mails que recebe.
                </p>
                <p class="text-black text-lg mb-8">
                    Ao usar nossos sites, você concorda com a Política de Privacidade citada acima.
                </p>
                <h3 class="text-xl md:text-2xl font-bold text-black mb-3">
                    Ligações a Sites de Terceiros
                </h3>
                <p class="text-black text-lg mb-4">
                    Este site possui ligações para outros sites, os quais, a nosso ver, podem conter
                    informações/ferramentas
                    úteis para os nossos visitantes. A nossa política de privacidade não é aplicada a sites de
                    terceiros,
                    pelo que, caso visite outro site a partir do nosso deverá ler a política de privacidade do mesmo.
                </p>
                <p class="text-black text-lg ">
                    Não nos responsabilizamos pela política de privacidade ou conteúdo presente nesses mesmos sites.
                </p>
            </div>
        </section>
    </App>
</template>

<!--<style src="./style.scss" lang="scss" scoped/>-->
