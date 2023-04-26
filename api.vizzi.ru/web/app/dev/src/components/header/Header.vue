<template>
    <section class="header-top bg-main-cyan w-full h-9 sm:hidden">
        <div class="container flex items-center mx-auto h-full">
            <p class="callback text-white underline">Перезвоните мне</p>
        </div>
    </section>
    <header class="header-btm sticky top-0 z-50 w-full shadow-md py-2 bg-white sm:hidden">
        <div class="container flex justify-between">

            <router-link to="/">
                <img src="/public/img/logo-main.svg" alt="logo">
            </router-link>

            <nav class="flex items-center">
                <ul class="flex gap-7">
                    <li><a href="#">Каталог лагерей</a></li>
                    <li><a href="#">О нас</a></li>
                    <li><a href="#">Как купить</a></li>
                    <li><a href="#">Контакты</a></li>
                </ul>
            </nav>
            <div class="header-btns flex gap-2">
                <btn-cashback />
                <btn-login />
            </div>
        </div>
    </header>
    <header
        class="header-mobile hidden sm:block bg-main-cyan sticky z-30 top-0">
        <div class="container sm:flex h-12 justify-between items-center">
            <div class="burger w-7 h-5 flex flex-col justify-between">
                <div class="burger-line h-[3px] w-full bg-white rounded-full"></div>
                <div class="burger-line h-[3px] w-full bg-white rounded-full"></div>
                <div class="burger-line h-[3px] w-full bg-white rounded-full"></div>
            </div>
            <div class="logo text-white">Logo</div>
            <div class="user">
                <img src="/public/img/icon-user-w.svg" alt="">
            </div>
        </div>

    </header>
</template>

<script>
import BtnCashback from './BtnCashback.vue'
import BtnLogin from './BtnLogin.vue'
export default {
    components: { BtnLogin, BtnCashback },

}
</script>

<style>
</style>