<template>
    <TheHeader />
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm-3 d-none d-sm-flex">
                <a-list bordered style="width: 100%;">
                    <the-menu/>
                    <template #header>
                        <div>Bang dieu khien</div>
                    </template>
                </a-list>
            </div>
            <div class="col-sm-9 col-12">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import TheHeader from '../components/TheHeader.vue';
import TheMenu from "../components/TheMenu.vue";

export default {
    components: {
        TheHeader,
        TheMenu
    }
}
</script>
