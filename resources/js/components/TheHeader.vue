<template>
    <div class="container-fuild">
        <div class="row text-white" style="background-color: #0c713d; padding: 1rem;">
            <div class="col-1 d-flex d-sm-none align-items-center justify-content-center">
                <span @click="showDrawer()">
                  <i class="fa-solid fa-align-justify"></i>
                </span>
            </div>
            <div class="col-10 col-sm-9 d-flex align-items-center justify-content-center justify-content-sm-start">
                <img src="../assets/logo.png" alt="Logo" heigh="32" width="34">
                <span class="d-none d-sm-flex">Quan tri</span>
            </div>

            <div class="col-sm-3 d-none d-sm-flex align-items-center justify-content-sm-end">
                <span>Admin</span>
            </div>
            <div class="col-1 d-flex d-sm-none align-items-center justify-content-center">
                <span @click="showDrawerUser()">
                  <i class="fa-solid fa-user"></i>
                </span>
            </div>
        </div>
    </div>

  <a-drawer
    v-model:visible="visible"
    title="Danh muc"
    placement="left"
  >
    <the-menu/>
  </a-drawer>
  <a-drawer
    v-model:visible="visible_user"
    title="User"
    placement="right"
  >
    <p>Some contents ...</p>
    <p>Some contents ...</p>
    <p>Some contents ...</p>
  </a-drawer>
</template>
<script>
import { defineComponent, ref } from 'vue';
import TheMenu from "./TheMenu.vue";
export default defineComponent({
  components: {
    TheMenu,
  },
  setup() {
    const visible = ref(false);
    const visible_user = ref(false);

    const showDrawer = () => {
      visible.value = true;
    };
    const showDrawerUser = () => {
        visible_user.value = true;
    }
    return {
      visible,
      visible_user,
      showDrawer,
      showDrawerUser
    };
  },
});
</script>
